<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

/* Simple List View implementation for Blog */
$blogs = $conn->query("SELECT * FROM blog ORDER BY tanggal DESC");
?>

<div class="flex-1 p-8 relative">
     <!-- Background grid decoration -->
    <div class="absolute inset-0 pattern-grid-lg opacity-10 pointer-events-none z-0"></div>

    <div class="relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
            <div>
                <h1 class="text-5xl font-black uppercase tracking-tighter mb-2">Data Blog</h1>
                <p class="font-bold text-gray-500 text-lg border-l-4 border-neo-accent pl-3">Tulis artikel untuk menaikkan SEO warungmu.</p>
            </div>
            <a href="tambah.php" class="bg-neo-accent text-black border-4 border-black px-8 py-4 font-black uppercase tracking-widest shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tulis Baru
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while($row = $blogs->fetch_assoc()): ?>
            <div class="bg-white border-4 border-black shadow-neo hover:-translate-y-2 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transition-all duration-300 flex flex-col h-full group">
                <!-- Image Placeholder -->
                <div class="h-48 bg-gray-200 border-b-4 border-black relative overflow-hidden group-hover:opacity-90 transition-opacity">
                    <!-- Random Pattern or Image -->
                    <?php if(!empty($row['gambar']) && file_exists("../../assets/img/blog/".$row['gambar'])): ?>
                        <img src="../../assets/img/blog/<?= $row['gambar'] ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" alt="Blog Thumb">
                    <?php else: ?>
                        <img src="https://placehold.co/600x400/<?= substr(md5($row['judul']), 0, 6) ?>/FFF?text=<?= urlencode(substr($row['judul'], 0, 10)) ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" alt="Blog Thumb">
                    <?php endif; ?>
                    <div class="absolute top-4 left-4">
                        <span class="bg-neo-secondary text-white border-2 border-black px-3 py-1 font-black text-xs uppercase shadow-sm">
                            <?= $row['kategori'] ?? 'UMUM' ?>
                        </span>
                    </div>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    <div class="mb-4">
                        <span class="text-xs font-black text-gray-400 uppercase tracking-wider">
                            <?= date('d F Y', strtotime($row['tanggal'])) ?>
                        </span>
                        <h3 class="font-black uppercase text-2xl leading-none mt-2 group-hover:text-neo-primary transition-colors line-clamp-2">
                            <?= $row['judul'] ?>
                        </h3>
                    </div>
                    
                    <p class="text-gray-600 font-bold text-sm line-clamp-3 mb-6">
                        <?= strip_tags(substr($row['konten'] ?? 'Tidak ada konten.', 0, 150)) ?>...
                    </p>

                    <div class="mt-auto flex gap-3">
                        <a href="edit.php?id=<?= $row['id'] ?>" class="flex-1 text-center bg-yellow-200 hover:bg-yellow-400 text-black border-2 border-black py-2 font-black uppercase text-sm transition-all">
                            Edit
                        </a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirmAction(event, 'Hapus artikel ini?', this.href)" class="flex-1 text-center bg-red-200 hover:bg-red-500 hover:text-white text-black border-2 border-black py-2 font-black uppercase text-sm transition-all">
                            Hapus
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
        <?php if($blogs->num_rows == 0): ?>
            <div class="text-center py-20 border-4 border-dashed border-black bg-gray-50">
                <p class="font-black text-2xl uppercase text-gray-400">Belum ada artikel.</p>
                <a href="tambah.php" class="inline-block mt-4 text-neo-accent font-bold underline">Mulai menulis sekarang -></a>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
