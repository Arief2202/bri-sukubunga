-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 06:45 AM
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
-- Database: `britv`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(255) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `playlist_id` varchar(255) NOT NULL,
  `running_text` longtext DEFAULT NULL,
  `enable_ajax_ip` tinyint(1) NOT NULL DEFAULT 0,
  `enable_sync` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `video_id`, `playlist_id`, `running_text`, `enable_ajax_ip`, `enable_sync`) VALUES
(1, '5QLF3pfZv5Q', 'list=PLC6gYrTu9CFpDDQCUn1UKkLlgKFXBMk31', 'KANTOR CABANG BRI PARE KEDIRI', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kurs`
--

CREATE TABLE `kurs` (
  `id` int(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `value` double NOT NULL,
  `buy` double NOT NULL,
  `sell` double NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurs`
--

INSERT INTO `kurs` (`id`, `flag`, `currency`, `value`, `buy`, `sell`, `timestamp`) VALUES
(1, 'SAR.png', 'SAR', 1, 4172.59, 4172.59, '2024-11-05 07:05:27'),
(2, 'JPY.png', 'JPY', 100, 10403.36, 10296.47, '2024-11-05 07:06:53'),
(3, 'HKD.png', 'HKD', 1, 2036.43, 2016.09, '2024-11-05 07:07:52'),
(4, 'SGD.png', 'SGD', 1, 12005.88, 11885.52, '2024-11-05 07:09:04'),
(5, 'GBP.png', 'GBP', 1, 20531.19, 20325.34, '2024-11-05 07:09:40'),
(6, 'USD.png', 'USD', 1, 15829.75, 15672.25, '2024-11-05 07:10:17'),
(7, 'MYR.png', 'MYR', 1, 3621.54, 3581.41, '2024-11-05 07:12:13'),
(8, 'KRW.png', 'KRW', 1000, 11530.01, 11410.01, '2024-11-05 07:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `suku_bunga`
--

CREATE TABLE `suku_bunga` (
  `id` int(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suku_bunga`
--

INSERT INTO `suku_bunga` (`id`, `section`, `label`, `value`) VALUES
(1, 'deposito', '1 Bulan', '12,0 %'),
(2, 'deposito', '3 Bulan', '20,0 %'),
(3, 'deposito', '6 Bulan', '30,0 %'),
(4, 'deposito', '12 Bulan', '40,0 %'),
(5, 'deposito', '24 Bulan', '50,0 %'),
(6, 'britama', '0 S/D 1 JUTA', '14,0 %'),
(7, 'britama', '> 1 JUTA S/D 50 JUTA', '14,52 %'),
(8, 'britama', '> 50 JUTA S/D < 500 JUTA', '30,0 %'),
(9, 'britama', '> 500 JUTA S/D 1 MILYAR', '40,0 %'),
(10, 'britama', '>1 MILYAR', '50,0 %'),
(11, 'simpedes', '0 S/D 1 JUTA', '10,0 %'),
(12, 'simpedes', '> 1 JUTA S/D 50 JUTA', '20,0 %'),
(13, 'simpedes', '> 50 JUTA S/D < 500 JUTA', '30,0 %'),
(14, 'simpedes', '> 500 JUTA S/D 1 MILYAR', '40,0 %'),
(15, 'simpedes', '>1 MILYAR', '50,0 %');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kurs`
--
ALTER TABLE `kurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suku_bunga`
--
ALTER TABLE `suku_bunga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kurs`
--
ALTER TABLE `kurs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suku_bunga`
--
ALTER TABLE `suku_bunga`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
