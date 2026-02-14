-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Jan 2026 pada 08.12
-- Versi server: 8.0.30
-- Versi PHP: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `warung_digital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'Diva_Baihaqi', '$2y$12$FOH4iozdAxQ7f0yUhdIXlePT3tNk5u3Sv1hgvFYF3vpeRsU8N.HMy', '2026-01-18 16:38:04'),
(6, 'Kelompok5', '$2y$12$kmzqjolNj5Z2ocdlsvhsUO2q0OANR/myI3MDyThc4q7rkajbDDca6', '2026-01-27 00:57:41'),
(8, 'admin', '$2y$12$wXNnTZ2d1uZ3nO7rHI9AB.jGWKRaT.71C/nRQfZPXZVX2isUolsjq', '2026-01-27 05:47:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog`
--

CREATE TABLE `blog` (
  `id` int NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `konten` text,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `blog`
--

INSERT INTO `blog` (`id`, `judul`, `konten`, `gambar`, `kategori`, `tanggal`) VALUES
(1, 'Cara Hemat Langganan Streaming', 'Tips hemat untuk anak kos...', NULL, 'Tips', '2026-01-18'),
(2, 'Kenapa AI Tools Penting?', 'Di era digital ini...', NULL, 'Teknologi', '2026-01-18'),
(3, 'ChatGPT Plus vs Gemini Pro: Mana yang Lebih Worth It untuk Produktivitas?', 'Skripsi macet? Tugas numpuk? AI solusinya!\r\n\r\nJangan cuma pakai AI buat tanya jawab biasa. Kalau kamu tahu triknya, tools seperti Gemini Advanced atau ChatGPT Plus bisa jadi asisten peneliti super canggih.\r\n\r\nGunakan Prompt \"Act As\": Suruh AI berperan sebagai dosen penguji untuk mengkritisi argumen di bab pembahasanmu.\r\n\r\nAnalisa Jurnal PDF: Upload file jurnal ke ChatGPT Plus, lalu minta ia merangkum poin penting yang relevan dengan topikmu. Hemat waktu baca berjam-jam!\r\n\r\nParaphrasing Tool: Hindari plagiasi dengan meminta AI menulis ulang kalimatmu dengan gaya bahasa akademis yang lebih formal.\r\n\r\nCari Referensi Terkini: Gunakan Gemini Pro untuk mencari sumber data terbaru yang real-time dari internet, karena datanya tidak terbatas tahun tertentu.\r\n\r\nMasih pusing juga ngerjainnya? Atau butuh akun premium biar fitur-fitur di atas kebuka semua?\r\n\r\nDapatkan akses akun premium murah meriah di toko kami. Atau kalau beneran udah mentok, hubungi admin untuk layanan konsultasi tugas!', '696d0e604fdae.jpg', 'Review Gadget & AI Tools', '2026-01-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` int NOT NULL,
  `pesanan_id` int DEFAULT NULL,
  `produk_id` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga_satuan` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `pesanan_id`, `produk_id`, `jumlah`, `harga_satuan`) VALUES
(1, 1, 4, 1, 20000),
(2, 2, 3, 1, 20000),
(3, 3, 2, 1, 20000),
(4, 4, 4, 1, 20000),
(5, 4, 5, 1, 20000),
(6, 5, 2, 1, 20000),
(8, 7, 2, 1, 20000),
(9, 7, 3, 1, 20000),
(10, 8, 2, 1, 20000),
(11, 9, 5, 1, 20000),
(12, 10, 1, 1, 250000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `faq`
--

CREATE TABLE `faq` (
  `id` int NOT NULL,
  `pertanyaan` varchar(255) DEFAULT NULL,
  `jawaban` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `faq`
--

INSERT INTO `faq` (`id`, `pertanyaan`, `jawaban`) VALUES
(1, 'Apakah ini legal?', '100% Legal bukan akun curian.'),
(2, 'Garansi berapa lama?', 'Full garansi selama masa aktif.'),
(3, 'Proses berapa lama?', '1-5 Menit jika admin online.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `slug` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `slug`) VALUES
(1, 'Streaming', 'streaming'),
(2, 'Music', 'music'),
(3, 'AI Tools', 'ai-tools'),
(4, 'Games', 'games'),
(5, 'Software', 'software');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `alamat` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `password`, `alamat`, `created_at`) VALUES
(3, 'Kelompok 5', 'kelompok5@gmail.com', '$2y$12$SRzZjayx/UB5YnhpDPirS.oRpdQAtHjHONxD6QnfUX0CjEb9Aq25y', 'Cirebon', '2026-01-27 01:00:15'),
(5, 'Hamdan Sadad', 'hamdan@ti23b.com', '$2y$12$jZCxLbGx4qvh.MWYO4m6Ae3sMnh73DeyIQGN4G0zFK1tPSXI55VYG', 'Cilimus', '2026-01-27 03:10:49'),
(6, 'Diva Baihaqi', 'diva@gmail.com', '$2y$12$3id2e4ZN3Qo6CvPKDhpIeuRXbsQfbkBski.shyjNjjbT7mRC9vdbi', 'cirebon', '2026-01-27 04:10:45'),
(7, 'Tester', 'test@gmail.com', '$2y$12$a9ET4jARll054aLdpbQaBuJlSapWNO37IytXMnZNkgPqfLaxMT4Ue', '082117964344', '2026-01-27 05:44:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int NOT NULL,
  `pelanggan_id` int DEFAULT NULL,
  `total_harga` decimal(12,0) DEFAULT NULL,
  `status` enum('pending','paid','shipped','completed','cancelled','success') DEFAULT 'pending',
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pesanan` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `pelanggan_id`, `total_harga`, `status`, `bukti_pembayaran`, `tanggal_pesanan`) VALUES
(1, 2, 21000, 'pending', NULL, '2026-01-27 02:51:30'),
(2, 2, 21000, 'pending', NULL, '2026-01-27 03:05:00'),
(3, 5, 21000, 'paid', NULL, '2026-01-27 03:11:56'),
(4, 6, 41000, 'paid', NULL, '2026-01-27 04:52:01'),
(5, 6, 21000, 'completed', NULL, '2026-01-27 05:05:29'),
(7, 7, 41000, 'completed', 'bukti_7_1769496417.png', '2026-01-27 06:31:31'),
(8, 7, 21000, 'completed', 'bukti_8_1769496360.jpg', '2026-01-27 06:44:40'),
(9, 7, 21000, 'completed', 'bukti_9_1769497663.jpg', '2026-01-27 07:07:22'),
(10, 7, 251000, 'completed', 'bukti_10_1769498536.png', '2026-01-27 07:21:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `deskripsi` text,
  `spesifikasi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `stok` int DEFAULT '100',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama_produk`, `harga`, `deskripsi`, `spesifikasi`, `gambar`, `stok`, `created_at`) VALUES
(1, 1, 'YouTube Premium', 250000, 'Nikmati YouTube tanpa iklan.', NULL, '696d0ef12d2d6.jpg', 9, '2026-01-18 13:56:22'),
(2, 2, 'Spotify Premium', 20000, 'Dengarkan musik tanpa jeda.', NULL, '696d0f0c9814c.jpg', 100, '2026-01-18 13:56:22'),
(3, 1, 'Netflix Premium', 20000, 'Nonton film 4K UHD.', NULL, '696d0f2367a4b.jpg', 100, '2026-01-18 13:56:22'),
(4, 3, 'ChatGPT Plus', 20000, 'Akses ke GPT-4.', NULL, '696d0f452a6ec.jpg', 100, '2026-01-18 13:56:22'),
(5, 3, 'Gemini Pro', 20000, 'Akses model AI tercerdas.', NULL, '696d0f599f9cc.jpg', 99, '2026-01-18 13:56:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_akun`
--

CREATE TABLE `produk_akun` (
  `id` int NOT NULL,
  `produk_id` int NOT NULL,
  `jenis_akun` varchar(50) DEFAULT 'akun',
  `data_akun` text NOT NULL,
  `status` enum('tersedia','terjual') DEFAULT 'tersedia',
  `pesanan_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `produk_akun`
--

INSERT INTO `produk_akun` (`id`, `produk_id`, `jenis_akun`, `data_akun`, `status`, `pesanan_id`, `created_at`) VALUES
(1, 1, 'akun', 'Email: user5943@gmail.com\nPassword: Pass934!', 'terjual', 10, '2026-01-27 07:04:51'),
(2, 1, 'akun', 'Email: user5705@gmail.com\nPassword: Pass977!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(3, 1, 'akun', 'Email: user7706@gmail.com\nPassword: Pass884!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(4, 1, 'akun', 'Email: user3544@gmail.com\nPassword: Pass786!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(5, 1, 'akun', 'Email: user3449@gmail.com\nPassword: Pass154!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(6, 1, 'akun', 'Email: user7977@gmail.com\nPassword: Pass342!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(7, 1, 'akun', 'Email: user5983@gmail.com\nPassword: Pass122!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(8, 1, 'akun', 'Email: user8355@gmail.com\nPassword: Pass535!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(9, 1, 'akun', 'Email: user3713@gmail.com\nPassword: Pass933!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(10, 1, 'akun', 'Email: user5485@gmail.com\nPassword: Pass440!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(11, 1, 'akun', 'Email: user2687@gmail.com\nPassword: Pass999!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(12, 1, 'akun', 'Email: user8990@gmail.com\nPassword: Pass392!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(13, 1, 'akun', 'Email: user9551@gmail.com\nPassword: Pass262!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(14, 1, 'akun', 'Email: user9431@gmail.com\nPassword: Pass390!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(15, 1, 'akun', 'Email: user9376@gmail.com\nPassword: Pass477!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(16, 1, 'akun', 'Email: user9830@gmail.com\nPassword: Pass800!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(17, 1, 'akun', 'Email: user9149@gmail.com\nPassword: Pass212!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(18, 1, 'akun', 'Email: user3958@gmail.com\nPassword: Pass108!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(19, 1, 'akun', 'Email: user5795@gmail.com\nPassword: Pass743!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(20, 1, 'akun', 'Email: user2377@gmail.com\nPassword: Pass619!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(21, 2, 'akun', 'Email: user3506@gmail.com\nPassword: Pass397!\nPlan: Premium Individual\nExp: 2026-02-26', 'terjual', 7, '2026-01-27 07:04:51'),
(22, 2, 'akun', 'Email: user1236@gmail.com\nPassword: Pass299!\nPlan: Premium Individual\nExp: 2026-02-26', 'terjual', 8, '2026-01-27 07:04:51'),
(23, 2, 'akun', 'Email: user5762@gmail.com\nPassword: Pass734!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(24, 2, 'akun', 'Email: user4142@gmail.com\nPassword: Pass304!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(25, 2, 'akun', 'Email: user5634@gmail.com\nPassword: Pass796!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(26, 2, 'akun', 'Email: user6957@gmail.com\nPassword: Pass580!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(27, 2, 'akun', 'Email: user9470@gmail.com\nPassword: Pass513!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(28, 2, 'akun', 'Email: user2368@gmail.com\nPassword: Pass956!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(29, 2, 'akun', 'Email: user4824@gmail.com\nPassword: Pass891!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(30, 2, 'akun', 'Email: user2102@gmail.com\nPassword: Pass790!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(31, 2, 'akun', 'Email: user8141@gmail.com\nPassword: Pass840!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(32, 2, 'akun', 'Email: user8681@gmail.com\nPassword: Pass931!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(33, 2, 'akun', 'Email: user9790@gmail.com\nPassword: Pass770!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(34, 2, 'akun', 'Email: user2240@gmail.com\nPassword: Pass838!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(35, 2, 'akun', 'Email: user7358@gmail.com\nPassword: Pass300!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(36, 2, 'akun', 'Email: user1659@gmail.com\nPassword: Pass726!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(37, 2, 'akun', 'Email: user4360@gmail.com\nPassword: Pass313!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(38, 2, 'akun', 'Email: user1332@gmail.com\nPassword: Pass780!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(39, 2, 'akun', 'Email: user6766@gmail.com\nPassword: Pass206!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(40, 2, 'akun', 'Email: user3704@gmail.com\nPassword: Pass583!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:04:51'),
(41, 3, 'akun', 'Email: user8677@gmail.com\nPassword: Pass715!\nProfile: User 1\nPIN: 1234', 'terjual', 7, '2026-01-27 07:04:51'),
(42, 3, 'akun', 'Email: user8899@gmail.com\nPassword: Pass237!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(43, 3, 'akun', 'Email: user5279@gmail.com\nPassword: Pass376!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(44, 3, 'akun', 'Email: user9024@gmail.com\nPassword: Pass546!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(45, 3, 'akun', 'Email: user3438@gmail.com\nPassword: Pass693!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(46, 3, 'akun', 'Email: user9977@gmail.com\nPassword: Pass887!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(47, 3, 'akun', 'Email: user4743@gmail.com\nPassword: Pass971!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(48, 3, 'akun', 'Email: user6036@gmail.com\nPassword: Pass791!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(49, 3, 'akun', 'Email: user8080@gmail.com\nPassword: Pass603!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(50, 3, 'akun', 'Email: user4956@gmail.com\nPassword: Pass702!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(51, 3, 'akun', 'Email: user6095@gmail.com\nPassword: Pass317!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(52, 3, 'akun', 'Email: user5197@gmail.com\nPassword: Pass484!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(53, 3, 'akun', 'Email: user9371@gmail.com\nPassword: Pass234!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(54, 3, 'akun', 'Email: user6085@gmail.com\nPassword: Pass996!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(55, 3, 'akun', 'Email: user7209@gmail.com\nPassword: Pass436!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(56, 3, 'akun', 'Email: user2505@gmail.com\nPassword: Pass469!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(57, 3, 'akun', 'Email: user5449@gmail.com\nPassword: Pass371!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(58, 3, 'akun', 'Email: user6176@gmail.com\nPassword: Pass708!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(59, 3, 'akun', 'Email: user7616@gmail.com\nPassword: Pass525!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(60, 3, 'akun', 'Email: user2660@gmail.com\nPassword: Pass933!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:04:51'),
(61, 4, 'akun', 'Email: user9800@gmail.com\nPassword: Pass871!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(62, 4, 'akun', 'Email: user7821@gmail.com\nPassword: Pass213!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(63, 4, 'akun', 'Email: user1056@gmail.com\nPassword: Pass876!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(64, 4, 'akun', 'Email: user7532@gmail.com\nPassword: Pass287!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(65, 4, 'akun', 'Email: user8243@gmail.com\nPassword: Pass314!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(66, 4, 'akun', 'Email: user5297@gmail.com\nPassword: Pass688!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(67, 4, 'akun', 'Email: user6878@gmail.com\nPassword: Pass675!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(68, 4, 'akun', 'Email: user7974@gmail.com\nPassword: Pass725!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(69, 4, 'akun', 'Email: user4714@gmail.com\nPassword: Pass624!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(70, 4, 'akun', 'Email: user2891@gmail.com\nPassword: Pass760!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(71, 4, 'akun', 'Email: user1770@gmail.com\nPassword: Pass348!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(72, 4, 'akun', 'Email: user1891@gmail.com\nPassword: Pass217!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(73, 4, 'akun', 'Email: user4699@gmail.com\nPassword: Pass926!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(74, 4, 'akun', 'Email: user9790@gmail.com\nPassword: Pass195!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(75, 4, 'akun', 'Email: user3116@gmail.com\nPassword: Pass554!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(76, 4, 'akun', 'Email: user3319@gmail.com\nPassword: Pass402!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(77, 4, 'akun', 'Email: user4642@gmail.com\nPassword: Pass246!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(78, 4, 'akun', 'Email: user9954@gmail.com\nPassword: Pass909!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(79, 4, 'akun', 'Email: user1671@gmail.com\nPassword: Pass295!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(80, 4, 'akun', 'Email: user7966@gmail.com\nPassword: Pass430!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:04:51'),
(81, 5, 'akun', 'Email: user5229@gmail.com\nPassword: Pass103!', 'terjual', 9, '2026-01-27 07:04:51'),
(82, 5, 'akun', 'Email: user3576@gmail.com\nPassword: Pass247!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(83, 5, 'akun', 'Email: user2068@gmail.com\nPassword: Pass757!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(84, 5, 'akun', 'Email: user4090@gmail.com\nPassword: Pass130!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(85, 5, 'akun', 'Email: user5777@gmail.com\nPassword: Pass400!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(86, 5, 'akun', 'Email: user1067@gmail.com\nPassword: Pass723!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(87, 5, 'akun', 'Email: user1974@gmail.com\nPassword: Pass782!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(88, 5, 'akun', 'Email: user2003@gmail.com\nPassword: Pass264!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(89, 5, 'akun', 'Email: user7342@gmail.com\nPassword: Pass827!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(90, 5, 'akun', 'Email: user7631@gmail.com\nPassword: Pass445!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(91, 5, 'akun', 'Email: user4075@gmail.com\nPassword: Pass163!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(92, 5, 'akun', 'Email: user3173@gmail.com\nPassword: Pass121!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(93, 5, 'akun', 'Email: user7898@gmail.com\nPassword: Pass775!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(94, 5, 'akun', 'Email: user4704@gmail.com\nPassword: Pass997!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(95, 5, 'akun', 'Email: user5895@gmail.com\nPassword: Pass930!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(96, 5, 'akun', 'Email: user7264@gmail.com\nPassword: Pass360!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(97, 5, 'akun', 'Email: user9780@gmail.com\nPassword: Pass925!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(98, 5, 'akun', 'Email: user5046@gmail.com\nPassword: Pass155!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(99, 5, 'akun', 'Email: user6082@gmail.com\nPassword: Pass596!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(100, 5, 'akun', 'Email: user3090@gmail.com\nPassword: Pass662!', 'tersedia', NULL, '2026-01-27 07:04:51'),
(101, 2, 'akun', 'Email: user9240@gmail.com\nPassword: Pass448!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(102, 2, 'akun', 'Email: user6779@gmail.com\nPassword: Pass173!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(103, 2, 'akun', 'Email: user3673@gmail.com\nPassword: Pass640!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(104, 2, 'akun', 'Email: user3620@gmail.com\nPassword: Pass321!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(105, 2, 'akun', 'Email: user5828@gmail.com\nPassword: Pass676!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(106, 2, 'akun', 'Email: user7564@gmail.com\nPassword: Pass239!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(107, 2, 'akun', 'Email: user1400@gmail.com\nPassword: Pass590!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(108, 2, 'akun', 'Email: user4501@gmail.com\nPassword: Pass663!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(109, 2, 'akun', 'Email: user6392@gmail.com\nPassword: Pass177!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(110, 2, 'akun', 'Email: user8661@gmail.com\nPassword: Pass469!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(111, 2, 'akun', 'Email: user4227@gmail.com\nPassword: Pass282!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(112, 2, 'akun', 'Email: user5619@gmail.com\nPassword: Pass307!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(113, 2, 'akun', 'Email: user3890@gmail.com\nPassword: Pass996!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(114, 2, 'akun', 'Email: user6689@gmail.com\nPassword: Pass188!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(115, 2, 'akun', 'Email: user3217@gmail.com\nPassword: Pass160!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(116, 2, 'akun', 'Email: user2441@gmail.com\nPassword: Pass132!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(117, 2, 'akun', 'Email: user9754@gmail.com\nPassword: Pass742!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(118, 2, 'akun', 'Email: user8791@gmail.com\nPassword: Pass470!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(119, 2, 'akun', 'Email: user1690@gmail.com\nPassword: Pass567!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(120, 2, 'akun', 'Email: user8116@gmail.com\nPassword: Pass659!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(121, 2, 'akun', 'Email: user5292@gmail.com\nPassword: Pass920!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(122, 2, 'akun', 'Email: user9878@gmail.com\nPassword: Pass912!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(123, 2, 'akun', 'Email: user3646@gmail.com\nPassword: Pass802!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(124, 2, 'akun', 'Email: user7646@gmail.com\nPassword: Pass514!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(125, 2, 'akun', 'Email: user2867@gmail.com\nPassword: Pass183!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(126, 2, 'akun', 'Email: user9690@gmail.com\nPassword: Pass522!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(127, 2, 'akun', 'Email: user9348@gmail.com\nPassword: Pass139!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(128, 2, 'akun', 'Email: user7315@gmail.com\nPassword: Pass847!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(129, 2, 'akun', 'Email: user2213@gmail.com\nPassword: Pass225!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(130, 2, 'akun', 'Email: user3407@gmail.com\nPassword: Pass612!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(131, 2, 'akun', 'Email: user3538@gmail.com\nPassword: Pass117!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(132, 2, 'akun', 'Email: user7258@gmail.com\nPassword: Pass120!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(133, 2, 'akun', 'Email: user9016@gmail.com\nPassword: Pass158!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(134, 2, 'akun', 'Email: user1753@gmail.com\nPassword: Pass671!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(135, 2, 'akun', 'Email: user5721@gmail.com\nPassword: Pass717!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(136, 2, 'akun', 'Email: user6487@gmail.com\nPassword: Pass611!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(137, 2, 'akun', 'Email: user9858@gmail.com\nPassword: Pass333!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(138, 2, 'akun', 'Email: user3818@gmail.com\nPassword: Pass866!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(139, 2, 'akun', 'Email: user1822@gmail.com\nPassword: Pass228!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(140, 2, 'akun', 'Email: user5987@gmail.com\nPassword: Pass318!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(141, 2, 'akun', 'Email: user1362@gmail.com\nPassword: Pass448!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(142, 2, 'akun', 'Email: user9567@gmail.com\nPassword: Pass518!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:06'),
(143, 2, 'akun', 'Email: user9413@gmail.com\nPassword: Pass636!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(144, 2, 'akun', 'Email: user2727@gmail.com\nPassword: Pass402!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(145, 2, 'akun', 'Email: user2351@gmail.com\nPassword: Pass480!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(146, 2, 'akun', 'Email: user4845@gmail.com\nPassword: Pass625!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(147, 2, 'akun', 'Email: user4566@gmail.com\nPassword: Pass846!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(148, 2, 'akun', 'Email: user9883@gmail.com\nPassword: Pass580!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(149, 2, 'akun', 'Email: user9160@gmail.com\nPassword: Pass772!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(150, 2, 'akun', 'Email: user3672@gmail.com\nPassword: Pass457!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(151, 2, 'akun', 'Email: user9799@gmail.com\nPassword: Pass339!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(152, 2, 'akun', 'Email: user8971@gmail.com\nPassword: Pass980!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(153, 2, 'akun', 'Email: user9342@gmail.com\nPassword: Pass602!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(154, 2, 'akun', 'Email: user8502@gmail.com\nPassword: Pass785!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(155, 2, 'akun', 'Email: user2145@gmail.com\nPassword: Pass751!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(156, 2, 'akun', 'Email: user7493@gmail.com\nPassword: Pass993!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(157, 2, 'akun', 'Email: user7471@gmail.com\nPassword: Pass208!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(158, 2, 'akun', 'Email: user7607@gmail.com\nPassword: Pass925!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(159, 2, 'akun', 'Email: user3775@gmail.com\nPassword: Pass741!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(160, 2, 'akun', 'Email: user8736@gmail.com\nPassword: Pass708!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(161, 2, 'akun', 'Email: user3093@gmail.com\nPassword: Pass337!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(162, 2, 'akun', 'Email: user1886@gmail.com\nPassword: Pass869!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(163, 2, 'akun', 'Email: user4615@gmail.com\nPassword: Pass543!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(164, 2, 'akun', 'Email: user4528@gmail.com\nPassword: Pass776!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(165, 2, 'akun', 'Email: user1688@gmail.com\nPassword: Pass525!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(166, 2, 'akun', 'Email: user7977@gmail.com\nPassword: Pass173!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(167, 2, 'akun', 'Email: user9027@gmail.com\nPassword: Pass728!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(168, 2, 'akun', 'Email: user2866@gmail.com\nPassword: Pass967!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(169, 2, 'akun', 'Email: user4821@gmail.com\nPassword: Pass480!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(170, 2, 'akun', 'Email: user4664@gmail.com\nPassword: Pass901!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(171, 2, 'akun', 'Email: user6010@gmail.com\nPassword: Pass410!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(172, 2, 'akun', 'Email: user9038@gmail.com\nPassword: Pass720!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(173, 2, 'akun', 'Email: user5720@gmail.com\nPassword: Pass542!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(174, 2, 'akun', 'Email: user9794@gmail.com\nPassword: Pass752!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(175, 2, 'akun', 'Email: user2762@gmail.com\nPassword: Pass368!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(176, 2, 'akun', 'Email: user5502@gmail.com\nPassword: Pass573!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(177, 2, 'akun', 'Email: user3668@gmail.com\nPassword: Pass923!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(178, 2, 'akun', 'Email: user4895@gmail.com\nPassword: Pass692!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(179, 2, 'akun', 'Email: user3495@gmail.com\nPassword: Pass472!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(180, 2, 'akun', 'Email: user7951@gmail.com\nPassword: Pass220!\nPlan: Premium Individual\nExp: 2026-02-26', 'tersedia', NULL, '2026-01-27 07:06:07'),
(181, 3, 'akun', 'Email: user9310@gmail.com\nPassword: Pass726!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(182, 3, 'akun', 'Email: user7684@gmail.com\nPassword: Pass129!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(183, 3, 'akun', 'Email: user9398@gmail.com\nPassword: Pass112!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(184, 3, 'akun', 'Email: user1234@gmail.com\nPassword: Pass885!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(185, 3, 'akun', 'Email: user8566@gmail.com\nPassword: Pass889!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(186, 3, 'akun', 'Email: user6054@gmail.com\nPassword: Pass505!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(187, 3, 'akun', 'Email: user3221@gmail.com\nPassword: Pass573!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(188, 3, 'akun', 'Email: user7943@gmail.com\nPassword: Pass114!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(189, 3, 'akun', 'Email: user6649@gmail.com\nPassword: Pass648!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(190, 3, 'akun', 'Email: user3960@gmail.com\nPassword: Pass936!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(191, 3, 'akun', 'Email: user2524@gmail.com\nPassword: Pass473!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(192, 3, 'akun', 'Email: user2774@gmail.com\nPassword: Pass865!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(193, 3, 'akun', 'Email: user5828@gmail.com\nPassword: Pass792!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(194, 3, 'akun', 'Email: user7937@gmail.com\nPassword: Pass668!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(195, 3, 'akun', 'Email: user9110@gmail.com\nPassword: Pass954!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(196, 3, 'akun', 'Email: user1124@gmail.com\nPassword: Pass192!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(197, 3, 'akun', 'Email: user6515@gmail.com\nPassword: Pass187!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(198, 3, 'akun', 'Email: user5655@gmail.com\nPassword: Pass709!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(199, 3, 'akun', 'Email: user1301@gmail.com\nPassword: Pass834!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(200, 3, 'akun', 'Email: user9685@gmail.com\nPassword: Pass248!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(201, 3, 'akun', 'Email: user1994@gmail.com\nPassword: Pass881!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(202, 3, 'akun', 'Email: user9337@gmail.com\nPassword: Pass334!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(203, 3, 'akun', 'Email: user3001@gmail.com\nPassword: Pass698!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(204, 3, 'akun', 'Email: user3101@gmail.com\nPassword: Pass167!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(205, 3, 'akun', 'Email: user7930@gmail.com\nPassword: Pass404!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(206, 3, 'akun', 'Email: user6305@gmail.com\nPassword: Pass346!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(207, 3, 'akun', 'Email: user8016@gmail.com\nPassword: Pass706!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(208, 3, 'akun', 'Email: user9780@gmail.com\nPassword: Pass935!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(209, 3, 'akun', 'Email: user5884@gmail.com\nPassword: Pass109!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(210, 3, 'akun', 'Email: user6174@gmail.com\nPassword: Pass450!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(211, 3, 'akun', 'Email: user4154@gmail.com\nPassword: Pass950!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(212, 3, 'akun', 'Email: user2747@gmail.com\nPassword: Pass138!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(213, 3, 'akun', 'Email: user7168@gmail.com\nPassword: Pass108!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(214, 3, 'akun', 'Email: user2106@gmail.com\nPassword: Pass713!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(215, 3, 'akun', 'Email: user7754@gmail.com\nPassword: Pass425!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(216, 3, 'akun', 'Email: user8465@gmail.com\nPassword: Pass912!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(217, 3, 'akun', 'Email: user5199@gmail.com\nPassword: Pass310!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(218, 3, 'akun', 'Email: user2727@gmail.com\nPassword: Pass457!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(219, 3, 'akun', 'Email: user4043@gmail.com\nPassword: Pass261!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(220, 3, 'akun', 'Email: user1420@gmail.com\nPassword: Pass620!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(221, 3, 'akun', 'Email: user6485@gmail.com\nPassword: Pass752!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(222, 3, 'akun', 'Email: user5067@gmail.com\nPassword: Pass749!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(223, 3, 'akun', 'Email: user2921@gmail.com\nPassword: Pass802!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(224, 3, 'akun', 'Email: user9404@gmail.com\nPassword: Pass507!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(225, 3, 'akun', 'Email: user1816@gmail.com\nPassword: Pass545!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(226, 3, 'akun', 'Email: user2504@gmail.com\nPassword: Pass433!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(227, 3, 'akun', 'Email: user3454@gmail.com\nPassword: Pass648!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(228, 3, 'akun', 'Email: user9830@gmail.com\nPassword: Pass822!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(229, 3, 'akun', 'Email: user5887@gmail.com\nPassword: Pass148!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(230, 3, 'akun', 'Email: user8396@gmail.com\nPassword: Pass446!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(231, 3, 'akun', 'Email: user4867@gmail.com\nPassword: Pass226!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(232, 3, 'akun', 'Email: user8910@gmail.com\nPassword: Pass162!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(233, 3, 'akun', 'Email: user5925@gmail.com\nPassword: Pass781!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(234, 3, 'akun', 'Email: user6172@gmail.com\nPassword: Pass383!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(235, 3, 'akun', 'Email: user7662@gmail.com\nPassword: Pass202!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(236, 3, 'akun', 'Email: user2726@gmail.com\nPassword: Pass830!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(237, 3, 'akun', 'Email: user4721@gmail.com\nPassword: Pass813!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(238, 3, 'akun', 'Email: user7008@gmail.com\nPassword: Pass593!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(239, 3, 'akun', 'Email: user7829@gmail.com\nPassword: Pass814!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(240, 3, 'akun', 'Email: user3780@gmail.com\nPassword: Pass603!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(241, 3, 'akun', 'Email: user9871@gmail.com\nPassword: Pass394!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(242, 3, 'akun', 'Email: user2968@gmail.com\nPassword: Pass829!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(243, 3, 'akun', 'Email: user9678@gmail.com\nPassword: Pass719!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(244, 3, 'akun', 'Email: user4242@gmail.com\nPassword: Pass468!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(245, 3, 'akun', 'Email: user7164@gmail.com\nPassword: Pass276!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(246, 3, 'akun', 'Email: user9264@gmail.com\nPassword: Pass731!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(247, 3, 'akun', 'Email: user8817@gmail.com\nPassword: Pass254!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(248, 3, 'akun', 'Email: user5517@gmail.com\nPassword: Pass591!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(249, 3, 'akun', 'Email: user2661@gmail.com\nPassword: Pass535!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(250, 3, 'akun', 'Email: user2335@gmail.com\nPassword: Pass770!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(251, 3, 'akun', 'Email: user3177@gmail.com\nPassword: Pass532!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(252, 3, 'akun', 'Email: user8921@gmail.com\nPassword: Pass479!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(253, 3, 'akun', 'Email: user2989@gmail.com\nPassword: Pass524!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(254, 3, 'akun', 'Email: user5071@gmail.com\nPassword: Pass632!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(255, 3, 'akun', 'Email: user5504@gmail.com\nPassword: Pass715!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(256, 3, 'akun', 'Email: user4189@gmail.com\nPassword: Pass126!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(257, 3, 'akun', 'Email: user6081@gmail.com\nPassword: Pass887!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(258, 3, 'akun', 'Email: user8344@gmail.com\nPassword: Pass962!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(259, 3, 'akun', 'Email: user8787@gmail.com\nPassword: Pass331!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(260, 3, 'akun', 'Email: user8540@gmail.com\nPassword: Pass670!\nProfile: User 1\nPIN: 1234', 'tersedia', NULL, '2026-01-27 07:06:07'),
(261, 4, 'akun', 'Email: user4269@gmail.com\nPassword: Pass119!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(262, 4, 'akun', 'Email: user9496@gmail.com\nPassword: Pass825!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(263, 4, 'akun', 'Email: user4199@gmail.com\nPassword: Pass528!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(264, 4, 'akun', 'Email: user8639@gmail.com\nPassword: Pass628!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(265, 4, 'akun', 'Email: user4588@gmail.com\nPassword: Pass299!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(266, 4, 'akun', 'Email: user7932@gmail.com\nPassword: Pass168!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(267, 4, 'akun', 'Email: user8834@gmail.com\nPassword: Pass291!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(268, 4, 'akun', 'Email: user3599@gmail.com\nPassword: Pass171!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(269, 4, 'akun', 'Email: user7606@gmail.com\nPassword: Pass311!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(270, 4, 'akun', 'Email: user3823@gmail.com\nPassword: Pass465!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(271, 4, 'akun', 'Email: user4582@gmail.com\nPassword: Pass818!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(272, 4, 'akun', 'Email: user9645@gmail.com\nPassword: Pass271!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(273, 4, 'akun', 'Email: user5604@gmail.com\nPassword: Pass415!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(274, 4, 'akun', 'Email: user3392@gmail.com\nPassword: Pass490!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(275, 4, 'akun', 'Email: user7473@gmail.com\nPassword: Pass132!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(276, 4, 'akun', 'Email: user3075@gmail.com\nPassword: Pass177!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(277, 4, 'akun', 'Email: user9130@gmail.com\nPassword: Pass438!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(278, 4, 'akun', 'Email: user7741@gmail.com\nPassword: Pass364!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(279, 4, 'akun', 'Email: user2881@gmail.com\nPassword: Pass780!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(280, 4, 'akun', 'Email: user8735@gmail.com\nPassword: Pass786!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(281, 4, 'akun', 'Email: user2477@gmail.com\nPassword: Pass277!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(282, 4, 'akun', 'Email: user6899@gmail.com\nPassword: Pass184!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(283, 4, 'akun', 'Email: user2108@gmail.com\nPassword: Pass819!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(284, 4, 'akun', 'Email: user4164@gmail.com\nPassword: Pass704!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(285, 4, 'akun', 'Email: user3450@gmail.com\nPassword: Pass662!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(286, 4, 'akun', 'Email: user1880@gmail.com\nPassword: Pass861!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(287, 4, 'akun', 'Email: user2512@gmail.com\nPassword: Pass273!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(288, 4, 'akun', 'Email: user2147@gmail.com\nPassword: Pass825!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(289, 4, 'akun', 'Email: user7265@gmail.com\nPassword: Pass883!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(290, 4, 'akun', 'Email: user6004@gmail.com\nPassword: Pass413!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(291, 4, 'akun', 'Email: user3491@gmail.com\nPassword: Pass578!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(292, 4, 'akun', 'Email: user5228@gmail.com\nPassword: Pass407!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(293, 4, 'akun', 'Email: user8015@gmail.com\nPassword: Pass677!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(294, 4, 'akun', 'Email: user5416@gmail.com\nPassword: Pass390!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(295, 4, 'akun', 'Email: user7516@gmail.com\nPassword: Pass265!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(296, 4, 'akun', 'Email: user5495@gmail.com\nPassword: Pass175!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(297, 4, 'akun', 'Email: user1358@gmail.com\nPassword: Pass907!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(298, 4, 'akun', 'Email: user9581@gmail.com\nPassword: Pass936!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(299, 4, 'akun', 'Email: user2653@gmail.com\nPassword: Pass854!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(300, 4, 'akun', 'Email: user1866@gmail.com\nPassword: Pass894!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(301, 4, 'akun', 'Email: user2755@gmail.com\nPassword: Pass524!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(302, 4, 'akun', 'Email: user2243@gmail.com\nPassword: Pass695!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(303, 4, 'akun', 'Email: user1800@gmail.com\nPassword: Pass992!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(304, 4, 'akun', 'Email: user1465@gmail.com\nPassword: Pass707!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(305, 4, 'akun', 'Email: user3333@gmail.com\nPassword: Pass667!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(306, 4, 'akun', 'Email: user3386@gmail.com\nPassword: Pass817!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(307, 4, 'akun', 'Email: user3902@gmail.com\nPassword: Pass550!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(308, 4, 'akun', 'Email: user8264@gmail.com\nPassword: Pass891!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(309, 4, 'akun', 'Email: user7596@gmail.com\nPassword: Pass802!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(310, 4, 'akun', 'Email: user5525@gmail.com\nPassword: Pass140!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(311, 4, 'akun', 'Email: user2609@gmail.com\nPassword: Pass934!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(312, 4, 'akun', 'Email: user5260@gmail.com\nPassword: Pass860!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(313, 4, 'akun', 'Email: user3334@gmail.com\nPassword: Pass380!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(314, 4, 'akun', 'Email: user4894@gmail.com\nPassword: Pass875!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(315, 4, 'akun', 'Email: user7997@gmail.com\nPassword: Pass688!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(316, 4, 'akun', 'Email: user8009@gmail.com\nPassword: Pass572!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(317, 4, 'akun', 'Email: user8473@gmail.com\nPassword: Pass290!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(318, 4, 'akun', 'Email: user4672@gmail.com\nPassword: Pass754!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(319, 4, 'akun', 'Email: user7117@gmail.com\nPassword: Pass461!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(320, 4, 'akun', 'Email: user6992@gmail.com\nPassword: Pass618!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(321, 4, 'akun', 'Email: user1866@gmail.com\nPassword: Pass216!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(322, 4, 'akun', 'Email: user8861@gmail.com\nPassword: Pass959!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(323, 4, 'akun', 'Email: user3519@gmail.com\nPassword: Pass781!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(324, 4, 'akun', 'Email: user2456@gmail.com\nPassword: Pass243!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(325, 4, 'akun', 'Email: user1847@gmail.com\nPassword: Pass260!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(326, 4, 'akun', 'Email: user5531@gmail.com\nPassword: Pass720!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(327, 4, 'akun', 'Email: user1544@gmail.com\nPassword: Pass929!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(328, 4, 'akun', 'Email: user3432@gmail.com\nPassword: Pass115!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(329, 4, 'akun', 'Email: user3997@gmail.com\nPassword: Pass953!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(330, 4, 'akun', 'Email: user4966@gmail.com\nPassword: Pass859!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(331, 4, 'akun', 'Email: user3283@gmail.com\nPassword: Pass720!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(332, 4, 'akun', 'Email: user3632@gmail.com\nPassword: Pass532!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(333, 4, 'akun', 'Email: user6576@gmail.com\nPassword: Pass448!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(334, 4, 'akun', 'Email: user5555@gmail.com\nPassword: Pass600!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(335, 4, 'akun', 'Email: user7663@gmail.com\nPassword: Pass229!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(336, 4, 'akun', 'Email: user6091@gmail.com\nPassword: Pass476!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(337, 4, 'akun', 'Email: user8271@gmail.com\nPassword: Pass804!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(338, 4, 'akun', 'Email: user6433@gmail.com\nPassword: Pass843!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(339, 4, 'akun', 'Email: user4475@gmail.com\nPassword: Pass373!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(340, 4, 'akun', 'Email: user3758@gmail.com\nPassword: Pass505!\nType: Plus Subscription', 'tersedia', NULL, '2026-01-27 07:06:07'),
(341, 5, 'akun', 'Email: user1267@gmail.com\nPassword: Pass104!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(342, 5, 'akun', 'Email: user1840@gmail.com\nPassword: Pass648!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(343, 5, 'akun', 'Email: user3354@gmail.com\nPassword: Pass734!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(344, 5, 'akun', 'Email: user8956@gmail.com\nPassword: Pass659!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(345, 5, 'akun', 'Email: user6486@gmail.com\nPassword: Pass621!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(346, 5, 'akun', 'Email: user1721@gmail.com\nPassword: Pass621!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(347, 5, 'akun', 'Email: user3406@gmail.com\nPassword: Pass442!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(348, 5, 'akun', 'Email: user2268@gmail.com\nPassword: Pass521!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(349, 5, 'akun', 'Email: user8415@gmail.com\nPassword: Pass120!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(350, 5, 'akun', 'Email: user5503@gmail.com\nPassword: Pass755!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(351, 5, 'akun', 'Email: user1200@gmail.com\nPassword: Pass861!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(352, 5, 'akun', 'Email: user6616@gmail.com\nPassword: Pass214!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(353, 5, 'akun', 'Email: user4842@gmail.com\nPassword: Pass873!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(354, 5, 'akun', 'Email: user9644@gmail.com\nPassword: Pass694!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(355, 5, 'akun', 'Email: user9690@gmail.com\nPassword: Pass989!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(356, 5, 'akun', 'Email: user7284@gmail.com\nPassword: Pass158!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(357, 5, 'akun', 'Email: user6270@gmail.com\nPassword: Pass399!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(358, 5, 'akun', 'Email: user3496@gmail.com\nPassword: Pass596!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(359, 5, 'akun', 'Email: user7219@gmail.com\nPassword: Pass623!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(360, 5, 'akun', 'Email: user2404@gmail.com\nPassword: Pass947!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(361, 5, 'akun', 'Email: user8994@gmail.com\nPassword: Pass240!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(362, 5, 'akun', 'Email: user7351@gmail.com\nPassword: Pass559!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(363, 5, 'akun', 'Email: user6169@gmail.com\nPassword: Pass533!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(364, 5, 'akun', 'Email: user9192@gmail.com\nPassword: Pass356!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(365, 5, 'akun', 'Email: user8673@gmail.com\nPassword: Pass687!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(366, 5, 'akun', 'Email: user7006@gmail.com\nPassword: Pass150!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(367, 5, 'akun', 'Email: user1384@gmail.com\nPassword: Pass837!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(368, 5, 'akun', 'Email: user5280@gmail.com\nPassword: Pass816!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(369, 5, 'akun', 'Email: user6798@gmail.com\nPassword: Pass773!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(370, 5, 'akun', 'Email: user9878@gmail.com\nPassword: Pass324!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(371, 5, 'akun', 'Email: user8069@gmail.com\nPassword: Pass304!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(372, 5, 'akun', 'Email: user8652@gmail.com\nPassword: Pass151!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(373, 5, 'akun', 'Email: user4657@gmail.com\nPassword: Pass876!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(374, 5, 'akun', 'Email: user5771@gmail.com\nPassword: Pass186!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(375, 5, 'akun', 'Email: user4941@gmail.com\nPassword: Pass796!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(376, 5, 'akun', 'Email: user1636@gmail.com\nPassword: Pass841!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(377, 5, 'akun', 'Email: user8070@gmail.com\nPassword: Pass802!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(378, 5, 'akun', 'Email: user1936@gmail.com\nPassword: Pass522!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(379, 5, 'akun', 'Email: user7849@gmail.com\nPassword: Pass108!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(380, 5, 'akun', 'Email: user8730@gmail.com\nPassword: Pass512!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(381, 5, 'akun', 'Email: user1360@gmail.com\nPassword: Pass575!', 'tersedia', NULL, '2026-01-27 07:06:07');
INSERT INTO `produk_akun` (`id`, `produk_id`, `jenis_akun`, `data_akun`, `status`, `pesanan_id`, `created_at`) VALUES
(382, 5, 'akun', 'Email: user7869@gmail.com\nPassword: Pass204!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(383, 5, 'akun', 'Email: user9065@gmail.com\nPassword: Pass542!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(384, 5, 'akun', 'Email: user8461@gmail.com\nPassword: Pass304!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(385, 5, 'akun', 'Email: user7029@gmail.com\nPassword: Pass314!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(386, 5, 'akun', 'Email: user2960@gmail.com\nPassword: Pass682!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(387, 5, 'akun', 'Email: user6282@gmail.com\nPassword: Pass217!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(388, 5, 'akun', 'Email: user9164@gmail.com\nPassword: Pass366!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(389, 5, 'akun', 'Email: user2001@gmail.com\nPassword: Pass887!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(390, 5, 'akun', 'Email: user3403@gmail.com\nPassword: Pass865!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(391, 5, 'akun', 'Email: user7227@gmail.com\nPassword: Pass429!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(392, 5, 'akun', 'Email: user8296@gmail.com\nPassword: Pass598!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(393, 5, 'akun', 'Email: user3962@gmail.com\nPassword: Pass167!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(394, 5, 'akun', 'Email: user8495@gmail.com\nPassword: Pass636!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(395, 5, 'akun', 'Email: user5369@gmail.com\nPassword: Pass753!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(396, 5, 'akun', 'Email: user9934@gmail.com\nPassword: Pass270!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(397, 5, 'akun', 'Email: user4299@gmail.com\nPassword: Pass940!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(398, 5, 'akun', 'Email: user4288@gmail.com\nPassword: Pass184!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(399, 5, 'akun', 'Email: user4129@gmail.com\nPassword: Pass661!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(400, 5, 'akun', 'Email: user1972@gmail.com\nPassword: Pass654!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(401, 5, 'akun', 'Email: user6824@gmail.com\nPassword: Pass914!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(402, 5, 'akun', 'Email: user6655@gmail.com\nPassword: Pass848!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(403, 5, 'akun', 'Email: user7713@gmail.com\nPassword: Pass830!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(404, 5, 'akun', 'Email: user5780@gmail.com\nPassword: Pass892!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(405, 5, 'akun', 'Email: user4986@gmail.com\nPassword: Pass841!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(406, 5, 'akun', 'Email: user7135@gmail.com\nPassword: Pass106!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(407, 5, 'akun', 'Email: user4924@gmail.com\nPassword: Pass744!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(408, 5, 'akun', 'Email: user2963@gmail.com\nPassword: Pass967!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(409, 5, 'akun', 'Email: user7557@gmail.com\nPassword: Pass718!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(410, 5, 'akun', 'Email: user8390@gmail.com\nPassword: Pass530!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(411, 5, 'akun', 'Email: user8828@gmail.com\nPassword: Pass237!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(412, 5, 'akun', 'Email: user5205@gmail.com\nPassword: Pass637!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(413, 5, 'akun', 'Email: user5116@gmail.com\nPassword: Pass263!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(414, 5, 'akun', 'Email: user1571@gmail.com\nPassword: Pass320!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(415, 5, 'akun', 'Email: user3305@gmail.com\nPassword: Pass617!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(416, 5, 'akun', 'Email: user3054@gmail.com\nPassword: Pass687!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(417, 5, 'akun', 'Email: user2240@gmail.com\nPassword: Pass362!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(418, 5, 'akun', 'Email: user5145@gmail.com\nPassword: Pass207!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(419, 5, 'akun', 'Email: user3994@gmail.com\nPassword: Pass894!', 'tersedia', NULL, '2026-01-27 07:06:07'),
(420, 5, 'akun', 'Email: user3898@gmail.com\nPassword: Pass424!', 'tersedia', NULL, '2026-01-27 07:06:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `produk_id` int DEFAULT NULL,
  `pelanggan_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `komentar` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_follows`
--

CREATE TABLE `social_follows` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_likes`
--

CREATE TABLE `social_likes` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_shares`
--

CREATE TABLE `social_shares` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `produk_akun`
--
ALTER TABLE `produk_akun`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `pesanan_id` (`pesanan_id`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `social_follows`
--
ALTER TABLE `social_follows`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `social_likes`
--
ALTER TABLE `social_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `social_shares`
--
ALTER TABLE `social_shares`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `produk_akun`
--
ALTER TABLE `produk_akun`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `social_follows`
--
ALTER TABLE `social_follows`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `social_likes`
--
ALTER TABLE `social_likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `social_shares`
--
ALTER TABLE `social_shares`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `produk_akun`
--
ALTER TABLE `produk_akun`
  ADD CONSTRAINT `produk_akun_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produk_akun_ibfk_2` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
