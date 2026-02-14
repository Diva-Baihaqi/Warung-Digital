<?php
include 'config/database.php';
include 'includes/public_header.php';

$blogs = $conn->query("SELECT * FROM blog ORDER BY tanggal DESC");
?>

<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-16">
        <h1 class="text-5xl md:text-7xl font-black uppercase mb-4 leading-none tracking-tighter">
            Blog & <span class="text-neo-accent">Artikel</span>
        </h1>
        <p class="text-xl font-bold max-w-2xl mx-auto border-b-4 border-black pb-4 inline-block">
            Baca konten terbaru seputar teknologi dan promo menarik Warung Digital.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php 
        if ($blogs->num_rows > 0):
            while($row = $blogs->fetch_assoc()): 
        ?>
        <a href="#" class="no-underline group">
            <div class="bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all flex flex-col h-full overflow-hidden">
                <!-- Image -->
                <div class="h-48 overflow-hidden relative border-b-4 border-black group-hover:opacity-90 transition-opacity">
                    <?php if(!empty($row['gambar']) && file_exists('assets/img/blog/' . $row['gambar'])): ?>
                        <img src="assets/img/blog/<?= $row['gambar'] ?>" alt="<?= htmlspecialchars($row['judul']) ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center font-black text-gray-400 text-4xl uppercase">
                            <?= substr($row['judul'], 0, 1) ?>
                        </div>
                    <?php endif; ?>
                    <div class="absolute top-4 left-4 bg-neo-secondary text-white px-3 py-1 font-black text-xs uppercase border-2 border-black transform -rotate-2 group-hover:rotate-0 transition-transform shadow-neo-sm">
                        <?= htmlspecialchars($row['kategori']) ?>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-2 text-gray-500 text-xs font-bold uppercase tracking-wider">
                            <span class="bg-black w-2 h-2"></span>
                            <?= date('d F Y', strtotime($row['tanggal'])) ?>
                        </div>
                        <h2 class="text-2xl font-black uppercase leading-tight mb-4 group-hover:text-neo-accent transition-colors line-clamp-2">
                            <?= htmlspecialchars($row['judul']) ?>
                        </h2>
                        <p class="text-gray-700 font-bold line-clamp-3 mb-4">
                            <?= strip_tags(substr($row['konten'], 0, 150)) ?>...
                        </p>
                    </div>
                    
                    <div class="flex justify-between items-center mt-4 pt-4 border-t-2 border-dashed border-gray-300">
                        <span class="text-sm font-black uppercase text-gray-400 group-hover:text-black transition-colors">Baca Selengkapnya -></span>
                    </div>
                </div>
            </div>
        </a>
        <?php 
            endwhile; 
        else: 
        ?>
            <div class="col-span-full text-center py-20 bg-gray-50 border-4 border-black border-dashed">
                <p class="font-black text-2xl uppercase text-gray-400">Belum ada artikel.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
