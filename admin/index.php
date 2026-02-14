<?php
include '../config/database.php';
// Adjusted path for checkAdmin since this is in admin/
checkAdmin(); 

include 'includes/header.php';
include 'includes/sidebar.php';

// --- STATS LOGIG ---
// 1. Total Produk
$files_count = $conn->query("SELECT COUNT(*) as c FROM produk")->fetch_assoc()['c'];

// 2. Pesanan Masuk (Pending & Success)
$pending_count = $conn->query("SELECT COUNT(*) as c FROM pesanan WHERE status IN ('pending', 'success')")->fetch_assoc()['c'];

// 3. Total Pelanggan
$users_count = $conn->query("SELECT COUNT(*) as c FROM pelanggan")->fetch_assoc()['c'];

// 4. Total Pendapatan (Completed)
$revenue = $conn->query("SELECT SUM(total_harga) as total FROM pesanan WHERE status = 'completed'")->fetch_assoc()['total'];
$revenue = $revenue ? $revenue : 0;

// 5. Data Grafik (7 Hari Terakhir)
$labels = [];
$data_sales = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $labels[] = date('d M', strtotime($date));
    
    // Hitung order selesai per tanggal
    $query = "SELECT COUNT(*) as c FROM pesanan WHERE DATE(tanggal_pesanan) = '$date' AND status = 'completed'";
    $count = $conn->query($query)->fetch_assoc()['c'];
    $data_sales[] = $count;
}

// Convert to JSON for JS
$js_labels = json_encode($labels);
$js_data = json_encode($data_sales);
?>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="flex-1 p-8 overflow-y-auto h-screen bg-[#f0f0f0]">
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-5xl font-black uppercase text-black tracking-tight" style="text-shadow: 2px 2px 0px #fff;">Dashboard</h1>
            <p class="font-bold text-gray-600 text-lg mt-1">Pantau performa tokomu secara <i>real-time</i>!</p>
        </div>
        <div class="bg-white border-4 border-black px-6 py-3 font-black shadow-neo flex items-center gap-3">
            <span class="text-2xl">📅</span>
            <?= date('l, d F Y') ?>
        </div>
    </header>

    <!-- STATS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Revenue Card -->
        <div class="bg-green-400 border-4 border-black p-6 shadow-neo hover:-translate-y-2 transition-transform">
            <h3 class="text-lg font-black uppercase mb-1">Total Pendapatan</h3>
            <p class="text-3xl font-black truncate" title="Rp <?= number_format($revenue,0,',','.') ?>">
                Rp <?= number_format($revenue/1000, 0) ?>k
            </p>
            <p class="text-xs font-bold mt-2 bg-black text-white inline-block px-2 py-1">LIFETIME</p>
        </div>

        <!-- Orders Card -->
        <div class="bg-[#FDE047] border-4 border-black p-6 shadow-neo hover:-translate-y-2 transition-transform">
            <h3 class="text-lg font-black uppercase mb-1">Perlu Diproses</h3>
            <p class="text-5xl font-black"><?= $pending_count ?></p>
            <p class="text-xs font-bold mt-2 bg-black text-white inline-block px-2 py-1">PENDING / SUCCESS</p>
        </div>

        <!-- Products Card -->
        <div class="bg-white border-4 border-black p-6 shadow-neo hover:-translate-y-2 transition-transform">
            <h3 class="text-lg font-black uppercase mb-1">Total Produk</h3>
            <p class="text-5xl font-black"><?= $files_count ?></p>
            <a href="produk/index.php" class="text-xs font-bold mt-2 underline">Lihat Detail -></a>
        </div>

        <!-- Users Card -->
        <div class="bg-[#a5b4fc] border-4 border-black p-6 shadow-neo hover:-translate-y-2 transition-transform">
            <h3 class="text-lg font-black uppercase mb-1">Pelanggan</h3>
            <p class="text-5xl font-black"><?= $users_count ?></p>
            <p class="text-xs font-bold mt-2 bg-black text-white inline-block px-2 py-1">ACTIVE USERS</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- CHART SECTION (2 Columns) -->
        <div class="lg:col-span-2 bg-white border-4 border-black p-6 shadow-neo relative">
            <h2 class="text-2xl font-black uppercase mb-6 border-b-4 border-black inline-block pb-1">
                📈 Statistik Penjualan (7 Hari)
            </h2>
            <div class="h-[300px] w-full">
                <canvas id="salesChart"></canvas>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute top-4 right-4 text-xs font-bold bg-black text-white px-2 py-1 transform rotate-3">
                LIVE DATA
            </div>
        </div>

        <!-- RECENT ORDERS (1 Column) -->
        <div class="bg-white border-4 border-black p-0 shadow-neo flex flex-col">
            <div class="p-6 border-b-4 border-black bg-gray-50">
                <h2 class="text-2xl font-black uppercase">🔥 Order Terbaru</h2>
            </div>
            
            <div class="flex-1 overflow-auto max-h-[300px] p-0">
                <?php
                $recent_orders = $conn->query("SELECT p.*, pl.nama FROM pesanan p JOIN pelanggan pl ON p.pelanggan_id = pl.id ORDER BY p.tanggal_pesanan DESC LIMIT 5");
                if($recent_orders->num_rows > 0):
                ?>
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-white shadow-sm z-10">
                        <tr>
                            <th class="p-3 font-bold uppercase text-xs border-b-2 border-black bg-gray-100">Info</th>
                            <th class="p-3 font-bold uppercase text-xs border-b-2 border-black bg-gray-100 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ro = $recent_orders->fetch_assoc()): ?>
                        <tr class="border-b border-gray-200 last:border-0 hover:bg-yellow-50 transition-colors">
                            <td class="p-3">
                                <div class="font-black">#<?= $ro['id'] ?> - <?= htmlspecialchars($ro['nama']) ?></div>
                                <div class="text-xs text-gray-500 font-mono">Rp <?= number_format($ro['total_harga'],0,',','.') ?></div>
                            </td>
                            <td class="p-3 text-right">
                                <?php
                                $status_color = match($ro['status']) {
                                    'pending' => 'bg-yellow-300',
                                    'paid', 'success' => 'bg-blue-300',
                                    'completed' => 'bg-green-400',
                                    'cancelled' => 'bg-red-400',
                                    default => 'bg-gray-200'
                                };
                                ?>
                                <span class="text-[10px] font-black uppercase px-2 py-1 border-2 border-black <?= $status_color ?>">
                                    <?= $ro['status'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <div class="p-8 text-center">
                        <p class="font-bold text-gray-400">Belum ada data.</p>
                    </div>
                <?php endif; ?>
            </div>
            <a href="/warung-digital/admin/pesanan/index.php" class="block text-center py-4 bg-black text-white font-black uppercase hover:bg-gray-800 transition-all border-t-4 border-black">
                Lihat Semua Order →
            </a>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="produk/tambah.php" class="bg-white border-4 border-black p-4 font-bold uppercase shadow-neo-sm hover:shadow-neo hover:-translate-y-1 transition-all text-center flex flex-col items-center gap-2 group">
            <span class="text-2xl group-hover:scale-110 transition-transform">📦</span>
            <span>Tambah Produk</span>
        </a>
        <a href="kategori/index.php" class="bg-white border-4 border-black p-4 font-bold uppercase shadow-neo-sm hover:shadow-neo hover:-translate-y-1 transition-all text-center flex flex-col items-center gap-2 group">
            <span class="text-2xl group-hover:scale-110 transition-transform">🏷️</span>
            <span>Kategori</span>
        </a>
        <a href="pesanan/index.php" class="bg-white border-4 border-black p-4 font-bold uppercase shadow-neo-sm hover:shadow-neo hover:-translate-y-1 transition-all text-center flex flex-col items-center gap-2 group">
            <span class="text-2xl group-hover:scale-110 transition-transform">⚡</span>
            <span>Proses Order</span>
        </a>
        <a href="../index.php" target="_blank" class="bg-neo-accent border-4 border-black p-4 font-bold uppercase shadow-neo-sm hover:shadow-neo hover:-translate-y-1 transition-all text-center flex flex-col items-center gap-2 group">
            <span class="text-2xl group-hover:scale-110 transition-transform">🌐</span>
            <span>Lihat Website</span>
        </a>
    </div>
</div>

<script>
    // Config Chart.js
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= $js_labels ?>,
            datasets: [{
                label: 'Order Selesai',
                data: <?= $js_data ?>,
                backgroundColor: '#000000',
                borderColor: '#000000',
                borderWidth: 0,
                barThickness: 40,
                hoverBackgroundColor: '#FDE047'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e5e5e5',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        stepSize: 1,
                        font: {
                            family: 'Space Grotesk',
                            weight: 'bold'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Space Grotesk',
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: { // Neo-brutalism tooltip style
                    backgroundColor: '#000',
                    titleFont: { family: 'Space Grotesk', size: 14 },
                    bodyFont: { family: 'Space Grotesk', size: 14 },
                    padding: 12,
                    cornerRadius: 0,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return context.raw + ' Pesanan';
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>
