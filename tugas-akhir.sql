-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 07:13 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id13522262_latihan`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_akun`
--

CREATE TABLE `daftar_akun` (
  `kode_akun` varchar(10) NOT NULL,
  `akun` varchar(100) NOT NULL,
  `pos_laporan` varchar(50) NOT NULL,
  `pos_akun` varchar(50) NOT NULL,
  `saldo_normal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_akun`
--

INSERT INTO `daftar_akun` (`kode_akun`, `akun`, `pos_laporan`, `pos_akun`, `saldo_normal`) VALUES
('1-101', 'Kas', 'Laporan Posisi Keuangan', 'Aset Lancar', 'Debit'),
('1-102', 'Piutang Jasa', 'Laporan Posisi Keuangan', 'Aset Lancar', 'Debit'),
('1-103', 'Perlengkapan', 'Laporan Posisi Keuangan', 'Aset Lancar', 'Debit'),
('1-201', 'Peralatan', 'Laporan Posisi Keuangan', 'Aset Tetap', 'Debit'),
('1-202', 'Akumulasi Penyusutan Peralatan', 'Laporan Posisi Keuangan', 'Aset Tetap', 'Debit'),
('1-203', 'Kendaraan', 'Laporan Posisi Keuangan', 'Aset Tetap', 'Debit'),
('1-204', 'Akumulasi Penyusutan Kendaraan', 'Laporan Posisi Keuangan', 'Aset Tetap', 'Debit'),
('2-001', 'Utang Usaha', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('2-002', 'Hutang Gaji', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('2-003', 'Hutang Listrik dan Telepon', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('3-001', 'Modal', 'Laporan Posisi Keuangan', 'Ekuitas', 'Kredit'),
('3-002', 'Prive', 'Laporan Posisi Keuangan', 'Ekuitas', 'Debit'),
('4-001', 'Pendapatan Jasa', 'Laba Rugi', 'Pendapatan', 'Kredit'),
('4-002', 'Pendapatan lain-lain', 'Laba Rugi', 'Pendapatan', 'Kredit'),
('4-003', 'Ikhtisar Laba Rugi', 'Laba Rugi', 'Pendapatan', 'Kredit'),
('5-001', 'Beban Listrik dan Telepon', 'Laba Rugi', 'Beban', 'Debit'),
('5-002', 'Beban Honor', 'Laba Rugi', 'Beban', 'Debit'),
('5-003', 'Beban Gaji', 'Laba Rugi', 'Beban', 'Debit'),
('5-004', 'Beban Pajak', 'Laba Rugi', 'Beban', 'Debit'),
('5-005', 'Beban Perlengkapan', 'Laba Rugi', 'Beban', 'Debit'),
('5-006', 'Beban Penyusutan Peralatan', 'Laba Rugi', 'Beban', 'Debit'),
('5-007', 'Beban BBM', 'Laba Rugi', 'Beban', 'Debit'),
('5-008', 'Beban Kontrak Kendaraan', 'Laba Rugi', 'Beban', 'Debit'),
('5-009', 'Beban Perawatan Kendaraan', 'Laba Rugi', 'Beban', 'Debit'),
('5-010', 'Beban Penyusutan Kendaraan', 'Laba Rugi', 'Beban', 'Debit'),
('5-011', 'Beban lain-lain', 'Laba Rugi', 'Beban', 'Debit'),
('5-012', 'Beban Sewa', 'Laba Rugi', 'Beban', 'Debit'),
('5-013', 'Beban Iklan', 'Laba Rugi', 'Beban', 'Debit'),
('5-014', 'Beban Pajak Kendaraan', 'Laba Rugi', 'Beban', 'Debit'),
('5-015', 'Beban Angsuran Kendaraan', 'Laba Rugi', 'Beban', 'Debit');

-- --------------------------------------------------------

--
-- Table structure for table `data_kendaraan`
--

CREATE TABLE `data_kendaraan` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `plat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kendaraan`
--

INSERT INTO `data_kendaraan` (`id`, `nama`, `plat`) VALUES
(4, 'Kijang', 'K 3051 JP'),
(5, 'Avanza', 'AE 9021 P');

-- --------------------------------------------------------

--
-- Table structure for table `data_sewa`
--

CREATE TABLE `data_sewa` (
  `id` int(5) NOT NULL,
  `nama_penyewa` varchar(50) NOT NULL,
  `tgl_sewa` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `biaya_sewa` decimal(15,2) NOT NULL,
  `uang_muka` decimal(15,2) NOT NULL,
  `bayar` decimal(15,2) NOT NULL,
  `kendaraan` varchar(50) NOT NULL,
  `tgl_lunas` date NOT NULL,
  `status` varchar(5) NOT NULL,
  `id_sewa` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_sewa`
--

INSERT INTO `data_sewa` (`id`, `nama_penyewa`, `tgl_sewa`, `tgl_kembali`, `biaya_sewa`, `uang_muka`, `bayar`, `kendaraan`, `tgl_lunas`, `status`, `id_sewa`) VALUES
(85, 'Adi', '2020-04-30', '2020-04-30', '5500000.00', '1500000.00', '0.00', 'Avanza', '0000-00-00', 'BL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `saldo_awal`
--

CREATE TABLE `saldo_awal` (
  `id` int(5) NOT NULL,
  `kode_akun` varchar(7) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `pos_laporan` varchar(100) NOT NULL,
  `akun` varchar(50) NOT NULL,
  `debit` decimal(15,2) NOT NULL,
  `kredit` decimal(15,2) NOT NULL,
  `pos_akun` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saldo_awal`
--

INSERT INTO `saldo_awal` (`id`, `kode_akun`, `keterangan`, `tanggal_transaksi`, `pos_laporan`, `akun`, `debit`, `kredit`, `pos_akun`) VALUES
(40, '1-101', 'Saldo Awal', '2019-12-31', 'Laporan Posisi Keuangan', 'Kas', '100000.00', '0.00', 'Aset Lancar'),
(41, '3-001', 'Saldo Awal', '2019-12-31', 'Laporan Posisi Keuangan', 'Modal', '0.00', '100000.00', 'Ekuitas');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(5) NOT NULL,
  `kode_akun` varchar(7) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `pos_saldo` varchar(20) NOT NULL,
  `pos_laporan` varchar(100) NOT NULL,
  `bukti_transaksi` varchar(8) NOT NULL,
  `akun` varchar(50) NOT NULL,
  `debit` decimal(15,2) NOT NULL,
  `kredit` decimal(15,2) NOT NULL,
  `pos_akun` varchar(50) NOT NULL,
  `id_sewa` int(7) DEFAULT NULL,
  `ref` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_akun`, `keterangan`, `tanggal_transaksi`, `pos_saldo`, `pos_laporan`, `bukti_transaksi`, `akun`, `debit`, `kredit`, `pos_akun`, `id_sewa`, `ref`) VALUES
(815, '1-101', 'Sewa Adi', '2020-04-30', 'Debit', 'Laporan Posisi Keuangan', '000001', 'Kas', '1500000.00', '0.00', 'Aset Lancar', 1, 'JU'),
(816, '1-102', 'Sewa Adi', '2020-04-30', 'Debit', 'Laporan Posisi Keuangan', '000001', 'Piutang Jasa', '4000000.00', '0.00', 'Aset Lancar', 1, 'JU'),
(817, '4-001', 'Sewa Adi', '2020-04-30', 'Kredit', 'Laba Rugi', '000001', 'Pendapatan Jasa', '0.00', '5500000.00', 'Pendapatan', 1, 'JU'),
(818, '1-101', 'Terharu', '2020-05-01', 'Debit', 'Laporan Posisi Keuangan', '000002', 'Kas', '5000000.00', '0.00', 'Aset Lancar', NULL, 'JU'),
(819, '4-001', 'Terharu', '2020-05-01', 'Kredit', 'Laba Rugi', '000002', 'Pendapatan Jasa', '0.00', '5000000.00', 'Pendapatan', NULL, 'JU'),
(820, '1-201', 'Beli peralatan', '2020-05-01', 'Debit', 'Laporan Posisi Keuangan', '000003', 'Peralatan', '1000000.00', '0.00', 'Aset Tetap', NULL, 'JU'),
(821, '1-101', 'Beli peralatan', '2020-05-01', 'Kredit', 'Laporan Posisi Keuangan', '000003', 'Kas', '0.00', '1000000.00', 'Aset Lancar', NULL, 'JU');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `gambar`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(5, 'Pemilik', 'pemilik@gmail.com', 'Ljungberg_Jadi.jpg', '$2y$10$Qf0tLxG3UKwFBrYEinqC0OXCUIuajr5N9I4/KaVUSjyQYr5YptMeq', 1, 1, 1580792292),
(6, 'Admin', 'admin@gmail.com', 'freddieljungberg210918a.jpg', '$2y$10$Awkz2wOzLd/GCjac.r/Rg.SLCFXBpfkGqYSTD5xcKWU39EmPgJPRe', 2, 1, 1583740100),
(11, 'Avanza', 'brambrom928@gmail.com', 'default.jpg', '$2y$10$clt5aaf8B7GNJZSTU5Tk3ecRgaBtpZDgZhoFMyz6u00udjuz2FdSu', 2, 1, 1588276479);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Pemilik'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(6, 'brambrom928@gmail.com', 'iP+E8ookelaHiUYlhIi5jxopYqZUkKR//ml9T8xVUuQ=', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_akun`
--
ALTER TABLE `daftar_akun`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indexes for table `data_kendaraan`
--
ALTER TABLE `data_kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_sewa`
--
ALTER TABLE `data_sewa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saldo_awal`
--
ALTER TABLE `saldo_awal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_kendaraan`
--
ALTER TABLE `data_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_sewa`
--
ALTER TABLE `data_sewa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `saldo_awal`
--
ALTER TABLE `saldo_awal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=822;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
