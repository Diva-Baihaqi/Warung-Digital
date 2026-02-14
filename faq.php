<?php
include 'config/database.php';
include 'includes/public_header.php';

$faqs = $conn->query("SELECT * FROM faq");

?>

<div class="max-w-4xl mx-auto mb-20">
    <div class="text-center mb-16">
        <h1 class="text-6xl font-black uppercase mb-4">FAQ</h1>
        <p class="text-xl font-bold border-2 border-black bg-white inline-block px-4 py-2 transform -rotate-1 shadow-neo-sm">
            Jawaban untuk keraguanmu.
        </p>
    </div>

    <div class="space-y-6">
        <?php while($f = $faqs->fetch_assoc()): ?>
        <details class="group bg-white border-4 border-black shadow-neo hover:shadow-neo-lg transition-all">
            <summary class="list-none flex justify-between items-center p-6 cursor-pointer bg-neo-white group-open:bg-neo-secondary transition-colors">
                <span class="text-xl font-black uppercase"><?= $f['pertanyaan'] ?></span>
                <span class="border-2 border-black w-8 h-8 flex items-center justify-center font-black bg-white group-open:rotate-180 transition-transform">
                    ▼
                </span>
            </summary>
            <div class="p-6 border-t-4 border-black leading-relaxed font-bold bg-gray-50 text-lg">
                <?= $f['jawaban'] ?>
            </div>
        </details>
        <?php endwhile; ?>
        
        <!-- Static Additional FAQs -->
        <details class="group bg-white border-4 border-black shadow-neo hover:shadow-neo-lg transition-all">
            <summary class="list-none flex justify-between items-center p-6 cursor-pointer bg-neo-white group-open:bg-neo-secondary transition-colors">
                <span class="text-xl font-black uppercase">Bagaimana cara klaim garansi?</span>
                <span class="border-2 border-black w-8 h-8 flex items-center justify-center font-black bg-white group-open:rotate-180 transition-transform">▼</span>
            </summary>
            <div class="p-6 border-t-4 border-black leading-relaxed font-bold bg-gray-50 text-lg">
                Cukup hubungi admin via WhatsApp dengan menyertakan nomor pesanan. Kami akan ganti akun baru dalam 1x24 jam jika terbukti bermasalah.
            </div>
        </details>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
