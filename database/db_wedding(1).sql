-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2022 at 10:25 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_wedding`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE IF NOT EXISTS `bobot` (
  `id_bobot` varchar(11) NOT NULL,
  `id_kriteria` varchar(11) NOT NULL,
  `bobot` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `id_kriteria`, `bobot`) VALUES
('BOBT.000001', 'KRIT.000005', '0.30'),
('BOBT.000002', 'KRIT.000004', '0.20'),
('BOBT.000003', 'KRIT.000001', '0.25'),
('BOBT.000004', 'KRIT.000002', '0.15'),
('BOBT.000005', 'KRIT.000003', '0.10');

-- --------------------------------------------------------

--
-- Table structure for table `detail_paket`
--

CREATE TABLE IF NOT EXISTS `detail_paket` (
  `id_detail` varchar(11) NOT NULL,
  `id_paket` varchar(11) NOT NULL,
  `id_produk` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_paket`
--

INSERT INTO `detail_paket` (`id_detail`, `id_paket`, `id_produk`) VALUES
('DPKT.000004', 'PAKT.000001', 'PROD.000001'),
('DPKT.000005', 'PAKT.000001', 'PROD.000010'),
('DPKT.000006', 'PAKT.000001', 'PROD.000014'),
('DPKT.000007', 'PAKT.000001', 'PROD.000015'),
('DPKT.000008', 'PAKT.000001', 'PROD.000019'),
('DPKT.000059', 'PAKT.000002', 'PROD.000001'),
('DPKT.000057', 'PAKT.000002', 'PROD.000014'),
('DPKT.000058', 'PAKT.000002', 'PROD.000015'),
('DPKT.000056', 'PAKT.000002', 'PROD.000021'),
('DPKT.000054', 'PAKT.000003', 'PROD.000009'),
('DPKT.000055', 'PAKT.000003', 'PROD.000012'),
('DPKT.000053', 'PAKT.000003', 'PROD.000015'),
('DPKT.000052', 'PAKT.000003', 'PROD.000022'),
('DPKT.000051', 'PAKT.000004', 'PROD.000001'),
('DPKT.000050', 'PAKT.000004', 'PROD.000010'),
('DPKT.000049', 'PAKT.000004', 'PROD.000012'),
('DPKT.000048', 'PAKT.000004', 'PROD.000015'),
('DPKT.000047', 'PAKT.000004', 'PROD.000023'),
('DPKT.000044', 'PAKT.000005', 'PROD.000002'),
('DPKT.000042', 'PAKT.000005', 'PROD.000010'),
('DPKT.000041', 'PAKT.000005', 'PROD.000014'),
('DPKT.000040', 'PAKT.000005', 'PROD.000015'),
('DPKT.000039', 'PAKT.000005', 'PROD.000020'),
('DPKT.000036', 'PAKT.000006', 'PROD.000002'),
('DPKT.000037', 'PAKT.000006', 'PROD.000005'),
('DPKT.000035', 'PAKT.000006', 'PROD.000008'),
('DPKT.000034', 'PAKT.000006', 'PROD.000010'),
('DPKT.000033', 'PAKT.000006', 'PROD.000014'),
('DPKT.000031', 'PAKT.000006', 'PROD.000015'),
('DPKT.000032', 'PAKT.000006', 'PROD.000017'),
('DPKT.000030', 'PAKT.000006', 'PROD.000021'),
('DPKT.000038', 'PAKT.000007', 'PROD.000002'),
('DPKT.000025', 'PAKT.000007', 'PROD.000004'),
('DPKT.000023', 'PAKT.000007', 'PROD.000010'),
('DPKT.000022', 'PAKT.000007', 'PROD.000014'),
('DPKT.000029', 'PAKT.000007', 'PROD.000015'),
('DPKT.000020', 'PAKT.000007', 'PROD.000022'),
('DPKT.000015', 'PAKT.000008', '-- Pilih Pr'),
('DPKT.000017', 'PAKT.000008', '-- Pilih Pr'),
('DPKT.000019', 'PAKT.000008', '-- Pilih Pr'),
('DPKT.000009', 'PAKT.000008', 'PROD.000001'),
('DPKT.000010', 'PAKT.000008', 'PROD.000004'),
('DPKT.000011', 'PAKT.000008', 'PROD.000008'),
('DPKT.000024', 'PAKT.000008', 'PROD.000009'),
('DPKT.000013', 'PAKT.000008', 'PROD.000014'),
('DPKT.000028', 'PAKT.000008', 'PROD.000015'),
('DPKT.000016', 'PAKT.000008', 'PROD.000017'),
('DPKT.000018', 'PAKT.000008', 'PROD.000023'),
('DPKT.000071', 'PAKT.000009', 'PROD.000001'),
('DPKT.000070', 'PAKT.000009', 'PROD.000006'),
('DPKT.000061', 'PAKT.000010', 'PROD.000002'),
('DPKT.000062', 'PAKT.000010', 'PROD.000003'),
('DPKT.000063', 'PAKT.000010', 'PROD.000006'),
('DPKT.000064', 'PAKT.000010', 'PROD.000007'),
('DPKT.000067', 'PAKT.000010', 'PROD.000011'),
('DPKT.000068', 'PAKT.000010', 'PROD.000016'),
('DPKT.000065', 'PAKT.000010', 'PROD.000025'),
('DPKT.000066', 'PAKT.000010', 'PROD.000026'),
('DPKT.000069', 'PAKT.000011', 'PROD.000013');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` varchar(11) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
('KTGR.000002', 'Dokumentasi'),
('KTGR.000003', 'Pelaminan'),
('KTGR.000004', 'Kursi Tamu'),
('KTGR.000005', 'Tenda'),
('KTGR.000006', 'Aksesoris'),
('KTGR.000007', 'Acara Adat'),
('KTGR.000008', 'Dekorasi Kain '),
('KTGR.000009', 'Paket Riasan');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` varchar(11) NOT NULL,
  `kriteria` varchar(30) NOT NULL,
  `attribut` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `attribut`) VALUES
('KRIT.000001', 'Harga', 'Cost'),
('KRIT.000002', 'Lama Pemasangan', 'Benefit'),
('KRIT.000003', 'Cashback (%)', 'Benefit'),
('KRIT.000004', 'Pelayanan Fasilitas', 'Benefit'),
('KRIT.000005', 'Popularitas', 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
`id_nilai` int(11) NOT NULL,
  `id_paket` varchar(11) NOT NULL,
  `id_kriteria` varchar(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_paket`, `id_kriteria`, `nilai`) VALUES
(6, 'PAKT.000008', 'KRIT.000001', 25),
(7, 'PAKT.000008', 'KRIT.000002', 75),
(8, 'PAKT.000008', 'KRIT.000003', 75),
(9, 'PAKT.000008', 'KRIT.000004', 75),
(10, 'PAKT.000008', 'KRIT.000005', 100),
(11, 'PAKT.000006', 'KRIT.000001', 25),
(12, 'PAKT.000006', 'KRIT.000002', 75),
(13, 'PAKT.000006', 'KRIT.000003', 75),
(14, 'PAKT.000006', 'KRIT.000004', 75),
(15, 'PAKT.000006', 'KRIT.000005', 100),
(16, 'PAKT.000007', 'KRIT.000001', 50),
(17, 'PAKT.000007', 'KRIT.000002', 50),
(18, 'PAKT.000007', 'KRIT.000003', 50),
(19, 'PAKT.000007', 'KRIT.000004', 75),
(20, 'PAKT.000007', 'KRIT.000005', 75),
(21, 'PAKT.000005', 'KRIT.000001', 75),
(22, 'PAKT.000005', 'KRIT.000002', 25),
(23, 'PAKT.000005', 'KRIT.000003', 25),
(24, 'PAKT.000005', 'KRIT.000004', 50),
(25, 'PAKT.000005', 'KRIT.000005', 25),
(26, 'PAKT.000004', 'KRIT.000001', 50),
(27, 'PAKT.000004', 'KRIT.000002', 75),
(28, 'PAKT.000004', 'KRIT.000003', 25),
(29, 'PAKT.000004', 'KRIT.000004', 50),
(30, 'PAKT.000004', 'KRIT.000005', 75),
(31, 'PAKT.000003', 'KRIT.000001', 75),
(32, 'PAKT.000003', 'KRIT.000002', 50),
(33, 'PAKT.000003', 'KRIT.000003', 25),
(34, 'PAKT.000003', 'KRIT.000004', 75),
(35, 'PAKT.000003', 'KRIT.000005', 25),
(36, 'PAKT.000002', 'KRIT.000001', 50),
(37, 'PAKT.000002', 'KRIT.000002', 50),
(38, 'PAKT.000002', 'KRIT.000003', 25),
(39, 'PAKT.000002', 'KRIT.000004', 50),
(40, 'PAKT.000002', 'KRIT.000005', 75),
(41, 'PAKT.000001', 'KRIT.000001', 100),
(42, 'PAKT.000001', 'KRIT.000002', 50),
(43, 'PAKT.000001', 'KRIT.000003', 25),
(44, 'PAKT.000001', 'KRIT.000004', 50),
(45, 'PAKT.000001', 'KRIT.000005', 25),
(46, 'PAKT.000009', 'KRIT.000001', 100),
(47, 'PAKT.000009', 'KRIT.000002', 25),
(48, 'PAKT.000009', 'KRIT.000003', 25),
(49, 'PAKT.000009', 'KRIT.000004', 25),
(50, 'PAKT.000009', 'KRIT.000005', 25),
(51, 'PAKT.000010', 'KRIT.000001', 25),
(52, 'PAKT.000010', 'KRIT.000002', 100),
(53, 'PAKT.000010', 'KRIT.000003', 100),
(54, 'PAKT.000010', 'KRIT.000004', 100),
(55, 'PAKT.000010', 'KRIT.000005', 100),
(56, 'PAKT.000011', 'KRIT.000001', 100),
(57, 'PAKT.000011', 'KRIT.000002', 25),
(58, 'PAKT.000011', 'KRIT.000003', 25),
(59, 'PAKT.000011', 'KRIT.000004', 25),
(60, 'PAKT.000011', 'KRIT.000005', 25);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_paket`
--

CREATE TABLE IF NOT EXISTS `nilai_paket` (
  `id_paket` varchar(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_paket`
--

INSERT INTO `nilai_paket` (`id_paket`, `nilai`) VALUES
('PAKT.000011', 0.0625),
('PAKT.000011', 0.0375),
('PAKT.000011', 0.025),
('PAKT.000011', 0.05),
('PAKT.000011', 0.075),
('PAKT.000010', 0.25),
('PAKT.000010', 0.15),
('PAKT.000010', 0.1),
('PAKT.000010', 0.2),
('PAKT.000010', 0.3),
('PAKT.000009', 0.0625),
('PAKT.000009', 0.0375),
('PAKT.000009', 0.025),
('PAKT.000009', 0.05),
('PAKT.000009', 0.075),
('PAKT.000008', 0.25),
('PAKT.000008', 0.1125),
('PAKT.000008', 0.075),
('PAKT.000008', 0.15),
('PAKT.000008', 0.3),
('PAKT.000007', 0.125),
('PAKT.000007', 0.075),
('PAKT.000007', 0.05),
('PAKT.000007', 0.15),
('PAKT.000007', 0.225),
('PAKT.000006', 0.25),
('PAKT.000006', 0.1125),
('PAKT.000006', 0.075),
('PAKT.000006', 0.15),
('PAKT.000006', 0.3),
('PAKT.000005', 0.0833),
('PAKT.000005', 0.0375),
('PAKT.000005', 0.025),
('PAKT.000005', 0.1),
('PAKT.000005', 0.075),
('PAKT.000004', 0.125),
('PAKT.000004', 0.1125),
('PAKT.000004', 0.025),
('PAKT.000004', 0.1),
('PAKT.000004', 0.225),
('PAKT.000003', 0.0833),
('PAKT.000003', 0.075),
('PAKT.000003', 0.025),
('PAKT.000003', 0.15),
('PAKT.000003', 0.075),
('PAKT.000002', 0.125),
('PAKT.000002', 0.075),
('PAKT.000002', 0.025),
('PAKT.000002', 0.1),
('PAKT.000002', 0.225),
('PAKT.000001', 0.0625),
('PAKT.000001', 0.075),
('PAKT.000001', 0.025),
('PAKT.000001', 0.1),
('PAKT.000001', 0.075);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_user`
--

CREATE TABLE IF NOT EXISTS `nilai_user` (
  `id_paket` varchar(11) NOT NULL,
  `nilai` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_user`
--

INSERT INTO `nilai_user` (`id_paket`, `nilai`, `username`) VALUES
('PAKT.000011', '1.5625', 'nabila'),
('PAKT.000011', '0.9375', 'nabila'),
('PAKT.000011', '0.625', 'nabila'),
('PAKT.000011', '1.25', 'nabila'),
('PAKT.000011', '1.875', 'nabila'),
('PAKT.000010', '6.25', 'nabila'),
('PAKT.000010', '3.75', 'nabila'),
('PAKT.000010', '2.5', 'nabila'),
('PAKT.000010', '5', 'nabila'),
('PAKT.000010', '7.5', 'nabila'),
('PAKT.000009', '1.5625', 'nabila'),
('PAKT.000009', '0.9375', 'nabila'),
('PAKT.000009', '0.625', 'nabila'),
('PAKT.000009', '1.25', 'nabila'),
('PAKT.000009', '1.875', 'nabila'),
('PAKT.000008', '6.25', 'nabila'),
('PAKT.000008', '2.8125', 'nabila'),
('PAKT.000008', '1.875', 'nabila'),
('PAKT.000008', '3.75', 'nabila'),
('PAKT.000008', '7.5', 'nabila'),
('PAKT.000007', '3.125', 'nabila'),
('PAKT.000007', '1.875', 'nabila'),
('PAKT.000007', '1.25', 'nabila'),
('PAKT.000007', '3.75', 'nabila'),
('PAKT.000007', '5.625', 'nabila'),
('PAKT.000006', '6.25', 'nabila'),
('PAKT.000006', '2.8125', 'nabila'),
('PAKT.000006', '1.875', 'nabila'),
('PAKT.000006', '3.75', 'nabila'),
('PAKT.000006', '7.5', 'nabila'),
('PAKT.000005', '2.0833', 'nabila'),
('PAKT.000005', '0.9375', 'nabila'),
('PAKT.000005', '0.625', 'nabila'),
('PAKT.000005', '2.5', 'nabila'),
('PAKT.000005', '1.875', 'nabila'),
('PAKT.000004', '3.125', 'nabila'),
('PAKT.000004', '2.8125', 'nabila'),
('PAKT.000004', '0.625', 'nabila'),
('PAKT.000004', '2.5', 'nabila'),
('PAKT.000004', '5.625', 'nabila'),
('PAKT.000003', '2.0833', 'nabila'),
('PAKT.000003', '1.875', 'nabila'),
('PAKT.000003', '0.625', 'nabila'),
('PAKT.000003', '3.75', 'nabila'),
('PAKT.000003', '1.875', 'nabila'),
('PAKT.000002', '3.125', 'nabila'),
('PAKT.000002', '1.875', 'nabila'),
('PAKT.000002', '0.625', 'nabila'),
('PAKT.000002', '2.5', 'nabila'),
('PAKT.000002', '5.625', 'nabila'),
('PAKT.000001', '1.5625', 'nabila'),
('PAKT.000001', '1.875', 'nabila'),
('PAKT.000001', '0.625', 'nabila'),
('PAKT.000001', '2.5', 'nabila'),
('PAKT.000001', '1.875', 'nabila'),
('PAKT.000011', '3.125', 'admin'),
('PAKT.000011', '1.875', 'admin'),
('PAKT.000011', '1.25', 'admin'),
('PAKT.000011', '2.5', 'admin'),
('PAKT.000011', '3.75', 'admin'),
('PAKT.000010', '12.5', 'admin'),
('PAKT.000010', '7.5', 'admin'),
('PAKT.000010', '5', 'admin'),
('PAKT.000010', '10', 'admin'),
('PAKT.000010', '15', 'admin'),
('PAKT.000009', '3.125', 'admin'),
('PAKT.000009', '1.875', 'admin'),
('PAKT.000009', '1.25', 'admin'),
('PAKT.000009', '2.5', 'admin'),
('PAKT.000009', '3.75', 'admin'),
('PAKT.000008', '12.5', 'admin'),
('PAKT.000008', '5.625', 'admin'),
('PAKT.000008', '3.75', 'admin'),
('PAKT.000008', '7.5', 'admin'),
('PAKT.000008', '15', 'admin'),
('PAKT.000007', '6.25', 'admin'),
('PAKT.000007', '3.75', 'admin'),
('PAKT.000007', '2.5', 'admin'),
('PAKT.000007', '7.5', 'admin'),
('PAKT.000007', '11.25', 'admin'),
('PAKT.000006', '12.5', 'admin'),
('PAKT.000006', '5.625', 'admin'),
('PAKT.000006', '3.75', 'admin'),
('PAKT.000006', '7.5', 'admin'),
('PAKT.000006', '15', 'admin'),
('PAKT.000005', '4.1667', 'admin'),
('PAKT.000005', '1.875', 'admin'),
('PAKT.000005', '1.25', 'admin'),
('PAKT.000005', '5', 'admin'),
('PAKT.000005', '3.75', 'admin'),
('PAKT.000004', '6.25', 'admin'),
('PAKT.000004', '5.625', 'admin'),
('PAKT.000004', '1.25', 'admin'),
('PAKT.000004', '5', 'admin'),
('PAKT.000004', '11.25', 'admin'),
('PAKT.000003', '4.1667', 'admin'),
('PAKT.000003', '3.75', 'admin'),
('PAKT.000003', '1.25', 'admin'),
('PAKT.000003', '7.5', 'admin'),
('PAKT.000003', '3.75', 'admin'),
('PAKT.000002', '6.25', 'admin'),
('PAKT.000002', '3.75', 'admin'),
('PAKT.000002', '1.25', 'admin'),
('PAKT.000002', '5', 'admin'),
('PAKT.000002', '11.25', 'admin'),
('PAKT.000001', '3.125', 'admin'),
('PAKT.000001', '3.75', 'admin'),
('PAKT.000001', '1.25', 'admin'),
('PAKT.000001', '5', 'admin'),
('PAKT.000001', '3.75', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE IF NOT EXISTS `paket` (
  `id_paket` varchar(11) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `deskripsi`, `harga`, `gambar`) VALUES
('PAKT.000001', 'Alternatif Paket 11', 'Harga paket relatif lebih murah.', 4750000, '65Kursi-lipat-kantor-Futura-FTR-501.jpeg'),
('PAKT.000002', 'Alternatif Paket 10', 'Harga paket relatif lebih murah', 9050000, '755.jpg'),
('PAKT.000003', 'Alternatif Paket 09', 'Harga paket relatif lebih murah', 7500000, '804.jpg'),
('PAKT.000004', 'Alternatif Paket 08', 'Harga paket relatif lebih murah', 8650000, '746.jpg'),
('PAKT.000005', 'Alternatif Paket 07', 'Paket Pernikahan Standar ', 6200000, '40.jpg'),
('PAKT.000006', 'Alternatif Paket 06', 'Paket Pernikahan Standar', 12400000, '35.jpg'),
('PAKT.000007', 'Alternatif Paket 05', 'Paket Pernikahan Standar', 8500000, '451.jpg'),
('PAKT.000008', 'Alternatif Paket 04', 'Paket Pernikahan Standar 01', 11350000, '837.jpg'),
('PAKT.000009', 'Alternatif Paket 03', 'Untuk Acara Syukuran dan Lain-lain', 2900000, '650.jpeg'),
('PAKT.000010', 'Alternatif Paket 02', 'Pemasangan Dekorasi Gedung  serta bagian Luar dari Gedung', 20150000, '86images.jpg'),
('PAKT.000011', 'Alternatif Paket 01', 'Untuk keperluan acara tahlil dan lain - lain', 700000, '710.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` varchar(11) NOT NULL,
  `id_kategori` varchar(11) NOT NULL,
  `produk` varchar(40) NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `produk`, `deskripsi`, `harga`, `gambar`) VALUES
('PROD.000001', 'KTGR.000002', 'Paket Foto Standar 1 Rol', 'Paket Foto 1 Rol, terdiri dari 32 lembar Foto ukuran 4R', 400000, '37images (3).jpeg'),
('PROD.000002', 'KTGR.000002', 'Paket Foto Standar 2 Rol', 'Foto 2 Rol, terdiri dari 60 lembar Foto ukuran 4R + 2 Foto Ukuran 10R', 800000, '11images (3).jpeg'),
('PROD.000003', 'KTGR.000002', 'Paket Foto Hard Cover', 'Foto 2 Rol, terdiri dari 60 lembar Foto ukuran 4R + 2 Foto Ukuran 10R + Album Hard Cover', 1800000, '50images (3).jpeg'),
('PROD.000004', 'KTGR.000002', 'Paket Video Standar 1', 'Video Shoot terdiri 1 keping CD berdurasi 40 menit', 1200000, '63images (3).jpeg'),
('PROD.000005', 'KTGR.000002', 'Paket Video Standar 2', 'Video Shoot terdiri 2 keping CD berdurasi 2 x 40 menit', 1800000, '64images (3).jpeg'),
('PROD.000006', 'KTGR.000002', 'Paket Video Ekskluif', 'Video Shoot terdiri 2 keping CD berdurasi 2 x 40 menit + Cinemiatic', 2500000, '45images (3).jpeg'),
('PROD.000007', 'KTGR.000007', 'Lengseran Lengkap', 'Terdiri dari acara pemandian sampai dengan penyambutan \r\n\r\n', 3000000, '3FB_IMG_1547268005762.jpg'),
('PROD.000008', 'KTGR.000007', 'Lengseran Penyambutan', 'Penyambutan kedatangan mempelai', 4000000, '93..jpg'),
('PROD.000009', 'KTGR.000008', 'Full Kain 1 - 3 Warna', 'Terdri dari 1 - 3 susunan warna kain, full menutup seluruh tenda acara', 1000000, '97images.jpg'),
('PROD.000010', 'KTGR.000008', 'Kain 1 - 3 Warna', 'Dekorasi terdiri dari 3 warna penutup bagian atas tenda', 700000, '82003.jpg'),
('PROD.000011', 'KTGR.000005', 'Tenda Standar 1 Lokal', 'Terdiri dari 1 tenda berukuran 4x4 meter dengan tinggi 4 meter', 250000, '980.jpeg'),
('PROD.000012', 'KTGR.000005', 'Tenda Standar 2 Lokal', 'Terdiri dari 2 tenda berukuran 4x4 meter dengan tinggi 4 meter', 500000, '80.jpeg'),
('PROD.000013', 'KTGR.000005', 'Tenda Standar 3 Lokal', 'Terdiri dari 3 tenda berukuran 4x4 meter dengan tinggi 4 meter', 700000, '980.jpeg'),
('PROD.000014', 'KTGR.000005', 'Tenda Standar 4 Lokal', 'Terdiri dari 4 tenda berukuran 4x4 meter dengan tinggi 4 meter', 1000000, '40.jpeg'),
('PROD.000015', 'KTGR.000004', 'Kusi Plastik', 'Terdiri dari 100 pcs kursi', 500000, '262.jpeg'),
('PROD.000016', 'KTGR.000004', 'Kusi Stainlees', 'Terdiri dari 100 pcs kursi', 800000, '811.jpg'),
('PROD.000017', 'KTGR.000004', 'Sarung Kursi', 'Tambahan sarung untuk setiap kursi terdiri dari 100 pcs ', 200000, '46index.jpg'),
('PROD.000018', 'KTGR.000003', 'Gebyong 6 Pintu', 'Dekorasi kayu ukir jepara 6 susun', 7000000, '330.jpg'),
('PROD.000019', 'KTGR.000003', 'Gebyong Putih 6 Pintu', 'Dekorasi kayu ukir jepara 6 susun', 9000000, '832.jpg'),
('PROD.000020', 'KTGR.000003', 'Gebyong 4 Pintu', 'Dekorasi kayu ukir jepara 4 susun', 4500000, '640.jpg'),
('PROD.000021', 'KTGR.000003', 'Minimalis Syahrini', 'Pelaminnan putih dengan kursi besar ala Syahrin', 9500000, '845.jpg'),
('PROD.000022', 'KTGR.000003', 'Minimalis Kubah', 'Panjang keseluruhan 5,5 meter bernuasa putih dan hijau', 6500000, '281.jpg'),
('PROD.000023', 'KTGR.000003', 'Minimalis Datar', 'Panjang keseluruhan 6 meter, warna dasar putih', 7500000, '626.jpg'),
('PROD.000024', 'KTGR.000003', 'Minimalis Sofa', 'Panjang keseluruhan 5,5 meter, terdiri dari 2 plihan warna sofa cokat da cream.', 8000000, '323.jpg'),
('PROD.000025', 'KTGR.000008', 'Kain Eksklusif', 'Untuk Keperluan Pertemuan Besar dan Paket Full Kain', 3500000, '18images.jpg'),
('PROD.000026', 'KTGR.000003', 'Pelaminan Kostem', 'Pelamainan Koatem diambil dari berbagai refrensi ', 10000000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE IF NOT EXISTS `sub_kriteria` (
  `id_sub` varchar(11) NOT NULL,
  `id_kriteria` varchar(11) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `nilai` double NOT NULL,
  `bobot` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub`, `id_kriteria`, `keterangan`, `nilai`, `bobot`) VALUES
('SUBK.000001', 'KRIT.000001', 'Lebih dari 10 Jt', 25, 'Kurang'),
('SUBK.000002', 'KRIT.000001', ' 8 Jt s/d 10,99 Jt', 50, 'Cukup'),
('SUBK.000003', 'KRIT.000001', '5 Juta s/d 7,99 Jt', 75, 'Baik'),
('SUBK.000004', 'KRIT.000001', 'Kurang dari 5 Jt', 100, 'Sangat Baik'),
('SUBK.000005', 'KRIT.000005', 'Kurang', 25, 'Kurang'),
('SUBK.000006', 'KRIT.000005', 'Cukup', 50, 'Cukup'),
('SUBK.000007', 'KRIT.000005', 'Baik', 75, 'Baik'),
('SUBK.000008', 'KRIT.000005', 'Sangat Baik', 100, 'Sangat Baik'),
('SUBK.000009', 'KRIT.000004', 'Kurang', 25, 'Kurang'),
('SUBK.000010', 'KRIT.000004', 'Cukup', 50, 'Cukup'),
('SUBK.000011', 'KRIT.000004', 'Baik', 75, 'Baik'),
('SUBK.000012', 'KRIT.000004', 'Sangat Baik', 100, 'Sangat Baik'),
('SUBK.000013', 'KRIT.000003', '0', 25, 'Kurang'),
('SUBK.000014', 'KRIT.000003', '1', 50, 'Cukup'),
('SUBK.000015', 'KRIT.000003', '2', 75, 'Baik'),
('SUBK.000016', 'KRIT.000003', '3', 100, 'Sangat Baik'),
('SUBK.000017', 'KRIT.000002', '1 Hari', 25, 'Kurang'),
('SUBK.000018', 'KRIT.000002', '2 Hari', 50, 'Cukup'),
('SUBK.000019', 'KRIT.000002', '3 Hari', 75, 'Baik'),
('SUBK.000020', 'KRIT.000002', '4 Hari', 100, 'Sangat Baik');

-- --------------------------------------------------------

--
-- Table structure for table `temp_nilaiuser`
--

CREATE TABLE IF NOT EXISTS `temp_nilaiuser` (
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `blokir` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Indra Purnama', 'indrapurnama@gmail.com', '08238923848', 'Admin', 'N', 'lp5sn95hh485cb0qm8hvri1gp2'),
('nabila', '652d3266220e0aacb047d3aa6f51f1b0', 'Nabilah Ratna Ayu nigsih', 'nabilara@gmail.com', '08717162212', 'Pelanggan', 'N', '922k8dbb9irpns97j34u7bu3l4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
 ADD PRIMARY KEY (`id_bobot`), ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `detail_paket`
--
ALTER TABLE `detail_paket`
 ADD PRIMARY KEY (`id_detail`), ADD KEY `id_paket` (`id_paket`,`id_produk`), ADD KEY `id_paket_2` (`id_paket`,`id_produk`), ADD KEY `id_paket_3` (`id_paket`,`id_produk`), ADD KEY `id_paket_4` (`id_paket`,`id_produk`), ADD KEY `id_paket_5` (`id_paket`,`id_produk`), ADD KEY `id_paket_6` (`id_paket`), ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
 ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
 ADD PRIMARY KEY (`id_nilai`), ADD KEY `id_paket` (`id_paket`,`id_kriteria`), ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `nilai_paket`
--
ALTER TABLE `nilai_paket`
 ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `nilai_user`
--
ALTER TABLE `nilai_user`
 ADD KEY `id_paket` (`id_paket`), ADD KEY `username` (`username`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
 ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
 ADD PRIMARY KEY (`id_produk`), ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
 ADD PRIMARY KEY (`id_sub`), ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot`
--
ALTER TABLE `bobot`
ADD CONSTRAINT `bobot_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Constraints for table `detail_paket`
--
ALTER TABLE `detail_paket`
ADD CONSTRAINT `detail_paket_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`),
ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Constraints for table `nilai_paket`
--
ALTER TABLE `nilai_paket`
ADD CONSTRAINT `nilai_paket_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Constraints for table `nilai_user`
--
ALTER TABLE `nilai_user`
ADD CONSTRAINT `nilai_user_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
