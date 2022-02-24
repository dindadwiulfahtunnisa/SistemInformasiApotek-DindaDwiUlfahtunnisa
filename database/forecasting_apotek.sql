-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 03:20 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forecasting_apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_level`) VALUES
(1, 'Developer'),
(2, 'Pemilik'),
(3, 'Apoteker'),
(4, 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `obat_id` int(11) NOT NULL,
  `kode_obat` varchar(10) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kedaluwarsa` date NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `satuan_obat` varchar(10) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_obat`
--

INSERT INTO `tbl_obat` (`obat_id`, `kode_obat`, `nama_obat`, `kedaluwarsa`, `harga_beli`, `harga_jual`, `satuan_obat`, `stok`, `supplier_id`) VALUES
(16, 'OB01', 'Tempra Syr 60 ml', '2024-07-11', 21500, 24000, 'Botol', 20, 7),
(17, 'OB02', 'Bodrek', '2025-02-10', 4500, 7000, 'Botol', 150, 5),
(18, 'OB03', 'Contrexin', '2025-04-04', 5500, 8000, 'Botol', 40, 5),
(19, 'OB04', 'Neu Rheumacyl', '2025-01-01', 8500, 10000, 'Strip', 90, 5),
(20, 'OB05', 'Hemaviton Stamina', '2025-05-24', 5000, 7500, 'Strip', 120, 5),
(21, 'OB06', 'Sanmol Syr', '2025-08-26', 13000, 16000, 'Botol', 80, 6),
(22, 'OB07', 'Sanmol Tablet', '2023-12-09', 5000, 2000, 'Strip', 250, 6),
(23, 'OB08', 'Pasquam', '2024-06-25', 30000, 33000, 'Tube', 90, 6),
(24, 'OB09', 'Sanvita Syr', '2024-03-02', 16050, 18000, 'Botol', 55, 6),
(25, 'OB010', 'Proris Syr', '2026-01-14', 25500, 29000, 'Tablet', 40, 5),
(28, 'OB011', 'Polysilane Syr', '2025-01-10', 22500, 25000, 'Botol', 75, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `kode_pembelian` varchar(10) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `kode_obat` varchar(10) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `bulan` varchar(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`pembelian_id`, `kode_pembelian`, `obat_id`, `kode_obat`, `supplier_id`, `bulan`, `tahun`, `tgl_pembelian`, `total_pembelian`) VALUES
(2, 'PB001', 16, 'OB01', 5, '', 0000, '2021-02-18', 1000),
(4, 'PB002', 17, '', 5, '', 0000, '2021-01-01', 1000),
(5, 'PB003', 18, '', 5, '', 0000, '2021-02-18', 1000),
(6, 'PB004', 23, '', 6, '', 0000, '2021-01-10', 1000),
(7, 'P005', 25, '', 7, '', 0000, '2021-04-22', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `kode_penjualan` varchar(10) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`penjualan_id`, `kode_penjualan`, `obat_id`, `bulan`, `tahun`, `tgl_penjualan`, `jumlah`) VALUES
(19, 'P001', 16, 1, 0000, '2021-01-13', 51),
(20, 'P002', 16, 1, 0000, '2021-02-16', 69),
(21, 'P003', 16, 1, 0000, '2021-03-18', 57),
(22, 'P004', 16, 1, 0000, '2021-04-15', 60),
(23, 'P005', 16, 1, 0000, '2021-05-16', 25),
(24, 'P006', 16, 0, 0000, '2021-06-30', 30),
(26, 'P007', 16, 0, 0000, '2021-07-28', 55),
(27, 'P008', 16, 0, 0000, '2021-08-05', 48),
(28, 'P009', 16, 0, 0000, '2021-09-15', 59),
(29, 'P010', 16, 0, 0000, '2021-10-08', 35),
(31, 'P012', 16, 0, 0000, '2021-12-12', 36);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prediksi`
--

CREATE TABLE `tbl_prediksi` (
  `ramalan_id` int(11) NOT NULL,
  `kode_ramalan` varchar(10) NOT NULL,
  `periode` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `hasil` double NOT NULL,
  `error` float NOT NULL,
  `mad` float NOT NULL,
  `mse` double NOT NULL,
  `mape` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_prediksi`
--

INSERT INTO `tbl_prediksi` (`ramalan_id`, `kode_ramalan`, `periode`, `jumlah`, `obat_id`, `bulan`, `tahun`, `hasil`, `error`, `mad`, `mse`, `mape`) VALUES
(14, 'PR01', 3, 29, 16, 1, 0000, 48.9, 19.9, 19.9, 396.01, 68.6207),
(21, 'PR02', 4, 36, 16, 0, 0000, 48.9, 12.9, 12.9, 166.41, 35.8333);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `kode_supplier`, `nama_supplier`, `alamat`, `nohp`) VALUES
(5, 'SUP01', 'PT. TEMPO', 'Ulak Karang', '082268266264'),
(6, 'SUP02', 'PT. BINA SAN PRIMA', 'Kuranji', '085263664777'),
(7, 'SUP03', 'PT. PARIT PADANG', 'Korong Gadang, Kuranji', '082268234567');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fullname`, `password`, `role_id`) VALUES
(3, 'developer', 'Dinda Dwi Ulfahtunnisa', 'developer', 1),
(18, 'pemilik', 'Ruhul J', 'pemilik', 2),
(19, 'apoteker', 'Intan Kumalasari', 'apoteker', 3),
(20, 'karyawan', 'Afriyani', 'karyawan', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`obat_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`pembelian_id`),
  ADD KEY `sumber_obat` (`obat_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `tbl_prediksi`
--
ALTER TABLE `tbl_prediksi`
  ADD PRIMARY KEY (`ramalan_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  MODIFY `obat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_prediksi`
--
ALTER TABLE `tbl_prediksi`
  MODIFY `ramalan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD CONSTRAINT `sumber` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD CONSTRAINT `sumber_obat` FOREIGN KEY (`obat_id`) REFERENCES `tbl_obat` (`obat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `level` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
