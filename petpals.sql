-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 02:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petpals`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`) VALUES
(1, 'abcdefg@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `no` int(11) NOT NULL,
  `idobat` varchar(11) NOT NULL,
  `namaobat` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `lokasi_penyimpanan` varchar(255) NOT NULL,
  `harga` decimal(10,3) NOT NULL,
  `kadaluwarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`no`, `idobat`, `namaobat`, `kategori`, `jumlah`, `lokasi_penyimpanan`, `harga`, `kadaluwarsa`) VALUES
(2, 'Ob001', 'kaloxy', 'antibiotik', 10, 'Gudang', '165.000', '2024-04-12'),
(3, 'Ob002', 'kaloxy', 'antibiotik', 2, 'Gudang', '165.000', '2024-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `no` int(11) NOT NULL,
  `idhewan` varchar(15) NOT NULL,
  `namapem` varchar(255) NOT NULL,
  `namahewan` varchar(50) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `dokterhewan` varchar(255) NOT NULL,
  `tglpendaf` date NOT NULL,
  `jenishwn` varchar(255) NOT NULL,
  `berathwn` varchar(255) NOT NULL,
  `warnabulu` varchar(255) NOT NULL,
  `umur` varchar(255) NOT NULL,
  `riwobat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`no`, `idhewan`, `namapem`, `namahewan`, `jk`, `notelp`, `alamat`, `dokterhewan`, `tglpendaf`, `jenishwn`, `berathwn`, `warnabulu`, `umur`, `riwobat`) VALUES
(15, 'A001', 'anin', 'Emong', 'Betina', '0812344565', 'Jl. Pamularsih', 'drh. Nivan', '2024-06-10', 'kucing', '2', 'putih', '3 bulan', 'tidak ada'),
(18, 'A002', 'omeng', 'Emongg', 'Betina', '0812344565', 'jl. sawunggaling', 'drh. Nivan', '2024-06-20', 'kucing', '2', 'putih', '3 ', 'tidak ada');

-- --------------------------------------------------------

--
-- Table structure for table `rekammedis`
--

CREATE TABLE `rekammedis` (
  `no` int(11) NOT NULL,
  `norekam` int(11) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `namahewan` varchar(50) NOT NULL,
  `idhewan` varchar(15) NOT NULL,
  `berathwn` varchar(255) NOT NULL,
  `temperatur` varchar(255) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `diagnosa` varchar(255) NOT NULL,
  `hasil_periksa` varchar(255) NOT NULL,
  `gejala` varchar(255) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekammedis`
--

INSERT INTO `rekammedis` (`no`, `norekam`, `tgl_periksa`, `namahewan`, `idhewan`, `berathwn`, `temperatur`, `tindakan`, `diagnosa`, `hasil_periksa`, `gejala`, `foto`) VALUES
(7, 10001, '2024-06-20', 'Emong', 'A001', '0,5', '26', 'memberi obat diare', 'diare', 'dasdsdqw', 'asadsdsq', 'Tracking dokter.png');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_hewan` varchar(20) NOT NULL,
  `no_rm` int(20) NOT NULL,
  `nama_hewan` varchar(100) NOT NULL,
  `tgl_transaksi` int(11) DEFAULT NULL,
  `tgl_jatuhtempo` int(11) DEFAULT NULL,
  `item` varchar(100) NOT NULL,
  `harga` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `total` int(20) NOT NULL,
  `status_pem` enum('paid','unpaid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_hewan`, `no_rm`, `nama_hewan`, `tgl_transaksi`, `tgl_jatuhtempo`, `item`, `harga`, `jumlah`, `total`, `status_pem`) VALUES
('A002', 567, 'vgvtguy', NULL, NULL, 'rtdur', 767, 87887, 567, 'paid'),
('a4535', 567, 'vgvtguy', NULL, NULL, 'rtdur', 767, 87887, 567, 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `no` int(11) NOT NULL,
  `idhewan` int(11) NOT NULL,
  `norekam` int(11) NOT NULL,
  `tgl_pem` datetime NOT NULL,
  `estimasi_tgl` date NOT NULL,
  `tahap` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `tgl_tahapan` date NOT NULL,
  `waktu_tahapan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `idhewan` (`idhewan`,`namapem`,`namahewan`,`berathwn`),
  ADD UNIQUE KEY `namapem` (`namapem`,`namahewan`,`berathwn`);

--
-- Indexes for table `rekammedis`
--
ALTER TABLE `rekammedis`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `norekam` (`norekam`) USING BTREE,
  ADD KEY `idhewan` (`idhewan`),
  ADD KEY `namahewan` (`namahewan`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rekammedis`
--
ALTER TABLE `rekammedis`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rekammedis`
--
ALTER TABLE `rekammedis`
  ADD CONSTRAINT `rekammedis_ibfk_1` FOREIGN KEY (`idhewan`) REFERENCES `pasien` (`idhewan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
