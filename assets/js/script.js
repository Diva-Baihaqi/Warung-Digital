// State
let cart = JSON.parse(localStorage.getItem("warung_cart")) || [];
const WA_NUMBER = "6282125184884"; // Sync with config

// DOM Elements
const cartDrawer = document.getElementById("cartDrawer");
const cartOverlay = document.getElementById("cartOverlay");
const cartItemsContainer = document.getElementById("cartItems");
const cartTotalElement = document.getElementById("cartTotal");
const cartCountElement = document.getElementById("cartCount");

// Initialize
document.addEventListener("DOMContentLoaded", () => {
  updateCartUI();
});

// Toggle Drawer
function toggleCart() {
  if (cartDrawer.classList.contains("translate-x-full")) {
    // Open
    cartDrawer.classList.remove("translate-x-full");
    cartOverlay.classList.remove("hidden");
    setTimeout(() => cartOverlay.classList.remove("opacity-0"), 10);
  } else {
    // Close
    cartDrawer.classList.add("translate-x-full");
    cartOverlay.classList.add("opacity-0");
    setTimeout(() => cartOverlay.classList.add("hidden"), 300);
  }
}

// Add Item
function addToCart(id, name, price, image, qty = 1) {
  if (typeof IS_LOGGED_IN !== "undefined" && !IS_LOGGED_IN) {
    if (window.alertRedirect) {
      alertRedirect(
        "Silahkan login terlebih dahulu untuk belanja!",
        "member/login.php"
      );
    } else {
      alert("Silahkan login terlebih dahulu untuk belanja!");
      window.location.href = "member/login.php";
    }
    return;
  }

  const existingIndex = cart.findIndex((item) => item.id === id);

  if (existingIndex > -1) {
    cart[existingIndex].qty += parseInt(qty);
  } else {
    cart.push({
      id,
      name,
      price,
      image,
      qty: parseInt(qty),
    });
  }

  saveCart();
  updateCartUI();
  showToast("Berhasil masuk keranjang!", "success");
  toggleCart(); // Auto open cart on add
}

// Remove Item
function removeFromCart(index) {
  cart.splice(index, 1);
  saveCart();
  updateCartUI();
}

// Update Qty in Cart
function updateCartQty(index, change) {
  if (cart[index].qty + change <= 0) {
    removeFromCart(index);
    return;
  }
  cart[index].qty += change;
  saveCart();
  updateCartUI();
}

// Save to LocalStorage
function saveCart() {
  localStorage.setItem("warung_cart", JSON.stringify(cart));
}

// Render UI
function updateCartUI() {
  // 1. Update Badge
  const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
  if (cartCountElement) {
    cartCountElement.innerText = totalItems;
    if (totalItems === 0) cartCountElement.classList.add("hidden");
    else cartCountElement.classList.remove("hidden");
  }

  // 2. Render Items
  if (cartItemsContainer) {
    cartItemsContainer.innerHTML = "";
    let total = 0;

    if (cart.length === 0) {
      cartItemsContainer.innerHTML = `
                <div class="text-center py-10 opacity-50 font-bold uppercase">
                    Keranjang Kosong
                </div>
            `;
    }

    cart.forEach((item, index) => {
      const itemTotal = item.price * item.qty;
      total += itemTotal;

      const html = `
                <div class="flex gap-4 border-4 border-black p-4 bg-white shadow-neo-sm">
                    <div class="w-16 h-16 border-2 border-black flex-shrink-0 overflow-hidden bg-gray-100">
                        ${
                          item.image
                            ? `<img src="uploads/${item.image}" class="w-full h-full object-cover">`
                            : '<div class="w-full h-full flex items-center justify-center">📦</div>'
                        }
                    </div>
                    <div class="flex-1">
                        <h4 class="font-black uppercase text-sm leading-tight mb-1">${
                          item.name
                        }</h4>
                        <div class="flex justify-between items-center">
                            <span class="font-bold">Rp ${item.price.toLocaleString(
                              "id-ID"
                            )}</span>
                            <div class="flex border-2 border-black">
                                <button onclick="updateCartQty(${index}, -1)" class="px-2 font-black hover:bg-gray-200">-</button>
                                <span class="px-2 font-bold border-x-2 border-black text-sm pt-0.5">${
                                  item.qty
                                }</span>
                                <button onclick="updateCartQty(${index}, 1)" class="px-2 font-black hover:bg-gray-200">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
      cartItemsContainer.innerHTML += html;
    });

    // 3. Update Footer Total
    if (cartTotalElement) {
      cartTotalElement.innerText = `Rp ${total.toLocaleString("id-ID")}`;
    }
  }
}

// Checkout Process
async function checkoutProcess() {
  if (typeof IS_LOGGED_IN !== "undefined" && !IS_LOGGED_IN) {
    if (window.alertRedirect) {
      alertRedirect(
        "Silahkan login terlebih dahulu untuk checkout!",
        "member/login.php"
      );
    } else {
      alert("Silahkan login terlebih dahulu untuk checkout!");
      window.location.href = "member/login.php";
    }
    return;
  }

  if (cart.length === 0) return;

  // Loading state (optional UI feedback)
  const btn = document.querySelector("#cartDrawer button");
  const originalText = btn.innerText;
  btn.innerText = "Memproses...";
  btn.disabled = true;

  try {
    const response = await fetch("checkout_process.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ cart: cart }),
    });

    const result = await response.json();

    if (result.success) {
      cart = [];
      saveCart();
      updateCartUI();
      toggleCart();
      // showToast("Pesanan berhasil! Menunggu konfirmasi admin.", "success");
      window.location.href = "member_orders.php";
    } else {
      showToast(result.message, "error");
    }
  } catch (err) {
    console.error(err);
    showToast("Gagal memproses pesanan", "error");
  } finally {
    btn.innerText = originalText;
    btn.disabled = false;
  }
}

// Utility Toast
function showToast(message, type = "success") {
  let container = document.getElementById("toast-container");
  if (!container) {
    container = document.createElement("div");
    container.id = "toast-container";
    container.className =
      "fixed bottom-4 right-4 z-[60] flex flex-col gap-2 pointer-events-none";
    document.body.appendChild(container);
  }

  const toast = document.createElement("div");
  const bgColor =
    type === "success" ? "bg-neo-secondary" : "bg-red-500 text-white";

  toast.className = `${bgColor} border-4 border-black p-4 shadow-neo flex items-center gap-3 transform translate-y-full opacity-0 transition-all duration-300 pointer-events-auto min-w-[300px]`;
  toast.innerHTML = `
        <span class="text-2xl">${type === "success" ? "✅" : "❌"}</span>
        <div class="font-bold uppercase">${message}</div>
    `;

  container.appendChild(toast);
  requestAnimationFrame(() =>
    toast.classList.remove("translate-y-full", "opacity-0")
  );
  setTimeout(() => {
    toast.classList.add("opacity-0", "translate-y-2");
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}
