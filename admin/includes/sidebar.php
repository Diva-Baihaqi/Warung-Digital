<aside id="admin-sidebar" class="w-64 bg-neo-black text-white flex-shrink-0 flex flex-col min-h-screen sticky top-0 transition-all duration-300 ease-in-out z-40">
    <div class="p-4 border-b border-gray-800 flex justify-between items-center bg-neo-black z-50 gap-4">
        <h1 class="text-xl font-black uppercase text-neo-secondary truncate">ADMIN PANEL</h1>
        <button onclick="window.toggleSidebar()" class="text-white hover:text-neo-accent p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        <a href="/warung-digital/admin/index.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Dashboard
        </a>
        
        <div class="pt-4 pb-2">
            <p class="text-xs uppercase text-gray-500 font-bold px-3">Master Data</p>
        </div>
        <a href="/warung-digital/admin/produk/index.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Produk
        </a>
        <a href="/warung-digital/admin/stok/index.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Stok Akun <span class="bg-red-500 text-white text-xs px-1 ml-1">NEW</span>
        </a>
        <a href="/warung-digital/admin/kategori/index.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Kategori
        </a>
        <a href="/warung-digital/admin/pelanggan/index.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Pelanggan
        </a>

        <div class="pt-4 pb-2">
            <p class="text-xs uppercase text-gray-500 font-bold px-3">Transaksi</p>
        </div>
        <a href="/warung-digital/admin/pesanan/index.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Pesanan
        </a>
        
        <div class="pt-4 pb-2">
            <p class="text-xs uppercase text-gray-500 font-bold px-3">Laporan</p>
        </div>
        <a href="/warung-digital/admin/laporan.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Laporan Penjualan <span class="bg-yellow-400 text-black text-xs px-1 ml-1 rounded">HOT</span>
        </a>
        
        <div class="pt-4 pb-2">
            <p class="text-xs uppercase text-gray-500 font-bold px-3">Interaksi</p>
        </div>
        <a href="/warung-digital/admin/review.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Reviews & Rating
        </a>
        <a href="/warung-digital/admin/blog/index.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Blog & Artikel
        </a>
        <a href="/warung-digital/admin/social.php" class="block p-3 font-bold hover:bg-gray-800 border-l-4 border-transparent hover:border-neo-accent transition-all">
            Social Data
        </a>
        
        <div class="pt-4 pb-2">
            <p class="text-xs uppercase text-gray-500 font-bold px-3">System</p>
        </div>
<a href="/warung-digital/admin/logout.php" class="block p-3 font-bold text-red-400 hover:bg-gray-800 hover:text-red-300 transition-all">
            Logout
        </a>
    </nav>
</aside>
