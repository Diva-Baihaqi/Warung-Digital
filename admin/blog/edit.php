<?php
include '../../config/database.php';
checkAdmin();

if(!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = $conn->query("SELECT * FROM blog WHERE id = '$id'");
$data = $query->fetch_assoc();

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $kategori = $_POST['kategori'];
    
    // Update logic
    if($_FILES['gambar']['name']) {
        $gambar_baru = uniqid().'.'.pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../assets/img/blog/".$gambar_baru);
        // Optional: delete old image if exists
        
        $sql = "UPDATE blog SET judul='$judul', konten='$konten', kategori='$kategori', gambar='$gambar_baru' WHERE id='$id'";
    } else {
        $sql = "UPDATE blog SET judul='$judul', konten='$konten', kategori='$kategori' WHERE id='$id'";
    }
    
    if($conn->query($sql)) {
        echo "<script>
            // Use sweetalert if available, else fallback
            if(typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Artikel berhasil diupdate.',
                    confirmButtonText: 'OK'
                }).then(() => { window.location='index.php'; });
            } else {
                alert('Berhasil update artikel');
                window.location='index.php';
            }
        </script>";
    } else {
        echo "<script>alert('Gagal update!');</script>";
    }
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="flex-1 p-8 relative min-h-screen bg-neo-bg">
    <!-- Background grid -->
    <div class="absolute inset-0 pattern-grid-lg opacity-10 pointer-events-none z-0"></div>

    <div class="relative z-10 max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                 <a href="index.php" class="inline-flex items-center gap-2 font-bold text-gray-500 hover:text-black mb-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali ke List
                </a>
                <h1 class="text-4xl font-black uppercase tracking-tighter">Edit Artikel</h1>
                <p class="font-bold text-gray-500 border-l-4 border-neo-accent pl-3 mt-2">Perbarui konten artikelmu agar tetap relevan.</p>
            </div>
        </div>

        <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <form method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                
                <!-- Judul -->
                <div class="flex flex-col gap-2">
                    <label class="font-black uppercase text-sm">Judul Artikel</label>
                    <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required 
                           class="w-full border-4 border-black p-4 font-bold text-xl focus:outline-none focus:shadow-[4px_4px_0px_0px_#000] focus:-translate-y-1 transition-all"
                           placeholder="Masukkan judul yang menarik...">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kategori -->
                    <div class="flex flex-col gap-2">
                        <label class="font-black uppercase text-sm">Kategori</label>
                        <input type="text" name="kategori" value="<?= htmlspecialchars($data['kategori'] ?? '') ?>" required
                               class="w-full border-4 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_#000] transition-all"
                               placeholder="Contoh: Tips, Berita, Promo">
                    </div>
                    
                    <!-- Gambar -->
                    <div class="flex flex-col gap-2">
                        <label class="font-black uppercase text-sm">Gambar Cover</label>
                        <div class="relative border-4 border-black bg-gray-50 p-2 flex items-center gap-4">
                            <?php if(!empty($data['gambar'])): ?>
                                <img src="../../assets/img/blog/<?= $data['gambar'] ?>" class="h-12 w-12 object-cover border-2 border-black" alt="Current">
                            <?php endif; ?>
                            <input type="file" name="gambar" class="font-bold text-sm file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black file:bg-white file:font-bold hover:file:bg-black hover:file:text-white transition-all cursor-pointer">
                        </div>
                        <small class="font-bold text-gray-400">*Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>
                </div>

                <!-- Konten -->
                <div class="flex flex-col gap-2">
                    <label class="font-black uppercase text-sm">Isi Konten</label>
                    <textarea name="konten" rows="15" required
                              class="w-full border-4 border-black p-4 font-mono text-sm leading-relaxed focus:outline-none focus:shadow-[4px_4px_0px_0px_#000] transition-all bg-gray-50"
                              placeholder="Mulai menulis ceritamu di sini..."><?= htmlspecialchars($data['konten']) ?></textarea>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 mt-4 pt-6 border-t-4 border-black border-dashed">
                    <a href="index.php" class="px-6 py-3 font-black uppercase text-gray-500 hover:text-black hover:bg-gray-100 transition-colors">Batal</a>
                    <button type="submit" name="submit" class="bg-neo-accent text-black px-8 py-3 border-4 border-black font-black uppercase tracking-wider shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] active:bg-yellow-500 transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
