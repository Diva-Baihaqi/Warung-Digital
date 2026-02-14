<?php
include 'config/database.php';
include 'includes/public_header.php';
?>

<div class="mb-20">
    <!-- Hero About -->
    <div class="text-center mb-24 relative">
        <h1 class="text-7xl md:text-9xl font-black uppercase tracking-tighter mb-4 z-10 relative">
            Warung <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-neo-accent to-neo-secondary" style="-webkit-text-stroke: 3px black;">Digital</span>
        </h1>
        <p class="text-2xl font-bold max-w-2xl mx-auto border-4 border-black p-6 bg-white shadow-neo transform rotate-1">
            Revolusi belanja produk digital yang sat-set, anti ribet, dan pastinya legal 100%.
        </p>
        
        <!-- Decor Elements -->
        <span class="absolute top-0 right-10 text-9xl text-neo-secondary opacity-50 rotate-12 -z-0">★</span>
        <span class="absolute bottom-0 left-10 text-9xl text-neo-accent opacity-50 -rotate-12 -z-0">★</span>
    </div>

    <!-- Vision Mission Asymmetric -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-6xl mx-auto items-center mb-24">
        <div class="bg-neo-black text-white border-4 border-black p-12 shadow-neo-lg transform -rotate-2">
            <h2 class="text-5xl font-black uppercase mb-6 text-neo-secondary">Visi Kami</h2>
            <p class="text-xl font-bold leading-relaxed">
                Menjadi pasar digital nomor satu di galaksi ini yang menyediakan akses premium tanpa harus jual ginjal. Murah itu hak segala bangsa.
            </p>
        </div>
        <div class="bg-white border-4 border-black p-12 shadow-neo-lg transform rotate-2 mt-12 md:mt-0">
            <h2 class="text-5xl font-black uppercase mb-6 text-neo-accent">Misi</h2>
            <ul class="text-xl font-bold space-y-4 list-disc list-inside">
                <li>Membasmi akun ilegal yang suka mati tengah jalan.</li>
                <li>Memberikan layanan customer service yang manusiawi, bukan bot.</li>
                <li>Menyediakan harga yang masuk akal untuk kantong pelajar.</li>
            </ul>
        </div>
    </div>

    <!-- Team (Just visuals) -->
    <div class="text-center">
        <h2 class="text-5xl font-black uppercase mb-12">Siapa Kami?</h2>
        <div class="flex justify-center gap-8 flex-wrap">
            <div class="bg-white border-4 border-black p-4 w-64 shadow-neo hover:-translate-y-2 transition-transform">
                <div class="h-48 bg-neo-muted border-2 border-black mb-4 overflow-hidden">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix" alt="CEO" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-black uppercase">CEO</h3>
                <p class="font-bold">Si Paling Visioner</p>
            </div>
            <div class="bg-white border-4 border-black p-4 w-64 shadow-neo hover:-translate-y-2 transition-transform">
                <div class="h-48 bg-neo-secondary border-2 border-black mb-4 overflow-hidden">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Aneka" alt="CTO" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-black uppercase">Admin</h3>
                <p class="font-bold">Penjaga Malam</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
