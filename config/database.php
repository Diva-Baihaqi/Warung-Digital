<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'warung_digital';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

define('BASE_URL', '/warung-digital');

// Function to check admin login
function checkAdmin() {
    if (!isset($_SESSION['admin_logged_in'])) {
        header("Location: " . BASE_URL . "/admin/login.php");
        exit;
    }
}

// Member Helper
function isMemberLoggedIn() {
    return isset($_SESSION['user_id']);
}

define('WA_NUMBER', '6282125184884');
?>
