<?php
include '../config/database.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password (using hardcoded hash for 'admin123' in setup, but using simple verify here)
        // Note: For this demo I used password_hash in SQL. 
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Warung Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= time() ?>">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'neo-bg': '#FFFDF5', 'neo-black': '#000000', 'neo-accent': '#FF6B6B' },
                    fontFamily: { 'sans': ['"Space Grotesk"', 'sans-serif'] },
                    boxShadow: { 'neo': '8px 8px 0px 0px #000' }
                }
            }
        }
    </script>
</head>
<body class="bg-neo-bg min-h-screen flex items-center justify-center font-sans">
    <div class="w-full max-w-md p-8 bg-white border-4 border-neo-black shadow-neo relative">
        <div class="absolute -top-4 -left-4 bg-neo-accent border-4 border-neo-black px-4 py-2 font-black uppercase transform -rotate-2">
            Admin Area
        </div>
        
        <h1 class="text-4xl font-black uppercase mb-6 text-center">Login</h1>
        
        <?php if(isset($error)): ?>
            <div class="bg-red-100 border-2 border-neo-black text-red-600 p-3 mb-4 font-bold"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block font-bold uppercase mb-2">Username</label>
                <input type="text" name="username" class="w-full border-4 border-neo-black p-3 font-bold focus:bg-yellow-100 focus:outline-none transition-colors" placeholder="admin">
            </div>
            <div>
                <label class="block font-bold uppercase mb-2">Password</label>
                <input type="password" name="password" class="w-full border-4 border-neo-black p-3 font-bold focus:bg-yellow-100 focus:outline-none transition-colors" placeholder="admin123">
            </div>
            <button type="submit" name="login" class="w-full bg-neo-black text-white py-4 font-black uppercase border-4 border-neo-black hover:bg-white hover:text-neo-black hover:shadow-neo transition-all active:translate-y-1 active:shadow-none">
                Masuk Dashboard
            </button>
        </form>
        <div class="mt-4 text-center">
             <a href="<?= BASE_URL ?>/index.php" class="font-bold underline hover:text-neo-accent">Kembali ke Website</a>
        </div>
    </div>
</body>
</html>
