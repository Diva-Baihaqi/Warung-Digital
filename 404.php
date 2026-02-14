<?php
include 'config/database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found - Warung Digital</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'neo-bg': '#FFFDF5',
                        'neo-black': '#000000',
                        'neo-accent': '#FF6B6B',
                        'neo-secondary': '#FFD93D', 
                        'neo-purple': '#A78BFA',
                    },
                    fontFamily: {
                        'sans': ['"Space Grotesk"', 'sans-serif'],
                    },
                    boxShadow: {
                        'neo': '8px 8px 0px 0px #000',
                        'neo-lg': '12px 12px 0px 0px #000',
                    }
                }
            }
        }
    </script>
    <style>
        .glitch-wrapper {
            position: relative;
        }
        .glitch {
            position: relative;
            color: black;
            font-weight: 900;
        }
        .glitch::before,
        .glitch::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .glitch::before {
            left: 4px;
            text-shadow: -2px 0 #FF6B6B;
            clip: rect(44px, 450px, 56px, 0);
            animation: glitch-anim 5s infinite linear alternate-reverse;
        }
        .glitch::after {
            left: -4px;
            text-shadow: -2px 0 #A78BFA;
            clip: rect(44px, 450px, 56px, 0);
            animation: glitch-anim2 5s infinite linear alternate-reverse;
        }
        @keyframes glitch-anim {
            0% { clip: rect(21px, 9999px, 15px, 0); }
            20% { clip: rect(66px, 9999px, 88px, 0); }
            40% { clip: rect(12px, 9999px, 92px, 0); }
            60% { clip: rect(83px, 9999px, 26px, 0); }
            80% { clip: rect(45px, 9999px, 2px, 0); }
            100% { clip: rect(33px, 9999px, 56px, 0); }
        }
        @keyframes glitch-anim2 {
            0% { clip: rect(2px, 9999px, 83px, 0); }
            20% { clip: rect(44px, 9999px, 12px, 0); }
            40% { clip: rect(98px, 9999px, 33px, 0); }
            60% { clip: rect(12px, 9999px, 66px, 0); }
            80% { clip: rect(46px, 9999px, 1px, 0); }
            100% { clip: rect(82px, 9999px, 2px, 0); }
        }
    </style>
</head>
<body class="bg-neo-secondary min-h-screen flex items-center justify-center p-4 overflow-hidden relative">

    <!-- Background Elements -->
    <div class="absolute top-10 left-10 w-32 h-32 bg-neo-accent rounded-full border-4 border-black mix-blend-multiply opacity-50 animate-bounce"></div>
    <div class="absolute bottom-10 right-10 w-48 h-48 bg-neo-purple rounded-full border-4 border-black mix-blend-multiply opacity-50 animate-pulse"></div>
    
    <!-- Main Card -->
    <div class="bg-white border-4 border-black p-8 md:p-16 shadow-neo-lg text-center relative z-10 max-w-2xl transform hover:-rotate-1 transition-transform duration-300">
        
        <div class="absolute -top-6 -left-6 bg-neo-black text-white px-4 py-2 font-black text-xl border-4 border-white transform -rotate-3">
            ERROR SYSTEM
        </div>

        <h1 class="text-9xl font-black mb-4 select-none glitch-wrapper">
            <span class="glitch" data-text="404">404</span>
        </h1>
        
        <h2 class="text-3xl md:text-4xl font-black uppercase mb-6 leading-tight">
            Halaman Tidak <span class="bg-neo-accent px-2">Ditemukan!</span>
        </h2>
        
        <p class="text-xl font-bold text-gray-600 mb-8 border-y-4 border-black py-4 border-dashed">
            Waduh, sepertinya kamu tersesat di dimensi lain. Link yang kamu tuju sudah hilang atau dipindahkan oleh alien.
        </p>
        
        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="<?= BASE_URL ?>/index.php" class="bg-neo-black text-white border-4 border-neo-black px-8 py-4 font-black uppercase text-xl hover:bg-white hover:text-black transition-all shadow-neo hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                &larr; Kembali ke Home
            </a>
            <a href="<?= BASE_URL ?>/contact.php" class="bg-white text-black border-4 border-black px-8 py-4 font-black uppercase text-xl hover:bg-neo-secondary transition-all shadow-neo hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                Lapor Admin
            </a>
        </div>

        <div class="mt-8 text-xs font-bold uppercase tracking-widest text-gray-400">
            Warung Digital System v2.0
        </div>
    </div>

</body>
</html>
