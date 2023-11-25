-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 07:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`nama`, `email`, `username`, `password`) VALUES
('ALIF AKBAR HILMY AULIYA', 'alif@gmail.com', 'alif', '1234'),
('Harold Matthew P', 'harold@student', 'Obb777', '1111'),
('ALIF', '111@gmail.com', 'alif2', '1234'),
('aliff', 'alifa11@gmail.com', 'akbar', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `icon` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`icon`, `nama`, `kategori`, `deskripsi`) VALUES
('minecraft.jpg', 'Minecraft', '| Adventure |', 'game kreativitas'),
('among-us.jpg', 'AmongUs', '| RPG |', 'game space'),
('ghost-hunt.jpg', 'The Midnight Ghost Hunt', '| Action | RPG |', 'game berburu hantu'),
('Death-Stranding.jpg', 'Death Stranding', '| Action | Adventure |', 'game mengirimkan paket di planet lain'),
('zelda.jpg', 'Zelda', '| Action | Adventure | RPG |', 'Game petualangan yang seru'),
('digimonw.jpg', 'Digimon', '| Action | Adventure |', 'Game monster digital'),
('images.jpeg', 'Cyberpunk', '| Action | Adventure | RPG |', 'Game bernuansa masa depan'),
('pb.jpg', 'Point Blank', '| Action | RPG |', 'game shooter'),
('image 2.png', 'Spiderman', '| Action | Adventure |', 'Game marvel spiderman');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
