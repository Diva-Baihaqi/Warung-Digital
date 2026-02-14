<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Digital</title>
    
    <!-- Fonts & Tailwind -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= time() ?>">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="<?= BASE_URL ?>/assets/js/tailwind-config.js"></script>

    <!-- ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>/assets/js/neo-alert.js"></script>
</head>
<body class="min-h-screen flex flex-col font-sans text-neo-black">

<!-- Navbar -->
<nav class="border-b-4 border-black bg-white sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center gap-4 max-w-7xl">
        <a href="<?= BASE_URL ?>/index.php" class="text-3xl font-black uppercase tracking-tighter hover:-rotate-1 transition-transform">
            WARUNG<span class="text-neo-accent">DIGITAL</span>
        </a>
        
        <!-- Search Bar -->
        <form action="" method="GET" class="flex w-full md:w-1/2 relative">
            <input type="text" name="q" placeholder="CARI PRODUK..." value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" 
                   class="w-full border-4 border-black p-3 font-bold placeholder-gray-400 focus:bg-neo-secondary outline-none rounded-none">
            <button type="submit" class="bg-neo-black text-white px-6 border-y-4 border-r-4 border-black font-bold hover:bg-neo-accent hover:text-black transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0z" />
                </svg>
            </button>
        </form>

        <div class="flex gap-4 items-center">
            <?php if(isMemberLoggedIn()): ?>
                <a href="<?= BASE_URL ?>/member/index.php" class="text-sm md:text-base font-bold hover:text-neo-accent transition-colors">Hi, <?= $_SESSION['user_nama'] ?? 'Member' ?> (Dashboard)</a>
                <a href="<?= BASE_URL ?>/member/logout.php" class="font-bold text-red-500 hover:underline">Logout</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/member/login.php" class="font-bold border-2 border-black px-3 py-1 bg-neo-secondary hover:bg-neo-accent transition-colors">Login / Daftar</a>
            <?php endif; ?>
            
            <button onclick="toggleCart()" class="bg-neo-secondary border-4 border-black p-2 relative hover:bg-neo-accent transition-colors click-push">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span id="cartCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-black border-2 border-black w-6 h-6 flex items-center justify-center rounded-full hidden">0</span>
            </button>
        </div>
    </div>
</nav>

<script>
    const IS_LOGGED_IN = <?= isMemberLoggedIn() ? 'true' : 'false' ?>;
</script>

<!-- Cart Overlay -->
<div id="cartOverlay" onclick="toggleCart()" class="fixed inset-0 bg-black/50 z-[60] hidden opacity-0 transition-opacity duration-300 backdrop-blur-sm"></div>

<!-- Cart Drawer -->
<div id="cartDrawer" class="fixed top-0 right-0 h-full w-full sm:w-[500px] bg-neo-bg border-l-4 border-black z-[70] transform translate-x-full transition-transform duration-300 shadow-[-12px_0px_0px_0px_#000] flex flex-col">
    <!-- Header -->
    <div class="p-6 border-b-4 border-black flex justify-between items-center bg-white">
        <h2 class="text-3xl font-black uppercase">Keranjang</h2>
        <button onclick="toggleCart()" class="text-2xl font-black hover:scale-110 transition-transform">X</button>
    </div>

    <!-- Items Container (Filled by JS) -->
    <div id="cartItems" class="flex-1 overflow-y-auto p-6 space-y-4">
        <!-- JS INJECTED HERE -->
    </div>

    <!-- Footer -->
    <div class="p-6 border-t-4 border-black bg-white">
        <div class="flex justify-between items-end mb-4 text-xl font-black uppercase">
            <span>Total:</span>
            <span id="cartTotal" class="text-3xl">Rp 0</span>
        </div>
        <button onclick="window.location.href='<?= BASE_URL ?>/checkout.php'" class="w-full bg-neo-accent border-4 border-black py-4 font-black uppercase tracking-widest hover:shadow-neo hover:-translate-y-1 transition-all active:translate-y-0 active:shadow-none">
            Checkout Sekarang
        </button>
    </div>
</div>

<script src="<?= BASE_URL ?>/assets/js/script.js"></script>

<main class="flex-grow container mx-auto px-4 py-8 max-w-7xl">
