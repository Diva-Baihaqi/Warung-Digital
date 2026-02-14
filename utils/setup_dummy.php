<?php
include __DIR__ . '/../config/database.php';

// 1. DUMMY REVIEWS
// Get Products
$products = [];
$res = $conn->query("SELECT id FROM produk");
while($row = $res->fetch_assoc()) $products[] = $row['id'];
if (count($products) == 0) {
    // Determine if we need to create dummy products? Let's assume there are products or create one.
     $conn->query("INSERT INTO produk (nama_produk, harga, deskripsi) VALUES ('Dummy Product', 10000, 'Desc')");
     $products[] = $conn->insert_id;
}

// Get Users
$users = [];
$res = $conn->query("SELECT id FROM pelanggan");
while($row = $res->fetch_assoc()) $users[] = $row['id'];
if (count($users) == 0) {
     $conn->query("INSERT INTO pelanggan (nama, email, password) VALUES ('Dummy User', 'dummy@example.com', '12345')");
     $users[] = $conn->insert_id;
}

$reviews_count = $conn->query("SELECT COUNT(*) as c FROM review")->fetch_assoc()['c'];
if ($reviews_count < 10) {
    $comments = [
        "Produk sangat bagus!", "Kualitas oke punya.", "Pengiriman cepat.", "Barang sesuai deskripsi.",
        "Mantap jiwa!", "Recommended seller.", "Harga bersahabat.", "Cukup puas.", "Akan order lagi.",
        "Bintang berbicara."
    ];
    
    for($i=0; $i<15; $i++) {
        $pid = $products[array_rand($products)];
        $uid = $users[array_rand($users)];
        $rating = rand(3, 5);
        $comment = $comments[array_rand($comments)];
        $conn->query("INSERT INTO review (produk_id, pelanggan_id, rating, komentar, created_at) VALUES ('$pid', '$uid', '$rating', '$comment', NOW())");
    }
    echo "Inserted dummy reviews.<br>";
}

// 2. DUMMY BLOG
// Ensure table structure exists - assuming it does based on file view, but let's be safe or just insert.
// If table doesn't exist, create it.
$conn->query("CREATE TABLE IF NOT EXISTS blog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    slug VARCHAR(255),
    konten TEXT,
    gambar VARCHAR(255),
    kategori VARCHAR(100),
    tanggal DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Ensure columns exist (if table already existed structure might be different)
try {
    $conn->query("ALTER TABLE blog ADD COLUMN slug VARCHAR(255)");
} catch (Exception $e) {}
try {
    $conn->query("ALTER TABLE blog ADD COLUMN konten TEXT");
} catch (Exception $e) {}
try {
    $conn->query("ALTER TABLE blog ADD COLUMN gambar VARCHAR(255)");
} catch (Exception $e) {}
try {
    $conn->query("ALTER TABLE blog ADD COLUMN kategori VARCHAR(100)");
} catch (Exception $e) {}

$blogs_count = $conn->query("SELECT COUNT(*) as c FROM blog")->fetch_assoc()['c'];
if ($blogs_count < 10) {
    $titles = [
        "Cara Hemat Belanja Online", "Tips Memilih Gadget Impian", "Resep Masakan Rumahan",
        "Tren Fashion 2024", "Panduan Merawat Tanaman", "Investasi Masa Depan",
        "Sehat Alami dengan Herbal", "Wisata Murah Meriah", "Teknologi AI Terbaru",
        "Hobi yang Menghasilkan Uang"
    ];
    
    foreach($titles as $title) {
        $slug = strtolower(str_replace(' ', '-', $title));
        $konten = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        $conn->query("INSERT INTO blog (judul, slug, konten, gambar, kategori, tanggal) VALUES ('$title', '$slug', '$konten', 'default.jpg', 'Tips', CURDATE())");
    }
    echo "Inserted dummy blogs.<br>";
}

// 3. DUMMY SOCIAL DATA
// Create tables if not exist
$conn->query("CREATE TABLE IF NOT EXISTS social_likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    target_type VARCHAR(50),
    target_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS social_follows (
    id INT AUTO_INCREMENT PRIMARY KEY,
    follower_id INT,
    following_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS social_shares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    platform VARCHAR(50),
    content_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Ensure columns exist for Social tables
// Ensure columns exist for Social tables
try { $conn->query("ALTER TABLE social_likes ADD COLUMN target_type VARCHAR(50)"); } catch (Exception $e) {}
try { $conn->query("ALTER TABLE social_likes ADD COLUMN target_id INT"); } catch (Exception $e) {}

try { $conn->query("ALTER TABLE social_shares ADD COLUMN platform VARCHAR(50)"); } catch (Exception $e) {}
try { $conn->query("ALTER TABLE social_shares ADD COLUMN content_id INT"); } catch (Exception $e) {}

try { $conn->query("ALTER TABLE social_follows ADD COLUMN follower_id INT"); } catch (Exception $e) {}
try { $conn->query("ALTER TABLE social_follows ADD COLUMN following_id INT"); } catch (Exception $e) {}

// Insert Dummy Likes
if ($conn->query("SELECT COUNT(*) as c FROM social_likes")->fetch_assoc()['c'] < 10) {
    for($i=0; $i<15; $i++) {
        $uid = $users[array_rand($users)];
        $conn->query("INSERT INTO social_likes (user_id, target_type, target_id) VALUES ('$uid', 'produk', ".rand(1,100).")");
    }
}

// Insert Dummy Follows
if ($conn->query("SELECT COUNT(*) as c FROM social_follows")->fetch_assoc()['c'] < 10) {
    for($i=0; $i<15; $i++) {
        $uid = $users[array_rand($users)];
        $fid = $users[array_rand($users)];
        $conn->query("INSERT INTO social_follows (follower_id, following_id) VALUES ('$uid', '$fid')");
    }
}

// Insert Dummy Shares
if ($conn->query("SELECT COUNT(*) as c FROM social_shares")->fetch_assoc()['c'] < 10) {
    $platforms = ['Facebook', 'Twitter', 'WhatsApp', 'Instagram'];
    for($i=0; $i<15; $i++) {
        $uid = $users[array_rand($users)];
        $plat = $platforms[array_rand($platforms)];
        $conn->query("INSERT INTO social_shares (user_id, platform, content_id) VALUES ('$uid', '$plat', ".rand(1,100).")");
    }
}

// 4. DUMMY SALES FOR REPORT (TODAY)
if ($conn->query("SELECT COUNT(*) as c FROM pesanan WHERE DATE(tanggal_pesanan) = CURDATE()")->fetch_assoc()['c'] < 10) {
    echo "Inserting dummy sales orders...<br>";
    $statuses = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];
    
    for($i=0; $i<15; $i++) {
        $uid = $users[array_rand($users)];
        $total = rand(50000, 500000);
        $status = $statuses[array_rand($statuses)];
        $date = date('Y-m-d H:i:s', strtotime('-'.rand(0, 12).' hours')); // Today random time
        
        $conn->query("INSERT INTO pesanan (pelanggan_id, total_harga, status, tanggal_pesanan) VALUES ('$uid', '$total', '$status', '$date')");
    }
}

echo "All dummy data setup complete.";
?>
