<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Warung Digital</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= time() ?>">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="<?= BASE_URL ?>/assets/js/tailwind-config.js"></script>

    <!-- ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>/assets/js/neo-alert.js"></script>
</head>
<body class="bg-neo-bg font-sans flex min-h-screen relative overflow-x-hidden">

<!-- Sidebar Toggle Button (Desktop & Mobile) -->
<button id="sidebar-toggle-btn" onclick="toggleSidebar()" class="fixed top-4 left-4 z-50 bg-neo-black text-white p-2 border-2 border-neo-secondary shadow-neo-sm hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('admin-sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle-btn');
        
        function updateState() {
            const isDesktop = window.innerWidth >= 1024;
            
            if (isDesktop) {
                // Desktop: Check if open (w-64)
                if (sidebar.classList.contains('w-64')) {
                    toggleBtn.classList.add('hidden');
                } else {
                    toggleBtn.classList.remove('hidden');
                }
            } else {
                // Mobile: Check if hidden
                if (sidebar.classList.contains('hidden')) {
                    toggleBtn.classList.remove('hidden');
                } else {
                    toggleBtn.classList.add('hidden');
                }
            }
        }

        window.toggleSidebar = function() {
            const isDesktop = window.innerWidth >= 1024;
            
            if (isDesktop) {
                if (sidebar.classList.contains('w-64')) {
                    // Close Sidebar (Make it width 0)
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-0', 'p-0', 'overflow-hidden');
                } else {
                    // Open Sidebar
                    sidebar.classList.remove('w-0', 'p-0', 'overflow-hidden');
                    sidebar.classList.add('w-64');
                }
            } else {
                // Mobile: Just toggle visibility
                sidebar.classList.toggle('hidden');
            }
            updateState();
        }

        // Initialize state
        updateState();

        // Handle Resize
        window.addEventListener('resize', () => {
             const isDesktop = window.innerWidth >= 1024;
             if (isDesktop) {
                sidebar.classList.remove('hidden'); 
                // Default to open if not specifically closed? Or keep state?
                // Let's keep state but ensure if it was mobile-hidden, it becomes visible-desktop
            } else {
                sidebar.classList.add('hidden');
            }
            updateState();
        });
    });
</script>
