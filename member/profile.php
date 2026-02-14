<?php
include '../config/database.php';
include '../includes/public_header.php';

if (!isMemberLoggedIn()) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM pelanggan WHERE id = '$user_id'")->fetch_assoc();

// Handle Profile Update
if (isset($_POST['update_profile'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    // $email = $conn->real_escape_string($_POST['email']); // Optional to update email
    $alamat = $conn->real_escape_string($_POST['alamat']);
    
    // Check if password change requested
    $password_sql = "";
    if (!empty($_POST['new_password'])) {
        $old_pass = $_POST['old_password'];
        $new_pass = $_POST['new_password'];
        $conf_pass = $_POST['confirm_password'];
        
        if (password_verify($old_pass, $user['password'])) {
            if ($new_pass === $conf_pass) {
                $hashed = password_hash($new_pass, PASSWORD_DEFAULT);
                $password_sql = ", password = '$hashed'";
            } else {
                $error = "Konfirmasi password baru tidak cocok!";
            }
        } else {
            $error = "Password lama salah!";
        }
    }
    
    if (!isset($error)) {
        $sql = "UPDATE pelanggan SET nama = '$nama', alamat = '$alamat' $password_sql WHERE id = '$user_id'";
        if ($conn->query($sql)) {
            $_SESSION['user_nama'] = $nama;
            echo "<script>alertRedirect('Profil berhasil diperbarui!', 'profile.php');</script>";
        } else {
            $error = "Gagal update profil: " . $conn->error;
        }
    }
}
?>

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="flex justify-between items-center mb-8 border-b-4 border-black pb-4">
        <h1 class="text-4xl font-black uppercase">Edit Profil</h1>
        <a href="index.php" class="font-bold underline uppercase text-sm hover:text-neo-accent">Kembali ke Dashboard</a>
    </div>

    <!-- Error Message -->
    <?php if(isset($error)): ?>
        <div class="bg-red-100 border-4 border-red-500 text-red-700 p-4 mb-6 font-bold flex items-center gap-2">
            <span>❌</span> <?= $error ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Sidebar / Avatar -->
        <div class="md:col-span-1">
            <div class="bg-white border-4 border-black p-6 shadow-neo text-center">
                <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto mb-4 border-4 border-black overflow-hidden">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= urlencode($user['nama']) ?>" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl font-black uppercase mb-1"><?= htmlspecialchars($user['nama']) ?></h2>
                <p class="text-sm font-bold text-gray-500 mb-4"><?= $user['email'] ?></p>
                <div class="bg-yellow-100 border-2 border-black px-3 py-1 font-bold text-xs inline-block uppercase tracking-wider">
                    Member Sejak <?= date('Y', strtotime($user['created_at'])) ?>
                </div>
            </div>
        </div>

        <!-- Forms -->
        <div class="md:col-span-2">
            <form method="POST" class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-2xl font-black uppercase mb-6 border-l-8 border-neo-secondary pl-4">Informasi Dasar</h3>
                
                <div class="mb-6">
                    <label class="block font-black uppercase text-sm mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required 
                           class="w-full border-4 border-black p-3 font-bold focus:outline-none focus:bg-gray-50 focus:shadow-neo transition-all">
                </div>

                <div class="mb-6">
                    <label class="block font-black uppercase text-sm mb-2">Email (Tidak dapat diubah)</label>
                    <input type="email" value="<?= $user['email'] ?>" disabled 
                           class="w-full border-4 border-black p-3 font-bold bg-gray-100 text-gray-500 cursor-not-allowed">
                </div>

                <div class="mb-8">
                    <label class="block font-black uppercase text-sm mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" required class="w-full border-4 border-black p-3 font-bold focus:outline-none focus:bg-gray-50 focus:shadow-neo transition-all"><?= htmlspecialchars($user['alamat']) ?></textarea>
                </div>

                <h3 class="text-2xl font-black uppercase mb-6 border-l-8 border-neo-accent pl-4">Ganti Password</h3>
                
                <div class="bg-gray-50 p-6 border-2 border-dashed border-black mb-8">
                    <div class="mb-4">
                        <label class="block font-black uppercase text-xs mb-1">Password Lama</label>
                        <input type="password" name="old_password" placeholder="Kosongkan jika tidak ingin ubah" 
                               class="w-full border-2 border-black p-2 font-bold text-sm">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Password Baru</label>
                            <input type="password" name="new_password" class="w-full border-2 border-black p-2 font-bold text-sm">
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" class="w-full border-2 border-black p-2 font-bold text-sm">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="reset" class="px-6 py-3 font-bold uppercase hover:underline">Reset</button>
                    <button type="submit" name="update_profile" class="bg-black text-white border-4 border-black px-8 py-3 font-black uppercase hover:bg-neo-accent hover:text-black hover:shadow-neo transition-all transform hover:-translate-y-1">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
