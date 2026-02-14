<?php
include '../config/database.php';
try {
    $conn->query("ALTER TABLE produk ADD COLUMN stok INT NOT NULL DEFAULT 0");
    echo "Column 'stok' added successfully.";
} catch (Exception $e) {
    echo "Column 'stok' likely already exists or other error: " . $e->getMessage();
}
?>
