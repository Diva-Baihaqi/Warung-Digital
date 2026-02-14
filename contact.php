<?php
include 'config/database.php';
include 'includes/public_header.php';
?>

<style>
    body {
        background-color: #FFFDF5 !important;
        background-image: none !important;
    }
</style>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20 max-w-6xl mx-auto items-center">
    <!-- Visual Section -->
    <div class="relative hidden lg:block">
        <div class="bg-neo-accent border-4 border-black p-12 transform -rotate-6 shadow-neo-lg z-0"></div>
        <div class="bg-white border-4 border-black p-12 absolute inset-0 z-10 flex flex-col justify-center items-center text-center">
            <div class="text-9xl mb-4">👋</div>
            <h2 class="text-4xl font-black uppercase mb-4">Jangan Ragu!</h2>
            <p class="font-bold text-xl">Admin kami ramah (kadang-kadang) dan siap membantu 24/7 kecuali pas tidur.</p>
        </div>
    </div>

    <!-- Form Section -->
    <div>
        <h1 class="text-6xl font-black uppercase mb-8 leading-none">
            Hubungi <span class="text-neo-secondary" style="-webkit-text-stroke: 2px black;">Kami</span>
        </h1>
        
        <form class="space-y-6 bg-white border-4 border-black p-8 shadow-neo-lg" onsubmit="event.preventDefault(); showToast('Pesan terkirim!', 'success');">
            <div>
                <label class="block font-black uppercase mb-2">Nama Lengkap</label>
                <input type="text" required class="w-full border-4 border-black p-4 font-bold bg-gray-50 focus:bg-neo-secondary focus:outline-none focus:shadow-neo-sm transition-all placeholder-gray-400" placeholder="SIAPA NAMAMU?">
            </div>
            
            <div>
                <label class="block font-black uppercase mb-2">Email</label>
                <input type="email" required class="w-full border-4 border-black p-4 font-bold bg-gray-50 focus:bg-neo-secondary focus:outline-none focus:shadow-neo-sm transition-all placeholder-gray-400" placeholder="EMAIL@CONTOH.COM">
            </div>

            <div>
                <label class="block font-black uppercase mb-2">Pesan</label>
                <textarea rows="5" required class="w-full border-4 border-black p-4 font-bold bg-gray-50 focus:bg-neo-secondary focus:outline-none focus:shadow-neo-sm transition-all placeholder-gray-400" placeholder="TULIS KELUHAN ATAU PUJIAN..."></textarea>
            </div>

            <button type="submit" class="w-full bg-neo-black text-white py-5 font-black uppercase tracking-widest border-4 border-black hover:bg-white hover:text-black hover:shadow-neo-lg transition-all transform active:translate-y-1 active:shadow-none">
                Kirim Pesan 🚀
            </button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
