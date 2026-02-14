<?php
require 'config/database.php';

if (!isMemberLoggedIn()) {
    header("Location: member/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("ID Pesanan tidak ditemukan.");
}

$id = $conn->real_escape_string($_GET['id']);
$user_id = $_SESSION['user_id'];

// Get Order Data
$sql = "SELECT p.*, pl.nama, pl.alamat FROM pesanan p JOIN pelanggan pl ON p.pelanggan_id = pl.id WHERE p.id = '$id' AND p.pelanggan_id = '$user_id'";
$res = $conn->query($sql);

if ($res->num_rows == 0) {
    die("Pesanan tidak ditemukan atau bukan milik Anda.");
}

$order = $res->fetch_assoc();

// Get Detail Data
$detail_sql = "SELECT dp.*, pr.nama_produk FROM detail_pesanan dp JOIN produk pr ON dp.produk_id = pr.id WHERE dp.pesanan_id = '$id'";
$details = $conn->query($detail_sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan #<?= $order['id'] ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; max-width: 400px; margin: 0 auto; padding: 20px; background: #fff; }
        .header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .title { font-size: 20px; font-weight: bold; }
        .info { margin-bottom: 10px; font-size: 14px; }
        .table { width: 100%; font-size: 14px; border-collapse: collapse; }
        .table th { text-align: left; border-bottom: 1px solid #000; }
        .table td { padding: 5px 0; }
        .total { border-top: 2px dashed #000; margin-top: 10px; padding-top: 10px; text-align: right; font-weight: bold; font-size: 16px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; }
        .status { text-transform: uppercase; border: 1px solid #000; display: inline-block; padding: 2px 5px; margin-top: 5px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <div class="title">WARUNG DIGITAL</div>
        <div>Solusi Produk Digital Terbaik</div>
        <div>WhatsApp: 0812-3456-7890</div>
    </div>

    <div class="info">
        <div>No. Order: #<?= $order['id'] ?></div>
        <div>Tanggal : <?= $order['tanggal_pesanan'] ?></div>
        <div>Pembeli : <?= $order['nama'] ?></div>
        <div>Status  : <span class="status"><?= $order['status'] ?></span></div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th style="text-align: right;">Jml</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php while($item = $details->fetch_assoc()): ?>
            <tr>
                <td><?= $item['nama_produk'] ?></td>
                <td style="text-align: right;"><?= $item['jumlah'] ?></td>
                <td style="text-align: right;"><?= number_format($item['jumlah'] * $item['harga_satuan'], 0, ',', '.') ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="total">
        TOTAL : Rp <?= number_format($order['total_harga'], 0, ',', '.') ?>
    </div>

    <div class="footer">
        <div>Terima kasih sudah berbelanja!</div>
        <div>Simpan struk ini sebagai bukti pembayaran.</div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 30px;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; font-weight: bold; background: #000; color: #fff; border: none;">Cetak / Simpan PDF</button>
        <br><br>
        <a href="member/orders.php" style="color: #000; text-decoration: underline;">Kembali ke Pesanan</a>
    </div>

</body>
</html>
