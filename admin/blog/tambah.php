<?php
include '../../config/database.php';
// checkAdmin();

// Include sweetalert CDN separately? 
// No, it's usually in header. But let's check structure.
// Actually, let's include header first to ensure styles loaded.

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $kategori = $_POST['kategori'];
    $tanggal = date('Y-m-d');
    
    // Upload Logic
    $gambar = "";
    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $upload_dir = '../../assets/img/blog/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = uniqid('blog_') . '.' . $ext;
        
        if(move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_dir . $gambar)) {
            // Success upload
        } else {
            $gambar = ""; // clear if failed
        }
    }

    $stmt = $conn->prepare("INSERT INTO blog (judul, konten, kategori, tanggal, gambar) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $judul, $konten, $kategori, $tanggal, $gambar);
    
    if($stmt->execute()) {
        echo "<script>alert('Artikel berhasil ditambahkan bro!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah artikel: " . $stmt->error . "');</script>";
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
                <h1 class="text-4xl font-black uppercase tracking-tighter">Tulis Artikel Baru</h1>
                <p class="font-bold text-gray-500 border-l-4 border-neo-accent pl-3 mt-2">Bagikan konten menarik untuk pengunjung warungmu.</p>
            </div>
        </div>

        <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all duration-300">
            <form method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                
                <!-- Judul -->
                <div class="flex flex-col gap-2 group focus-within:text-neo-primary">
                    <label class="font-black uppercase text-sm group-focus-within:text-black transition-colors">Judul Artikel</label>
                    <input type="text" name="judul" required 
                           class="w-full border-4 border-black p-4 font-bold text-xl placeholder-gray-400 focus:outline-none focus:bg-yellow-50 focus:shadow-[4px_4px_0px_0px_#000] focus:-translate-y-1 transition-all"
                           placeholder="Masukkan judul yang memikat...">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kategori -->
                    <div class="flex flex-col gap-2">
                        <label class="font-black uppercase text-sm">Kategori</label>
                        <select name="kategori" required
                                class="w-full border-4 border-black p-4 font-bold bg-white focus:outline-none focus:shadow-[4px_4px_0px_0px_#000] transition-all cursor-pointer appearance-none">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Tips">Tips & Trik</option>
                            <option value="Berita">Berita Warung</option>
                            <option value="Promo">Promo Spesial</option>
                            <option value="Produk Baru">Produk Baru</option>
                        </select>
                    </div>
                    
                    <!-- Gambar -->
                    <div class="flex flex-col gap-2">
                        <label class="font-black uppercase text-sm">Gambar Cover</label>
                        <div class="relative border-4 border-black bg-gray-50 p-3 h-full flex items-center justify-center border-dashed hover:bg-gray-100 transition-colors cursor-pointer group">
                            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span class="text-xs font-bold uppercase">Upload File</span>
                            </div>
                            <input type="file" name="gambar" class="opacity-0 w-full h-full cursor-pointer absolute inset-0 z-20">
                        </div>
                    </div>
                </div>

                <!-- Konten -->
                <div class="flex flex-col gap-2">
                    <label class="font-black uppercase text-sm">Isi Konten</label>
                    <textarea name="konten" rows="12" required
                              class="w-full border-4 border-black p-5 font-mono text-sm leading-relaxed focus:outline-none focus:bg-yellow-50 focus:shadow-[4px_4px_0px_0px_#000] transition-all bg-gray-50 placeholder-gray-400"
                              placeholder="Mulai menulis ceritamu di sini..."></textarea>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 mt-6 pt-6 border-t-4 border-black border-dashed">
                    <a href="index.php" class="px-6 py-3 font-black uppercase text-gray-500 hover:text-black hover:bg-gray-100 transition-colors border-2 border-transparent hover:border-black">Batal</a>
                    <button type="submit" name="submit" class="bg-neo-black text-white px-8 py-3 border-4 border-black font-black uppercase tracking-wider shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-neo-accent hover:text-black hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] active:bg-yellow-600 transition-all flex items-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                        Publish Artikel
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
