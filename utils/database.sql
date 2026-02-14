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

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO
    `admins` (
        `id`,
        `username`,
        `password`,
        `created_at`
    )
VALUES (
        4,
        'Diva_Baihaqi',
        '$2y$12$FOH4iozdAxQ7f0yUhdIXlePT3tNk5u3Sv1hgvFYF3vpeRsU8N.HMy',
        '2026-01-18 16:38:04'
    ),
    (
        6,
        'Kelompok5',
        '$2y$12$kmzqjolNj5Z2ocdlsvhsUO2q0OANR/myI3MDyThc4q7rkajbDDca6',
        '2026-01-27 00:57:41'
    ),
    (
        8,
        'admin',
        '$2y$12$wXNnTZ2d1uZ3nO7rHI9AB.jGWKRaT.71C/nRQfZPXZVX2isUolsjq',
        '2026-01-27 05:47:40'
    );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `blog`
--

INSERT INTO
    `blog` (
        `id`,
        `judul`,
        `konten`,
        `gambar`,
        `kategori`,
        `tanggal`
    )
VALUES (
        1,
        'Cara Hemat Langganan Streaming',
        'Tips hemat untuk anak kos...',
        NULL,
        'Tips',
        '2026-01-18'
    ),
    (
        2,
        'Kenapa AI Tools Penting?',
        'Di era digital ini...',
        NULL,
        'Teknologi',
        '2026-01-18'
    ),
    (
        3,
        'ChatGPT Plus vs Gemini Pro: Mana yang Lebih Worth It untuk Produktivitas?',
        'Skripsi macet? Tugas numpuk? AI solusinya!\r\n\r\nJangan cuma pakai AI buat tanya jawab biasa. Kalau kamu tahu triknya, tools seperti Gemini Advanced atau ChatGPT Plus bisa jadi asisten peneliti super canggih.\r\n\r\nGunakan Prompt \"Act As\": Suruh AI berperan sebagai dosen penguji untuk mengkritisi argumen di bab pembahasanmu.\r\n\r\nAnalisa Jurnal PDF: Upload file jurnal ke ChatGPT Plus, lalu minta ia merangkum poin penting yang relevan dengan topikmu. Hemat waktu baca berjam-jam!\r\n\r\nParaphrasing Tool: Hindari plagiasi dengan meminta AI menulis ulang kalimatmu dengan gaya bahasa akademis yang lebih formal.\r\n\r\nCari Referensi Terkini: Gunakan Gemini Pro untuk mencari sumber data terbaru yang real-time dari internet, karena datanya tidak terbatas tahun tertentu.\r\n\r\nMasih pusing juga ngerjainnya? Atau butuh akun premium biar fitur-fitur di atas kebuka semua?\r\n\r\nDapatkan akses akun premium murah meriah di toko kami. Atau kalau beneran udah mentok, hubungi admin untuk layanan konsultasi tugas!',
        '696d0e604fdae.jpg',
        'Review Gadget & AI Tools',
        '2026-01-18'
    );

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
    `id` int NOT NULL,
    `pesanan_id` int DEFAULT NULL,
    `produk_id` int DEFAULT NULL,
    `jumlah` int DEFAULT NULL,
    `harga_satuan` decimal(10, 0) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO
    `detail_pesanan` (
        `id`,
        `pesanan_id`,
        `produk_id`,
        `jumlah`,
        `harga_satuan`
    )
VALUES (1, 1, 4, 1, 20000),
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `faq`
--

INSERT INTO
    `faq` (`id`, `pertanyaan`, `jawaban`)
VALUES (
        1,
        'Apakah ini legal?',
        '100% Legal bukan akun curian.'
    ),
    (
        2,
        'Garansi berapa lama?',
        'Full garansi selama masa aktif.'
    ),
    (
        3,
        'Proses berapa lama?',
        '1-5 Menit jika admin online.'
    );

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
    `id` int NOT NULL,
    `nama_kategori` varchar(50) NOT NULL,
    `slug` varchar(100) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO
    `kategori` (`id`, `nama_kategori`, `slug`)
VALUES (1, 'Streaming', 'streaming'),
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO
    `pelanggan` (
        `id`,
        `nama`,
        `email`,
        `password`,
        `alamat`,
        `created_at`
    )
VALUES (
        3,
        'Kelompok 5',
        'kelompok5@gmail.com',
        '$2y$12$SRzZjayx/UB5YnhpDPirS.oRpdQAtHjHONxD6QnfUX0CjEb9Aq25y',
        'Cirebon',
        '2026-01-27 01:00:15'
    ),
    (
        5,
        'Hamdan Sadad',
        'hamdan@ti23b.com',
        '$2y$12$jZCxLbGx4qvh.MWYO4m6Ae3sMnh73DeyIQGN4G0zFK1tPSXI55VYG',
        'Cilimus',
        '2026-01-27 03:10:49'
    ),
    (
        6,
        'Diva Baihaqi',
        'diva@gmail.com',
        '$2y$12$3id2e4ZN3Qo6CvPKDhpIeuRXbsQfbkBski.shyjNjjbT7mRC9vdbi',
        'cirebon',
        '2026-01-27 04:10:45'
    ),
    (
        7,
        'Tester',
        'test@gmail.com',
        '$2y$12$a9ET4jARll054aLdpbQaBuJlSapWNO37IytXMnZNkgPqfLaxMT4Ue',
        '082117964344',
        '2026-01-27 05:44:45'
    );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
    `id` int NOT NULL,
    `pelanggan_id` int DEFAULT NULL,
    `total_harga` decimal(12, 0) DEFAULT NULL,
    `status` enum(
        'pending',
        'paid',
        'shipped',
        'completed',
        'cancelled',
        'success'
    ) DEFAULT 'pending',
    `bukti_pembayaran` varchar(255) DEFAULT NULL,
    `tanggal_pesanan` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO
    `pesanan` (
        `id`,
        `pelanggan_id`,
        `total_harga`,
        `status`,
        `bukti_pembayaran`,
        `tanggal_pesanan`
    )
VALUES (
        1,
        2,
        21000,
        'pending',
        NULL,
        '2026-01-27 02:51:30'
    ),
    (
        2,
        2,
        21000,
        'pending',
        NULL,
        '2026-01-27 03:05:00'
    ),
    (
        3,
        5,
        21000,
        'paid',
        NULL,
        '2026-01-27 03:11:56'
    ),
    (
        4,
        6,
        41000,
        'paid',
        NULL,
        '2026-01-27 04:52:01'
    ),
    (
        5,
        6,
        21000,
        'completed',
        NULL,
        '2026-01-27 05:05:29'
    ),
    (
        7,
        7,
        41000,
        'completed',
        'bukti_7_1769496417.png',
        '2026-01-27 06:31:31'
    ),
    (
        8,
        7,
        21000,
        'completed',
        'bukti_8_1769496360.jpg',
        '2026-01-27 06:44:40'
    ),
    (
        9,
        7,
        21000,
        'completed',
        'bukti_9_1769497663.jpg',
        '2026-01-27 07:07:22'
    ),
    (
        10,
        7,
        251000,
        'completed',
        'bukti_10_1769498536.png',
        '2026-01-27 07:21:02'
    );

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
    `id` int NOT NULL,
    `kategori_id` int DEFAULT NULL,
    `nama_produk` varchar(100) NOT NULL,
    `harga` decimal(10, 0) NOT NULL,
    `deskripsi` text,
    `spesifikasi` text,
    `gambar` varchar(255) DEFAULT NULL,
    `stok` int DEFAULT '100',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO
    `produk` (
        `id`,
        `kategori_id`,
        `nama_produk`,
        `harga`,
        `deskripsi`,
        `spesifikasi`,
        `gambar`,
        `stok`,
        `created_at`
    )
VALUES (
        1,
        1,
        'YouTube Premium',
        250000,
        'Nikmati YouTube tanpa iklan.',
        NULL,
        '696d0ef12d2d6.jpg',
        9,
        '2026-01-18 13:56:22'
    ),
    (
        2,
        2,
        'Spotify Premium',
        20000,
        'Dengarkan musik tanpa jeda.',
        NULL,
        '696d0f0c9814c.jpg',
        100,
        '2026-01-18 13:56:22'
    ),
    (
        3,
        1,
        'Netflix Premium',
        20000,
        'Nonton film 4K UHD.',
        NULL,
        '696d0f2367a4b.jpg',
        100,
        '2026-01-18 13:56:22'
    ),
    (
        4,
        3,
        'ChatGPT Plus',
        20000,
        'Akses ke GPT-4.',
        NULL,
        '696d0f452a6ec.jpg',
        100,
        '2026-01-18 13:56:22'
    ),
    (
        5,
        3,
        'Gemini Pro',
        20000,
        'Akses model AI tercerdas.',
        NULL,
        '696d0f599f9cc.jpg',
        99,
        '2026-01-18 13:56:22'
    );

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_akun`
--

CREATE TABLE `produk_akun` (
    `id` int NOT NULL,
    `produk_id` int NOT NULL,
    `jenis_akun` varchar(50) DEFAULT 'akun',
    `data_akun` text NOT NULL,
    `status` enum('tersedia', 'terjual') DEFAULT 'tersedia',
    `pesanan_id` int DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `produk_akun`
--

INSERT INTO
    `produk_akun` (
        `id`,
        `produk_id`,
        `jenis_akun`,
        `data_akun`,
        `status`,
        `pesanan_id`,
        `created_at`
    )
VALUES (
        1,
        1,
        'akun',
        'Email: user5943@gmail.com\nPassword: Pass934!',
        'terjual',
        10,
        '2026-01-27 07:04:51'
    ),
    (
        2,
        1,
        'akun',
        'Email: user5705@gmail.com\nPassword: Pass977!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        3,
        1,
        'akun',
        'Email: user7706@gmail.com\nPassword: Pass884!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        4,
        1,
        'akun',
        'Email: user3544@gmail.com\nPassword: Pass786!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        5,
        1,
        'akun',
        'Email: user3449@gmail.com\nPassword: Pass154!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        6,
        1,
        'akun',
        'Email: user7977@gmail.com\nPassword: Pass342!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        7,
        1,
        'akun',
        'Email: user5983@gmail.com\nPassword: Pass122!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        8,
        1,
        'akun',
        'Email: user8355@gmail.com\nPassword: Pass535!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        9,
        1,
        'akun',
        'Email: user3713@gmail.com\nPassword: Pass933!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        10,
        1,
        'akun',
        'Email: user5485@gmail.com\nPassword: Pass440!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        11,
        1,
        'akun',
        'Email: user2687@gmail.com\nPassword: Pass999!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        12,
        1,
        'akun',
        'Email: user8990@gmail.com\nPassword: Pass392!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        13,
        1,
        'akun',
        'Email: user9551@gmail.com\nPassword: Pass262!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        14,
        1,
        'akun',
        'Email: user9431@gmail.com\nPassword: Pass390!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        15,
        1,
        'akun',
        'Email: user9376@gmail.com\nPassword: Pass477!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        16,
        1,
        'akun',
        'Email: user9830@gmail.com\nPassword: Pass800!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        17,
        1,
        'akun',
        'Email: user9149@gmail.com\nPassword: Pass212!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        18,
        1,
        'akun',
        'Email: user3958@gmail.com\nPassword: Pass108!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        19,
        1,
        'akun',
        'Email: user5795@gmail.com\nPassword: Pass743!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        20,
        1,
        'akun',
        'Email: user2377@gmail.com\nPassword: Pass619!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        21,
        2,
        'akun',
        'Email: user3506@gmail.com\nPassword: Pass397!\nPlan: Premium Individual\nExp: 2026-02-26',
        'terjual',
        7,
        '2026-01-27 07:04:51'
    ),
    (
        22,
        2,
        'akun',
        'Email: user1236@gmail.com\nPassword: Pass299!\nPlan: Premium Individual\nExp: 2026-02-26',
        'terjual',
        8,
        '2026-01-27 07:04:51'
    ),
    (
        23,
        2,
        'akun',
        'Email: user5762@gmail.com\nPassword: Pass734!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        24,
        2,
        'akun',
        'Email: user4142@gmail.com\nPassword: Pass304!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        25,
        2,
        'akun',
        'Email: user5634@gmail.com\nPassword: Pass796!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        26,
        2,
        'akun',
        'Email: user6957@gmail.com\nPassword: Pass580!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        27,
        2,
        'akun',
        'Email: user9470@gmail.com\nPassword: Pass513!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        28,
        2,
        'akun',
        'Email: user2368@gmail.com\nPassword: Pass956!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        29,
        2,
        'akun',
        'Email: user4824@gmail.com\nPassword: Pass891!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        30,
        2,
        'akun',
        'Email: user2102@gmail.com\nPassword: Pass790!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        31,
        2,
        'akun',
        'Email: user8141@gmail.com\nPassword: Pass840!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        32,
        2,
        'akun',
        'Email: user8681@gmail.com\nPassword: Pass931!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        33,
        2,
        'akun',
        'Email: user9790@gmail.com\nPassword: Pass770!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        34,
        2,
        'akun',
        'Email: user2240@gmail.com\nPassword: Pass838!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        35,
        2,
        'akun',
        'Email: user7358@gmail.com\nPassword: Pass300!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        36,
        2,
        'akun',
        'Email: user1659@gmail.com\nPassword: Pass726!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        37,
        2,
        'akun',
        'Email: user4360@gmail.com\nPassword: Pass313!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        38,
        2,
        'akun',
        'Email: user1332@gmail.com\nPassword: Pass780!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        39,
        2,
        'akun',
        'Email: user6766@gmail.com\nPassword: Pass206!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        40,
        2,
        'akun',
        'Email: user3704@gmail.com\nPassword: Pass583!\nPlan: Premium Individual\nExp: 2026-02-26',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        41,
        3,
        'akun',
        'Email: user8677@gmail.com\nPassword: Pass715!\nProfile: User 1\nPIN: 1234',
        'terjual',
        7,
        '2026-01-27 07:04:51'
    ),
    (
        42,
        3,
        'akun',
        'Email: user8899@gmail.com\nPassword: Pass237!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        43,
        3,
        'akun',
        'Email: user5279@gmail.com\nPassword: Pass376!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        44,
        3,
        'akun',
        'Email: user9024@gmail.com\nPassword: Pass546!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        45,
        3,
        'akun',
        'Email: user3438@gmail.com\nPassword: Pass693!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        46,
        3,
        'akun',
        'Email: user9977@gmail.com\nPassword: Pass887!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        47,
        3,
        'akun',
        'Email: user4743@gmail.com\nPassword: Pass971!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        48,
        3,
        'akun',
        'Email: user6036@gmail.com\nPassword: Pass791!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        49,
        3,
        'akun',
        'Email: user8080@gmail.com\nPassword: Pass603!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        50,
        3,
        'akun',
        'Email: user4956@gmail.com\nPassword: Pass702!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        51,
        3,
        'akun',
        'Email: user6095@gmail.com\nPassword: Pass317!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        52,
        3,
        'akun',
        'Email: user5197@gmail.com\nPassword: Pass484!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        53,
        3,
        'akun',
        'Email: user9371@gmail.com\nPassword: Pass234!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        54,
        3,
        'akun',
        'Email: user6085@gmail.com\nPassword: Pass996!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        55,
        3,
        'akun',
        'Email: user7209@gmail.com\nPassword: Pass436!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        56,
        3,
        'akun',
        'Email: user2505@gmail.com\nPassword: Pass469!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        57,
        3,
        'akun',
        'Email: user5449@gmail.com\nPassword: Pass371!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        58,
        3,
        'akun',
        'Email: user6176@gmail.com\nPassword: Pass708!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        59,
        3,
        'akun',
        'Email: user7616@gmail.com\nPassword: Pass525!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        60,
        3,
        'akun',
        'Email: user2660@gmail.com\nPassword: Pass933!\nProfile: User 1\nPIN: 1234',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        61,
        4,
        'akun',
        'Email: user9800@gmail.com\nPassword: Pass871!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        62,
        4,
        'akun',
        'Email: user7821@gmail.com\nPassword: Pass213!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        63,
        4,
        'akun',
        'Email: user1056@gmail.com\nPassword: Pass876!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        64,
        4,
        'akun',
        'Email: user7532@gmail.com\nPassword: Pass287!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        65,
        4,
        'akun',
        'Email: user8243@gmail.com\nPassword: Pass314!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        66,
        4,
        'akun',
        'Email: user5297@gmail.com\nPassword: Pass688!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        67,
        4,
        'akun',
        'Email: user6878@gmail.com\nPassword: Pass675!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        68,
        4,
        'akun',
        'Email: user7974@gmail.com\nPassword: Pass725!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        69,
        4,
        'akun',
        'Email: user4714@gmail.com\nPassword: Pass624!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        70,
        4,
        'akun',
        'Email: user2891@gmail.com\nPassword: Pass760!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        71,
        4,
        'akun',
        'Email: user1770@gmail.com\nPassword: Pass348!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        72,
        4,
        'akun',
        'Email: user1891@gmail.com\nPassword: Pass217!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        73,
        4,
        'akun',
        'Email: user4699@gmail.com\nPassword: Pass926!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        74,
        4,
        'akun',
        'Email: user9790@gmail.com\nPassword: Pass195!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        75,
        4,
        'akun',
        'Email: user3116@gmail.com\nPassword: Pass554!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        76,
        4,
        'akun',
        'Email: user3319@gmail.com\nPassword: Pass402!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        77,
        4,
        'akun',
        'Email: user4642@gmail.com\nPassword: Pass246!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        78,
        4,
        'akun',
        'Email: user9954@gmail.com\nPassword: Pass909!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        79,
        4,
        'akun',
        'Email: user1671@gmail.com\nPassword: Pass295!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        80,
        4,
        'akun',
        'Email: user7966@gmail.com\nPassword: Pass430!\nType: Plus Subscription',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        81,
        5,
        'akun',
        'Email: user5229@gmail.com\nPassword: Pass103!',
        'terjual',
        9,
        '2026-01-27 07:04:51'
    ),
    (
        82,
        5,
        'akun',
        'Email: user3576@gmail.com\nPassword: Pass247!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        83,
        5,
        'akun',
        'Email: user2068@gmail.com\nPassword: Pass757!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        84,
        5,
        'akun',
        'Email: user4090@gmail.com\nPassword: Pass130!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        85,
        5,
        'akun',
        'Email: user5777@gmail.com\nPassword: Pass400!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        86,
        5,
        'akun',
        'Email: user1067@gmail.com\nPassword: Pass723!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        87,
        5,
        'akun',
        'Email: user1974@gmail.com\nPassword: Pass782!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        88,
        5,
        'akun',
        'Email: user2003@gmail.com\nPassword: Pass264!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        89,
        5,
        'akun',
        'Email: user7342@gmail.com\nPassword: Pass827!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        90,
        5,
        'akun',
        'Email: user7631@gmail.com\nPassword: Pass445!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        91,
        5,
        'akun',
        'Email: user4075@gmail.com\nPassword: Pass163!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        92,
        5,
        'akun',
        'Email: user3173@gmail.com\nPassword: Pass121!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        93,
        5,
        'akun',
        'Email: user7898@gmail.com\nPassword: Pass775!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        94,
        5,
        'akun',
        'Email: user4704@gmail.com\nPassword: Pass997!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        95,
        5,
        'akun',
        'Email: user5895@gmail.com\nPassword: Pass930!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        96,
        5,
        'akun',
        'Email: user7264@gmail.com\nPassword: Pass360!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        97,
        5,
        'akun',
        'Email: user9780@gmail.com\nPassword: Pass925!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        98,
        5,
        'akun',
        'Email: user5046@gmail.com\nPassword: Pass155!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        99,
        5,
        'akun',
        'Email: user6082@gmail.com\nPassword: Pass596!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    ),
    (
        100,
        5,
        'akun',
        'Email: user3090@gmail.com\nPassword: Pass662!',
        'tersedia',
        NULL,
        '2026-01-27 07:04:51'
    );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_follows`
--

CREATE TABLE `social_follows` (
    `id` int NOT NULL,
    `user_id` int DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_likes`
--

CREATE TABLE `social_likes` (
    `id` int NOT NULL,
    `user_id` int DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_shares`
--

CREATE TABLE `social_shares` (
    `id` int NOT NULL,
    `user_id` int DEFAULT NULL,
    `platform` varchar(50) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

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
ALTER TABLE `blog` ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
ADD PRIMARY KEY (`id`),
ADD KEY `pesanan_id` (`pesanan_id`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq` ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori` ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan` ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan` ADD PRIMARY KEY (`id`);

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
ALTER TABLE `review` ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `social_follows`
--
ALTER TABLE `social_follows` ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `social_likes`
--
ALTER TABLE `social_likes` ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `social_shares`
--
ALTER TABLE `social_shares` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT untuk tabel `blog`
--
ALTER TABLE `blog`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 13;

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan` MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT untuk tabel `produk_akun`
--
ALTER TABLE `produk_akun`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 421;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review` MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `social_follows`
--
ALTER TABLE `social_follows`
MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `social_likes`
--
ALTER TABLE `social_likes` MODIFY `id` int NOT NULL AUTO_INCREMENT;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;