-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 12:39 AM
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
-- Database: `2023-ppdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ayah`
--

CREATE TABLE `tbl_ayah` (
  `id` int(11) NOT NULL,
  `no_pendaftaran` varchar(10) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `tmp_lahir_ayah` varchar(50) NOT NULL,
  `tgl_lahir_ayah` date NOT NULL,
  `agama_ayah` varchar(20) NOT NULL,
  `warganegara_ayah` varchar(20) NOT NULL,
  `no_telp_ayah` varchar(15) NOT NULL,
  `alamat_ayah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ayah`
--

INSERT INTO `tbl_ayah` (`id`, `no_pendaftaran`, `nama_ayah`, `tmp_lahir_ayah`, `tgl_lahir_ayah`, `agama_ayah`, `warganegara_ayah`, `no_telp_ayah`, `alamat_ayah`) VALUES
(1, '2023110001', 'Dihari', 'Pekalongan', '2023-11-20', 'Islam', 'Indonesia', '-', 'Pekalongan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calon_siswa`
--

CREATE TABLE `tbl_calon_siswa` (
  `no_pendaftaran` varchar(10) NOT NULL,
  `tahun_pendaftaran` year(4) NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `sekolah_asal` int(11) NOT NULL,
  `jalur` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_calon_siswa`
--

INSERT INTO `tbl_calon_siswa` (`no_pendaftaran`, `tahun_pendaftaran`, `nisn`, `nama_lengkap`, `tmp_lahir`, `tgl_lahir`, `jk_kelamin`, `agama`, `alamat`, `sekolah_asal`, `jalur`, `status`, `keterangan`) VALUES
('2023110001', '2023', '1234567810', 'Jaenudin', 'Pekalongan', '2023-11-20', 'Laki - Laki', 'Islam', 'Tangerang', 1, 'Reguler', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_filescan`
--

CREATE TABLE `tbl_filescan` (
  `id` int(11) NOT NULL,
  `no_pendaftaran` varchar(10) NOT NULL,
  `filescan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ibu`
--

CREATE TABLE `tbl_ibu` (
  `id` int(11) NOT NULL,
  `no_pendaftaran` varchar(10) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `tmp_lahir_ibu` varchar(50) NOT NULL,
  `tgl_lahir_ibu` date NOT NULL,
  `agama_ibu` varchar(20) NOT NULL,
  `warganegara_ibu` varchar(20) NOT NULL,
  `no_telp_ibu` varchar(15) NOT NULL,
  `alamat_ibu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ibu`
--

INSERT INTO `tbl_ibu` (`id`, `no_pendaftaran`, `nama_ibu`, `tmp_lahir_ibu`, `tgl_lahir_ibu`, `agama_ibu`, `warganegara_ibu`, `no_telp_ibu`, `alamat_ibu`) VALUES
(1, '2023110001', 'Katijah', 'Pekalongan', '2023-11-20', 'Islam', 'Indonesia', '-', 'Pekalongan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id` int(11) NOT NULL,
  `id_file` int(11) NOT NULL,
  `mapel` varchar(20) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `kelas` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `verifikasi` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sekolah_asal`
--

CREATE TABLE `tbl_sekolah_asal` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(50) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sekolah_asal`
--

INSERT INTO `tbl_sekolah_asal` (`id`, `nama_sekolah`, `kota`, `alamat`) VALUES
(1, 'SMPN1 Tangerang', 'Tangerang', 'Jl. Raya Tangerang'),
(2, 'SMPN2 Tangerang', 'Tangerang', 'Jl. Raya 2 Tangerang'),
(3, 'SMPN3 Tangerang', 'Tangerang', 'Jl. Raya 3 Tangerang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama_lengkap`, `username`, `password`, `level`, `foto`) VALUES
(1, 'Administrator', 'administrator', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'Administrator', 'male.jpg'),
(2, 'Fitriyani', 'fitriyani', '032bedb15e572337322df077a1f5976b', 'Staff', 'default1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_ayah`
--
ALTER TABLE `tbl_ayah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_calon_siswa`
--
ALTER TABLE `tbl_calon_siswa`
  ADD PRIMARY KEY (`no_pendaftaran`);

--
-- Indexes for table `tbl_filescan`
--
ALTER TABLE `tbl_filescan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ibu`
--
ALTER TABLE `tbl_ibu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sekolah_asal`
--
ALTER TABLE `tbl_sekolah_asal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_ayah`
--
ALTER TABLE `tbl_ayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_filescan`
--
ALTER TABLE `tbl_filescan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ibu`
--
ALTER TABLE `tbl_ibu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sekolah_asal`
--
ALTER TABLE `tbl_sekolah_asal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
