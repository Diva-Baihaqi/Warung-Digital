<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

$id = $_GET['id'] ?? 0;
$data = $conn->query("SELECT * FROM produk_akun WHERE id = $id")->fetch_assoc();

if(!$data) {
    header("Location: index.php");
    exit;
}

$prod_info = $conn->query("SELECT nama_produk FROM produk WHERE id = " . $data['produk_id'])->fetch_assoc();

if (isset($_POST['update'])) {
    $jenis = $_POST['jenis'];
    $raw_data = $_POST['data_akun'];
    $status = $_POST['status'];
    
    // Logic update stok fisik jika status berubah manual
    // Misal admin ubah 'tersedia' -> 'terjual' manual (kurangi stok)
    // Atau 'terjual' -> 'tersedia' (tambah stok)
    // Tapi ini agak kompleks, sederhananya kita update data saja dulu.
    
    $stmt = $conn->prepare("UPDATE produk_akun SET jenis_akun=?, data_akun=?, status=? WHERE id=?");
    $stmt->bind_param("sssi", $jenis, $raw_data, $status, $id);
    
    if ($stmt->execute()) {
        echo "<script>alertRedirect('Stok berhasil diupdate!', 'index.php');</script>";
    } else {
        echo "<script>alertRedirect('Gagal update!', 'index.php');</script>";
    }
}
?>

<div class="flex-1 p-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-4xl font-black uppercase mb-8">Edit Stok Digital</h1>

        <div class="bg-white border-4 border-black p-8 shadow-neo">
            <form method="POST" class="space-y-6">
                
                <div class="bg-gray-100 p-4 border-2 border-black">
                    <label class="block font-black uppercase text-xs text-gray-500">Produk</label>
                    <div class="font-bold text-xl"><?= $prod_info['nama_produk'] ?></div>
                </div>

                <div>
                    <label class="block font-black uppercase mb-2">Jenis Data</label>
                    <select name="jenis" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none bg-white">
                        <option value="akun" <?= $data['jenis_akun'] == 'akun' ? 'selected' : '' ?>>Akun (Email & Password)</option>
                        <option value="lisensi" <?= $data['jenis_akun'] == 'lisensi' ? 'selected' : '' ?>>Kode Lisensi / Token</option>
                        <option value="file" <?= $data['jenis_akun'] == 'file' ? 'selected' : '' ?>>Link Download</option>
                    </select>
                </div>

                <div>
                    <label class="block font-black uppercase mb-2">Data Akun / Lisensi</label>
                    <textarea name="data_akun" rows="6" required class="w-full border-4 border-black p-3 font-bold font-mono focus:bg-yellow-50 outline-none"><?= $data['data_akun'] ?></textarea>
                </div>

                <div>
                    <label class="block font-black uppercase mb-2">Status</label>
                    <select name="status" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none bg-white">
                        <option value="tersedia" <?= $data['status'] == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                        <option value="terjual" <?= $data['status'] == 'terjual' ? 'selected' : '' ?>>Terjual / Terpakai</option>
                    </select>
                    <p class="text-xs text-gray-500 font-bold mt-1">*Ubah status manual hanya jika diperlukan (misal retur).</p>
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="index.php" class="bg-white border-4 border-black px-6 py-3 font-bold uppercase hover:bg-gray-100 w-full text-center">Batal</a>
                    <button type="submit" name="update" class="bg-neo-black text-white border-4 border-black px-6 py-3 font-bold uppercase hover:bg-neo-accent hover:text-black hover:shadow-neo transition-all w-full">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
