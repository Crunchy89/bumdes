-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2020 at 07:56 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumdes`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status` varchar(11) NOT NULL,
  `pekerjaan` varchar(20) NOT NULL,
  `alamat` tinytext NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `tempat` varchar(20) NOT NULL,
  `lahir` date NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nik`, `nama`, `jk`, `agama`, `status`, `pekerjaan`, `alamat`, `no_hp`, `tempat`, `lahir`, `gambar`) VALUES
(2, '520207163133', 'm rodik artawan', 'L', 'islam', 'Kawin', 'Swasta', 'pendem', '08786427038', 'puyung', '1997-09-26', '8.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id_angsuran` int(11) NOT NULL,
  `petugas` varchar(20) NOT NULL,
  `besar_angsuran` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `tgl_setor` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `angsuran_ke` varchar(10) NOT NULL,
  `ket` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id_angsuran`, `petugas`, `besar_angsuran`, `id_pinjaman`, `tgl_setor`, `angsuran_ke`, `ket`) VALUES
(1, 'Maman', 101500, 5, '2020-02-18 00:45:51', '1', '-'),
(2, 'Maman', 203000, 5, '2020-02-18 01:00:30', '2-3', '-');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `level`) VALUES
(1, 'Admin'),
(2, 'Ketua'),
(3, 'Member'),
(4, 'Petugas');

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `petugas` varchar(20) NOT NULL,
  `besar_penarikan` int(11) NOT NULL,
  `tanggal_penarikan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ket` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penarikan`
--

INSERT INTO `penarikan` (`id_penarikan`, `id_anggota`, `petugas`, `besar_penarikan`, `tanggal_penarikan`, `ket`) VALUES
(1, 2, 'Maman', 100000, '2020-02-18 04:45:52', '-'),
(2, 2, 'Maman', 50000, '2020-02-18 05:33:23', '');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `petugas` varchar(20) NOT NULL,
  `besar_pinjaman` int(11) NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `tgl_pelunasan` date NOT NULL,
  `total_pinjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `id_anggota`, `petugas`, `besar_pinjaman`, `tgl_pinjaman`, `tgl_pelunasan`, `total_pinjaman`) VALUES
(5, 2, 'Maman', 1000000, '2020-02-17', '2020-12-17', 1015000);

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `petugas` varchar(20) NOT NULL,
  `tanggal_simpanan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `besar_simpanan` int(11) NOT NULL,
  `ket` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `id_anggota`, `petugas`, `tanggal_simpanan`, `besar_simpanan`, `ket`) VALUES
(1, 2, 'Maman', '2020-02-17 11:20:03', 100000, '-'),
(2, 2, 'Maman', '2020-02-17 11:52:05', 500000, '-'),
(3, 2, 'Maman', '2020-02-17 12:51:32', 50000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_level`, `id_login`, `status`) VALUES
(2, 'admin', 'admin', 1, 0, 1),
(3, 'rodi', 'rodi', 2, 0, 1),
(4, 'odik', 'odik', 3, 2, 1),
(7, 'Maman', 'maman', 4, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id_angsuran`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id_penarikan`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id_simpanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
