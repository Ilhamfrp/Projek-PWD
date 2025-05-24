-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2025 pada 14.58
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
-- Database: `rental_ip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `iphones`
--

CREATE TABLE `iphones` (
  `idIphone` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `storage` varchar(50) DEFAULT NULL,
  `hargaPerHari` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `iphones`
--

INSERT INTO `iphones` (`idIphone`, `nama`, `model`, `warna`, `storage`, `hargaPerHari`, `stok`, `gambar`) VALUES
(1, 'iPhone 14 Pro Max', 'Pro Max', 'Space Black', '256GB', 350000.00, 5, 'iphone14promax.jpg'),
(2, 'iPhone 13', 'Standard', 'Blue', '128GB', 280000.00, 8, 'iphone13.jpg'),
(3, 'iPhone 12', 'Standard', 'White', '64GB', 220000.00, 3, 'iphone12.jpg'),
(4, 'iPhone 11', 'Standard', 'Red', '128GB', 200000.00, 6, 'iphone11.jpg'),
(5, 'iPhone 16', 'Pro', 'Titan Gray', '512GB', 400000.00, 2, 'iphone16.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `idPayment` int(11) NOT NULL,
  `idSewa` int(11) DEFAULT NULL,
  `tanggalBayar` date NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `metode` varchar(50) NOT NULL,
  `status` enum('pending','paid','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`idPayment`, `idSewa`, `tanggalBayar`, `jumlah`, `metode`, `status`) VALUES
(1, 2, '2025-05-16', 99999999.99, 'COD', 'pending'),
(2, 3, '2025-05-16', 99999999.99, 'Transfer Bank', 'pending'),
(3, 3, '2025-05-16', 99999999.99, 'Transfer Bank', 'pending'),
(4, 4, '2025-05-16', 3300000.00, 'Transfer Bank', 'pending'),
(5, 5, '2025-05-17', 280000.00, 'Transfer Bank', 'pending'),
(6, 6, '2025-05-19', 8750000.00, 'Transfer Bank', 'pending'),
(7, 7, '2025-05-19', 350000.00, 'Transfer Bank', 'pending'),
(8, 8, '2025-05-19', 10150000.00, 'COD', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `idReview` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idSewa` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `komentar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sewa`
--

CREATE TABLE `sewa` (
  `idSewa` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idIphone` int(11) DEFAULT NULL,
  `tglMulai` date NOT NULL,
  `tglSelesai` date NOT NULL,
  `totalHarga` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','rejected','returned') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sewa`
--

INSERT INTO `sewa` (`idSewa`, `idUser`, `idIphone`, `tglMulai`, `tglSelesai`, `totalHarga`, `status`, `created_at`) VALUES
(1, 4, 2, '2000-02-11', '2000-03-01', 5320000.00, 'pending', '2025-05-16 13:09:36'),
(2, 4, 1, '2011-11-11', '2012-11-11', 99999999.99, 'pending', '2025-05-16 16:19:05'),
(3, 4, 1, '2011-11-11', '2012-11-11', 99999999.99, 'pending', '2025-05-16 16:23:05'),
(4, 4, 3, '2025-05-01', '2025-05-16', 3300000.00, 'pending', '2025-05-16 16:44:12'),
(5, 3, 2, '2025-05-04', '2025-05-05', 280000.00, 'pending', '2025-05-17 13:43:31'),
(6, 0, 1, '2025-05-04', '2025-05-29', 8750000.00, 'pending', '2025-05-19 11:05:36'),
(7, 0, 1, '2025-05-01', '2025-05-02', 350000.00, 'pending', '2025-05-19 12:36:46'),
(8, 0, 1, '2025-05-02', '2025-05-31', 10150000.00, 'pending', '2025-05-19 12:47:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `alamat`, `username`, `password`, `phone`, `created_at`) VALUES
(1, '', '', 'asep', '$2y$10$Xg4yoHqzyPgiv.P/MaLaQujvaI/FMrz7EyzcUuuCqdMdYTt9/.etW', '', '2025-05-14 15:48:02'),
(2, '', '', 'alvina', '$2y$10$.zOX/AG9i2sRH1A9vILJVOOaQ6hEZ18zeU8z1tH2fKkJnTl1GZEnC', '', '2025-05-15 15:39:30'),
(3, '', '', 'ilham', '$2y$10$MCJTfXYPFtszA9VN4mK8tuzQLOJop5KpmZTrFn8CEcsocxPdbyDfG', '', '2025-05-15 17:52:25'),
(4, '', '', 'ee', '$2y$10$b2aNEIQmDA82B8RNzH9CRuDEhVYz0dXfgjh5.qQDun8.z1xFlfgna', '', '2025-05-16 12:35:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `iphones`
--
ALTER TABLE `iphones`
  ADD PRIMARY KEY (`idIphone`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idPayment`),
  ADD KEY `idSewa` (`idSewa`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idReview`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idSewa` (`idSewa`);

--
-- Indeks untuk tabel `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`idSewa`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idIphone` (`idIphone`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `iphones`
--
ALTER TABLE `iphones`
  MODIFY `idIphone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `idPayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review`
  MODIFY `idReview` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sewa`
--
ALTER TABLE `sewa`
  MODIFY `idSewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`idSewa`) REFERENCES `sewa` (`idSewa`);

--
-- Ketidakleluasaan untuk tabel `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`idSewa`) REFERENCES `sewa` (`idSewa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
