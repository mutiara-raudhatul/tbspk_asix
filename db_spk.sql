-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 12:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(10) NOT NULL,
  `nama_alternatif` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `nama_alternatif`) VALUES
(1, 'Sangkuriang Jaya Agam'),
(2, 'Talgo Agam'),
(3, 'Restu Ibu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(10) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` float NOT NULL,
  `cost_benefit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `cost_benefit`) VALUES
(1, 'Kelas Pokdakan', 25, 'Benefit'),
(2, 'Usia Pokdakan', 20, 'Benefit'),
(3, 'Luas Kolam', 15, 'Benefit'),
(4, 'Lokasi Kolam', 5, 'Benefit'),
(5, 'Jumlah Anggota Pokdakan', 10, 'Benefit'),
(6, 'Rata-Rata Produksi', 15, 'Benefit'),
(7, 'Domisili Anggota', 10, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `tb_subkriteria`
--

CREATE TABLE `tb_subkriteria` (
  `id_subkriteria` varchar(10) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `nama_subkriteria` varchar(255) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_subkriteria`
--

INSERT INTO `tb_subkriteria` (`id_subkriteria`, `id_kriteria`, `nama_subkriteria`, `nilai`) VALUES
('S101', 1, 'Kelas Pemula', 1),
('S102', 1, 'Kelas Madya', 2),
('S103', 1, 'Kelas Utama', 3),
('S201', 2, '0-1 tahun', 1),
('S202', 2, '1-3 tahun', 2),
('S203', 2, '3-5 tahun', 3),
('S204', 2, '>5 tahun', 4),
('S301', 3, '100-200 m2', 1),
('S302', 3, '200-300 m2', 2),
('S303', 3, '300-400 m2', 3),
('S304', 3, '>400 m2', 4),
('S401', 4, 'Tidak Baik', 1),
('S402', 4, 'Kurang Baik', 2),
('S403', 4, 'Baik', 3),
('S404', 4, 'Sangat Baik', 4),
('S501', 5, '5-10 orang', 1),
('S502', 5, '10-15 orang', 2),
('S503', 5, '15-20 orang', 3),
('S504', 5, '>20 orang', 4),
('S601', 6, '<7 kg/m3', 1),
('S602', 6, '7-10 kg/m3', 2),
('S603', 6, '10-15 kg/m3', 3),
('S604', 6, '>15 kg/m3', 4),
('S701', 7, 'Mayoritas anggota berdomisili di jauh dari lokasi kolam', 1),
('S702', 7, 'Mayoritas anggota berdomisili di desa/ kampung yang berbeda namun tidak terlalu jauh dengan lokasi kolam', 2),
('S703', 7, 'Mayoritas anggota berdomisili di desa/ kampung yang sama dengan lokasi kolam', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_topsis`
--

CREATE TABLE `tb_topsis` (
  `id_alternatif` int(10) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `id_subkriteria` varchar(255) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_topsis`
--

INSERT INTO `tb_topsis` (`id_alternatif`, `id_kriteria`, `id_subkriteria`, `nilai`) VALUES
(1, 1, 'S101', 1),
(1, 2, 'S203', 3),
(1, 3, 'S304', 4),
(1, 4, 'S403', 3),
(1, 5, 'S502', 2),
(1, 6, 'S603', 3),
(1, 7, 'S703', 3),
(2, 1, 'S101', 1),
(2, 2, 'S202', 2),
(2, 3, 'S304', 4),
(2, 4, 'S403', 3),
(2, 5, 'S502', 2),
(2, 6, 'S603', 3),
(2, 7, 'S703', 3),
(3, 1, 'S101', 1),
(3, 2, 'S202', 2),
(3, 3, 'S303', 3),
(3, 4, 'S403', 3),
(3, 5, 'S502', 2),
(3, 6, 'S603', 3),
(3, 7, 'S703', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tb_topsis`
--
ALTER TABLE `tb_topsis`
  ADD KEY `tb_topsis_ibfk_1` (`id_alternatif`),
  ADD KEY `tb_topsis_ibfk_2` (`id_kriteria`),
  ADD KEY `tb_topsis_ibfk_3` (`id_subkriteria`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id_alternatif` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD CONSTRAINT `tb_subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`);

--
-- Constraints for table `tb_topsis`
--
ALTER TABLE `tb_topsis`
  ADD CONSTRAINT `tb_topsis_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `tb_alternatif` (`id_alternatif`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_topsis_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_topsis_ibfk_3` FOREIGN KEY (`id_subkriteria`) REFERENCES `tb_subkriteria` (`id_subkriteria`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
