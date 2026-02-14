<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

// Delete Logic
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM pelanggan WHERE id = $id");
    echo "<script>window.location='index.php';</script>";
}

$users = $conn->query("SELECT * FROM pelanggan ORDER BY created_at DESC");
?>

<div class="flex-1 p-8">
    <h1 class="text-4xl font-black uppercase mb-8">Data Pelanggan</h1>

    <div class="bg-white border-4 border-black shadow-neo overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-neo-black text-white uppercase font-black">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Alamat</th>
                    <th class="p-4">Bergabung</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $users->fetch_assoc()): ?>
                <tr class="border-b-2 border-black hover:bg-gray-50 font-bold">
                    <td class="p-4"><?= $row['id'] ?></td>
                    <td class="p-4"><?= $row['nama'] ?></td>
                    <td class="p-4"><?= $row['email'] ?></td>
                    <td class="p-4"><?= substr($row['alamat'], 0, 30) ?>...</td>
                    <td class="p-4"><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                    <td class="p-4">
                        <a href="?delete=<?= $row['id'] ?>" onclick="return confirmAction(event, 'Hapus user ini?', this.href)" class="bg-red-500 text-white px-3 py-1 border-2 border-black hover:shadow-sm">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
