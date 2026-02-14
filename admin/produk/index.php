<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

$result = $conn->query("SELECT p.*, k.nama_kategori FROM produk p LEFT JOIN kategori k ON p.kategori_id = k.id ORDER BY p.created_at DESC");
?>

<div class="flex-1 p-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-black uppercase">Data Produk</h1>
        <a href="tambah.php" class="bg-neo-accent border-4 border-black px-6 py-3 font-bold uppercase shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all">
            + Tambah Produk
        </a>
    </div>

    <div class="overflow-x-auto border-4 border-black shadow-neo">
        <table class="w-full text-left border-collapse">
            <thead class="bg-neo-black text-white">
                <tr>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">#</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Gambar</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Nama Produk</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Kategori</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Harga</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Stok</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php $i=1; while($row = $result->fetch_assoc()): ?>
                <tr class="border-b-2 border-black hover:bg-yellow-50">
                    <td class="p-4 font-bold border-r-2 border-black"><?= $i++ ?></td>
                    <td class="p-4 border-r-2 border-black">
                        <?php if($row['gambar']): ?>
                            <img src="../../uploads/<?= $row['gambar'] ?>" class="h-16 w-16 object-cover border-2 border-black">
                        <?php else: ?>
                            <span class="text-gray-400">No Image</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-4 font-bold border-r-2 border-black"><?= $row['nama_produk'] ?></td>
                    <td class="p-4 border-r-2 border-black">
                        <span class="bg-neo-muted px-2 py-1 border-2 border-black text-xs font-bold uppercase">
                            <?= $row['nama_kategori'] ?? 'Uncategorized' ?>
                        </span>
                    </td>
                    <td class="p-4 font-mono font-bold border-r-2 border-black">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td class="p-4 font-mono font-bold border-r-2 border-black">
                        <?= $row['stok'] ?>
                    </td>
                    <td class="p-4 flex gap-2">
                        <a href="edit.php?id=<?= $row['id'] ?>" class="bg-neo-secondary border-2 border-black px-3 py-1 font-bold uppercase hover:bg-neo-accent transition-colors">Edit</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirmAction(event, 'Hapus produk ini?', this.href)" class="bg-white border-2 border-black px-3 py-1 font-bold uppercase hover:bg-red-500 hover:text-white transition-colors">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
