<?php
include '../config/database.php';
// checkAdmin(); // Uncomment if needed
include 'includes/header.php';
include 'includes/sidebar.php';

// Default: Current Month
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'completed';

// Build Query
$where = "WHERE p.tanggal_pesanan BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'";
if($status_filter != 'all') {
    $where .= " AND p.status = '$status_filter'";
}

$query = "SELECT p.*, pl.nama 
          FROM pesanan p 
          JOIN pelanggan pl ON p.pelanggan_id = pl.id 
          $where 
          ORDER BY p.tanggal_pesanan DESC";

$result = $conn->query($query);

// Calculate Totals
$total_revenue = 0;
$total_orders = $result->num_rows;
$data = [];
while($row = $result->fetch_assoc()) {
    $total_revenue += $row['total_harga'];
    $data[] = $row; // Store for display to avoid re-querying or resetting pointer
}
?>

<div class="flex-1 p-8 print:p-0 bg-neo-bg min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4 print:hidden">
        <div>
            <h1 class="text-5xl font-black uppercase tracking-tighter mb-2">Laporan Penjualan</h1>
            <p class="font-bold text-gray-500 border-l-4 border-neo-accent pl-3">Analisa performa penjualan warungmu.</p>
        </div>
        
        <div class="flex gap-2">
            <button onclick="window.print()" class="bg-gray-800 text-white border-4 border-black px-6 py-3 font-black uppercase shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Print / PDF
            </button>
            <a href="export_excel.php?start_date=<?= $start_date ?>&end_date=<?= $end_date ?>&status=<?= $status_filter ?>" target="_blank" class="bg-green-500 text-white border-4 border-black px-6 py-3 font-black uppercase shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Export Excel
            </a>
        </div>
    </div>

    <!-- Filter Section (No Print) -->
    <div class="bg-white border-4 border-black p-6 mb-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] print:hidden">
        <form method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label class="font-black uppercase text-sm mb-1 block">Dari Tanggal</label>
                <input type="date" name="start_date" value="<?= $start_date ?>" class="w-full border-4 border-black p-3 font-bold">
            </div>
            <div class="flex-1 w-full">
                <label class="font-black uppercase text-sm mb-1 block">Sampai Tanggal</label>
                <input type="date" name="end_date" value="<?= $end_date ?>" class="w-full border-4 border-black p-3 font-bold">
            </div>
            <div class="flex-1 w-full">
                <label class="font-black uppercase text-sm mb-1 block">Status Order</label>
                <select name="status" class="w-full border-4 border-black p-3 font-bold bg-white cursor-pointer">
                    <option value="all" <?= $status_filter == 'all' ? 'selected' : '' ?>>Semua Status</option>
                    <option value="completed" <?= $status_filter == 'completed' ? 'selected' : '' ?>>Completed (Selesai)</option>
                    <option value="pending" <?= $status_filter == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="paid" <?= $status_filter == 'paid' ? 'selected' : '' ?>>Paid</option>
                    <option value="shipped" <?= $status_filter == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                    <option value="cancelled" <?= $status_filter == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="bg-neo-accent text-black border-4 border-black px-8 py-3 font-black uppercase shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all w-full md:w-auto">
                Filter
            </button>
        </form>
    </div>

    <!-- Report Content (Printable) -->
    <div class="bg-white border-4 border-black p-8 shadow-neo print:shadow-none print:border-none print:p-0">
        <!-- Header for Print -->
        <div class="hidden print:block mb-8 border-b-4 border-black pb-4">
            <h2 class="text-4xl font-black uppercase">Warung Digital Report</h2>
            <p class="font-bold">Periode: <?= date('d F Y', strtotime($start_date)) ?> - <?= date('d F Y', strtotime($end_date)) ?></p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 print:grid-cols-3 print:gap-4">
            <div class="bg-green-100 border-4 border-black p-6 print:border-2">
                <h3 class="text-sm font-black uppercase text-gray-500 mb-1">Total Pendapatan</h3>
                <p class="text-3xl font-black">Rp <?= number_format($total_revenue, 0, ',', '.') ?></p>
            </div>
            <div class="bg-blue-100 border-4 border-black p-6 print:border-2">
                <h3 class="text-sm font-black uppercase text-gray-500 mb-1">Total Transaksi</h3>
                <p class="text-3xl font-black"><?= number_format($total_orders) ?></p>
            </div>
            <div class="bg-yellow-100 border-4 border-black p-6 print:border-2">
                <h3 class="text-sm font-black uppercase text-gray-500 mb-1">Rata-rata Basket</h3>
                <p class="text-3xl font-black">Rp <?= $total_orders > 0 ? number_format($total_revenue / $total_orders, 0, ',', '.') : 0 ?></p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left print:text-sm">
                <thead class="bg-black text-white uppercase font-black print:bg-gray-200 print:text-black">
                    <tr>
                        <th class="p-4 print:p-2 border-b-2 border-black">ID</th>
                        <th class="p-4 print:p-2 border-b-2 border-black">Tanggal</th>
                        <th class="p-4 print:p-2 border-b-2 border-black">Pelanggan</th>
                        <th class="p-4 print:p-2 border-b-2 border-black">Status</th>
                        <th class="p-4 print:p-2 border-b-2 border-black text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="font-bold">
                    <?php if(empty($data)): ?>
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500 italic border-b-2 border-gray-200">Tidak ada data untuk periode ini.</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach($data as $row): ?>
                        <tr class="border-b-2 border-gray-100 print:border-gray-300">
                            <td class="p-4 print:p-2">#<?= $row['id'] ?></td>
                            <td class="p-4 print:p-2"><?= date('d/m/Y H:i', strtotime($row['tanggal_pesanan'])) ?></td>
                            <td class="p-4 print:p-2"><?= $row['nama'] ?></td>
                            <td class="p-4 print:p-2 uppercase text-xs">
                                <span class="bg-gray-100 border border-black px-2 py-1"><?= $row['status'] ?></span>
                            </td>
                            <td class="p-4 print:p-2 text-right">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot class="bg-gray-50 print:bg-gray-100 font-black">
                    <tr>
                        <td colspan="4" class="p-4 text-right uppercase">Total Periode Ini</td>
                        <td class="p-4 text-right border-t-4 border-black">Rp <?= number_format($total_revenue, 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="hidden print:block mt-8 text-center text-xs font-bold text-gray-500">
            Dicetak oleh Admin pada <?= date('d F Y H:i:s') ?>
        </div>
    </div>
</div>

<style>
@media print {
    /* Hide sidebar, header, and filter */
    nav, aside, .print\:hidden { display: none !important; }
    
    body { background: white; }
    .flex-1 { margin: 0; padding: 0; }
    
    /* Ensure table borders print */
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #000 !important; }
}
</style>

</body>
</html>
