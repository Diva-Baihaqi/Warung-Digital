<?php
header('Content-Type: application/json');
include __DIR__ . '/../config/database.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Silahkan login terlebih dahulu']);
    exit;
}

// Get POST data
$input = json_decode(file_get_contents('php://input'), true);

if (empty($input['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Keranjang kosong']);
    exit;
}

$user_id = $_SESSION['user_id'];
$cart = $input['cart'];
$total_harga = 0;

// Calculate total and validate stock (optional, skipping stock for now as per simple requirement)
foreach ($cart as $item) {
    // Sanitize and validate logic here strictly if needed
    // For now assuming frontend data is okay, but recounting price is safer
    $prod_id = $conn->real_escape_string($item['id']);
    $res = $conn->query("SELECT harga FROM produk WHERE id = '$prod_id'");
    if ($res->num_rows > 0) {
        $prod = $res->fetch_assoc();
        $total_harga += $prod['harga'] * intval($item['qty']);
    }
}

// 0. Update Address if provided
if (!empty($input['address'])) {
    $address = $conn->real_escape_string($input['address']);
    $conn->query("UPDATE pelanggan SET alamat = '$address' WHERE id = '$user_id'");
}

// Service fee
$service_fee = isset($input['service_fee']) ? floatval($input['service_fee']) : 0;
$total_harga += $service_fee;

// Start Transaction
$conn->begin_transaction();

try {
    // 0. Validate Stock First
    foreach ($cart as $item) {
        $prod_id = intval($item['id']);
        $qty = intval($item['qty']);
        
        $stock_res = $conn->query("SELECT nama_produk, stok FROM produk WHERE id = $prod_id");
        if ($stock_res->num_rows > 0) {
            $prod = $stock_res->fetch_assoc();
            if ($prod['stok'] < $qty) {
                throw new Exception("Stok untuk produk '{$prod['nama_produk']}' tidak mencukupi (Sisa: {$prod['stok']})");
            }
        }
    }

    // 1. Insert Pesanan
    $stmt = $conn->prepare("INSERT INTO pesanan (pelanggan_id, total_harga, status, tanggal_pesanan) VALUES (?, ?, 'pending', NOW())");
    $stmt->bind_param("id", $user_id, $total_harga);
    
    if (!$stmt->execute()) {
        throw new Exception("Gagal membuat pesanan");
    }
    
    $pesanan_id = $conn->insert_id;
    
    // 2. Insert Detail Pesanan & Update Stock
    $stmt_detail = $conn->prepare("INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah, harga_satuan) VALUES (?, ?, ?, ?)");
    $stmt_update_stock = $conn->prepare("UPDATE produk SET stok = stok - ? WHERE id = ?");
    
    foreach ($cart as $item) {
        $prod_id = intval($item['id']);
        $qty = intval($item['qty']);
        // Fetch current price from DB for consistency
        $price_res = $conn->query("SELECT harga FROM produk WHERE id = $prod_id");
        $price_row = $price_res->fetch_assoc();
        $price = $price_row['harga'];
        
        $stmt_detail->bind_param("iiid", $pesanan_id, $prod_id, $qty, $price);
        if (!$stmt_detail->execute()) {
            throw new Exception("Gagal menyimpan detail pesanan");
        }

        // Deduct Stock
        $stmt_update_stock->bind_param("ii", $qty, $prod_id);
        if (!$stmt_update_stock->execute()) {
             throw new Exception("Gagal mengupdate stok");
        }
    }
    
    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Pesanan berhasil dibuat!', 'order_id' => $pesanan_id]);
    
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>
