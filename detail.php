<?php
include 'config/database.php';
include 'includes/public_header.php';

if (!isset($_GET['id'])) header("Location: index.php");
$id = $_GET['id'];
$query = "SELECT p.*, k.nama_kategori FROM produk p LEFT JOIN kategori k ON p.kategori_id = k.id WHERE p.id = $id";
$result = $conn->query($query);

if ($result->num_rows == 0) header("Location: index.php");
$row = $result->fetch_assoc();
?>

<style>
    body {
        background-color: #ffffff !important;
        background-image: none !important;
    }
</style>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 mb-20 animate-fade-in-up items-start">
    <!-- Gallery Section -->
    <div class="relative lg:col-span-5 xl:col-span-4">
        <div class="bg-white border-4 border-black p-2 shadow-neo-lg sticky top-24">
            <div class="bg-gray-100 border-2 border-black aspect-square flex items-center justify-center overflow-hidden relative">
                 <?php if(!empty($row['gambar']) && file_exists('uploads/' . $row['gambar'])): ?>
                    <img src="uploads/<?= $row['gambar'] ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <span class="text-6xl">📦</span>
                <?php endif; ?>
                
                <!-- Floating Badge -->
                <div class="absolute top-4 left-4 bg-neo-accent border-4 border-black px-4 py-2 rotate-3 font-black uppercase text-sm shadow-neo-sm">
                    Best Seller
                </div>
            </div>
            <!-- Thumbnails (Static for visual) -->
            <div class="grid grid-cols-4 gap-2 mt-4">
                <?php for($i=0; $i<4; $i++): ?>
                <div class="border-2 border-black aspect-square bg-gray-200 cursor-pointer hover:bg-neo-secondary transition-colors"></div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="lg:col-span-7 xl:col-span-8">
        <div class="mb-2">
            <a href="index.php" class="text-sm font-bold uppercase text-gray-500 hover:text-black hover:underline">&larr; Kembali</a>
        </div>
        
        <h1 class="text-4xl md:text-6xl font-black uppercase leading-none mb-4"><?= $row['nama_produk'] ?></h1>
        
        <div class="flex items-center gap-4 mb-6">
            <span class="bg-black text-white px-3 py-1 font-bold uppercase text-sm"><?= $row['nama_kategori'] ?></span>
            <div class="flex text-neo-secondary">
                ★★★★★ <span class="text-black ml-2 text-sm font-bold">(142 Ulasan)</span>
            </div>
        </div>

        <div class="flex items-center justify-between border-b-4 border-black pb-8 mb-8 border-dashed">
            <span class="text-5xl font-black">Rp <?= number_format($row['harga'], 0, ',', '.') ?></span>
            <div class="text-right">
                <div class="text-sm font-bold uppercase text-gray-500">Stok Tersedia</div>
                <div class="text-2xl font-black bg-yellow-200 border-2 border-black px-3 inline-block transform -rotate-2">
                    <?= $row['stok'] ?>
                </div>
            </div>
        </div>

        <div class="mb-8 prose max-w-none">
            <h3 class="font-black uppercase text-xl mb-2">Deskripsi Produk</h3>
            <p class="font-medium text-lg leading-relaxed mb-4"><?= $row['deskripsi'] ?></p>
            
            <h3 class="font-black uppercase text-xl mb-2">Spesifikasi & Garansi</h3>
            <ul class="list-disc list-inside font-bold space-y-2 marker:text-neo-accent">
                <li>Garansi Full 30 Hari</li>
                <li>Support 24/7 via WhatsApp</li>
                <li>Akun Legal & Private (Bukan Sharing)</li>
                <li>Proses Kilat 1-5 Menit</li>
            </ul>
        </div>

        <!-- Action Buttons -->
        <?php if ($row['stok'] > 0): ?>
        <div class="flex flex-col sm:flex-row gap-4 sticky bottom-4 z-40 bg-neo-bg py-4 border-t-4 border-black sm:border-t-0 sm:py-0 sm:static">
            <div class="flex items-center border-4 border-black bg-white w-full sm:w-auto">
                <button onclick="updateQty(-1)" class="px-4 py-3 font-black text-xl hover:bg-gray-200">-</button>
                <input type="number" id="qty" value="1" min="1" max="<?= $row['stok'] ?>" class="w-12 text-center font-black text-xl border-x-4 border-black h-full focus:outline-none appearance-none m-0">
                <button onclick="updateQty(1)" class="px-4 py-3 font-black text-xl hover:bg-gray-200">+</button>
            </div>
            
            <button onclick="addToCart(<?= $row['id'] ?>, '<?= $row['nama_produk'] ?>', <?= $row['harga'] ?>, '<?= $row['gambar'] ?>', document.getElementById('qty').value)" 
                    class="flex-1 bg-neo-accent text-black border-4 border-black py-4 px-8 font-black uppercase text-xl shadow-neo hover:shadow-neo-lg hover:-translate-y-1 active:translate-y-1 active:shadow-none transition-all">
                Tambah Keranjang
            </button>
            
            <button onclick="beliLangsung()" class="flex-1 bg-neo-secondary text-black border-4 border-black py-4 px-8 font-black uppercase text-xl shadow-neo hover:shadow-neo-lg hover:-translate-y-1 active:translate-y-1 active:shadow-none transition-all">
                Beli Langsung
            </button>
        </div>
        <?php else: ?>
        <div class="bg-gray-200 border-4 border-black p-4 text-center">
            <h3 class="text-2xl font-black uppercase text-gray-500">Stok Habis</h3>
            <p class="font-bold">Produk ini sedang tidak tersedia.</p>
        </div>
        <?php endif; ?>
        
        <script>
            function updateQty(change) {
                const qtyInput = document.getElementById('qty');
                let newValue = parseInt(qtyInput.value) + change;
                if (newValue < 1) newValue = 1;
                qtyInput.value = newValue;
            }

            function beliLangsung() {
                if (typeof IS_LOGGED_IN !== 'undefined' && !IS_LOGGED_IN) {
                    alert("Silahkan login terlebih dahulu untuk beli!");
                    window.location.href = "member_login.php";
                    return;
                }

                const id = <?= $row['id'] ?>;
                const name = '<?= $row['nama_produk'] ?>';
                const price = <?= $row['harga'] ?>;
                const image = '<?= $row['gambar'] ?>';
                const qty = parseInt(document.getElementById('qty').value);

                // Get current cart
                let cart = JSON.parse(localStorage.getItem("warung_cart")) || [];
                
                // Add or Update
                const existingIndex = cart.findIndex((item) => item.id === id);
                if (existingIndex > -1) {
                    cart[existingIndex].qty += qty;
                } else {
                    cart.push({ id, name, price, image, qty });
                }

                // Save to localStorage
                localStorage.setItem("warung_cart", JSON.stringify(cart));
                
                // Redirect directly to checkout
                window.location.href = 'checkout.php';
            }
        </script>
        
        <!-- Trust Badges -->
        <div class="mt-8 grid grid-cols-3 gap-4 text-center">
            <div class="border-2 border-black p-2 bg-white">
                <span class="block text-2xl">⚡</span>
                <span class="text-xs font-bold uppercase">Proses Cepat</span>
            </div>
            <div class="border-2 border-black p-2 bg-white">
                <span class="block text-2xl">🛡️</span>
                <span class="text-xs font-bold uppercase">Aman Legal</span>
            </div>
            <div class="border-2 border-black p-2 bg-white">
                <span class="block text-2xl">💬</span>
                <span class="text-xs font-bold uppercase">Support 24/7</span>
            </div>
        </div>
    </div>
</div>

<!-- Related Products -->
<?php
$cat_id = $row['kategori_id'];
// Fetch related products: same category, different ID
$related_sql = "SELECT * FROM produk WHERE kategori_id = '$cat_id' AND id != '$id' ORDER BY RAND() LIMIT 4";
$related_res = $conn->query($related_sql);

if ($related_res->num_rows > 0):
?>
<div class="border-t-4 border-black py-12">
    <h3 class="text-3xl font-black uppercase mb-8">Kamu Mungkin Suka</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <?php while($rel = $related_res->fetch_assoc()): ?>
        <a href="detail.php?id=<?= $rel['id'] ?>" class="block bg-white border-4 border-black p-4 hover:-translate-y-2 hover:shadow-neo transition-all group">
            <div class="aspect-square bg-gray-100 border-2 border-black mb-4 overflow-hidden relative flex items-center justify-center">
                 <?php if(!empty($rel['gambar']) && file_exists('uploads/' . $rel['gambar'])): ?>
                    <img src="uploads/<?= $rel['gambar'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <?php else: ?>
                    <span class="text-4xl grayscale">📦</span>
                <?php endif; ?>
            </div>
            <h4 class="font-black uppercase text-sm leading-tight mb-2 truncate"><?= $rel['nama_produk'] ?></h4>
            <div class="font-bold text-neo-accent">Rp <?= number_format($rel['harga'], 0, ',', '.') ?></div>
        </a>
        <?php endwhile; ?>
    </div>
</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
