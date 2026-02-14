<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

if (!isset($_GET['id'])) {
    echo "<script>alertRedirect('ID Pesanan tidak ditemukan', 'index.php');</script>";
    exit;
}

$id = $conn->real_escape_string($_GET['id']);

// Ambil Header Pesanan
$sql_order = "SELECT p.*, pl.nama, pl.email, pl.alamat, pl.id as pelanggan_id 
              FROM pesanan p 
              JOIN pelanggan pl ON p.pelanggan_id = pl.id 
              WHERE p.id = '$id'";
$res_order = $conn->query($sql_order);

if ($res_order->num_rows == 0) {
    echo "<script>alertRedirect('Pesanan tidak ditemukan', 'index.php');</script>";
    exit;
}

$order = $res_order->fetch_assoc();

// Update Status Handler
if(isset($_POST['update_status'])) {
    $status = $_POST['status'];
    $conn->query("UPDATE pesanan SET status = '$status' WHERE id = $id");
    echo "<script>window.location='detail.php?id=$id';</script>";
    exit;
}

// Ambil Detail Barang
$sql_detail = "SELECT dp.*, pr.nama_produk, pr.gambar 
               FROM detail_pesanan dp 
               JOIN produk pr ON dp.produk_id = pr.id 
               WHERE dp.pesanan_id = '$id'";
$details = $conn->query($sql_detail);
?>

<div class="flex-1 p-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-black uppercase">Detail Pesanan #<?= $order['id'] ?></h1>
        <a href="index.php" class="bg-gray-200 border-2 border-black px-4 py-2 font-bold hover:bg-gray-300 transition-all">
            &larr; Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Kolom Kiri: Detail Items -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white border-4 border-black p-6 shadow-neo">
                <h2 class="text-2xl font-black uppercase mb-6 border-b-4 border-black pb-2">Daftar Produk</h2>
                <div class="space-y-4">
                    <?php while($item = $details->fetch_assoc()): ?>
                    <div class="flex items-center gap-4 border-2 border-black p-4 bg-gray-50">
                        <div class="w-20 h-20 border-2 border-black bg-white flex-shrink-0">
                            <?php if(!empty($item['gambar'])): ?>
                                <img src="../../uploads/<?= $item['gambar'] ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-2xl">📦</div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-black text-lg"><?= $item['nama_produk'] ?></h3>
                            <p class="text-sm font-bold text-gray-500">
                                <?= $item['jumlah'] ?> x Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?>
                            </p>
                        </div>
                        <div class="text-right font-black text-xl">
                            Rp <?= number_format($item['jumlah'] * $item['harga_satuan'], 0, ',', '.') ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                
                <div class="mt-6 border-t-4 border-black pt-4 flex justify-between items-center">
                    <span class="text-xl font-bold uppercase">Total Pembayaran</span>
                    <span class="text-3xl font-black bg-neo-secondary px-4 py-1 border-2 border-black shadow-neo-sm transform -rotate-1">
                        Rp <?= number_format($order['total_harga'], 0, ',', '.') ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Info Customer & Status -->
        <div class="space-y-8">
            <!-- Info Pelanggan -->
            <div class="bg-neo-bg border-4 border-black p-6 shadow-neo">
                <h2 class="text-xl font-black uppercase mb-4 border-b-2 border-black pb-2">Informasi Pelanggan</h2>
                <div class="space-y-2 font-bold">
                    <div>
                        <span class="text-gray-500 text-sm uppercase">Nama</span>
                        <div class="text-lg"><?= $order['nama'] ?></div>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm uppercase">Email</span>
                        <div class="text-lg"><?= $order['email'] ?></div>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm uppercase">Alamat</span>
                        <div class="text-lg"><?= !empty($order['alamat']) ? nl2br($order['alamat']) : '-' ?></div>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm uppercase">Waktu Pesanan</span>
                        <div class="text-lg"><?= $order['tanggal_pesanan'] ?></div>
                    </div>
                </div>
            </div>

            <!-- Bukti Pembayaran -->
            <?php if(!empty($order['bukti_pembayaran'])): ?>
            <div class="bg-white border-4 border-black p-6 shadow-neo">
                <h2 class="text-xl font-black uppercase mb-4 border-b-2 border-black pb-2">Bukti Pembayaran</h2>
                <div class="relative group">
                    <img src="../../uploads/kwitansi/<?= $order['bukti_pembayaran'] ?>" class="w-full border-2 border-black h-48 object-cover">
                    <a href="../../uploads/kwitansi/<?= $order['bukti_pembayaran'] ?>" target="_blank" class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 flex items-center justify-center transition-all opacity-0 group-hover:opacity-100">
                        <span class="bg-white border-2 border-black px-4 py-2 font-black uppercase transform scale-90 group-hover:scale-100 transition-transform">
                            Lihat Full
                        </span>
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <!-- Update Status -->
            <div class="bg-white border-4 border-black p-6 shadow-neo">
                <h2 class="text-xl font-black uppercase mb-4 border-b-2 border-black pb-2">Update Status</h2>
                
                <div class="mb-4">
                    <span class="block text-gray-500 text-sm uppercase mb-1">Status Saat Ini</span>
                    <?php 
                    $colors = [
                        'pending' => 'bg-yellow-200', 
                        'paid' => 'bg-blue-200', 
                        'shipped' => 'bg-purple-200', 
                        'completed' => 'bg-green-200', 
                        'cancelled' => 'bg-red-200'
                    ];
                    $bg = $colors[$order['status']] ?? 'bg-gray-200';
                    ?>
                    <span class="<?= $bg ?> border-2 border-black px-3 py-1 inline-block font-black uppercase tracking-wider">
                        <?= $order['status'] ?>
                    </span>
                </div>

                <form method="POST" class="space-y-4">
                    <select name="status" class="w-full border-4 border-black p-3 font-bold bg-white focus:shadow-neo transition-all cursor-pointer">
                        <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>PENDING (Menunggu)</option>
                        <option value="paid" <?= $order['status'] == 'paid' ? 'selected' : '' ?>>PAID (Dibayar)</option>
                        <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>COMPLETED (Selesai)</option>
                        <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>CANCELLED (Batal)</option>
                    </select>
                    <button type="submit" name="update_status" class="w-full bg-neo-black text-white border-4 border-black py-3 font-black uppercase hover:bg-neo-accent hover:text-black transition-all shadow-neo-sm active:translate-y-1 active:shadow-none">
                        Simpan Status
                    </button>
                </form>
            </div>
            
            <div class="text-center">
                <?php
                // Get WA Number from 'alamat' field (as per checkout logic)
                $wa = preg_replace('/[^0-9]/', '', $order['alamat']);
                if (substr($wa, 0, 1) == '0') {
                    $wa = '62' . substr($wa, 1);
                }
                ?>
                <a href="https://wa.me/<?= $wa ?>" target="_blank" class="inline-block w-full bg-[#25D366] text-white border-4 border-black py-3 font-black uppercase shadow-neo hover:translate-y-[-2px] transition-all flex items-center justify-center gap-2">
                    <span class="text-xl">💬</span> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
