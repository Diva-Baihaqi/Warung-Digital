</main>

<footer class="border-t-4 border-black bg-neo-secondary py-12 mt-auto">
    <div class="container mx-auto px-4 max-w-6xl text-center">
        <h2 class="text-4xl font-black uppercase mb-6 tracking-tight">Butuh Bantuan?</h2>
        <div class="flex justify-center gap-4 mb-8">
            <a href="https://wa.me/6289664364535" class="bg-neo-white border-4 border-black px-6 py-3 font-bold uppercase shadow-neo-sm hover:shadow-neo transition-all transform hover:-rotate-1">
                WhatsApp Admin
            </a>
            <a href="https://instagram.com/diva_babah" target="_blank" class="bg-neo-black text-neo-white border-4 border-black px-6 py-3 font-bold uppercase shadow-neo-sm hover:shadow-neo hover:bg-gray-900 transition-all transform hover:rotate-1">
                Instagram
            </a>
            <a href="https://www.facebook.com/divabaihaqi.sgb" target="_blank" class="bg-blue-600 text-white border-4 border-black px-6 py-3 font-bold uppercase shadow-neo-sm hover:shadow-neo transition-all transform hover:-rotate-1">
                Facebook
            </a>
            <a href="https://www.threads.net/@diva_babah" target="_blank" class="bg-black text-white border-4 border-black px-6 py-3 font-bold uppercase shadow-neo-sm hover:shadow-neo transition-all transform hover:rotate-1">
                Threads
            </a>
            <a href="<?= BASE_URL ?>/contact.php" class="bg-neo-accent text-black border-4 border-black px-6 py-3 font-bold uppercase shadow-neo-sm hover:shadow-neo transition-all transform hover:-rotate-1">
                Lapor Admin
            </a>
        </div>
        <div class="mb-12 border-4 border-black bg-neo-accent p-8 transform rotate-1 shadow-neo">
            <h3 class="text-2xl font-black uppercase mb-4">Jangan Ketinggalan Info!</h3>
            <form action="#" class="flex flex-col md:flex-row gap-4" onsubmit="event.preventDefault(); showToast('Terima kasih sudah langganan!', 'success')">
                <input type="email" placeholder="MASUKKAN EMAIL..." class="flex-1 border-4 border-black p-4 font-bold outline-none focus:bg-white" required>
                <button class="bg-neo-black text-white border-4 border-black px-8 py-4 font-black uppercase hover:bg-white hover:text-black transition-colors">
                    Langganan
                </button>
            </form>
        </div>

        <p class="font-bold border-t-2 border-black pt-8 inline-block w-full max-w-md">
            &copy; <?= date('Y') ?> Warung Digital. Created with <span class="text-neo-accent">♥</span> Kelompok 5 - TI23B.
        </p>
    </div>
</footer>

</body>
</html>
