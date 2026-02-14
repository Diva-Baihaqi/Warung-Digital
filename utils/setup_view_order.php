<?php
include '../config/database.php';

// 1. Create Table
$sql_create = "CREATE TABLE IF NOT EXISTS produk_akun (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produk_id INT NOT NULL,
    jenis_akun VARCHAR(50) DEFAULT 'akun', -- 'akun' or 'lisensi'
    data_akun TEXT NOT NULL,
    status ENUM('tersedia', 'terjual') DEFAULT 'tersedia',
    pesanan_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produk_id) REFERENCES produk(id) ON DELETE CASCADE,
    FOREIGN KEY (pesanan_id) REFERENCES pesanan(id) ON DELETE SET NULL
)";

if ($conn->query($sql_create) === TRUE) {
    echo "Tabel 'produk_akun' berhasil dibuat/diperiksa.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// 2. Clear existing dummy data (optional: cleanup availability)
// $conn->query("DELETE FROM produk_akun WHERE status = 'tersedia'"); 

// 3. Generate Dummy Data
$products = $conn->query("SELECT p.id, p.nama_produk, k.nama_kategori, p.stok 
                          FROM produk p 
                          JOIN kategori k ON p.kategori_id = k.id");

echo "<h3>Generate Dummy Data:</h3>";

if ($products->num_rows > 0) {
    while($p = $products->fetch_assoc()) {
        $pid = $p['id'];
        $pname = $p['nama_produk'];
        $kategori = $p['nama_kategori'];
        $stok = $p['stok']; // Generate based on stock? 
        // User said: "sesuai dengan stok yang tersedia". 
        // Note: Stok in produk table is just a number. 
        // We should double check if we already have enough rows.
        
        $current_rows = $conn->query("SELECT COUNT(*) as c FROM produk_akun WHERE produk_id = '$pid'")->fetch_assoc()['c'];
        
        $needed = $stok - $current_rows;
        
        if ($needed <= 0) {
            echo "Produk $pname sudah cukup datanya ($current_rows).<br>";
            continue;
        }
        
        // Limit generation to prevent timeouts if stock is very large, but aim for full stock
        $target_gen = $stok; 
        if($target_gen > 100) $target_gen = 100; // Safety cap
        
        $needed = $target_gen - $current_rows;
        
        if ($needed <= 0) {
            echo "Produk $pname sudah cukup datanya ($current_rows / $target_gen).<br>";
             continue;
        }

        echo "Generating $needed items for $pname...<br>";

        for ($i = 0; $i < $needed; $i++) {
            $data_content = "";
            $jenis = 'akun';
            
            if (stripos($kategori, 'Software') !== false || stripos($pname, 'License') !== false || stripos($pname, 'Windows') !== false) {
                $jenis = 'lisensi';
                $key = strtoupper(substr(md5(rand()), 0, 4) . '-' . substr(md5(rand()), 0, 4) . '-' . substr(md5(rand()), 0, 4) . '-' . substr(md5(rand()), 0, 4));
                $data_content = "License Key:\n$key";
            } else {
                // Account
                $domain = strtolower(str_replace(' ', '', $pname)) . ".com";
                $email = "user" . rand(1000, 9999) . "@gmail.com";
                $pass = "Pass" . rand(100, 999) . "!";
                $data_content = "Email: $email\nPassword: $pass";
                
                if (stripos($pname, 'Spotify') !== false) {
                    $data_content .= "\nPlan: Premium Individual\nExp: " . date('Y-m-d', strtotime('+30 days'));
                } elseif (stripos($pname, 'Netflix') !== false) {
                    $data_content .= "\nProfile: User 1\nPIN: 1234";
                } elseif (stripos($pname, 'ChatGPT') !== false) {
                    $data_content .= "\nType: Plus Subscription";
                }
            }
            
            $stmt = $conn->prepare("INSERT INTO produk_akun (produk_id, jenis_akun, data_akun, status) VALUES (?, ?, ?, 'tersedia')");
            $stmt->bind_param("iss", $pid, $jenis, $data_content);
            $stmt->execute();
        }
    }
} else {
    echo "Tidak ada produk ditemukan.<br>";
}

echo "Done.";
?>
