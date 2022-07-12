-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 09:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_1707`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (  
    `nip` varchar(12) NOT NULL,  
    `nama` varchar(35) NOT NULL,  
    `jenis_kelamin` varchar(20) NOT NULL,  
    `alamat` varchar(15) NOT NULL,  
    `telp` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `kd_gaji` varchar(6) NOT NULL,
  `nip` varchar(12) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `gaji_pokok` int(10) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `tunj_jabatan` int(10) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`kd_gaji`),
  ADD KEY `nip` (`nip`);
  
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `nip` varchar(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `kd_gaji` varchar(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
  
  --
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tbl_pegawai` (`nip`);
