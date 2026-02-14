# Struktur Folder Proyek Warung Digital

Berikut adalah struktur direktori proyek **Warung Digital** setelah dilakukan perapihan dan penambahan fitur terbaru. Struktur ini mencerminkan organisasi file yang digunakan dalam pengembangan sistem.

```bash
warung-digital/
├── .htaccess                 # Konfigurasi Server Apache (Rewrite & Security)
├── 404.php                   # Halaman Error 404 Custom (Neo-Brutalism)
├── actions/                  # Logika pemrosesan backend (PHP Action Scripts)
│   └── checkout_process.php  # - Proses transaksi checkout
├── admin/                    # Halaman Dashboard & Manajemen Admin
│   ├── includes/             # - Header/Sidebar Admin
│   ├── login.php             # - Login Admin
│   └── ... (file admin lainnya)
├── assets/                   # Aset Statis Frontend
│   ├── css/                  # - Stylesheet (Tailwind config, custom CSS)
│   ├── img/                  # - Gambar aset statis
│   └── js/                   # - Script JavaScript (Alerts, interactions)
├── config/                   # Konfigurasi Sistem
│   └── database.php          # - Koneksi Database MySQL
├── database/                 # Backup & Skema Database
│   ├── relasi_tabel.dbml     # - Skema Relasi Database (DBDiagram.io)
│   └── warung_digital.sql    # - File Import Database
├── documentation/            # Dokumentasi Proyek
│   ├── screenshots/          # - Kumpulan tangkapan layar sistem
│   └── urutan_ss.md          # - Panduan urutan screenshot
├── includes/                 # Komponen UI Shared (Public)
│   ├── footer.php            # - Footer website
│   └── public_header.php     # - Navbar & Header website
├── member/                   # Area Khusus Pelanggan
│   ├── login.php             # - Login Member
│   ├── orders.php            # - Riwayat Pesanan
│   └── register.php          # - Pendaftaran Member
├── uploads/                  # File yang diupload User/Admin
│   ├── produk/               # - Gambar Produk
│   └── kwitansi/             # - Bukti Pembayaran
├── utils/                    # Utilitas & Script Bantu
│   └── setup_dummy.php       # - Generator Data Dummy
├── vendor/                   # Dependencies (Composer)
├── about.php                 # Halaman Tentan Kami
├── blog.php                  # Halaman Blog/Artikel
├── cetak_struk.php           # Fitur Cetak Struk Pesanan
├── checkout.php              # Halaman Checkout
├── contact.php               # Halaman Kontak
├── detail.php                # Halaman Detail Produk
├── faq.php                   # Halaman FAQ
├── index.php                 # Halaman Utama (Homepage)
├── reviews.php               # Halaman Ulasan Pengguna
└── social.php                # Halaman Data Sosial
```

## Keterangan Folder & File Penting

1.  **`config/`**: Jantung koneksi aplikasi ke database. Berisi kredensial server.
2.  **`admin/` & `member/`**: Pemisahan logika akses antara Administrator (pengelola) dan Member (pelanggan).
3.  **`actions/`**: Folder khusus untuk menampung file PHP yang memproses data dari form (seperti _checkout_), memisahkan _view_ dari _logic_.
4.  **`database/`**: Menyimpan file SQL dump dan skema relasi tabel (`.dbml`) untuk visualisasi struktur data.
5.  **`utils/`**: Berisi alat bantu pengembangan, seperti _seeder_ database.
6.  **`404.php`**: Halaman custom error yang menangani link mati atau salah alamat dengan desain menarik.
7.  **`.htaccess`**: File konfigurasi server untuk mengatur _pretty URL_, _redirect_ error 404, dan keamanan dasar.
