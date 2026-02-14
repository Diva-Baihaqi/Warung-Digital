<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

$prods = $conn->query("SELECT id, nama_produk FROM produk ORDER BY nama_produk ASC");

if (isset($_POST['simpan'])) {
    $produk_id = $_POST['produk_id'];
    $jenis = $_POST['jenis']; // akun / lisensi
    $raw_data = $_POST['data_akun'];

    // Split per baris (support bulk insert) (sebenarnya 1 baris 1 akun, atau dipisah enter 2x)
    // Sederhananya: Kita anggap admin input 1 data per box, ATAU kita buat fitur canggih.
    // Laporan bilang "Input Stok", mari buat single input dulu untuk keamanan, atau textarea besar tapi delimiter jelas.
    // Agar aman dan sesuai "data_akun" yang biasanya multiline (email \n password), kita anggap 1 input = 1 stok saja dulu biar tidak bingung.
    
    // TAPI, kalau jual Netflix biasanya Email:Pass (1 line). Kalau akun game bisa detail panjang.
    // Mari buat textarea biasa, 1 input = 1 stok item.
    
    $stmt = $conn->prepare("INSERT INTO produk_akun (produk_id, jenis_akun, data_akun, status) VALUES (?, ?, ?, 'tersedia')");
    $stmt->bind_param("iss", $produk_id, $jenis, $raw_data);
    
    if ($stmt->execute()) {
        // Update stok fisik di tabel produk (opsional, tapi bagus untuk sinkronisasi)
        $conn->query("UPDATE produk SET stok = stok + 1 WHERE id = $produk_id");
        
        echo "<script>alertRedirect('Stok berhasil ditambahkan!', 'index.php');</script>";
    } else {
        echo "<script>alertRedirect('Gagal!', 'index.php');</script>";
    }
}
?>

<div class="flex-1 p-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-4xl font-black uppercase mb-8">Tambah Stok Digital</h1>

        <div class="bg-white border-4 border-black p-8 shadow-neo">
            <form method="POST" class="space-y-6">
                <div>
                    <label class="block font-black uppercase mb-2">Pilih Produk</label>
                    <select name="produk_id" required class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none bg-white">
                        <option value="">-- Pilih Produk --</option>
                        <?php while($p = $prods->fetch_assoc()): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['nama_produk'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div>
                    <label class="block font-black uppercase mb-2">Jenis Data</label>
                    <select name="jenis" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none bg-white">
                        <option value="akun">Akun (Email & Password)</option>
                        <option value="lisensi">Kode Lisensi / Token</option>
                        <option value="file">Link Download</option>
                    </select>
                </div>

                <div>
                    <label class="block font-black uppercase mb-2">Data Akun / Lisensi</label>
                    <p class="text-xs text-gray-500 font-bold mb-2">*Masukkan detail lengkap (Email, Password, Expired, dll). Data ini yang akan dilihat pembeli.</p>
                    <textarea name="data_akun" rows="6" required class="w-full border-4 border-black p-3 font-bold font-mono focus:bg-yellow-50 outline-none" placeholder="Email: user@example.com&#10;Pass: secret123&#10;Exp: 2025-12-31"></textarea>
                </div>

                <div class="bg-yellow-100 border-l-4 border-black p-4 text-sm font-bold">
                    Info: Saat tombol Simpan ditekan, jumlah stok pada tabel Produk akan otomatis bertambah +1.
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="index.php" class="bg-white border-4 border-black px-6 py-3 font-bold uppercase hover:bg-gray-100 w-full text-center">Batal</a>
                    <button type="submit" name="simpan" class="bg-neo-black text-white border-4 border-black px-6 py-3 font-bold uppercase hover:bg-neo-accent hover:text-black hover:shadow-neo transition-all w-full">
                        Simpan Stok
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
