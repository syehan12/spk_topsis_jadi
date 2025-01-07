-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2025 at 12:56 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_ahp`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `nama`) VALUES
(19, 'Laptop Lenovo A1'),
(20, 'Laptop HP A2'),
(21, 'Laptop Axioo A3'),
(23, 'Laptop Acer A4');

-- --------------------------------------------------------

--
-- Table structure for table `ir`
--

CREATE TABLE `ir` (
  `jumlah` int NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ir`
--

INSERT INTO `ir` (`jumlah`, `nilai`) VALUES
(1, 0),
(2, 0),
(3, 0.58),
(4, 0.9),
(5, 1.12),
(6, 1.24),
(7, 1.32),
(8, 1.41),
(9, 1.45),
(10, 1.49),
(11, 1.51),
(12, 1.48),
(13, 1.56),
(14, 1.57),
(15, 1.59);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`) VALUES
(34, 'Penyimpanan'),
(33, 'Berat'),
(32, 'Display'),
(35, 'Processor'),
(36, 'Ram');

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_alternatif`
--

CREATE TABLE `perbandingan_alternatif` (
  `id` int NOT NULL,
  `alternatif1` int NOT NULL,
  `alternatif2` int NOT NULL,
  `pembanding` int NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perbandingan_alternatif`
--

INSERT INTO `perbandingan_alternatif` (`id`, `alternatif1`, `alternatif2`, `pembanding`, `nilai`) VALUES
(48, 20, 21, 34, 3),
(47, 19, 21, 34, 5),
(46, 19, 20, 34, 1),
(45, 20, 21, 33, 1),
(44, 19, 21, 33, 2),
(43, 19, 20, 33, 4),
(42, 20, 21, 32, 3),
(41, 19, 21, 32, 5),
(40, 19, 20, 32, 1),
(49, 19, 23, 32, 3),
(50, 20, 23, 32, 1),
(51, 21, 23, 32, 1),
(52, 19, 23, 33, 9),
(53, 20, 23, 33, 7),
(54, 21, 23, 33, 5),
(55, 19, 23, 34, 7),
(56, 20, 23, 34, 5),
(57, 21, 23, 34, 3),
(58, 19, 20, 35, 5),
(59, 19, 21, 35, 6),
(60, 19, 23, 35, 9),
(61, 20, 21, 35, 3),
(62, 20, 23, 35, 5),
(63, 21, 23, 35, 2),
(64, 19, 20, 36, 3),
(65, 19, 21, 36, 6),
(66, 19, 23, 36, 7),
(67, 20, 21, 36, 3),
(68, 20, 23, 36, 5),
(69, 21, 23, 36, 2);

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_kriteria`
--

CREATE TABLE `perbandingan_kriteria` (
  `id` int NOT NULL,
  `kriteria1` int NOT NULL,
  `kriteria2` int NOT NULL,
  `nilai` float NOT NULL,
  `per` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perbandingan_kriteria`
--

INSERT INTO `perbandingan_kriteria` (`id`, `kriteria1`, `kriteria2`, `nilai`, `per`) VALUES
(15, 33, 34, 0.235702, 4.24264),
(14, 32, 34, 0.22771, 4.39155),
(13, 32, 33, 5.19615, 0.19245),
(16, 32, 35, 0.0251976, 39.6863),
(17, 33, 35, 0.020367, 147.297),
(18, 34, 35, 0.22771, 9.81981),
(19, 32, 36, 0.075593, 13.2288),
(20, 33, 36, 0.011759, 147.297),
(21, 34, 36, 0.105409, 16.4317),
(22, 35, 36, 1.29099, 0.774597);

-- --------------------------------------------------------

--
-- Table structure for table `pv_alternatif`
--

CREATE TABLE `pv_alternatif` (
  `id` int NOT NULL,
  `id_alternatif` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pv_alternatif`
--

INSERT INTO `pv_alternatif` (`id`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(63, 20, 34, 0.363874),
(62, 19, 34, 0.448695),
(61, 21, 33, 0.224204),
(64, 21, 34, 0.127897),
(60, 20, 33, 0.213349),
(59, 19, 33, 0.518439),
(58, 21, 32, 0.111404),
(57, 20, 32, 0.290351),
(56, 19, 32, 0.423684),
(65, 23, 32, 0.174561),
(66, 23, 33, 0.0440077),
(67, 23, 34, 0.0595343),
(68, 19, 35, 0.63571),
(69, 20, 35, 0.217058),
(70, 21, 35, 0.0941719),
(71, 23, 35, 0.0530607),
(72, 19, 36, 0.577139),
(73, 20, 36, 0.260634),
(74, 21, 36, 0.100888),
(75, 23, 36, 0.06134);

-- --------------------------------------------------------

--
-- Table structure for table `pv_kriteria`
--

CREATE TABLE `pv_kriteria` (
  `id_kriteria` int NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pv_kriteria`
--

INSERT INTO `pv_kriteria` (`id_kriteria`, `nilai`) VALUES
(34, 0.0557388),
(33, 0.00595049),
(32, 0.0170169),
(35, 0.50474),
(36, 0.416554);

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `id_alternatif` int NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`id_alternatif`, `nilai`) VALUES
(19, 0.596945),
(20, 0.244441),
(21, 0.0998461),
(23, 0.0587684);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ir`
--
ALTER TABLE `ir`
  ADD PRIMARY KEY (`jumlah`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perbandingan_alternatif`
--
ALTER TABLE `perbandingan_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pv_alternatif`
--
ALTER TABLE `pv_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pv_kriteria`
--
ALTER TABLE `pv_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `perbandingan_alternatif`
--
ALTER TABLE `perbandingan_alternatif`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pv_alternatif`
--
ALTER TABLE `pv_alternatif`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
