-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 11:19 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kopi`
--

-- --------------------------------------------------------

--
-- Table structure for table `biji`
--

CREATE TABLE `biji` (
  `id_biji` int(11) NOT NULL,
  `nama_biji` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biji`
--

INSERT INTO `biji` (`id_biji`, `nama_biji`) VALUES
(5, 'Arabica'),
(6, 'Robusta'),
(7, 'American Blend'),
(8, 'Luwak'),
(9, 'Gayo Beans'),
(10, 'Dieng Beans');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(7, 'Latte'),
(8, 'Artificial Coffee'),
(9, 'Espresso Based'),
(10, 'Cold Brew'),
(12, 'Manual Brew');

-- --------------------------------------------------------

--
-- Table structure for table `kopi`
--

CREATE TABLE `kopi` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_biji` int(11) NOT NULL,
  `image` varchar(55) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kopi`
--

INSERT INTO `kopi` (`id`, `nama`, `id_jenis`, `id_biji`, `image`, `deskripsi`) VALUES
(16, 'Kopi Milo', 7, 7, 'kopimilo.jpg', 'Ini sering dijual di wilayah dipatiukur'),
(17, 'Java Koffee', 10, 10, 'javakoffe.png', 'Kopi ini cocok untuk kamu yang menyukai java'),
(18, 'Kopi Hadoop Cluster', 8, 5, 'OIP (9).jpg', 'Rasanya pahit karna liburan di ambil Big Data');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biji`
--
ALTER TABLE `biji`
  ADD PRIMARY KEY (`id_biji`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kopi`
--
ALTER TABLE `kopi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_biji` (`id_biji`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biji`
--
ALTER TABLE `biji`
  MODIFY `id_biji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kopi`
--
ALTER TABLE `kopi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kopi`
--
ALTER TABLE `kopi`
  ADD CONSTRAINT `kopi_ibfk_1` FOREIGN KEY (`id_biji`) REFERENCES `biji` (`id_biji`),
  ADD CONSTRAINT `kopi_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
