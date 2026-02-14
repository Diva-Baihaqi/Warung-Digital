<?php
include '../config/database.php';
include '../includes/public_header.php';

if (!isMemberLoggedIn()) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM pelanggan WHERE id = '$user_id'")->fetch_assoc();

// Stats
$total_orders = $conn->query("SELECT COUNT(*) as c FROM pesanan WHERE pelanggan_id = '$user_id'")->fetch_assoc()['c'];
$pending_orders = $conn->query("SELECT COUNT(*) as c FROM pesanan WHERE pelanggan_id = '$user_id' AND status = 'pending'")->fetch_assoc()['c'];
$completed_orders = $conn->query("SELECT COUNT(*) as c FROM pesanan WHERE pelanggan_id = '$user_id' AND status = 'completed'")->fetch_assoc()['c'];

// Recent Orders
$recent = $conn->query("SELECT * FROM pesanan WHERE pelanggan_id = '$user_id' ORDER BY tanggal_pesanan DESC LIMIT 5");
?>

<style>
    body {
        background-color: #ffffff !important;
        background-image: none !important;
    }
</style>

<div class="container mx-auto px-4 py-8 max-w-5xl">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
        <div>
            <h1 class="text-4xl font-black uppercase mb-2">Dashboard Member</h1>
            <p class="font-bold text-gray-500">Selamat datang kembali, <span class="text-black"><?= htmlspecialchars($user['nama']) ?></span>!</p>
        </div>
        <div class="flex gap-4">
            <a href="profile.php" class="bg-neo-secondary text-black border-4 border-black px-6 py-3 font-black uppercase shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all flex items-center gap-2">
                <span>👤</span> Edit Profil
            </a>
            <a href="orders.php" class="bg-neo-accent text-black border-4 border-black px-6 py-3 font-black uppercase shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all flex items-center gap-2">
                <span>📦</span> Pesanan Saya
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <!-- Total Orders -->
        <div class="bg-white border-4 border-black p-6 shadow-neo hover:-translate-y-1 transition-transform relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 bg-gray-100 w-24 h-24 rounded-full border-4 border-black group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <h3 class="text-xl font-black uppercase mb-2">Total Pesanan</h3>
                <div class="flex justify-between items-end">
                    <span class="text-5xl font-black"><?= $total_orders ?></span>
                    <span class="text-3xl">🛍️</span>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-yellow-100 border-4 border-black p-6 shadow-neo hover:-translate-y-1 transition-transform relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 bg-yellow-300 w-24 h-24 rounded-full border-4 border-black group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <h3 class="text-xl font-black uppercase mb-2">Menunggu Pembayaran</h3>
                <div class="flex justify-between items-end">
                    <span class="text-5xl font-black"><?= $pending_orders ?></span>
                    <span class="text-3xl">⏳</span>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="bg-green-100 border-4 border-black p-6 shadow-neo hover:-translate-y-1 transition-transform relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 bg-green-300 w-24 h-24 rounded-full border-4 border-black group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <h3 class="text-xl font-black uppercase mb-2">Pesanan Selesai</h3>
                <div class="flex justify-between items-end">
                    <span class="text-5xl font-black"><?= $completed_orders ?></span>
                    <span class="text-3xl">✅</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white border-4 border-black p-8 shadow-neo-lg">
        <div class="flex justify-between items-center mb-6 border-b-4 border-black pb-4">
            <h2 class="text-2xl font-black uppercase">Pesanan Terakhir</h2>
            <a href="orders.php" class="font-bold underline text-sm hover:text-neo-accent">Lihat Semua -></a>
        </div>

        <?php if($recent->num_rows > 0): ?>
            <div class="space-y-4">
                <?php while($row = $recent->fetch_assoc()): ?>
                <div class="flex flex-col md:flex-row justify-between items-center bg-gray-50 border-2 border-black p-4 hover:bg-gray-100 transition-colors">
                    <div class="flex items-center gap-4 mb-2 md:mb-0">
                        <div class="w-10 h-10 bg-black text-white flex items-center justify-center font-black rounded-full text-xs">
                            #<?= $row['id'] ?>
                        </div>
                        <div>
                            <div class="font-bold uppercase text-sm system-font"><?= date('d F Y', strtotime($row['tanggal_pesanan'])) ?></div>
                            <div class="text-xs font-bold text-gray-500">Total: Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <span class="font-bold uppercase text-xs px-2 py-1 border border-black 
                            <?= $row['status'] == 'completed' ? 'bg-green-200' : ($row['status'] == 'pending' ? 'bg-yellow-200' : 'bg-gray-200') ?>">
                            <?= $row['status'] ?>
                        </span>
                        <a href="orders.php" class="bg-white border-2 border-black px-3 py-1 font-bold text-xs uppercase hover:bg-black hover:text-white transition-colors">
                            Detail
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center font-bold text-gray-500 py-8">Belum ada pesanan terbaru.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
