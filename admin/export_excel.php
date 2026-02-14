<?php
include '../config/database.php';
// checkAdmin(); // Uncomment if needed

// Parameters
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'completed';

// Build Query
$where = "WHERE p.tanggal_pesanan BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'";
if($status_filter != 'all') {
    $where .= " AND p.status = '$status_filter'";
}

$query = "SELECT p.id, p.tanggal_pesanan, pl.nama, pl.email, p.total_harga, p.status 
          FROM pesanan p 
          JOIN pelanggan pl ON p.pelanggan_id = pl.id 
          $where 
          ORDER BY p.tanggal_pesanan DESC";

$result = $conn->query($query);

// Headers for Download
$filename = "laporan_penjualan_" . date('Ymd', strtotime($start_date)) . "_to_" . date('Ymd', strtotime($end_date)) . ".csv";
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

// Create File Pointer
$output = fopen('php://output', 'w');

// Add BOM for Excel UTF-8 compatibility
fwrite($output, "\xEF\xBB\xBF");

// Add Column Headers
fputcsv($output, ['Order ID', 'Tanggal', 'Nama Pelanggan', 'Email', 'Status', 'Total (Rp)']);

// Add Data Rows
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        fputcsv($output, [
            '#' . $row['id'],
            $row['tanggal_pesanan'],
            $row['nama'],
            $row['email'],
            strtoupper($row['status']),
            $row['total_harga']
        ]);
    }
} else {
    fputcsv($output, ['Tidak ada data untuk periode ini']);
}

fclose($output);
exit;
?>
