<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

// Pagination setup
$limit = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Fetch Categories for Filter
$cats = $conn->query("SELECT * FROM kategori");

// Filter
$where = "1=1";
if(isset($_GET['status']) && $_GET['status'] != '') {
    $s = $conn->real_escape_string($_GET['status']);
    $where .= " AND pa.status = '$s'";
}
if(isset($_GET['kategori_id']) && $_GET['kategori_id'] != '') {
    $k = (int)$_GET['kategori_id'];
    $where .= " AND p.kategori_id = $k";
}

$query = "SELECT pa.*, p.nama_produk, k.nama_kategori 
          FROM produk_akun pa 
          JOIN produk p ON pa.produk_id = p.id 
          LEFT JOIN kategori k ON p.kategori_id = k.id
          WHERE $where 
          ORDER BY pa.created_at DESC 
          LIMIT $start, $limit";
$result = $conn->query($query);

// Count total for pagination
$total = $conn->query("SELECT COUNT(*) as c FROM produk_akun pa JOIN produk p ON pa.produk_id = p.id WHERE $where")->fetch_assoc()['c'];
$pages = ceil($total / $limit);
?>

<div class="flex-1 p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-black uppercase">Stok Produk Digital</h1>
            <p class="text-gray-600 font-bold mt-2">Gudang Akun & Lisensi</p>
        </div>
        <a href="tambah.php" class="bg-neo-accent border-4 border-black px-6 py-3 font-bold uppercase shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all">
            + Tambah Stok
        </a>
    </div>

    <!-- Filter -->
    <div class="bg-white border-4 border-black p-4 mb-8 shadow-neo flex flex-wrap gap-4 items-center">
        <span class="font-bold uppercase">Filter:</span>
        
        <!-- Status Filter -->
        <a href="?status=&kategori_id=<?= $_GET['kategori_id'] ?? '' ?>" class="px-3 py-1 border-2 border-black font-bold hover:bg-gray-100 <?= !isset($_GET['status']) || $_GET['status'] == '' ? 'bg-neo-black text-white' : 'bg-white' ?>">Semua Status</a>
        <a href="?status=tersedia&kategori_id=<?= $_GET['kategori_id'] ?? '' ?>" class="px-3 py-1 border-2 border-black font-bold hover:bg-green-100 <?= (isset($_GET['status']) && $_GET['status'] == 'tersedia') ? 'bg-green-500 text-white' : 'bg-white' ?>">Tersedia</a>
        <a href="?status=terjual&kategori_id=<?= $_GET['kategori_id'] ?? '' ?>" class="px-3 py-1 border-2 border-black font-bold hover:bg-red-100 <?= (isset($_GET['status']) && $_GET['status'] == 'terjual') ? 'bg-red-500 text-white' : 'bg-white' ?>">Terjual</a>

        <span class="border-r-2 border-black h-6 mx-2"></span>

        <!-- Kategori Filter -->
        <form action="" method="GET" class="flex gap-2 items-center">
            <input type="hidden" name="status" value="<?= $_GET['status'] ?? '' ?>">
            <select name="kategori_id" onchange="this.form.submit()" class="border-2 border-black p-1 font-bold bg-white focus:bg-yellow-50 outline-none">
                <option value="">Semua Kategori</option>
                <?php while($c = $cats->fetch_assoc()): ?>
                    <option value="<?= $c['id'] ?>" <?= (isset($_GET['kategori_id']) && $_GET['kategori_id'] == $c['id']) ? 'selected' : '' ?>>
                        <?= $c['nama_kategori'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </form>
    </div>

    <div class="overflow-x-auto border-4 border-black shadow-neo">
        <table class="w-full text-left border-collapse">
            <thead class="bg-neo-black text-white">
                <tr>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">#</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Produk</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Kategori</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Data (Email/Key)</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Status</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Tgl Input</th>
                    <th class="p-4 border-b-4 border-black uppercase font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php $i=$start+1; if($result->num_rows > 0): while($row = $result->fetch_assoc()): ?>
                <tr class="border-b-2 border-black hover:bg-yellow-50">
                    <td class="p-4 font-bold border-r-2 border-black"><?= $i++ ?></td>
                    <td class="p-4 font-bold border-r-2 border-black text-lg"><?= $row['nama_produk'] ?></td>
                    <td class="p-4 border-r-2 border-black font-bold text-sm">
                        <span class="bg-gray-200 border border-black px-2 py-1 text-xs">
                            <?= $row['nama_kategori'] ?? 'Uncategorized' ?>
                        </span>
                    </td>
                    <td class="p-4 border-r-2 border-black font-mono text-sm whitespace-pre-line bg-gray-50 max-w-xs block overflow-hidden truncate">
                        <?= substr($row['data_akun'], 0, 50) ?>...
                    </td>
                    <td class="p-4 border-r-2 border-black">
                        <?php if($row['status'] == 'tersedia'): ?>
                            <span class="bg-green-200 text-green-800 border-2 border-black px-2 py-1 font-bold uppercase text-xs">Tersedia</span>
                        <?php else: ?>
                            <span class="bg-red-200 text-red-800 border-2 border-black px-2 py-1 font-bold uppercase text-xs">Terjual</span>
                            <div class="text-xs font-bold mt-1">Order ID: #<?= $row['pesanan_id'] ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="p-4 border-r-2 border-black font-bold text-sm">
                        <?= date('d M Y H:i', strtotime($row['created_at'])) ?>
                    </td>
                    <td class="p-4 flex gap-2">
                        <a href="edit.php?id=<?= $row['id'] ?>" class="bg-neo-secondary border-2 border-black px-3 py-1 font-bold uppercase hover:bg-yellow-400 transition-colors">Edit</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirmAction(event, 'Hapus data ini?', this.href)" class="bg-white border-2 border-black px-3 py-1 font-bold uppercase hover:bg-red-500 hover:text-white transition-colors">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr>
                    <td colspan="7" class="p-8 text-center font-bold text-gray-500 italic border-black">-- Tidak ada data stok yang sesuai filter --</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex gap-2 mt-4 justify-center">
        <?php for($p=1; $p<=$pages; $p++): ?>
            <a href="?page=<?= $p ?>&status=<?= $_GET['status'] ?? '' ?>&kategori_id=<?= $_GET['kategori_id'] ?? '' ?>" class="border-2 border-black px-4 py-2 font-bold hover:bg-neo-accent <?= $page == $p ? 'bg-neo-black text-white' : 'bg-white' ?>">
                <?= $p ?>
            </a>
        <?php endfor; ?>
    </div>
</div>

</body>
</html>
