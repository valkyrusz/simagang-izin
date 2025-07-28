-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2025 at 03:09 PM
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
-- Database: `magangmhs`
--

-- --------------------------------------------------------

--
-- Table structure for table `mhsdiskominfo`
--

CREATE TABLE `mhsdiskominfo` (
  `id` int(4) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `nama` char(45) NOT NULL,
  `univ` char(40) NOT NULL,
  `prodi` char(35) NOT NULL,
  `tgl` date NOT NULL,
  `foto` varchar(25) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mhsdiskominfo`
--

INSERT INTO `mhsdiskominfo` (`id`, `nim`, `nama`, `univ`, `prodi`, `tgl`, `foto`, `ket`) VALUES
(1, 'A11.2021.00001', 'Ade Rahmano', 'Universitas UNDIP', '123', '2025-07-01', 'sun.png', 'oke \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'mhs', '0357a7592c4734a8b1e12bc48e29e9e9', 'mhs'),
(3, 'dsn', 'da532bf806defa26fdbeee5dd2e0d68f', 'dsn'),
(4, 'tu', 'b6b4ce6df035dcfaa26f3bc32fb89e6a', 'tu'),
(5, 'llg', 'b8ae57911c26ed8313cd09a33f7f43f5', 'admin'),
(7, 'A12.2016.02898', 'f8057ac11cd7a20c6bf238c4bf239c1c', 'mhs'),
(8, 'admin2', '202cb962ac59075b964b07152d234b70', 'admin'),
(9, 'Ade Nugraha', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin'),
(10, 'Ibnu Prasetyo', '81dc9bdb52d04dc20036dbd8313ed055', 'Mahas'),
(11, 'Raya Bagaskara', '202cb962ac59075b964b07152d234b70', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mhsdiskominfo`
--
ALTER TABLE `mhsdiskominfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mhsdiskominfo`
--
ALTER TABLE `mhsdiskominfo`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
