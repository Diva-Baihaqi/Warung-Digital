<?php
include '../../config/database.php';
checkAdmin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_get = "SELECT gambar FROM produk WHERE id = $id";
    $result = $conn->query($sql_get);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['gambar'] && file_exists("../../uploads/" . $row['gambar'])) {
            unlink("../../uploads/" . $row['gambar']);
        }
    }

    $conn->query("DELETE FROM produk WHERE id = $id");
}
header("Location: index.php");
?>
