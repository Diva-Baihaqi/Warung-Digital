# 🚀 Demo Warung Digital

Selamat datang di **Warung Digital**! Aplikasi e-commerce modern dengan desain _Neo-Brutalism_ yang unik, cepat, dan interaktif. Dokumen ini akan memandu Anda menjelajahi seluruh fitur aplikasi dari sisi Pembeli maupun Admin.

---

## 🛍️ Bagian 1: Untuk Pembeli (Member)

### 1. **Halaman Utama (Homepage)**

Saat pertama kali membuka website, Anda akan disuguhkan tampilan yang _bold_ dan menarik.

- **Kategori Interaktif**: Klik tombol kategori (Streaming, AI Tools, dll) di bagian atas. Produk akan tersaring secara instan tanpa loading ulang (animasi halus).
- **Pencarian**: Gunakan kolom pencarian di navigasi atas untuk mencari produk spesifik.
- **Produk**: Klik tombol `+` pada produk untuk memasukkan ke keranjang secara cepat, atau klik `Detail` untuk info lengkap.

### 2. **Detail Produk**

Halaman ini menampilkan informasi lengkap produk.

- **Galeri Gambar**: Tampilan gambar produk yang jelas.
- **Pilihan Jumlah**: Atur mau beli berapa banyak.
- **Rekomendasi**: Di bagian bawah, ada fitur "Kamu Mungkin Suka" yang menampilkan produk sejenis.
- **Beli Langsung**: Tombol ini akan otomatis memasukkan barang ke keranjang dan membuka menu checkout.

### 3. **Keranjang & Checkout**

- **Keranjang Belanja**: Klik ikon keranjang di pojok kanan atas. _Drawer_ keranjang akan muncul dari samping (tanpa pindah halaman).
- **Proses Checkout**:
  1. Klik tombol **"CHECKOUT SEKARANG"** di keranjang.
  2. Anda akan diarahkan ke halaman Checkout khusus.
  3. **Alamat**: Isi/Edit alamat pengiriman Anda.
  4. **Metode Pembayaran**: Pilih BCA, Mandiri, OVO, atau GoPay/QRIS.
     - Jika pilih **GoPay**, akan muncul QR Code yang bisa discan.
     - Jika pilih Bank, akan muncul nomor rekening yang bisa disalin.
  5. Klik **"BAYAR SEKARANG"**.

### 4. **Pesanan Saya (Member Area)**

Setelah sukses checkout, Anda masuk ke halaman riwayat pesanan.

- **Status Real-time**: Pantau status pesanan Anda (Pending, Paid, Shipped, Completed).
- **Fitur Batalkan**: Jika status masih _Pending_, Anda bisa membatalkan pesanan dengan klik tombol merah **"BATALKAN PESANAN"**.
- **Cetak Struk**: Klik tombol **"CETAK STRUK"** untuk menyimpan bukti transaksi dalam bentuk PDF atau diprint langsung.

---

## 👨‍💻 Bagian 2: Untuk Admin

### 1. **Dashboard Login**

Masuk sebagai admin untuk mengelola toko. (Akun default: `admin` / `admin`).

### 2. **Manajemen Pesanan (Interactive)**

Halaman ini adalah pusat kontrol admin.

- **Daftar Pesanan**: Melihat semua pesanan masuk dari member.
- **Update Status Cepat**:
  - Di tabel pesanan, Admin bisa langsung mengubah status (misal dari `Pending` ke `Paid` atau `Shipped`) melalui _dropdown_.
  - **Tanpa Reload**: Perubahan status terjadi seketika (AJAX) dan muncul notifikasi sukses (Toast) di pojok kanan bawah.
  - Warna label status akan berubah otomatis sesuai status yang dipilih.
- **Detail Pesanan**: Klik tombol "Detail" untuk melihat rincian barang yang dibeli dan alamat pembeli.

---

## 🎨 Teknologi & Desain

- **Desain**: Menggunakan gaya _Neo-Brutalism_ (Border tebal, bayangan keras, warna kontras) yang sedang tren.
- **Frontend**: HTML, Tailwind CSS (CDN), Vanilla JavaScript.
- **Backend**: PHP Native (Tanpa Framework berat).
- **Database**: MySQL.
- **Interaktivitas**: Menggunakan AJAX (Fetch API) untuk update data tanpa refresh halaman agar pengalaman pengguna sangat mulus.

---

Selamat mencoba aplikasi Warung Digital! 🚀
