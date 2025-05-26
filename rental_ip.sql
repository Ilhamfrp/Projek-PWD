-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 08:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `iphones`
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
-- Dumping data for table `iphones`
--

INSERT INTO `iphones` (`idIphone`, `nama`, `model`, `warna`, `storage`, `hargaPerHari`, `stok`, `gambar`) VALUES
(1, 'iPhone 14 Pro Max', 'Pro Max', 'Space Black', '256GB', 350000.00, 4, 'iphone14promax.jpg'),
(2, 'iPhone 13', 'Standard', 'Blue', '128GB', 280000.00, 7, 'iphone13.jpg'),
(3, 'iPhone 12', 'Standard', 'White', '64GB', 220000.00, 3, 'iphone12.jpg'),
(4, 'iPhone 11', 'Standard', 'Red', '128GB', 200000.00, 5, 'iphone11.jpg'),
(5, 'iPhone 16', 'Pro', 'Titan Gray', '512GB', 400000.00, 0, 'iphone16.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
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
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`idPayment`, `idSewa`, `tanggalBayar`, `jumlah`, `metode`, `status`) VALUES
(1, 2, '2025-05-16', 99999999.99, 'COD', 'pending'),
(2, 3, '2025-05-16', 99999999.99, 'Transfer Bank', 'pending'),
(3, 3, '2025-05-16', 99999999.99, 'Transfer Bank', 'pending'),
(4, 4, '2025-05-16', 3300000.00, 'Transfer Bank', 'pending'),
(5, 5, '2025-05-17', 280000.00, 'Transfer Bank', 'pending'),
(6, 6, '2025-05-19', 8750000.00, 'Transfer Bank', 'pending'),
(7, 7, '2025-05-19', 350000.00, 'Transfer Bank', 'pending'),
(8, 8, '2025-05-19', 10150000.00, 'COD', 'pending'),
(9, 9, '2025-05-19', 400000.00, 'Transfer Bank', 'pending'),
(10, 11, '2025-05-19', 400000.00, 'Transfer Bank', 'pending'),
(11, 12, '2025-05-24', 280000.00, 'Transfer Bank', 'paid'),
(12, 13, '2025-05-24', 1400000.00, 'COD', 'pending'),
(13, 14, '2025-05-24', 1200000.00, 'Transfer Bank', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `review`
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
-- Table structure for table `sewa`
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
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`idSewa`, `idUser`, `idIphone`, `tglMulai`, `tglSelesai`, `totalHarga`, `status`, `created_at`) VALUES
(1, 4, 2, '2000-02-11', '2000-03-01', 5320000.00, 'pending', '2025-05-16 13:09:36'),
(2, 4, 1, '2011-11-11', '2012-11-11', 99999999.99, 'pending', '2025-05-16 16:19:05'),
(3, 4, 1, '2011-11-11', '2012-11-11', 99999999.99, 'pending', '2025-05-16 16:23:05'),
(4, 4, 3, '2025-05-01', '2025-05-16', 3300000.00, 'pending', '2025-05-16 16:44:12'),
(5, 3, 2, '2025-05-04', '2025-05-05', 280000.00, 'pending', '2025-05-17 13:43:31'),
(6, 0, 1, '2025-05-04', '2025-05-29', 8750000.00, 'pending', '2025-05-19 11:05:36'),
(7, 0, 1, '2025-05-01', '2025-05-02', 350000.00, 'pending', '2025-05-19 12:36:46'),
(8, 0, 1, '2025-05-02', '2025-05-31', 10150000.00, 'pending', '2025-05-19 12:47:46'),
(9, 5, 5, '2025-05-20', '2025-05-21', 400000.00, 'pending', '2025-05-19 14:22:33'),
(10, 7, 4, '2025-05-20', '2025-05-21', 200000.00, 'pending', '2025-05-19 15:33:45'),
(11, 7, 4, '2025-05-20', '2025-05-22', 400000.00, 'rejected', '2025-05-19 15:36:23'),
(12, 8, 2, '2025-05-25', '2025-05-26', 280000.00, 'returned', '2025-05-24 13:11:39'),
(13, 9, 1, '2025-05-24', '2025-05-28', 1400000.00, 'approved', '2025-05-24 14:10:29'),
(14, 9, 5, '2025-05-24', '2025-05-27', 1200000.00, 'approved', '2025-05-24 14:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `alamat`, `username`, `password`, `phone`, `created_at`, `role`) VALUES
(1, '', '', 'asep', '$2y$10$Xg4yoHqzyPgiv.P/MaLaQujvaI/FMrz7EyzcUuuCqdMdYTt9/.etW', '', '2025-05-14 15:48:02', 'user'),
(2, '', '', 'alvina', '$2y$10$.zOX/AG9i2sRH1A9vILJVOOaQ6hEZ18zeU8z1tH2fKkJnTl1GZEnC', '', '2025-05-15 15:39:30', 'user'),
(3, '', '', 'ilham', '$2y$10$MCJTfXYPFtszA9VN4mK8tuzQLOJop5KpmZTrFn8CEcsocxPdbyDfG', '', '2025-05-15 17:52:25', 'user'),
(4, '', '', 'ee', '$2y$10$b2aNEIQmDA82B8RNzH9CRuDEhVYz0dXfgjh5.qQDun8.z1xFlfgna', '', '2025-05-16 12:35:56', 'user'),
(5, '', '', 'vinsky', '$2y$10$VaBYMldMTNhdDQC7WBW.y.wwIB278Jk3zvzSXPr3H.VmSn6i/4zbK', '', '2025-05-19 14:18:10', 'user'),
(6, '', '', 'vinabudi', '$2y$10$YOHPR5D5knB5VgYcLOzH7ueazz4am82gYxGY6Z7rPFhAGphEcPP9K', '', '2025-05-19 15:07:15', 'user'),
(7, 'Tara', 'Kotagede', 'vinabuds', '$2y$10$eTc6dvAjxMGO2yONJbEiDuXTDnOOPU2iFbP1eHAnRj7UjIBA3gOCS', '', '2025-05-19 15:09:22', 'user'),
(8, 'Vina', 'Kotagede', 'vina', '$2y$10$q65E/YQ4yhbp.EZgx/9ZV.E1wSYNvL1R4EoI/gitSKd2PbLSc1.K.', '', '2025-05-24 13:08:51', 'admin'),
(9, 'Tara', '', 'tara', '$2y$10$AiYPV4do51ywqIThYoCoFOTsdvnKfksM9pnRIIGOTsHnsTXF.eXFO', '', '2025-05-24 14:09:54', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iphones`
--
ALTER TABLE `iphones`
  ADD PRIMARY KEY (`idIphone`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idPayment`),
  ADD KEY `idSewa` (`idSewa`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idReview`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idSewa` (`idSewa`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`idSewa`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idIphone` (`idIphone`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iphones`
--
ALTER TABLE `iphones`
  MODIFY `idIphone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `idPayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `idReview` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `idSewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`idSewa`) REFERENCES `sewa` (`idSewa`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`idSewa`) REFERENCES `sewa` (`idSewa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
