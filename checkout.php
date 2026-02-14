<?php
include 'config/database.php';

if (!isMemberLoggedIn()) {
    header("Location: member/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_sql = "SELECT * FROM pelanggan WHERE id = '$user_id'";
$user = $conn->query($user_sql)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Warung Digital</title>
    
    <!-- Fonts & Tailwind -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'neo-bg': '#FFFDF5',
                        'neo-black': '#000000',
                        'neo-accent': '#FF6B6B', // Red
                        'neo-secondary': '#FFD93D', // Yellow
                        'neo-white': '#FFFFFF',
                    },
                    fontFamily: {
                        'sans': ['"Space Grotesk"', 'sans-serif'],
                    },
                    boxShadow: {
                        'neo-sm': '4px 4px 0px 0px #000',
                        'neo': '8px 8px 0px 0px #000',
                    }
                }
            }
        }
    </script>
    <!-- ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>/assets/js/neo-alert.js"></script>
</head>
<body class="bg-neo-bg text-neo-black min-h-screen flex flex-col font-sans">
    
    <!-- Navbar (Minimalist) -->
    <nav class="border-b-4 border-black bg-white sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center max-w-7xl">
            <a href="index.php" class="text-3xl font-black uppercase tracking-tighter">
                WARUNG<span class="text-neo-accent">DIGITAL</span>
            </a>
            <span class="font-bold border-l-4 border-black pl-4 ml-4">Checkout Aman</span>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-7xl flex-grow">
        <div id="checkout-container" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start opacity-0 transition-opacity duration-300">
            
            <!-- Left Column: Order Details -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Identity & Contact Info -->
                <div class="bg-white border-4 border-black p-6 shadow-neo">
                    <h2 class="text-xl font-black uppercase mb-4 border-b-2 border-black pb-2 flex items-center gap-2">
                        <span>👤</span> Identitas Penerima
                    </h2>
                    <div class="space-y-4">
                        <!-- Name & Email (Read Only) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                                <div class="font-black text-lg bg-gray-100 border-2 border-black p-2">
                                    <?= $user['nama'] ?>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-500 uppercase mb-1">Email (Akun)</label>
                                <div class="font-black text-lg bg-gray-100 border-2 border-black p-2 truncate">
                                    <?= $user['email'] ?>
                                </div>
                            </div>
                        </div>

                        <!-- Address / Contact Input -->
                        <div>
                            <label class="block text-sm font-bold text-gray-500 uppercase mb-1">
                                Nomor WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="whatsapp_number" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full border-2 border-black p-3 font-bold bg-white focus:bg-yellow-50 transition-colors outline-none text-lg" placeholder="Contoh: 081234567890" value="<?= preg_replace('/[^0-9]/', '', $user['alamat'] ?? '') ?>">
                            <p class="text-sm text-gray-500 font-bold mt-1">
                                *Masukan hanya angka. Nomor ini akan digunakan untuk pengiriman detail pesanan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white border-4 border-black p-6 shadow-neo">
                    <h2 class="text-xl font-black uppercase mb-4 border-b-2 border-black pb-2 flex items-center gap-2">
                        <span>📦</span> Daftar Pesanan
                    </h2>
                    <div id="order-items" class="space-y-4">
                        <!-- Items rendered via JS -->
                    </div>
                </div>
            </div>

            <!-- Right Column: Summary & Payment -->
            <div class="lg:col-span-4 sticky top-24 space-y-6">
                <div class="bg-white border-4 border-black p-6 shadow-neo">
                    <h2 class="text-xl font-black uppercase mb-4 border-b-2 border-black pb-2">Ringkasan Belanja</h2>
                    
                    <div class="space-y-2 mb-4 font-bold text-gray-600">
                        <div class="flex justify-between">
                            <span>Total Harga (<span id="total-items">0</span> barang)</span>
                            <span id="subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Layanan</span>
                            <span>Rp 1.000</span> <!-- Flat fee example -->
                        </div>
                    </div>
                    
                    <div class="border-t-4 border-black border-dashed py-4 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="font-black text-lg uppercase">Total Tagihan</span>
                            <span id="grand-total" class="font-black text-2xl text-neo-accent">Rp 0</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-black uppercase mb-2">Metode Pembayaran</label>
                        <select id="payment-method" onchange="updatePaymentInfo()" class="w-full border-4 border-black p-3 font-bold bg-white text-lg mb-4">
                            <option value="bca">Transfer Bank BCA</option>
                            <option value="mandiri">Transfer Bank Mandiri</option>
                            <option value="gopay">GoPay / QRIS</option>
                            <option value="ovo">OVO</option>
                        </select>

                        <!-- Dynamic Payment Info -->
                        <div id="payment-info" class="bg-neo-bg border-4 border-black p-4 text-center">
                            <!-- Content injected by JS -->
                        </div>
                    </div>

                    <button id="btn-pay" onclick="processCheckout()" class="w-full bg-neo-secondary border-4 border-black py-4 font-black uppercase text-xl shadow-neo hover:shadow-neo-lg hover:-translate-y-1 active:translate-y-1 active:shadow-none transition-all">
                        Bayar Sekarang
                    </button>
                    
                    <div class="text-center mt-4">
                        <a href="index.php" class="text-sm font-bold underline hover:text-neo-accent">Batal & Kembali Belanja</a>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Empty State (Hidden by default) -->
        <div id="empty-cart" class="hidden text-center py-20">
            <div class="text-8xl mb-6">🛒</div>
            <h1 class="text-4xl font-black uppercase mb-4">Keranjang Kosong</h1>
            <p class="text-xl font-bold text-gray-500 mb-8">Wah, keranjangmu masih kosong nih. Yuk isi dulu!</p>
            <a href="index.php" class="inline-block bg-neo-accent border-4 border-black px-8 py-4 font-black uppercase shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all">
                Mulai Belanja
            </a>
        </div>

    </main>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed bottom-4 right-4 z-[60] flex flex-col gap-2 pointer-events-none"></div>

    <script>
        // Use cart from localStorage
        let cart = JSON.parse(localStorage.getItem("warung_cart")) || [];
        const fee = 1000;

        const paymentDetails = {
            bca: {
                title: 'Bank BCA',
                account: '1234567890',
                name: 'WARUNG DIGITAL',
                icon: '🏦'
            },
            mandiri: {
                title: 'Bank Mandiri',
                account: '1230009876543',
                name: 'WARUNG DIGITAL',
                icon: '🏦'
            },
            ovo: {
                title: 'OVO',
                account: '081234567890',
                name: 'WARUNG DIGITAL',
                icon: '📱'
            },
            gopay: {
                title: 'QRIS / GoPay',
                image: 'uploads/checkout/gopayqr.png',
                instruction: 'Scan QR di bawah ini'
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            if (cart.length === 0) {
                document.getElementById('checkout-container').classList.add('hidden');
                document.getElementById('empty-cart').classList.remove('hidden');
            } else {
                renderCheckoutItems();
                document.getElementById('checkout-container').classList.remove('opacity-0');
                updatePaymentInfo(); // Init payment info
            }
        });

        function updatePaymentInfo() {
            const method = document.getElementById('payment-method').value;
            const infoDiv = document.getElementById('payment-info');
            const data = paymentDetails[method];

            if (method === 'gopay') {
                infoDiv.innerHTML = `
                    <div class="font-bold mb-2">${data.instruction}</div>
                    <img src="${data.image}" class="mx-auto w-48 border-2 border-black" alt="QRIS Code">
                `;
            } else {
                infoDiv.innerHTML = `
                    <div class="text-4xl mb-2">${data.icon}</div>
                    <div class="font-bold uppercase text-sm text-gray-500 mb-1">${data.title}</div>
                    <div class="font-black text-2xl tracking-widest mb-1 select-all bg-white border-2 border-black inline-block px-2">${data.account}</div>
                    <div class="font-bold text-sm">A.N ${data.name}</div>
                `;
            }
        }

        function renderCheckoutItems() {
            const container = document.getElementById('order-items');
            let subtotal = 0;
            let totalQty = 0;
            container.innerHTML = '';

            cart.forEach(item => {
                const total = item.price * item.qty;
                subtotal += total;
                totalQty += item.qty;

                const html = `
                    <div class="flex gap-4 border-b-2 border-dashed border-gray-300 pb-4 last:border-0 last:pb-0">
                        <div class="w-20 h-20 border-2 border-black bg-gray-100 flex-shrink-0 flex items-center justify-center overflow-hidden">
                            ${item.image ? `<img src="uploads/${item.image}" class="w-full h-full object-cover">` : '<span class="text-2xl">📦</span>'}
                        </div>
                        <div class="flex-1">
                            <h3 class="font-black uppercase text-lg leading-tight mb-1">${item.name}</h3>
                            <div class="text-gray-500 font-bold text-sm mb-2">${item.qty} x Rp ${item.price.toLocaleString('id-ID')}</div>
                        </div>
                        <div class="font-black text-lg">
                            Rp ${total.toLocaleString('id-ID')}
                        </div>
                    </div>
                `;
                container.innerHTML += html;
            });

            // Update Summary
            document.getElementById('total-items').innerText = totalQty;
            document.getElementById('subtotal').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('grand-total').innerText = 'Rp ' + (subtotal + fee).toLocaleString('id-ID');
        }

        async function processCheckout() {
            const btn = document.getElementById('btn-pay');
            const waNumber = document.getElementById('whatsapp_number').value;
            const payment = document.getElementById('payment-method').value;

            if (waNumber.trim() === '') {
                alert('Silahkan isi Nomor WhatsApp terlebih dahulu!');
                return;
            }
            
            // Basic validation for length (e.g., at least 9 or 10 digits) - Optional but good for UX
             if (waNumber.length < 9) {
                 alert('Nomor WhatsApp yang anda masukan terlalu pendek.');
                 return;
             }

            // Loading
            const originalText = btn.innerText;
            btn.innerText = 'Memproses...';
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');

            try {
                // Include address and payment method in payload
                const payload = {
                    cart: cart,
                    address: waNumber,
                    payment_method: payment,
                    service_fee: fee
                };

                const response = await fetch('actions/checkout_process.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (result.success) {
                    // Clear cart
                    localStorage.removeItem('warung_cart');
                    // Redirect
                    window.location.href = 'member/orders.php';
                } else {
                    alert('Gagal: ' + result.message);
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan sistem.');
            } finally {
                btn.innerText = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    </script>
</body>
</html>
