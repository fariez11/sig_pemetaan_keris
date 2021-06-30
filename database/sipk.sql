-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 Nov 2019 pada 00.03
-- Versi Server: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akuns`
--

CREATE TABLE `akuns` (
  `AKUN_ID` int(11) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `NAMA` varchar(30) NOT NULL,
  `LEVEL` int(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akuns`
--

INSERT INTO `akuns` (`AKUN_ID`, `USERNAME`, `PASSWORD`, `NAMA`, `LEVEL`, `updated_at`, `created_at`) VALUES
(1, 'admin', 'admin', 'Administrator', 0, '2019-11-20 10:48:01', '0000-00-00 00:00:00'),
(2, 'fajar', 'fajar', 'Fajar Immamulya', 1, '2019-11-21 01:55:05', '2019-11-20 05:22:17'),
(3, 'sai', 'sai', 'SAI IN AHMAD', 1, '2019-11-21 23:29:57', '2019-11-20 19:12:37'),
(4, 'farhan', 'farhan', 'Farhan', 1, '2019-11-22 05:23:15', '2019-11-22 05:23:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `det_keris`
--

CREATE TABLE `det_keris` (
  `DETAIL_ID` int(11) NOT NULL,
  `PEMILIK_ID` int(11) NOT NULL,
  `JENIS` varchar(20) NOT NULL,
  `ALAMAT` varchar(30) NOT NULL,
  `FOTO` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `det_keris`
--

INSERT INTO `det_keris` (`DETAIL_ID`, `PEMILIK_ID`, `JENIS`, `ALAMAT`, `FOTO`, `updated_at`, `created_at`) VALUES
(1, 3, 'AGEMAN', 'jl.bedrek no 123', 'cam.png', '2019-11-20 19:26:20', '2019-11-20 19:26:20'),
(3, 4, 'TAYUHAN', 'jl.manggar no 123', 'supo.jpeg', '2019-11-22 22:53:34', '2019-11-22 15:33:48'),
(4, 2, 'TAYUHAN', 'jl.santai no 123', 'gold-brush-stroke_53876-76976.jpg', '2019-11-23 00:31:14', '2019-11-22 15:59:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keris`
--

CREATE TABLE `keris` (
  `KERIS_ID` int(11) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `KECAMATAN` varchar(50) DEFAULT NULL,
  `LATITUDE` double NOT NULL,
  `LONGITUDE` double NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keris`
--

INSERT INTO `keris` (`KERIS_ID`, `NAMA`, `KECAMATAN`, `LATITUDE`, `LONGITUDE`, `updated_at`, `created_at`) VALUES
(1, 'KERIS PUSAKA', 'BEDREK', -7.790926351582149, 112.08084891875001, '2019-11-20 19:26:19', '2019-11-20 19:26:19'),
(3, 'KERIS SUPO GATI', 'BLITAR', -7.7871846447004, 112.07947562773, '2019-11-22 22:45:13', '2019-11-22 15:33:48'),
(4, 'KERIS MPU GANDRING', 'SANTREN', -7.7558890619664, 112.080505596, '2019-11-23 00:31:13', '2019-11-22 15:59:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemiliks`
--

CREATE TABLE `pemiliks` (
  `PEMILIK_ID` int(11) NOT NULL,
  `AKUN_ID` int(11) DEFAULT NULL,
  `NAMA_LENGKAP` varchar(30) DEFAULT NULL,
  `GENDER` varchar(1) DEFAULT NULL,
  `NO_TELP` bigint(16) DEFAULT NULL,
  `EMAIL` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemiliks`
--

INSERT INTO `pemiliks` (`PEMILIK_ID`, `AKUN_ID`, `NAMA_LENGKAP`, `GENDER`, `NO_TELP`, `EMAIL`, `updated_at`, `created_at`) VALUES
(1, 1, 'Administrator', 'L', 987328519874514, 'admin@admin.com', '2019-11-20 11:08:06', '0000-00-00 00:00:00'),
(2, 2, 'FAJAR IMMAMULYA', 'L', 1234567890123456, 'fajar@gmail.com', '2019-11-21 01:55:05', '2019-11-20 05:22:17'),
(3, 3, 'SAI IN AHMAD', 'L', 1984305913746897, 'sai@gmail.com', '2019-11-21 23:29:57', '2019-11-20 19:12:37'),
(4, 4, 'FARHAN', 'L', 9187435872157862, 'farhan', '2019-11-22 05:23:15', '2019-11-22 05:23:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akuns`
--
ALTER TABLE `akuns`
  ADD PRIMARY KEY (`AKUN_ID`);

--
-- Indexes for table `det_keris`
--
ALTER TABLE `det_keris`
  ADD PRIMARY KEY (`DETAIL_ID`);

--
-- Indexes for table `keris`
--
ALTER TABLE `keris`
  ADD PRIMARY KEY (`KERIS_ID`),
  ADD UNIQUE KEY `PUSKESMAS_PK` (`KERIS_ID`);

--
-- Indexes for table `pemiliks`
--
ALTER TABLE `pemiliks`
  ADD PRIMARY KEY (`PEMILIK_ID`),
  ADD UNIQUE KEY `PETUGAS_PK` (`PEMILIK_ID`),
  ADD KEY `RELATIONSHIP_6_FK` (`AKUN_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akuns`
--
ALTER TABLE `akuns`
  MODIFY `AKUN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `det_keris`
--
ALTER TABLE `det_keris`
  ADD CONSTRAINT `det_keris_ibfk_1` FOREIGN KEY (`DETAIL_ID`) REFERENCES `keris` (`KERIS_ID`);

--
-- Ketidakleluasaan untuk tabel `pemiliks`
--
ALTER TABLE `pemiliks`
  ADD CONSTRAINT `pemiliks_ibfk_1` FOREIGN KEY (`AKUN_ID`) REFERENCES `akuns` (`AKUN_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
