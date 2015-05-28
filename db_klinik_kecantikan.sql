-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2014 at 06:48 AM
-- Server version: 5.5.35
-- PHP Version: 5.4.4-14+deb7u14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_klinik_kecantikan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(150) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_pokok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `diskon` varchar(10) NOT NULL DEFAULT '0',
  `keuntungan` varchar(20) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `stok`, `harga_pokok`, `harga_jual`, `diskon`, `keuntungan`, `created_at`, `updated_at`) VALUES
(1, 'Pasak Bumi', 15, 120000, 140000, '4', '14400', '15/11/2014 07:37:39', '2014-12-02 23:48:10'),
(2, 'Lidah Buaya', 34, 10000, 15000, '0', '5000', '2014-11-23 23:26:48', '2014-11-29 04:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokter`
--

CREATE TABLE IF NOT EXISTS `tbl_dokter` (
  `id_dokter` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `tempat_tanggal_lahir` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(150) NOT NULL,
  `spesialis` varchar(150) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id_dokter`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_dokter`
--

INSERT INTO `tbl_dokter` (`id_dokter`, `nama`, `tempat_tanggal_lahir`, `alamat`, `no_telepon`, `spesialis`, `created_at`) VALUES
(1, 'Suma Wijaya', 'Denpasar, 1 Januari 1980', 'Denpasar, Bali', '083847395705', 'Kulit', '15/11/2014 11:01:32'),
(2, 'Dedek', 'Bandung, 19 Oktober 1978', 'Bandung', '12392', 'Bedah', '15/11/2014 14:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_transaksi`
--

CREATE TABLE IF NOT EXISTS `tbl_master_transaksi` (
  `id_master_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasien` int(11) NOT NULL,
  `id_perawatan` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `hutang` int(11) NOT NULL DEFAULT '0',
  `biaya` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `total_bayar` int(11) NOT NULL DEFAULT '0',
  `status_pembayaran` varchar(20) NOT NULL DEFAULT 'Belum Lunas',
  PRIMARY KEY (`id_master_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_master_transaksi`
--

INSERT INTO `tbl_master_transaksi` (`id_master_transaksi`, `id_pasien`, `id_perawatan`, `created_at`, `updated_at`, `keterangan`, `hutang`, `biaya`, `total`, `total_bayar`, `status_pembayaran`) VALUES
(2, 1, 1, '2014-03-30 06:26:15', '22/01/2014 04:49:30', 'Ok', 0, 100000, 9400000, 250000, 'Lunas'),
(3, 2, 1, '2014-11-16 06:31:17', '2014-12-03 00:11:16', 'Sipp', 0, 1000000, 3163000, 3200000, 'Lunas'),
(4, 2, 1, '2014-09-16 22:17:12', '2014-11-24 00:13:19', 'Mules', 1288000, 3000000, 5688000, 4400000, 'Belum Lunas'),
(5, 1, 1, '2014-11-24 00:14:11', '2014-11-24 00:15:07', 'Jerawat', 0, 100000, 175000, 200000, 'Lunas'),
(6, 1, 1, '2014-06-27 00:19:09', '2014-11-27 00:19:09', 'xxxxx', 0, 300000, 584400, 600000, 'Lunas'),
(7, 2, 1, '2014-01-30 10:38:32', '2014-11-30 10:42:54', 'dsdsdsd', 0, 0, 15000, 500000, 'Lunas'),
(8, 1, 1, '2014-01-30 16:37:51', '2014-12-01 22:19:53', 'sfdf', 0, 0, 2926000, 3000000, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pasien`
--

CREATE TABLE IF NOT EXISTS `tbl_pasien` (
  `id_pasien` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_tanggal_lahir` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `member` varchar(5) NOT NULL DEFAULT 'Tidak',
  PRIMARY KEY (`id_pasien`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`id_pasien`, `nama`, `alamat`, `tempat_tanggal_lahir`, `no_telepon`, `created_at`, `member`) VALUES
(1, 'Gede Lumbung', 'Denpasar, Bali', 'Denpasar, 4 Februari 1991', '083847395705', '15/11/2014 06:37:33', 'Ya'),
(2, 'Edi Wibowo', 'Badung, Bali', 'Denpasar, 4 Februari 1992', '083847395705', '16/11/2014 22:57:20', 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengaturan`
--

CREATE TABLE IF NOT EXISTS `tbl_pengaturan` (
  `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id_pengaturan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_pengaturan`
--

INSERT INTO `tbl_pengaturan` (`id_pengaturan`, `type`, `title`, `content`) VALUES
(1, 'site_name', 'Nama Aplikasi', 'Sistem Manajemen Klinik Kecantikan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perawat`
--

CREATE TABLE IF NOT EXISTS `tbl_perawat` (
  `id_perawat` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `tempat_tanggal_lahir` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id_perawat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_perawat`
--

INSERT INTO `tbl_perawat` (`id_perawat`, `nama`, `tempat_tanggal_lahir`, `alamat`, `no_telepon`, `created_at`) VALUES
(1, 'Ni Kadek Lisna Dewi', 'Badung, 12 Maret 1992', 'Badung, Bali', '081212978111', '15/11/2014 12:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perawatan`
--

CREATE TABLE IF NOT EXISTS `tbl_perawatan` (
  `id_perawatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perawatan` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon_member` varchar(5) NOT NULL,
  `diskon_umum` varchar(5) NOT NULL,
  `komisi_dokter` int(11) NOT NULL,
  `komisi_perawat` int(11) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  PRIMARY KEY (`id_perawatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_perawatan`
--

INSERT INTO `tbl_perawatan` (`id_perawatan`, `nama_perawatan`, `harga`, `diskon_member`, `diskon_umum`, `komisi_dokter`, `komisi_perawat`, `created_at`, `updated_at`) VALUES
(1, 'Totok Wajah', 500000, '5', '4', 75000, 35000, '2014-11-29 05:11:02', '2014-11-29 05:11:02'),
(2, 'Pasang Susuk', 1000000, '7', '9', 250000, 100000, '2014-11-30 16:37:12', '2014-11-30 16:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_dokter`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi_dokter` (
  `id_transaksi_dokter` int(11) NOT NULL AUTO_INCREMENT,
  `id_master_transaksi` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id_transaksi_dokter`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `tbl_transaksi_dokter`
--

INSERT INTO `tbl_transaksi_dokter` (`id_transaksi_dokter`, `id_master_transaksi`, `id_dokter`, `created_at`) VALUES
(39, 2, 1, '22/11/2014 04:49:30'),
(40, 2, 2, '22/11/2014 04:49:30'),
(55, 4, 2, '2014-11-24 00:13:19'),
(61, 5, 2, '2014-11-24 00:15:07'),
(62, 6, 1, '2014-11-27 00:19:09'),
(78, 8, 1, '2014-12-01 22:19:53'),
(105, 3, 1, '2014-12-03 00:11:16'),
(106, 3, 2, '2014-12-03 00:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_obat`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi_obat` (
  `id_transaksi_obat` int(11) NOT NULL AUTO_INCREMENT,
  `id_master_transaksi` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `created_at` varchar(50) NOT NULL,
  PRIMARY KEY (`id_transaksi_obat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `tbl_transaksi_obat`
--

INSERT INTO `tbl_transaksi_obat` (`id_transaksi_obat`, `id_master_transaksi`, `id_obat`, `jumlah`, `created_at`) VALUES
(37, 2, 1, 1, '22/11/2014 04:49:30'),
(52, 4, 1, 20, '2014-11-24 00:13:19'),
(58, 5, 2, 5, '2014-11-24 00:15:07'),
(59, 6, 2, 10, '2014-11-27 00:19:09'),
(60, 6, 1, 1, '2014-11-27 00:19:09'),
(62, 7, 2, 1, '2014-11-30 10:42:54'),
(87, 8, 1, 10, '2014-12-01 22:19:53'),
(88, 8, 1, 5, '2014-12-01 22:19:53'),
(115, 3, 1, 10, '2014-12-03 00:11:16'),
(116, 3, 1, 10, '2014-12-03 00:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_perawat`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi_perawat` (
  `id_transaksi_perawat` int(11) NOT NULL AUTO_INCREMENT,
  `id_master_transaksi` int(11) NOT NULL,
  `id_perawat` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id_transaksi_perawat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `tbl_transaksi_perawat`
--

INSERT INTO `tbl_transaksi_perawat` (`id_transaksi_perawat`, `id_master_transaksi`, `id_perawat`, `created_at`) VALUES
(40, 2, 1, '22/11/2014 04:49:30'),
(59, 4, 1, '2014-11-24 00:13:19'),
(65, 5, 1, '2014-11-24 00:15:07'),
(66, 6, 1, '2014-11-27 00:19:09'),
(84, 8, 1, '2014-12-01 22:19:53'),
(124, 3, 1, '2014-12-03 00:11:16'),
(125, 3, 1, '2014-12-03 00:11:16'),
(126, 3, 1, '2014-12-03 00:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_cms`
--

CREATE TABLE IF NOT EXISTS `tbl_user_cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'kasir',
  `telepon` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user_cms`
--

INSERT INTO `tbl_user_cms` (`id`, `username`, `password`, `nama`, `email`, `status`, `telepon`) VALUES
(1, 'admin', '$2a$10$M0Z3.tA3.fv/KIUN0Ck6OO8bX7e7d.ZE7EGRE8.H0ig5qlUUVT9jO', 'Gede Lumbung', 'gede@bedforest.com', 'admin', '083847395705'),
(2, 'kasir', '$2a$10$d2rv1dgP/G7XET774NB1MeqW.yDZreZ70I/.2Qmcoka.acogUNweC', 'Kasir', 'kasir@mail.com', 'kasir', '1234567890'),
(3, 'owner', '$2a$10$.5SG83rQhr41lDHYL/ie3.nOVCoU3BgqqS1jyjMEav0NBjRVEuHcy', 'Owner', 'owner@mail.com', 'owner', '0987654321');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
