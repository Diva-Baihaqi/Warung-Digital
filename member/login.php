<?php
include '../config/database.php';

if (isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "/index.php");
    exit;
}

if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    $result = $conn->query("SELECT * FROM pelanggan WHERE email = '$email'");
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_nama'] = $row['nama'];
            
            // Redirect back to intended page or index
            header("Location: " . BASE_URL . "/index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Member - Warung Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= time() ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'neo-bg': '#FFFDF5',
                        'neo-black': '#000000',
                        'neo-accent': '#FF6B6B',
                        'neo-secondary': '#FFD93D',
                    },
                    fontFamily: {
                        'sans': ['"Space Grotesk"', 'sans-serif'],
                    },
                    boxShadow: {
                        'neo': '8px 8px 0px 0px #000',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-neo-bg flex items-center justify-center min-h-screen text-neo-black p-4">

    <div class="w-full max-w-md bg-white border-4 border-black p-8 shadow-neo relative">
        <div class="absolute -top-6 -left-6 bg-neo-black text-white border-4 border-black px-4 py-2 font-black uppercase transform rotate-2">
            Member Area
        </div>

        <h1 class="text-4xl font-black uppercase mb-2">Login</h1>
        <p class="font-bold text-gray-500 mb-8">Masuk dulu sebelum belanja!</p>

        <?php if(isset($_GET['registered'])): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 font-bold" role="alert">
                Registrasi berhasil! Silakan login.
            </div>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 font-bold" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block font-black uppercase mb-2">Email Address</label>
                <input type="email" name="email" required class="w-full border-4 border-black p-3 font-bold focus:shadow-neo transition-shadow outline-none" placeholder="email@contoh.com">
            </div>

            <div>
                <label class="block font-black uppercase mb-2">Password</label>
                <input type="password" name="password" required class="w-full border-4 border-black p-3 font-bold focus:shadow-neo transition-shadow outline-none" placeholder="********">
            </div>

            <button type="submit" name="login" class="w-full bg-neo-secondary border-4 border-black py-4 font-black uppercase tracking-widest hover:translate-y-1 hover:shadow-none shadow-neo transition-all">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-6 text-center font-bold">
            Belum punya akun? <a href="register.php" class="text-blue-600 underline">Daftar disini</a>
        </div>
        <div class="mt-2 text-center text-sm font-bold">
            <a href="<?= BASE_URL ?>/index.php" class="text-gray-500 hover:text-black">Kembali ke Home</a>
        </div>
    </div>

</body>
</html>
