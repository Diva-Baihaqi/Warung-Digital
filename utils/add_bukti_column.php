<?php
include '../config/database.php';

try {
    $conn->query("ALTER TABLE pesanan ADD COLUMN bukti_pembayaran VARCHAR(255) DEFAULT NULL AFTER status");
    echo "Column 'bukti_pembayaran' added successfully.";
} catch (Exception $e) {
    echo "Column 'bukti_pembayaran' likely already exists or other error: " . $e->getMessage();
}
?>
