<?php
include '../config/database.php';
checkAdmin();
include 'includes/header.php';
include 'includes/sidebar.php';

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM review WHERE id = $id");
    echo "<script>window.location='review.php';</script>";
}

$reviews = $conn->query("SELECT r.*, p.nama_produk FROM review r JOIN produk p ON r.produk_id = p.id ORDER BY r.created_at DESC");
?>

<div class="flex-1 p-8 relative">
    <!-- Background grid decoration -->
    <div class="absolute inset-0 pattern-grid-lg opacity-10 pointer-events-none z-0"></div>

    <div class="relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-5xl font-black uppercase tracking-tighter mb-2">Moderasi Review</h1>
                <p class="font-bold text-gray-500 text-lg border-l-4 border-neo-accent pl-3">Kelola ulasan pelanggan dengan gaya.</p>
            </div>
            <div class="bg-white border-4 border-black p-2 font-black shadow-neo">
                TOTAL: <?= $reviews->num_rows ?> REVIEW
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            <?php while($row = $reviews->fetch_assoc()): ?>
            <div class="bg-white border-4 border-black shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all duration-200 flex flex-col h-full group">
                <!-- Card Header -->
                <div class="bg-neo-black text-white p-3 border-b-4 border-black flex justify-between items-center">
                    <span class="font-black uppercase text-sm tracking-widest text-neo-secondary">#<?= $row['id'] ?></span>
                    <span class="text-xs font-bold bg-white text-black px-2 py-1"><?= date('d M Y', strtotime($row['created_at'])) ?></span>
                </div>
                
                <!-- Product Label -->
                <div class="p-4 pb-0">
                    <div class="inline-block bg-yellow-300 border-2 border-black px-3 py-1 text-xs font-black uppercase rotate-1 transform">
                        <?= $row['nama_produk'] ?>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 flex-1 flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-black flex items-center justify-center font-black overflow-hidden">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= $row['pelanggan_id'] ?>" alt="Avatar">
                        </div>
                        <div>
                            <div class="font-black text-sm uppercase">User #<?= $row['pelanggan_id'] ?></div>
                            <div class="flex text-yellow-500 text-lg leading-none">
                                <?php for($i=0; $i<5; $i++): ?>
                                    <span><?= $i < $row['rating'] ? '★' : '☆' ?></span>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <span class="absolute -top-4 -left-2 text-4xl text-gray-200 font-serif">"</span>
                        <p class="font-bold text-gray-800 italic relative z-10 pl-4">
                            <?= htmlspecialchars($row['komentar']) ?>
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="p-4 pt-0 mt-auto">
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirmAction(event, 'Hapus review ini?', this.href)" class="flex items-center justify-center w-full bg-red-100 hover:bg-red-500 hover:text-white border-2 border-black py-3 font-black uppercase tracking-wider transition-colors gap-2 group-hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        Hapus Block
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
        <?php if($reviews->num_rows == 0): ?>
            <div class="text-center py-20 border-4 border-dashed border-black bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p class="font-black text-2xl uppercase text-gray-400">Belum ada review masuk.</p>
                <p class="font-bold text-gray-400">Pastikan produkmu laku dulu bos!</p>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
