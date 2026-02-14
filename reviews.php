<?php
include 'config/database.php';
include 'includes/public_header.php';

$reviews = $conn->query("SELECT r.*, p.nama_produk, pl.nama as nama_user FROM review r JOIN produk p ON r.produk_id = p.id JOIN pelanggan pl ON r.pelanggan_id = pl.id ORDER BY r.created_at DESC");
?>

<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-16">
        <h1 class="text-5xl md:text-7xl font-black uppercase mb-4 leading-none tracking-tighter">
            Apa Kata <span class="text-neo-accent">Mereka?</span>
        </h1>
        <p class="text-xl font-bold max-w-2xl mx-auto border-b-4 border-black pb-4 inline-block">
            Review jujur dari pelanggan setia Warung Digital. No tipu-tipu!
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php while($row = $reviews->fetch_assoc()): ?>
        <div class="bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all flex flex-col h-full group">
            <div class="p-6 flex-1 flex flex-col gap-4">
                <!-- Header -->
                <div class="flex justify-between items-start">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full border-2 border-black overflow-hidden bg-gray-100">
                             <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= $row['nama_user'] ?>" alt="Avatar">
                        </div>
                        <div>
                            <h3 class="font-black uppercase text-sm leading-tight"><?= $row['nama_user'] ?></h3>
                            <span class="text-xs font-bold text-gray-500"><?= date('d M Y', strtotime($row['created_at'])) ?></span>
                        </div>
                    </div>
                    <div class="bg-neo-secondary text-white border-2 border-black px-2 py-1 text-xs font-black uppercase transform rotate-2">
                        <?= $row['nama_produk'] ?>
                    </div>
                </div>

                <!-- Rating -->
                <div class="flex text-yellow-400 text-2xl">
                    <?php for($i=0; $i<5; $i++): ?>
                        <span><?= $i < $row['rating'] ? '★' : '☆' ?></span>
                    <?php endfor; ?>
                </div>

                <!-- Comment -->
                <div class="relative mt-2">
                    <span class="absolute -top-6 -left-2 text-6xl text-gray-100 font-serif z-0">"</span>
                    <p class="font-bold text-gray-800 italic relative z-10 pl-2">
                        <?= htmlspecialchars($row['komentar']) ?>
                    </p>
                </div>
            </div>
            
            <div class="bg-gray-50 p-3 border-t-4 border-black text-center">
                <span class="text-xs font-black uppercase tracking-widest text-gray-400">Verified Purchase</span>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    
    <?php if ($reviews->num_rows == 0): ?>
        <div class="text-center py-20 bg-white border-4 border-black border-dashed">
            <p class="font-black text-2xl uppercase text-gray-400">Belum ada review.</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
