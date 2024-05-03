-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 09:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codicipostali`
--

-- --------------------------------------------------------

--
-- Table structure for table `codicipostali`
--

CREATE TABLE `codicipostali` (
  `id` int(11) NOT NULL,
  `CodicePostale` varchar(10) NOT NULL,
  `Comune` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codicipostali`
--

INSERT INTO `codicipostali` (`id`, `CodicePostale`, `Comune`) VALUES
(1, '00100', 'Roma'),
(2, '10121', 'Torino'),
(3, '20121', 'Milano'),
(4, '50121', 'Firenze'),
(5, '80121', 'Napoli'),
(6, '90139', 'Palermo'),
(7, '16121', 'Genova'),
(8, '48121', 'Ravenna'),
(9, '39100', 'Bolzano'),
(10, '36100', 'Vicenza'),
(11, '31100', 'Treviso'),
(12, '35121', 'Padova'),
(13, '44121', 'Ferrara'),
(15, '42123', 'Reggio Emilia'),
(16, 'gf', 'gf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codicipostali`
--
ALTER TABLE `codicipostali`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codicipostali`
--
ALTER TABLE `codicipostali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
