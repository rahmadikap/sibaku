-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 08:24 AM
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
-- Database: `perpusda`
--

-- --------------------------------------------------------

--
-- Table structure for table `donasi_buku`
--

CREATE TABLE `donasi_buku` (
  `id` int(5) UNSIGNED NOT NULL,
  `identitas` varchar(100) NOT NULL,
  `alamat_pendonasi` text NOT NULL,
  `nama_pendonasi` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomortelepon` varchar(20) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jumlah_eksemlar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donasi_buku`
--

INSERT INTO `donasi_buku` (`id`, `identitas`, `alamat_pendonasi`, `nama_pendonasi`, `email`, `nomortelepon`, `jumlah`, `keterangan`, `created_at`, `updated_at`, `jumlah_eksemlar`) VALUES
(1, '123455555', 'ada', 'jamal', 'jamal@gmail.com', '123456790', 10, '', '2024-09-17 21:56:36', '2024-09-17 21:56:36', 1),
(2, '1231231', 'bau', 'budi', 'budi@gmail.com', '12123131', 9, '', '2024-09-17 21:57:08', '2024-09-17 21:57:08', 3),
(3, '1232131', 'jam', 'huda', 'huda@gmail.com', '12312314', 10, '', '2024-09-17 21:58:14', '2024-09-17 21:58:14', 1),
(4, '1231312312', 'roma', 'banu', 'banu@gmail.com', '09876543211', 10, 'hai', '2024-09-22 13:36:35', '2024-09-22 13:36:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$XLiPBvQiIPihth7PCRGKbeB4NI6LgEcQ4ZBB3313QpQRK3ufvbXky', '2024-09-22 06:58:10', '2024-09-22 06:58:10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
