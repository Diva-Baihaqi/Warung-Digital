<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

// Fetch categories
$cats = $conn->query("SELECT * FROM kategori");

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $kat_id = $_POST['kategori_id'];
    
    // Upload Image
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $gambar_db = "";
    
    if($gambar) {
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $file_ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
        if(in_array($file_ext, $extensions)) {
            $new_name = uniqid() . '.' . $file_ext;
            // Move to root uploads folder
            move_uploaded_file($tmp_name, "../../uploads/" . $new_name);
            $gambar_db = $new_name;
        }
    }

    $stmt = $conn->prepare("INSERT INTO produk (nama_produk, harga, stok, deskripsi, gambar, kategori_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siisss", $nama, $harga, $stok, $deskripsi, $gambar_db, $kat_id);
    
    if ($stmt->execute()) {
        echo "<script>window.location='index.php';</script>";
    } else {
        $error = "Gagal menambah data.";
    }
}
?>

<div class="flex-1 p-8">
    <div class="max-w-3xl">
        <h1 class="text-4xl font-black uppercase mb-8">Tambah Produk Baru</h1>

        <div class="bg-white border-4 border-black p-8 shadow-neo">
            <form method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label class="block font-black uppercase mb-2">Nama Produk</label>
                    <input type="text" name="nama" required class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                </div>
                
                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <label class="block font-black uppercase mb-2">Harga</label>
                        <input type="number" name="harga" required class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                    </div>
                    <div>
                        <label class="block font-black uppercase mb-2">Stok</label>
                        <input type="number" name="stok" required value="0" min="0" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                    </div>
                    <div>
                        <label class="block font-black uppercase mb-2">Kategori</label>
                        <select name="kategori_id" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none bg-white">
                            <?php while($c = $cats->fetch_assoc()): ?>
                                <option value="<?= $c['id'] ?>"><?= $c['nama_kategori'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none"></textarea>
                </div>

                <div>
                    <label class="block font-black uppercase mb-2">Gambar</label>
                    <input type="file" name="gambar" class="w-full border-4 border-black p-3 font-bold bg-neo-bg">
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="index.php" class="bg-white border-4 border-black px-6 py-3 font-bold uppercase hover:bg-gray-100">Batal</a>
                    <button type="submit" name="submit" class="bg-neo-black text-white border-4 border-black px-6 py-3 font-bold uppercase hover:bg-neo-accent hover:text-black hover:shadow-neo transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
