<?php
include 'config/database.php';
include 'includes/public_header.php';

$where = "";
if (isset($_GET['q'])) {
    $q = $conn->real_escape_string($_GET['q']);
    $where = "WHERE nama_produk LIKE '%$q%' OR deskripsi LIKE '%$q%'";
}

$sql = "SELECT p.*, k.nama_kategori FROM produk p LEFT JOIN kategori k ON p.kategori_id = k.id $where ORDER BY p.created_at DESC";
$result = $conn->query($sql);
?>

<!-- Hero Section -->
<?php if(empty($_GET['q'])): ?>
<div class="mb-16 bg-neo-black text-white border-4 border-black p-8 md:p-12 relative overflow-hidden shadow-neo-lg">
    <div class="absolute top-0 right-0 w-64 h-64 bg-neo-accent rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 -translate-y-1/2"></div>
    <div class="relative z-10">
        <span class="bg-neo-secondary text-black px-4 py-1 font-black uppercase text-sm border-2 border-black mb-4 inline-block transform -rotate-2">Promo Spesial</span>
        <h1 class="text-5xl md:text-7xl font-black uppercase mb-6 leading-none tracking-tighter">
            Digital<br>
            <span class="text-stroke-white-2 text-transparent">Lifestyle</span>
        </h1>
        <p class="text-xl font-bold max-w-xl mb-8">Upgrade gaya hidup digitalmu dengan akun premium termurah se-jagad raya. Legal, aman, dan bergaransi.</p>
        <a href="#katalog" class="inline-block bg-neo-white text-black border-4 border-black px-8 py-4 font-black uppercase hover:bg-neo-accent hover:shadow-neo transition-all transform hover:-rotate-1">
            Belanja Sekarang
        </a>
    </div>
</div>
<?php endif; ?>

<!-- Categories Scroller -->
<div class="mb-12">
    <h2 class="text-2xl font-black uppercase mb-6 border-l-8 border-neo-accent pl-4">Kategori</h2>
    <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide" id="category-container">
        <!-- 'All' Button -->
        <button onclick="filterProducts('all', this)" class="category-btn active flex-shrink-0 min-w-[120px] bg-neo-black text-white border-4 border-black p-4 text-center font-black uppercase shadow-neo-sm ring-4 ring-neo-accent scale-105 hover:shadow-neo hover:-translate-y-1 transition-all cursor-pointer">
            Semua
        </button>
        <?php 
        $cat_sql = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
        $cat_res = $conn->query($cat_sql);
        $colors = ['bg-neo-accent', 'bg-neo-secondary', 'bg-neo-muted', 'bg-cyan-400', 'bg-green-400', 'bg-fuchsia-400', 'bg-orange-400'];
        $i = 0;
        if ($cat_res->num_rows > 0):
            while($cat = $cat_res->fetch_assoc()):
                $color = $colors[$i % count($colors)];
                $i++;
        ?>
        <button onclick="filterProducts('<?= $cat['id'] ?>', this)" class="category-btn flex-shrink-0 min-w-[150px] <?= $color ?> border-4 border-black p-4 text-center font-black uppercase shadow-neo-sm hover:shadow-neo hover:-translate-y-1 transition-all cursor-pointer text-black">
            <?= $cat['nama_kategori'] ?>
        </button>
        <?php 
            endwhile; 
        endif;
        ?>
    </div>
</div>

<script>
function filterProducts(categoryId, btn) {
    // 1. Update Buttons State
    document.querySelectorAll('.category-btn').forEach(b => {
        b.classList.remove('ring-4', 'ring-neo-accent', 'scale-105');
        // Reset styles for non-active if needed, though basic CSS handles hover
        if(b === btn) {
           // Add active indication
           b.classList.add('ring-4', 'ring-neo-accent', 'scale-105');
        }
    });

    // 2. Filter Products
    const products = document.querySelectorAll('.product-card');
    let delay = 0;
    
    products.forEach(product => {
        const prodCat = product.getAttribute('data-category');
        
        // Reset animation
        product.style.opacity = '0';
        product.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            if (categoryId === 'all' || prodCat === categoryId) {
                product.classList.remove('hidden');
                // Trigger reflow
                void product.offsetWidth; 
                product.style.opacity = '1';
                product.style.transform = 'scale(1)';
            } else {
                product.classList.add('hidden');
            }
        }, 300); // Wait for fade out
    });
}
</script>

<div id="katalog" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="product-card group bg-white border-4 border-black flex flex-col h-full hover-lift transition-all duration-500 ease-in-out" data-category="<?= $row['kategori_id'] ?>">
                <!-- Image -->
                <div class="h-48 bg-gray-100 border-b-4 border-black relative overflow-hidden flex items-center justify-center">
                    <span class="absolute top-2 right-2 bg-black text-white px-2 py-1 text-xs font-bold uppercase z-10">
                        <?= $row['nama_kategori'] ?>
                    </span>
                    <?php if(!empty($row['gambar']) && file_exists('uploads/' . $row['gambar'])): ?>
                        <img src="uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_produk'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <?php else: ?>
                        <span class="text-4xl grayscale">📦</span>
                    <?php endif; ?>
                </div>

                <!-- Body -->
                <div class="p-5 flex-grow flex flex-col">
                    <h3 class="text-xl font-black uppercase leading-tight mb-2"><?= $row['nama_produk'] ?></h3>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-2xl font-black">Rp <?= number_format($row['harga'], 0, ',', '.') ?></span>
                            <span class="text-xs font-bold bg-gray-100 border border-black px-2 py-1 rounded">
                                Stok: <?= $row['stok'] ?>
                            </span>
                        </div>

                        <div class="flex gap-2">
                            <a href="detail.php?id=<?= $row['id'] ?>" class="flex-1 text-center bg-white border-2 border-black py-3 font-bold uppercase hover:bg-gray-100 transition-all">
                                Detail
                            </a>
                            <?php if ($row['stok'] > 0): ?>
                                <button onclick="addToCart(<?= $row['id'] ?>, '<?= $row['nama_produk'] ?>', <?= $row['harga'] ?>, '<?= $row['gambar'] ?>', 1)" class="px-4 bg-neo-accent border-2 border-black font-black hover:shadow-neo-sm hover:-translate-y-1 transition-all">
                                    +
                                </button>
                            <?php else: ?>
                                <button disabled class="px-4 bg-gray-300 border-2 border-black font-black cursor-not-allowed text-gray-500" title="Stok Habis">
                                    x
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-span-full text-center py-20 bg-gray-50 border-4 border-black border-dashed">
            <h3 class="text-2xl font-bold uppercase">Produk Tidak Ditemukan</h3>
            <a href="index.php" class="text-neo-accent underline font-bold mt-2 inline-block">Reset Pencarian</a>
        </div>
    <?php endif; ?>
</div>

<!-- Explore Section -->
<div class="mb-20 container mx-auto px-4">
    <div class="bg-black text-white p-4 mb-8 transform -rotate-1 inline-block border-2 border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <h2 class="text-2xl font-black uppercase tracking-widest">Jelajahi Lebih Jauh</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Reviews -->
        <a href="reviews.php" class="group relative bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all overflow-hidden">
            <div class="absolute -right-4 -top-4 bg-yellow-300 w-24 h-24 rounded-full border-4 border-black group-hover:scale-150 transition-transform duration-500 z-0"></div>
            <div class="relative z-10">
                <span class="text-4xl mb-4 block group-hover:rotate-12 transition-transform duration-300">⭐</span>
                <h3 class="text-3xl font-black uppercase mb-2 leading-none">Reviews & Ratings</h3>
                <p class="font-bold text-gray-600 border-l-4 border-black pl-3 group-hover:border-yellow-300 transition-colors">
                    Lihat apa kata mereka tentang layanan kami. Jujur & Transparan.
                </p>
                <div class="mt-6 flex items-center font-black uppercase text-sm tracking-wider group-hover:gap-2 transition-all">
                    Cek Ombak <span class="ml-2">-></span>
                </div>
            </div>
        </a>

        <!-- Blog -->
        <a href="blog.php" class="group relative bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all overflow-hidden">
             <div class="absolute -right-4 -top-4 bg-neo-accent w-24 h-24 rounded-full border-4 border-black group-hover:scale-150 transition-transform duration-500 z-0"></div>
            <div class="relative z-10">
                <span class="text-4xl mb-4 block group-hover:-rotate-12 transition-transform duration-300">📰</span>
                <h3 class="text-3xl font-black uppercase mb-2 leading-none">Blog & Artikel</h3>
                <p class="font-bold text-gray-600 border-l-4 border-black pl-3 group-hover:border-neo-accent transition-colors">
                    Tips teknologi, tutorial, dan update terbaru dunia digital.
                </p>
                <div class="mt-6 flex items-center font-black uppercase text-sm tracking-wider group-hover:gap-2 transition-all">
                    Baca Yuk <span class="ml-2">-></span>
                </div>
            </div>
        </a>

        <!-- Social -->
        <a href="social.php" class="group relative bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all overflow-hidden">
             <div class="absolute -right-4 -top-4 bg-blue-300 w-24 h-24 rounded-full border-4 border-black group-hover:scale-150 transition-transform duration-500 z-0"></div>
            <div class="relative z-10">
                <span class="text-4xl mb-4 block group-hover:scale-110 transition-transform duration-300">💬</span>
                <h3 class="text-3xl font-black uppercase mb-2 leading-none">Social Data</h3>
                <p class="font-bold text-gray-600 border-l-4 border-black pl-3 group-hover:border-blue-300 transition-colors">
                    Intip keramaian komunitas kami secara realtime.
                </p>
                <div class="mt-6 flex items-center font-black uppercase text-sm tracking-wider group-hover:gap-2 transition-all">
                    Lihat Data <span class="ml-2">-></span>
                </div>
            </div>
        </a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
