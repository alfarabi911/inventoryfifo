-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 01:13 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fifo`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kobar` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kobar`, `nama_barang`, `jenis`) VALUES
('18901057510025', 'Staples Kangaro', 'ATK'),
('4902430563864', 'Shampoo Pantene', 'Non Atk'),
('8992946521836', 'sabun shinzui', 'Non Atk'),
('B001', 'PERCETAKAN', 'Atk'),
('B002', 'Roti Sari Rasa', ''),
('B003', 'Lem', 'ATK'),
('B004', 'Pudding', ''),
('B005', 'Susu segar', ''),
('B006', 'PENA', 'Atk'),
('B007', 'Kertas', 'ATK');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` varchar(11) NOT NULL,
  `tgl_keluar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `tgl_keluar`) VALUES
('BK180205001', '2018-02-05 13:58:50'),
('BK180206001', '2018-02-06 00:24:35'),
('BK180206002', '2018-02-06 09:10:13'),
('BK180206003', '2018-02-06 11:15:43'),
('BK180207001', '2018-02-07 05:59:09'),
('BK180207002', '2018-02-07 06:00:49'),
('BK180207003', '2018-02-07 06:02:30'),
('BK200330001', '2020-03-30 12:22:20'),
('BK200330002', '2020-03-30 12:25:54'),
('BK200401001', '2020-04-01 04:12:15'),
('BK200415001', '2020-04-15 10:50:26'),
('BK200425001', '2020-04-24 20:16:31'),
('BK200425002', '2020-04-24 20:22:12'),
('BK200425003', '2020-04-25 07:49:29'),
('BK200425004', '2020-04-25 07:50:09'),
('BK200501001', '2020-05-01 10:25:21'),
('BK200519001', '2020-05-18 20:07:08'),
('BK200519002', '2020-05-18 20:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` varchar(11) NOT NULL,
  `tgl_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `tgl_masuk`) VALUES
('BM180205001', '2020-05-16 20:03:36'),
('BM180205002', '2018-02-05 03:28:47'),
('BM180205003', '2018-02-05 07:32:10'),
('BM180205004', '2018-02-05 13:28:56'),
('BM180206001', '2018-02-06 09:03:11'),
('BM180206002', '2018-02-06 09:05:18'),
('BM180208001', '2018-02-08 13:44:53'),
('BM200330001', '2020-03-30 12:21:26'),
('BM200330002', '2020-03-30 12:25:36'),
('BM200401001', '2020-04-01 03:57:54'),
('BM200415001', '2020-04-15 10:49:03'),
('BM200415002', '2020-04-15 10:50:02'),
('BM200415003', '2020-04-15 11:18:35'),
('BM200415004', '2020-04-15 11:20:00'),
('BM200425001', '2020-04-24 20:15:38'),
('BM200425002', '2020-04-24 20:21:43'),
('BM200425003', '2020-04-25 07:47:43'),
('BM200425004', '2020-04-25 07:48:52'),
('BM200501001', '2020-05-01 10:22:33'),
('BM200501002', '2020-05-16 20:13:24'),
('BM200517001', '2020-05-16 20:09:06'),
('BM200518001', '2020-05-18 10:40:30'),
('BM200519001', '2020-05-18 18:09:52'),
('BM200519002', '2020-05-18 18:55:34'),
('BM200519003', '2020-05-18 19:12:11'),
('BM200519004', '2020-05-18 19:17:32'),
('BM200519005', '2020-05-18 19:31:28'),
('BM200519006', '2020-05-18 19:47:24'),
('BM200519007', '2020-05-18 19:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang_keluar`
--

CREATE TABLE `detail_barang_keluar` (
  `id_keluar` varchar(11) NOT NULL,
  `kobar` varchar(50) NOT NULL,
  `qty` int(3) NOT NULL,
  `ket` varchar(60) NOT NULL,
  `id_masuk` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_barang_keluar`
--

INSERT INTO `detail_barang_keluar` (`id_keluar`, `kobar`, `qty`, `ket`, `id_masuk`) VALUES
('BK180205001', 'B001', 5, '', 'BM180205001'),
('BK180205001', 'B001', 1, '', 'BM180205002'),
('BK180205001', 'B002', 4, '', 'BM180205001'),
('BK180206001', 'B001', 1, '', 'BM180205002'),
('BK180206001', 'B001', 4, '', 'BM180205003'),
('BK180206001', 'B002', 1, '', 'BM180205001'),
('BK180206001', 'B002', 1, '', 'BM180205002'),
('BK180206001', 'B002', 2, '', 'BM180205003'),
('BK180206002', 'B001', 1, '', 'BM180205003'),
('BK180206002', 'B001', 1, '', 'BM180205004'),
('BK180206002', 'B004', 3, '', 'BM180206001'),
('BK180206002', 'B003', 1, '', 'BM180206001'),
('BK180206003', 'B001', 1, '', 'BM180205004'),
('BK180207001', 'B002', 4, '', 'BM180206002'),
('BK180207001', 'B003', 2, '', 'BM180206001'),
('BK180207002', 'B003', 5, '', 'BM180206001'),
('BK180207003', 'B003', 2, '', 'BM180206001'),
('BK180207003', 'B004', 2, '', 'BM180206001'),
('BK200330001', 'B006', 2, '', 'BM200330001'),
('BK200330002', 'B005', 1, '', 'BM180208001'),
('BK200401001', 'B006', 6, '', 'BM200330001'),
('BK200415001', 'B003', 1, '', 'BM200415001'),
('BK200425001', '4902', 3, '', 'BM200425001'),
('BK200425002', '4902430563864', 2, '', 'BM200425001'),
('BK200425002', '4902430563864', 3, '', 'BM200425002'),
('BK200425003', '8992946521836', 6, '', 'BM200425003'),
('BK200425004', '8992946521836', 4, '', 'BM200425003'),
('BK200425004', '8992946521836', 4, '', 'BM200425004'),
('BK200501001', '8992946521836', 3, '', 'BM200501001'),
('BK200501001', '4902430563864', 2, '', 'BM200425002'),
('BK200501002', '8992946521836', 1, '', 'BM200501001'),
('BK200519001', '4902430563864', 1, 'Celmix', 'BM200425002'),
('BK200519001', '4902430563864', 5, 'Celmix', 'BM200501002'),
('BK200519001', '4902430563864', 5, 'Celmix', 'BM200519001'),
('BK200519001', '4902430563864', 20, 'Celmix', 'BM200519002'),
('BK200519001', '4902430563864', 1, 'Celmix', 'BM200519005'),
('BK200519001', '4902430563864', 4, 'Celmix', 'BM200519005'),
('BK200519001', '4902430563864', 6, 'Celmix', 'BM200519007'),
('BK200519001', '18901057510025', 4, 'ce', 'BM200517001'),
('BK200519002', '18901057510025', 4, 'ce', 'BM200517001');

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang_masuk`
--

CREATE TABLE `detail_barang_masuk` (
  `id_masuk` varchar(11) NOT NULL,
  `kobar` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `rak` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `ket` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_barang_masuk`
--

INSERT INTO `detail_barang_masuk` (`id_masuk`, `kobar`, `qty`, `sisa`, `rak`, `harga`, `ket`) VALUES
('BM180205001', 'B001', 5, 0, '', 20000, ''),
('BM180205001', 'B002', 5, 0, '', 5000, ''),
('BM180205002', 'B001', 2, 0, '', 20000, ''),
('BM180205002', 'B002', 1, 0, '', 5000, ''),
('BM180205003', 'B001', 5, 0, '', 21000, ''),
('BM180205003', 'B002', 2, 0, '', 5500, ''),
('BM180205004', 'B001', 2, 0, '', 21000, ''),
('BM180206001', 'B004', 5, 0, '', 4500, ''),
('BM180206001', 'B003', 10, 0, '', 6000, ''),
('BM180206002', 'B002', 4, 0, '', 5500, ''),
('BM180208001', 'B001', 10, 10, '', 1000, ''),
('BM180208001', 'B005', 10, 9, '', 10, ''),
('BM200330001', 'B006', 10, 2, '', 2000, ''),
('BM200330002', 'B005', 3, 3, '', 10, ''),
('BM200401001', 'B006', 5, 5, '', 2000, ''),
('BM200415001', 'B003', 3, 2, '', 6000, ''),
('BM200415002', 'B003', 6, 6, '', 6000, ''),
('BM200415003', 'B003', 2, 2, '', 6000, ''),
('BM200415004', 'B007', 2, 2, '', 35000, ''),
('BM200425001', '4902430563864', 5, 0, '', 1000, ''),
('BM200425002', '4902430563864', 6, 0, '', 2000, ''),
('BM200425003', '8992946521836', 10, 0, '', 4000, ''),
('BM200425004', '8992946521836', 4, 0, '', 4000, ''),
('BM200501001', '8992946521836', 5, 1, '', 4000, ''),
('BM200501002', '4902430563864', 5, 0, '', 2000, ''),
('BM200517001', '18901057510025', 20, 12, '', 2000, ''),
('BM200518001', '8992946521836', 21, 21, '', 4000, ''),
('BM200519001', '4902430563864', 5, 0, '', 2000, ''),
('BM200519002', '4902430563864', 20, 0, '', 2000, ''),
('BM200519003', '18901057510025', 5, 5, 'hijau', 2000, ''),
('BM200519004', '18901057510025', 5, 5, 'hijau', 2000, ''),
('BM200519005', '4902430563864', 5, 0, 'Besi', 2000, ''),
('BM200519006', '18901057510025', 10, 10, 'Hijau', 2000, 'PT r'),
('BM200519007', '18901057510025', 5, 5, 'Hijau', 2000, 'PT R'),
('BM200519007', '4902430563864', 6, 0, 'Besi', 2000, 'PT R');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `level` enum('admin','karu') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `username`, `password`, `level`) VALUES
(1, 'Mas Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'karu', 'kepalaruangan', '3bce44d59838f6df1f28a7547edf2036', 'karu'),
(3, 'admin1', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kobar`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
