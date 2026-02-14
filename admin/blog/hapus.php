<?php
include '../../config/database.php';
checkAdmin();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Optional: Delete image
    $conn->query("DELETE FROM blog WHERE id = $id");
}
header("Location: index.php");
?>
