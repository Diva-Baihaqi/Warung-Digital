<?php
include '../../config/database.php';
checkAdmin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data dulu untuk tahu produk_id nya
    $data = $conn->query("SELECT produk_id, status FROM produk_akun WHERE id = $id")->fetch_assoc();
    
    if($data) {
        $pid = $data['produk_id'];
        
        // Hapus data
        $conn->query("DELETE FROM produk_akun WHERE id = $id");
        
        // Kurangi stok fisik di tabel produk HANYA JIKA status masih 'tersedia'
        // Kalau 'terjual', berarti stok sudah berkurang saat checkout, jadi hapus history tidak boleh kurangi stok lagi.
        if($data['status'] == 'tersedia') {
            $conn->query("UPDATE produk SET stok = stok - 1 WHERE id = $pid AND stok > 0");
        }
    }
}

header("Location: index.php");
?>
