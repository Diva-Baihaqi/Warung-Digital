<?php
include '../config/database.php';

try {
    // 1. Modify the 'status' column in 'pesanan' table to include 'success'
    $conn->query("ALTER TABLE pesanan MODIFY COLUMN status ENUM('pending', 'paid', 'shipped', 'completed', 'cancelled', 'success') DEFAULT 'pending'");
    echo "Column 'status' updated successfully to include 'success'.";
} catch (Exception $e) {
    echo "Error updating column 'status': " . $e->getMessage();
}
?>
