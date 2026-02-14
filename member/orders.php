<?php
include '../config/database.php';
include '../includes/public_header.php';

if (!isMemberLoggedIn()) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// --- Auto-Assign Logic for Completed Orders ---
$pending_assignment = $conn->query("SELECT id FROM pesanan WHERE pelanggan_id = '$user_id' AND status = 'completed'");
while($ord = $pending_assignment->fetch_assoc()) {
    $oid_chk = $ord['id'];
    $items_chk = $conn->query("SELECT * FROM detail_pesanan WHERE pesanan_id = '$oid_chk'");
    while($item_chk = $items_chk->fetch_assoc()) {
        $pid_chk = $item_chk['produk_id'];
        $qty_chk = $item_chk['jumlah'];
        
        // Check assigned count
        $assigned_count = $conn->query("SELECT COUNT(*) as c FROM produk_akun WHERE pesanan_id = '$oid_chk' AND produk_id = '$pid_chk'")->fetch_assoc()['c'];
        $needed = $qty_chk - $assigned_count;
        
        if ($needed > 0) {
            $sql_assign = "UPDATE produk_akun SET status = 'terjual', pesanan_id = '$oid_chk' WHERE produk_id = '$pid_chk' AND status = 'tersedia' LIMIT $needed";
            $conn->query($sql_assign);
        }
    }
}
// --- End Auto-Assign ---

// Handle Cancellation
if (isset($_POST['cancel_order'])) {
    $order_id = $conn->real_escape_string($_POST['order_id']);
    
    // Verify ownership and status
    $check = $conn->query("SELECT id FROM pesanan WHERE id = '$order_id' AND pelanggan_id = '$user_id' AND status = 'pending'");
    
    if ($check->num_rows > 0) {
        $conn->query("UPDATE pesanan SET status = 'cancelled' WHERE id = '$order_id'");
        echo "<script>alertRedirect('Pesanan berhasil dibatalkan', 'orders.php');</script>";
    } else {
        echo "<script>alertRedirect('Gagal membatalkan pesanan', 'orders.php');</script>";
    }
}

// Handle Upload Bukti
if (isset($_POST['upload_bukti'])) {
    $order_id = $conn->real_escape_string($_POST['order_id']);
    
    $check = $conn->query("SELECT id FROM pesanan WHERE id = '$order_id' AND pelanggan_id = '$user_id' AND status = 'pending'");
    
    if ($check->num_rows > 0) {
        $file_name = $_FILES['bukti_file']['name'];
        $file_tmp = $_FILES['bukti_file']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
        
        if (in_array($file_ext, $allowed)) {
            $new_name = "bukti_" . $order_id . "_" . time() . "." . $file_ext;
            
            // Use absolute path and ensure directory exists
            $target_dir = __DIR__ . "/../uploads/kwitansi/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $upload_path = $target_dir . $new_name;
            $db_path = "uploads/kwitansi/" . $new_name; // Path stored in DB relative to web root if needed
            
            // Note: DB usually stores relative path, but let's check how it's used. 
            // In the previous code: "UPDATE ... bukti_pembayaran = '$new_name'". 
            // It seems it just stored the filename.
            // Let's store just the filename as before, or relative path?
            // Previous code: $upload_path = "uploads/bukti_pembayaran/" . $new_name;
            // ... move_uploaded_file(..., $upload_path)
            // ... status = ..., bukti_pembayaran = '$new_name'
            // It stored ONLY the filename in DB. The viewer (admin/member) presumably needs to know the folder.
            // Code in orders.php line 43 was logic.
            // Let's stick to storing filename, but upload to correct folder.
            
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Update status to success
                $conn->query("UPDATE pesanan SET status = 'success', bukti_pembayaran = '$new_name' WHERE id = '$order_id'");
                echo "<script>alertRedirect('Bukti pembayaran berhasil diupload! Pesanan Anda sedang diproses.', 'orders.php');</script>";
            } else {
                echo "<script>alertRedirect('Gagal mengupload file.', 'orders.php');</script>";
            }
        } else {
            echo "<script>alertRedirect('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.', 'orders.php');</script>";
        }
    } else {
        echo "<script>alertRedirect('Pesanan tidak valid.', 'orders.php');</script>";
    }
}

$orders = $conn->query("SELECT * FROM pesanan WHERE pelanggan_id = '$user_id' ORDER BY tanggal_pesanan DESC");
?>

<div class="container mx-auto px-4 py-8 max-w-5xl">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-black uppercase">Pesanan Saya</h1>
        <a href="<?= BASE_URL ?>/index.php" class="font-bold underline hover:text-neo-accent">Lanjut Belanja</a>
    </div>

    <?php if ($orders->num_rows > 0): ?>
        <div class="space-y-6">
            <?php while($row = $orders->fetch_assoc()): ?>
            <div class="bg-white border-4 border-black p-6 shadow-neo hover:-translate-y-1 transition-transform">
                <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 border-b-2 border-black pb-4 mb-4">
                    <div>
                        <span class="font-black text-lg">Order #<?= $row['id'] ?></span>
                        <div class="text-sm text-gray-500 font-bold"><?= $row['tanggal_pesanan'] ?></div>
                    </div>
                    
                    <?php 
                    $colors = [
                        'pending' => 'bg-neo-secondary', // Yellow
                        'paid' => 'bg-neo-muted',        // Violet
                        'shipped' => 'bg-cyan-400',      // Cyan (Vibrant)
                        'completed' => 'bg-green-400',   // Green (Vibrant)
                        'cancelled' => 'bg-neo-accent'   // Red
                    ];
                    $bg = $colors[$row['status']] ?? 'bg-gray-200';
                    ?>
                    <div class="flex items-center gap-4">
                        <span class="<?= $bg ?> border-2 border-black px-3 py-1 font-black uppercase tracking-wider text-sm">
                            <?= $row['status'] ?>
                        </span>
                    </div>
                </div>

                <!-- Items Preview -->
                <?php
                $oid = $row['id'];
                $items = $conn->query("SELECT dp.*, p.nama_produk FROM detail_pesanan dp JOIN produk p ON dp.produk_id = p.id WHERE dp.pesanan_id = '$oid'");
                ?>
                <div class="space-y-2 mb-4">
                    <?php while($item = $items->fetch_assoc()): ?>
                    <div class="flex justify-between text-sm font-bold">
                        <span><?= $item['nama_produk'] ?> <span class="text-gray-500">x<?= $item['jumlah'] ?></span></span>
                        <span>Rp <?= number_format($item['harga_satuan'] * $item['jumlah'], 0, ',', '.') ?></span>
                    </div>
                    <?php endwhile; ?>
                </div>

                <div class="flex justify-between items-center border-t-2 border-dashed border-black pt-4">
                    <div class="flex items-center gap-4">
                        <span class="font-bold text-gray-500 uppercase">Total Belanja</span>
                        <span class="font-black text-2xl">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <a href="<?= BASE_URL ?>/cetak_struk.php?id=<?= $row['id'] ?>" target="_blank" class="bg-neo-black text-white border-2 border-black px-4 py-2 font-bold uppercase hover:bg-gray-800 hover:shadow-neo-sm transition-all text-xs">
                            Cetak Struk
                        </a>

                        <?php if($row['status'] == 'completed'): ?>
                            <button onclick="document.getElementById('view-order-<?= $row['id'] ?>').classList.remove('hidden')" class="bg-neo-accent text-black border-2 border-black px-4 py-2 font-bold uppercase hover:bg-yellow-400 hover:shadow-neo-sm transition-all text-xs">
                                Lihat Data
                            </button>
                            
                            <!-- Modal View Order -->
                            <div id="view-order-<?= $row['id'] ?>" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
                                <div class="bg-white border-4 border-black p-6 max-w-lg w-full shadow-neo-lg relative max-h-[90vh] overflow-y-auto">
                                    <button onclick="document.getElementById('view-order-<?= $row['id'] ?>').classList.add('hidden')" class="absolute top-2 right-2 font-black text-xl hover:text-red-500">&times;</button>
                                    <h3 class="text-xl font-black uppercase mb-6 border-b-4 border-black pb-2">Data Pesanan #<?= $row['id'] ?></h3>
                                    
                                    <div class="space-y-6">
                                        <?php
                                        // Fetch assigned accounts
                                        $accounts = $conn->query("
                                            SELECT pa.*, p.nama_produk 
                                            FROM produk_akun pa 
                                            JOIN produk p ON pa.produk_id = p.id 
                                            WHERE pa.pesanan_id = '{$row['id']}'
                                        ");
                                        
                                        if($accounts->num_rows > 0):
                                            while($acc = $accounts->fetch_assoc()):
                                        ?>
                                            <div class="bg-gray-50 border-2 border-black p-4">
                                                <div class="font-bold text-lg mb-2 flex items-center gap-2">
                                                    <span>📦 <?= $acc['nama_produk'] ?></span>
                                                    <span class="text-xs bg-black text-white px-2 py-0.5 rounded shadow-sm"><?= strtoupper($acc['jenis_akun']) ?></span>
                                                </div>
                                                <div class="bg-white border border-gray-300 p-3 font-mono text-sm whitespace-pre-wrap select-all"><?= $acc['data_akun'] ?></div>
                                                <p class="text-xs text-gray-400 mt-2">*Rahasiakan data ini. Klik teks untuk copy.</p>
                                            </div>
                                        <?php 
                                            endwhile;
                                        else:
                                        ?>
                                            <div class="text-center p-4 bg-yellow-100 border-2 border-yellow-400 text-yellow-800 font-bold">
                                                Data belum tersedia. Hubungi Admin.
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="mt-6 text-right">
                                        <button onclick="document.getElementById('view-order-<?= $row['id'] ?>').classList.add('hidden')" class="bg-black text-white px-6 py-2 font-bold uppercase hover:bg-gray-800 transition-all">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($row['status'] == 'pending'): ?>
                        
                        <!-- Upload Button Trigger -->
                        <button onclick="document.getElementById('upload-modal-<?= $row['id'] ?>').classList.remove('hidden')" class="bg-neo-secondary text-black border-2 border-black px-4 py-2 font-bold uppercase hover:bg-yellow-400 hover:shadow-neo-sm transition-all text-xs">
                            Upload Bukti
                        </button>
                        
                        <!-- Cancel Button -->
                        <form method="POST" onsubmit="return confirmForm(event, 'Yakin ingin membatalkan pesanan ini?');">
                            <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                            <button type="submit" name="cancel_order" class="bg-red-500 text-white border-2 border-black px-4 py-2 font-bold uppercase hover:bg-red-600 hover:shadow-neo-sm transition-all text-xs">
                                Batalkan
                            </button>
                        </form>

                        <!-- Upload Modal -->
                        <div id="upload-modal-<?= $row['id'] ?>" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
                            <div class="bg-white border-4 border-black p-6 max-w-md w-full m-4 shadow-neo-lg relative">
                                <button onclick="document.getElementById('upload-modal-<?= $row['id'] ?>').classList.add('hidden')" class="absolute top-2 right-2 font-black text-xl hover:text-red-500">&times;</button>
                                
                                <h3 class="text-xl font-black uppercase mb-4">Upload Bukti Pembayaran</h3>
                                <p class="text-sm text-gray-600 mb-4">Silahkan transfer sesuai nominal, lalu upload bukti screenshot/fotonya disini.</p>
                                
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                                    <input type="file" name="bukti_file" required class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black file:text-sm file:font-bold file:bg-gray-100 mb-4 cursor-pointer">
                                    <button type="submit" name="upload_bukti" class="w-full bg-neo-accent border-2 border-black py-2 font-black uppercase hover:shadow-neo-sm transition-all">
                                        Kirim Bukti
                                    </button>
                                </form>
                            </div>
                        </div>

                        <?php endif; ?>
                    </div>
                </div>

                <!-- Success Message if Paid -->
                <?php if($row['status'] == 'success'): ?>
                <div class="bg-green-100 border-2 border-green-500 text-green-800 p-3 mt-4 text-sm font-bold flex items-center gap-2">
                    ✅ Pembayaran Berhasil! Pesanan sedang diproses. Silahkan cek WhatsApp anda berkala.
                </div>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-20 bg-gray-50 border-4 border-black border-dashed">
            <div class="text-6xl mb-4">🛍️</div>
            <h3 class="text-2xl font-bold uppercase mb-2">Belum ada pesanan</h3>
            <p class="font-medium text-gray-500 mb-6">Yuk mulai belanja kebutuhan digitalmu!</p>
            <a href="<?= BASE_URL ?>/index.php" class="inline-block bg-neo-accent border-4 border-black px-8 py-3 font-black uppercase shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all">
                Cari Produk
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
