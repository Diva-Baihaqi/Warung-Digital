<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM kategori WHERE id = $id");
    echo "<script>window.location='index.php';</script>";
}

if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $slug = strtolower(str_replace(' ', '-', $nama));
    $conn->query("INSERT INTO kategori (nama_kategori, slug) VALUES ('$nama', '$slug')");
}

$cats = $conn->query("SELECT * FROM kategori");
?>

<div class="flex-1 p-8">
    <h1 class="text-4xl font-black uppercase mb-8">Data Kategori</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Form -->
        <div class="bg-white border-4 border-black p-6 shadow-neo h-fit">
            <h3 class="text-xl font-black uppercase mb-4">Tambah Kategori</h3>
            <form method="POST" class="space-y-4">
                <input type="text" name="nama" placeholder="Nama Kategori" required class="w-full border-4 border-black p-3 font-bold">
                <button type="submit" name="submit" class="w-full bg-neo-black text-white border-4 border-black py-3 font-black uppercase hover:bg-neo-accent hover:text-black">
                    Simpan
                </button>
            </form>
        </div>

        <!-- List -->
        <div class="md:col-span-2">
            <div class="bg-white border-4 border-black shadow-neo">
                <table class="w-full text-left">
                    <thead class="bg-neo-black text-white font-black uppercase">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Nama</th>
                            <th class="p-4">Slug</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $cats->fetch_assoc()): ?>
                        <tr class="border-b-2 border-black hover:bg-gray-50 font-bold">
                            <td class="p-4"><?= $row['id'] ?></td>
                            <td class="p-4"><?= $row['nama_kategori'] ?></td>
                            <td class="p-4 text-gray-500"><?= $row['slug'] ?></td>
                            <td class="p-4">
                                <a href="?delete=<?= $row['id'] ?>" onclick="return confirmAction(event, 'Hapus kategori ini?', this.href)" class="text-red-500 hover:underline">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
