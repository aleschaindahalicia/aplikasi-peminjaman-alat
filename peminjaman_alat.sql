-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 09 Apr 2026 pada 01.56
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_alat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id_log`, `id_user`, `activity`, `created_at`) VALUES
(816, 4, 'Mengakses halaman Activity Log', '2026-04-08 11:47:20'),
(817, 4, 'Mengakses halaman Activity Log', '2026-04-08 11:47:36'),
(818, 4, 'Login ke sistem', '2026-04-08 18:21:38'),
(819, 4, 'Mengakses dashboard Admin', '2026-04-08 18:21:38'),
(820, 4, 'Mengakses halaman Activity Log', '2026-04-08 18:21:49'),
(821, 4, 'Mengakses halaman Activity Log', '2026-04-08 18:21:55'),
(822, 4, 'Mengakses halaman Activity Log', '2026-04-08 18:22:17'),
(823, 4, 'Mengakses halaman Activity Log', '2026-04-08 18:22:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL,
  `nama_alat` varchar(30) NOT NULL,
  `id_category` int(11) NOT NULL,
  `merk_alat` varchar(30) NOT NULL,
  `kondisi` varchar(30) NOT NULL,
  `deskripsi_alat` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`id_alat`, `nama_alat`, `id_category`, `merk_alat`, `kondisi`, `deskripsi_alat`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Drum', 2, 'Yamaha', 'Baik', 'Hybrid Maple', 'Dibooking', '2026-04-07 11:04:04', '2026-04-08 11:25:00', '0000-00-00 00:00:00'),
(11, 'Keyboard', 2, 'Yamaha', 'Baik', 'PSR-F52', 'Tersedia', '2026-04-07 11:04:43', '2026-04-07 18:23:01', '0000-00-00 00:00:00'),
(12, 'Suling', 1, 'Yamaha', 'Baik', 'YRS-23', 'Tersedia', '2026-04-07 11:05:10', '2026-04-07 18:23:04', '0000-00-00 00:00:00'),
(13, 'Piano', 2, 'Yamaha', 'Baik', 'Clavinova', 'Tersedia', '2026-04-07 11:06:07', '2026-04-08 09:20:38', '0000-00-00 00:00:00'),
(14, 'Keyboard', 1, 'Yamaha', 'Rusak Ringan', 'wh', 'Tersedia', '2026-04-07 11:06:17', '2026-04-07 11:06:27', '2026-04-07 11:06:27'),
(15, 'Suling', 1, 'Yamaha', 'Rusak Ringan', 'y', 'Tersedia', '2026-04-07 11:12:27', '2026-04-07 11:12:31', '2026-04-07 11:12:31'),
(16, 'suling', 2, 'Yamaha', 'Baik', 'q\r\n', 'Tersedia', '2026-04-07 16:02:01', '2026-04-07 16:02:15', '2026-04-07 16:02:15'),
(17, 'Keyboard', 2, 'Yamaha', 'Rusak Ringan', '12323', 'Tersedia', '2026-04-07 16:40:15', '2026-04-07 16:40:24', '2026-04-07 16:40:24'),
(18, 'Drum', 2, 'Yamaha', 'Baik', 'q', 'Tersedia', '2026-04-07 17:14:38', '2026-04-07 17:14:53', '2026-04-07 17:14:53'),
(19, 'Keyboard', 1, 'Yamaha', 'Rusak Ringan', 'csa', 'Tersedia', '2026-04-07 19:49:15', '2026-04-07 19:49:39', '2026-04-07 19:49:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `nama_category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `nama_category`) VALUES
(1, 'Tradisional'),
(2, 'Modern');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `alasan_penolakan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_alat`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `alasan_penolakan`) VALUES
(2, 5, 2, '2026-03-30', '2026-03-30', 'Dikembalikan', ''),
(4, 5, 2, '2026-04-01', '2026-04-01', 'Dikembalikan', ''),
(5, 5, 1, '2026-04-01', '2026-04-01', 'Dikembalikan', ''),
(6, 5, 2, '2026-04-01', '0000-00-00', 'Ditolak', ''),
(7, 5, 2, '2026-04-02', '2026-04-02', 'Dikembalikan', ''),
(8, 5, 2, '2026-04-03', '2026-04-03', 'Dikembalikan', ''),
(9, 5, 3, '2026-04-06', '2026-04-06', 'Dikembalikan', ''),
(10, 5, 1, '2026-04-06', '0000-00-00', 'Ditolak', ''),
(11, 5, 3, '2026-04-06', '2026-04-07', 'Dikembalikan', ''),
(12, 5, 1, '2026-04-07', '2026-04-07', 'Dikembalikan', ''),
(13, 5, 3, '2026-04-07', '0000-00-00', 'Ditolak', ''),
(14, 5, 1, '2026-04-07', '2026-04-07', 'Dikembalikan', ''),
(20, 13, 13, '2026-04-07', '0000-00-00', 'Ditolak', 'Sudah Pernah Meminjam'),
(22, 16, 10, '2026-04-08', '0000-00-00', 'Menunggu', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `password`, `role`, `no_hp`, `alamat`) VALUES
(4, 'Alescha indah alicia', 'alescha@gmail.com', '$2y$10$sYVkrUJWNfhjD6.cKIvP4OvhYHawSNXLdJGXSxvuxQxvrPCRdhRii', 'Admin', '085167829364', 'Jl. Cihanjuang'),
(5, 'Keysha', 'keysha@gmail.com', '$2y$10$tkOl4zQuBMi6cl.84CRHdu.tVWpbj0zq/BfY7CLdBeyYD3Si4IWOm', 'Peminjam', '081221200104', 'Nanjung'),
(6, 'Kinanti', 'kinanti@gmail.com', '$2y$10$5mR3m651Plrku38sczfs8.aT75puEBHDse6F0uplZcaBJMzx41Zfe', 'Petugas', '087392748395', 'Jl. Cigugur'),
(13, 'Aliyah', 'Aliyah@gmail.com', '$2y$10$Ux8int.RCNqOZV/QrAymBeOU9iN.a7a9aUHoVfy8XxVZPo0MeWXEq', 'Peminjam', '085167829364', 'Jl. Ciawitali'),
(16, 'Indri', 'indri@gmail.com', '$2y$10$n5ZsqjxleR8Z3bOYsIPz3ubq5F5QsDmBFFGuXcKA4lk8YS1qZJOvu', 'Peminjam', '08762979264', 'jl');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=824;

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
