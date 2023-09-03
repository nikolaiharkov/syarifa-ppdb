-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2023 at 11:25 PM
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
-- Database: `syarifa-ppdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `idadmin` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `notelepon` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`idadmin`, `username`, `nama`, `email`, `level`, `notelepon`, `password`) VALUES
(1, 'admin', 'Administrator', 'admin@gmail.com', 1, '089612277256', '$2y$10$8MxYXSo9xw6g0LTu8AWoAevE4kzP/3CdL.3BGvowzaCcl0Msh.wma');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen`
--

CREATE TABLE `tbl_dokumen` (
  `iddokumen` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `foto_anak` varchar(255) NOT NULL,
  `akte_kelahiran` varchar(255) NOT NULL,
  `kartu_keluarga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_bms`
--

CREATE TABLE `tbl_kategori_bms` (
  `idbms` int(11) NOT NULL,
  `nama_bms` varchar(255) DEFAULT NULL,
  `detail_bms` text DEFAULT NULL,
  `total_bms` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `idpembayaran` int(11) NOT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `tgl_formulir` date NOT NULL,
  `bukti_formulir` varchar(255) DEFAULT NULL,
  `diskon_bms` int(11) DEFAULT NULL,
  `bukti_bms` varchar(255) DEFAULT NULL,
  `idpendaftar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaftar`
--

CREATE TABLE `tbl_pendaftar` (
  `idpendaftar` int(11) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `level` int(11) NOT NULL,
  `nama_pendaftar` varchar(255) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nik_ayah` varchar(20) NOT NULL,
  `tempat_lahir_ayah` varchar(100) NOT NULL,
  `tanggal_lahir_ayah` date NOT NULL,
  `pendidikan_ayah` varchar(100) NOT NULL,
  `alamat_ayah` text NOT NULL,
  `telepon_ayah` varchar(15) NOT NULL,
  `agama_ayah` varchar(50) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `alamat_kantor_ayah` varchar(255) NOT NULL,
  `gaji_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `nik_ibu` varchar(20) NOT NULL,
  `tempat_lahir_ibu` varchar(100) NOT NULL,
  `tanggal_lahir_ibu` date NOT NULL,
  `pendidikan_ibu` varchar(100) NOT NULL,
  `alamat_ibu` text NOT NULL,
  `telepon_ibu` varchar(15) NOT NULL,
  `agama_ibu` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `alamat_kantor_ibu` varchar(255) NOT NULL,
  `gaji_ibu` varchar(100) NOT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `nik_wali` varchar(20) DEFAULT NULL,
  `tempat_lahir_wali` varchar(100) DEFAULT NULL,
  `tanggal_lahir_wali` date DEFAULT NULL,
  `pendidikan_wali` varchar(100) DEFAULT NULL,
  `alamat_wali` text DEFAULT NULL,
  `telepon_wali` varchar(15) DEFAULT NULL,
  `agama_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `alamat_kantor_wali` varchar(255) DEFAULT NULL,
  `gaji_wali` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `idsiswa` int(11) NOT NULL,
  `idpendaftar` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nama_panggilan` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `asal_sekolah` varchar(255) DEFAULT NULL,
  `agama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `jarak_rumah` decimal(5,2) NOT NULL,
  `tinggal_bersama` enum('Orang Tua','Wali') NOT NULL,
  `transportasi` varchar(255) NOT NULL,
  `jumlah_saudara` int(11) DEFAULT NULL,
  `berat_badan` decimal(5,2) NOT NULL,
  `tinggi_badan` int(11) NOT NULL,
  `sakit_ringan` text DEFAULT NULL,
  `sakit_berat` text DEFAULT NULL,
  `alergi` text DEFAULT NULL,
  `kelainan_sejak_lahir` text DEFAULT NULL,
  `operasi` text DEFAULT NULL,
  `kecelakaan` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  `idbms` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  ADD PRIMARY KEY (`iddokumen`),
  ADD KEY `idsiswa` (`idsiswa`);

--
-- Indexes for table `tbl_kategori_bms`
--
ALTER TABLE `tbl_kategori_bms`
  ADD PRIMARY KEY (`idbms`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`idpembayaran`),
  ADD KEY `idsiswa` (`idsiswa`),
  ADD KEY `fk_tbl_pembayaran_tbl_pendaftar` (`idpendaftar`);

--
-- Indexes for table `tbl_pendaftar`
--
ALTER TABLE `tbl_pendaftar`
  ADD PRIMARY KEY (`idpendaftar`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`idsiswa`),
  ADD KEY `idpendaftar` (`idpendaftar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  MODIFY `iddokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_kategori_bms`
--
ALTER TABLE `tbl_kategori_bms`
  MODIFY `idbms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `idpembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pendaftar`
--
ALTER TABLE `tbl_pendaftar`
  MODIFY `idpendaftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `idsiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  ADD CONSTRAINT `tbl_dokumen_ibfk_1` FOREIGN KEY (`idsiswa`) REFERENCES `tbl_siswa` (`idsiswa`);

--
-- Constraints for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `fk_tbl_pembayaran_tbl_pendaftar` FOREIGN KEY (`idpendaftar`) REFERENCES `tbl_pendaftar` (`idpendaftar`),
  ADD CONSTRAINT `tbl_pembayaran_ibfk_1` FOREIGN KEY (`idsiswa`) REFERENCES `tbl_siswa` (`idsiswa`);

--
-- Constraints for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`idpendaftar`) REFERENCES `tbl_pendaftar` (`idpendaftar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
