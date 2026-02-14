<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM produk WHERE id = $id")->fetch_assoc();
$cats = $conn->query("SELECT * FROM kategori");

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $kat_id = $_POST['kategori_id'];
    
    $gambar_db = $data['gambar'];
    
    if(!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $file_ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
        if(in_array($file_ext, $extensions)) {
            if($data['gambar'] && file_exists("../../uploads/" . $data['gambar'])) {
                unlink("../../uploads/" . $data['gambar']);
            }
            $new_name = uniqid() . '.' . $file_ext;
            move_uploaded_file($tmp_name, "../../uploads/" . $new_name);
            $gambar_db = $new_name;
        }
    }

    $stmt = $conn->prepare("UPDATE produk SET nama_produk=?, harga=?, stok=?, deskripsi=?, gambar=?, kategori_id=? WHERE id=?");
    $stmt->bind_param("siisssi", $nama, $harga, $stok, $deskripsi, $gambar_db, $kat_id, $id);
    
    if ($stmt->execute()) {
        echo "<script>window.location='index.php';</script>";
    }
}
?>

<div class="flex-1 p-8">
    <div class="max-w-3xl">
        <h1 class="text-4xl font-black uppercase mb-8">Edit Produk</h1>

        <div class="bg-white border-4 border-black p-8 shadow-neo">
            <form method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label class="block font-black uppercase mb-2">Nama Produk</label>
                    <input type="text" name="nama" value="<?= $data['nama_produk'] ?>" required class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                </div>
                
                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <label class="block font-black uppercase mb-2">Harga</label>
                        <input type="number" name="harga" value="<?= $data['harga'] ?>" required class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                    </div>
                    <div>
                        <label class="block font-black uppercase mb-2">Stok</label>
                        <input type="number" name="stok" value="<?= $data['stok'] ?>" required class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                    </div>
                    <div>
                        <label class="block font-black uppercase mb-2">Kategori</label>
                        <select name="kategori_id" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none bg-white">
                            <?php while($c = $cats->fetch_assoc()): ?>
                                <option value="<?= $c['id'] ?>" <?= ($data['kategori_id'] == $c['id']) ? 'selected' : '' ?>><?= $c['nama_kategori'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none"><?= $data['deskripsi'] ?></textarea>
                </div>

                <div>
                    <label class="block font-black uppercase mb-2">Gambar</label>
                    <?php if($data['gambar']): ?>
                        <div class="mb-2"><img src="../../uploads/<?= $data['gambar'] ?>" class="h-20 border-2 border-black"></div>
                    <?php endif; ?>
                    <input type="file" name="gambar" class="w-full border-4 border-black p-3 font-bold bg-neo-bg">
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="index.php" class="bg-white border-4 border-black px-6 py-3 font-bold uppercase hover:bg-gray-100">Batal</a>
                    <button type="submit" name="update" class="bg-neo-black text-white border-4 border-black px-6 py-3 font-bold uppercase hover:bg-neo-accent hover:text-black hover:shadow-neo transition-all">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
