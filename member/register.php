<?php
include '../config/database.php';

if (isset($_POST['register'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Check if email exists
    $check = $conn->query("SELECT id FROM pelanggan WHERE email = '$email'");
    if ($check->num_rows > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $insert = $conn->query("INSERT INTO pelanggan (nama, email, password) VALUES ('$nama', '$email', '$password')");
        if ($insert) {
            header("Location: login.php?registered=1");
            exit;
        } else {
            $error = "Gagal mendaftar!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member - Warung Digital</title>
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
        <div class="absolute -top-6 -left-6 bg-neo-secondary border-4 border-black px-4 py-2 font-black uppercase transform -rotate-2">
            Gabung Sekarang
        </div>

        <h1 class="text-4xl font-black uppercase mb-2">Daftar Akun</h1>
        <p class="font-bold text-gray-500 mb-8">Buat akun biar beli-beli makin gampang!</p>

        <?php if(isset($error)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 font-bold" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block font-black uppercase mb-2">Nama Lengkap</label>
                <input type="text" name="nama" required class="w-full border-4 border-black p-3 font-bold focus:shadow-neo transition-shadow outline-none" placeholder="Jhon Doe">
            </div>

            <div>
                <label class="block font-black uppercase mb-2">Email Address</label>
                <input type="email" name="email" required class="w-full border-4 border-black p-3 font-bold focus:shadow-neo transition-shadow outline-none" placeholder="email@contoh.com">
            </div>

            <div>
                <label class="block font-black uppercase mb-2">Password</label>
                <input type="password" name="password" required class="w-full border-4 border-black p-3 font-bold focus:shadow-neo transition-shadow outline-none" placeholder="********">
            </div>

            <button type="submit" name="register" class="w-full bg-neo-accent border-4 border-black py-4 font-black uppercase tracking-widest hover:translate-y-1 hover:shadow-none shadow-neo transition-all">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-6 text-center font-bold">
            Sudah punya akun? <a href="login.php" class="text-blue-600 underline">Login disini</a>
        </div>
        <div class="mt-2 text-center text-sm font-bold">
            <a href="<?= BASE_URL ?>/index.php" class="text-gray-500 hover:text-black">Kembali ke Home</a>
        </div>
    </div>

</body>
</html>
