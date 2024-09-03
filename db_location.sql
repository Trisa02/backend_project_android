-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 05:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_location`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_location`
--

CREATE TABLE `tb_location` (
  `id` int(11) NOT NULL,
  `longitude` varchar(25) NOT NULL,
  `latitude` varchar(25) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `tb_location`
--

INSERT INTO `tb_location` (`id`, `longitude`, `latitude`, `address`) VALUES
(71, '106.8130799', '-6.2170501', ''),
(72, '106.8122548', '-6.2128783', ''),
(73, '106.8122599', '-6.2128819', ''),
(74, '106.8133229', '-6.2122879', ''),
(75, '106.8122796', '-6.2128657', ''),
(76, '106.8122852', '-6.2128672', ''),
(77, '106.8122782', '-6.2128706', ''),
(78, '106.8122759', '-6.2128768', ''),
(79, '106.8122748', '-6.2128772', ''),
(80, '106.8122801', '-6.212862', ''),
(81, '106.8122666', '-6.2128647', ''),
(82, '106.8122629', '-6.2128701', ''),
(83, '106.8122754', '-6.21287', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `full_name` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id`, `full_name`, `email`, `username`, `password`) VALUES
(25, 'Test Trisa2', 'trisasarifatulanisa@gmail.com', 'test_trisa2', '$2y$10$SHcaMD05Dt8WTpXV/DfehezQnv48s7SPO.4UNGSQkaVRFj4.x4ti.'),
(26, 'Trisa Sarifatul Anisak', 'trisasarifatulanisa@gmail.com', 'trisa_s.f.a', '$2y$10$mdiehDVzS.7f6ycTXNniMOaSX.MXcVDY/gk.U4AehZyNUbTOr70zO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_location`
--
ALTER TABLE `tb_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_location`
--
ALTER TABLE `tb_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
