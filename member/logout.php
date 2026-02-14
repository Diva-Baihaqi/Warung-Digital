<?php
session_start();
include '../config/database.php';
unset($_SESSION['user_id']);
unset($_SESSION['user_nama']);
header("Location: " . BASE_URL . "/index.php");
exit;
?>
