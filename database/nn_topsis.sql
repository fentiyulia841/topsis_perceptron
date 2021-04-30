-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2021 at 03:28 AM
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
-- Database: `nn_topsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `nama_alternatif`) VALUES
(1, 'Rusak Ringan'),
(2, 'Rusak Sedang'),
(3, 'Rusak Berat');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bencana`
--

CREATE TABLE `tb_bencana` (
  `id_bencana` int(11) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `tanggal_kejadian` date DEFAULT NULL,
  `tanggal_input` date DEFAULT NULL,
  `id_jenis` varchar(255) DEFAULT NULL,
  `id_sektor` varchar(255) DEFAULT NULL,
  `id_alternatif` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bencana`
--

INSERT INTO `tb_bencana` (`id_bencana`, `lokasi`, `tanggal_kejadian`, `tanggal_input`, `id_jenis`, `id_sektor`, `id_alternatif`) VALUES
(2, 'Jl. Raya Uluwatu, Ungasan, Kec. Kuta Sel., Kabupaten Badung, Bali 80364', '2021-03-28', '2021-03-28', '2', '1', '1'),
(3, 'Blitar, Kota Blitar, Jawa Timur', '2021-04-26', '2021-04-26', '1', '1', '1'),
(5, 'Pantai Batu Bolong, Jl. Pantai Batu Bolong, Canggu, Kec. Kuta Utara, Kabupaten Badung, Bali', '2021-04-26', '2021-04-26', '1', '1', '1'),
(6, 'Bali', '2021-04-26', '2021-04-26', '1', '1', '1'),
(7, 'Blitar, Kota Blitar, Jawa Timur', '2021-04-29', '2021-04-29', '1', '1', '1'),
(8, 'Malang, jawa timur', '2021-04-29', '2021-04-29', '1', '1', '1'),
(9, 'Riau, Indonesia', '2021-04-29', '2021-04-29', '1', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bencana_detail`
--

CREATE TABLE `tb_bencana_detail` (
  `ID` int(11) NOT NULL,
  `id_bencana` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_crips` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bencana_detail`
--

INSERT INTO `tb_bencana_detail` (`ID`, `id_bencana`, `id_kriteria`, `id_crips`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 4),
(3, 1, 3, 7),
(4, 1, 4, 10),
(5, 1, 5, 13),
(6, 2, 1, 1),
(7, 2, 2, 4),
(8, 2, 3, 7),
(9, 2, 4, 10),
(10, 2, 5, 13),
(11, 3, 1, 1),
(12, 3, 2, 4),
(13, 3, 3, 7),
(14, 3, 4, 10),
(15, 3, 5, 13),
(16, 4, 1, 1),
(17, 4, 2, 4),
(18, 4, 3, 7),
(19, 4, 4, 10),
(20, 4, 5, 13),
(21, 5, 1, 1),
(22, 5, 2, 4),
(23, 5, 3, 7),
(24, 5, 4, 10),
(25, 5, 5, 13),
(26, 6, 1, 1),
(27, 6, 2, 4),
(28, 6, 3, 7),
(29, 6, 4, 10),
(30, 6, 5, 13),
(31, 7, 1, 1),
(32, 7, 2, 4),
(33, 7, 3, 7),
(34, 7, 4, 10),
(35, 7, 5, 13),
(36, 8, 1, 1),
(37, 8, 2, 4),
(38, 8, 3, 7),
(39, 8, 4, 10),
(40, 8, 5, 13),
(41, 9, 1, 1),
(42, 9, 2, 5),
(43, 9, 3, 7),
(44, 9, 4, 10),
(45, 9, 5, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tb_crips`
--

CREATE TABLE `tb_crips` (
  `id_crips` int(11) NOT NULL,
  `id_kriteria` varchar(16) DEFAULT NULL,
  `nama_kriteria` varchar(125) NOT NULL,
  `nama_crips` varchar(255) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_crips`
--

INSERT INTO `tb_crips` (`id_crips`, `id_kriteria`, `nama_kriteria`, `nama_crips`, `nilai`) VALUES
(1, '1', 'Keadaan Bangunan', 'Masih Berdiri', 1),
(2, '1', 'Keadaan Bangunan', 'Miring', 2),
(3, '1', 'Keadaan Bangunan', 'Roboh Total', 3),
(4, '2', 'Keadaan Struktur Bangunan', 'Sebagian Kecil Rusak Ringan', 1),
(5, '2', 'Keadaan Struktur Bangunan', 'Sebagian Kecil Rusak', 2),
(6, '2', 'Keadaan Struktur Bangunan', 'Sebagian Besar Rusak', 3),
(7, '3', 'Kondisi Fisik Bangunan', '<30%', 1),
(8, '3', 'Kondisi Fisik Bangunan', '30-50%', 2),
(9, '3', 'Kondisi Fisik Bangunan', '>50%', 3),
(10, '4', 'Fungsi Bangunan', 'Tidak Berbahaya', 1),
(11, '4', 'Fungsi Bangunan', 'Relatif Berbahaya', 2),
(12, '4', 'Fungsi Bangunan', 'Membahayakan', 3),
(13, '5', 'Keadaan Penunjang Lainnya', 'Sebagian Kecil Rusak', 1),
(14, '5', 'Keadaan Penunjang Lainnya', 'Sebagian Besar Rusak', 2),
(15, '5', 'Keadaan Penunjang Lainnya', 'Rusak Total', 3),
(26, NULL, '1', 'Masih Berdiri', 1),
(27, NULL, '1', 'Masih Berdiri', 4),
(29, NULL, '1', 'Masih ', 4),
(30, NULL, '2', 'Masih Berdiri', 4),
(31, NULL, '1', 'Masih Berdiri', 1),
(32, '', '1', 'Masih Berdiri', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Banjir'),
(2, 'Tsunami'),
(4, 'Gempa Bumi'),
(5, 'Gunung Meletus'),
(6, 'Kebakaran');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `nama_kriteria` varchar(255) DEFAULT NULL,
  `nilai_kriteria` int(11) DEFAULT NULL,
  `bb` int(11) DEFAULT NULL,
  `ba` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `nilai_kriteria`, `bb`, `ba`) VALUES
(1, 'K1', 'Keadaan Bangunan', 4, 1, 3),
(2, 'K2', 'Keadaan Struktur Bangunan', 1, 1, 3),
(3, 'K3', 'Kondisi Fisik Bangunan', 3, 1, 3),
(4, 'K4', 'Fungsi Bangunan', 3, 1, 3),
(5, 'K5', 'Keadaan Penunjang Lainnya', 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_options`
--

CREATE TABLE `tb_options` (
  `option_name` varchar(16) NOT NULL,
  `option_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pola`
--

CREATE TABLE `tb_pola` (
  `id_pola` int(11) NOT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_sektor` int(11) DEFAULT NULL,
  `tanggal_kejadian` date DEFAULT NULL,
  `tanggal_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pola`
--

INSERT INTO `tb_pola` (`id_pola`, `id_jenis`, `id_sektor`, `tanggal_kejadian`, `tanggal_input`) VALUES
(3, 2, 1, '2021-03-24', '2021-03-24'),
(4, 4, 2, '2021-03-24', '2021-03-24'),
(5, 1, 1, '2021-03-25', '2021-03-24'),
(6, 1, 1, '2021-03-29', '2021-03-24'),
(7, 1, 2, '2021-03-31', '2021-03-24'),
(8, 2, 1, '2021-03-24', '2021-03-24'),
(9, 4, 2, '2021-03-10', '2021-03-24'),
(10, 4, 1, '2021-03-09', '2021-03-24'),
(11, 1, 1, '2021-03-01', '2021-03-24'),
(12, 1, 2, '2021-03-09', '2021-03-24'),
(13, 1, 1, '2021-03-02', '2021-03-24'),
(14, 1, 1, '2021-03-06', '2021-03-24'),
(15, 1, 1, '2021-03-11', '2021-03-24'),
(16, 1, 2, '2021-02-11', '2021-03-24'),
(17, 1, 2, '2021-02-19', '2021-03-24'),
(18, 1, 2, '2021-02-28', '2021-03-24'),
(19, 1, 2, '2021-02-05', '2021-03-24'),
(20, 1, 2, '2021-02-01', '2021-03-24'),
(21, 1, 1, '2021-02-08', '2021-03-24'),
(22, 1, 1, '2021-03-24', '2021-03-24'),
(23, 1, 2, '2020-12-30', '2021-03-24'),
(24, 1, 1, '2021-01-24', '2021-03-24'),
(25, 1, 1, '2020-12-16', '2021-03-24'),
(27, 1, 1, '2021-04-29', '2021-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pola_detail`
--

CREATE TABLE `tb_pola_detail` (
  `ID` int(11) NOT NULL,
  `id_pola` int(11) DEFAULT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_crips` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pola_detail`
--

INSERT INTO `tb_pola_detail` (`ID`, `id_pola`, `id_alternatif`, `id_kriteria`, `id_crips`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 1, 2),
(3, 1, 3, 1, 3),
(4, 1, 1, 2, 5),
(5, 1, 2, 2, 4),
(6, 1, 3, 2, 6),
(7, 1, 1, 3, 9),
(8, 1, 2, 3, 7),
(9, 1, 3, 3, 8),
(10, 1, 1, 4, 10),
(11, 1, 2, 4, 11),
(12, 1, 3, 4, 10),
(13, 1, 1, 5, 13),
(14, 1, 2, 5, 15),
(15, 1, 3, 5, 14),
(16, 2, 1, 1, NULL),
(17, 2, 2, 1, NULL),
(18, 2, 3, 1, NULL),
(19, 2, 1, 2, NULL),
(20, 2, 2, 2, NULL),
(21, 2, 3, 2, NULL),
(22, 2, 1, 3, NULL),
(23, 2, 2, 3, NULL),
(24, 2, 3, 3, NULL),
(25, 2, 1, 4, NULL),
(26, 2, 2, 4, NULL),
(27, 2, 3, 4, NULL),
(28, 2, 1, 5, NULL),
(29, 2, 2, 5, NULL),
(30, 2, 3, 5, NULL),
(53, 3, 1, 1, 2),
(54, 3, 2, 1, 1),
(55, 3, 3, 1, 2),
(56, 3, 1, 2, 5),
(57, 3, 2, 2, 6),
(58, 3, 3, 2, 5),
(59, 3, 1, 3, 8),
(60, 3, 2, 3, 9),
(61, 3, 3, 3, 8),
(62, 3, 1, 4, 11),
(63, 3, 2, 4, 12),
(64, 3, 3, 4, 12),
(65, 3, 1, 5, 15),
(66, 3, 2, 5, 14),
(67, 3, 3, 5, 15),
(68, 4, 1, 1, 3),
(69, 4, 2, 1, 1),
(70, 4, 3, 1, 3),
(71, 4, 1, 2, 5),
(72, 4, 2, 2, 6),
(73, 4, 3, 2, 4),
(74, 4, 1, 3, 8),
(75, 4, 2, 3, 8),
(76, 4, 3, 3, 9),
(77, 4, 1, 4, 11),
(78, 4, 2, 4, 12),
(79, 4, 3, 4, 11),
(80, 4, 1, 5, 14),
(81, 4, 2, 5, 14),
(82, 4, 3, 5, 14),
(83, 5, 1, 1, 3),
(84, 5, 2, 1, 3),
(85, 5, 3, 1, 3),
(86, 5, 1, 2, 6),
(87, 5, 2, 2, 6),
(88, 5, 3, 2, 6),
(89, 5, 1, 3, 8),
(90, 5, 2, 3, 9),
(91, 5, 3, 3, 8),
(92, 5, 1, 4, 12),
(93, 5, 2, 4, 12),
(94, 5, 3, 4, 11),
(95, 5, 1, 5, 15),
(96, 5, 2, 5, 14),
(97, 5, 3, 5, 15),
(98, 6, 1, 1, 1),
(99, 6, 2, 1, 2),
(100, 6, 3, 1, 3),
(101, 6, 1, 2, 4),
(102, 6, 2, 2, 5),
(103, 6, 3, 2, 6),
(104, 6, 1, 3, 7),
(105, 6, 2, 3, 8),
(106, 6, 3, 3, 9),
(107, 6, 1, 4, 10),
(108, 6, 2, 4, 11),
(109, 6, 3, 4, 12),
(110, 6, 1, 5, 13),
(111, 6, 2, 5, 15),
(112, 6, 3, 5, 15),
(113, 7, 1, 1, 1),
(114, 7, 2, 1, 2),
(115, 7, 3, 1, 3),
(116, 7, 1, 2, 4),
(117, 7, 2, 2, 5),
(118, 7, 3, 2, 6),
(119, 7, 1, 3, 7),
(120, 7, 2, 3, 8),
(121, 7, 3, 3, 9),
(122, 7, 1, 4, 10),
(123, 7, 2, 4, 11),
(124, 7, 3, 4, 12),
(125, 7, 1, 5, 13),
(126, 7, 2, 5, 14),
(127, 7, 3, 5, 15),
(128, 8, 1, 1, 1),
(129, 8, 2, 1, 1),
(130, 8, 3, 1, 1),
(131, 8, 1, 2, 5),
(132, 8, 2, 2, 5),
(133, 8, 3, 2, 6),
(134, 8, 1, 3, 7),
(135, 8, 2, 3, 7),
(136, 8, 3, 3, 9),
(137, 8, 1, 4, 11),
(138, 8, 2, 4, 10),
(139, 8, 3, 4, 12),
(140, 8, 1, 5, 13),
(141, 8, 2, 5, 14),
(142, 8, 3, 5, 15),
(143, 9, 1, 1, 1),
(144, 9, 2, 1, 2),
(145, 9, 3, 1, 3),
(146, 9, 1, 2, 4),
(147, 9, 2, 2, 5),
(148, 9, 3, 2, 6),
(149, 9, 1, 3, 7),
(150, 9, 2, 3, 8),
(151, 9, 3, 3, 9),
(152, 9, 1, 4, 10),
(153, 9, 2, 4, 11),
(154, 9, 3, 4, 12),
(155, 9, 1, 5, 13),
(156, 9, 2, 5, 14),
(157, 9, 3, 5, 15),
(158, 10, 1, 1, 3),
(159, 10, 2, 1, 2),
(160, 10, 3, 1, 1),
(161, 10, 1, 2, 6),
(162, 10, 2, 2, 5),
(163, 10, 3, 2, 4),
(164, 10, 1, 3, 9),
(165, 10, 2, 3, 8),
(166, 10, 3, 3, 7),
(167, 10, 1, 4, 12),
(168, 10, 2, 4, 11),
(169, 10, 3, 4, 10),
(170, 10, 1, 5, 15),
(171, 10, 2, 5, 14),
(172, 10, 3, 5, 13),
(173, 11, 1, 1, 3),
(174, 11, 2, 1, 2),
(175, 11, 3, 1, 1),
(176, 11, 1, 2, 6),
(177, 11, 2, 2, 5),
(178, 11, 3, 2, 4),
(179, 11, 1, 3, 9),
(180, 11, 2, 3, 8),
(181, 11, 3, 3, 7),
(182, 11, 1, 4, 12),
(183, 11, 2, 4, 11),
(184, 11, 3, 4, 10),
(185, 11, 1, 5, 15),
(186, 11, 2, 5, 14),
(187, 11, 3, 5, 13),
(188, 12, 1, 1, 1),
(189, 12, 2, 1, 1),
(190, 12, 3, 1, 1),
(191, 12, 1, 2, 4),
(192, 12, 2, 2, 4),
(193, 12, 3, 2, 4),
(194, 12, 1, 3, 7),
(195, 12, 2, 3, 7),
(196, 12, 3, 3, 7),
(197, 12, 1, 4, 10),
(198, 12, 2, 4, 10),
(199, 12, 3, 4, 10),
(200, 12, 1, 5, 13),
(201, 12, 2, 5, 13),
(202, 12, 3, 5, 13),
(203, 13, 1, 1, 2),
(204, 13, 2, 1, 2),
(205, 13, 3, 1, 2),
(206, 13, 1, 2, 5),
(207, 13, 2, 2, 5),
(208, 13, 3, 2, 5),
(209, 13, 1, 3, 8),
(210, 13, 2, 3, 8),
(211, 13, 3, 3, 8),
(212, 13, 1, 4, 11),
(213, 13, 2, 4, 11),
(214, 13, 3, 4, 11),
(215, 13, 1, 5, 14),
(216, 13, 2, 5, 14),
(217, 13, 3, 5, 14),
(218, 14, 1, 1, 3),
(219, 14, 2, 1, 1),
(220, 14, 3, 1, 2),
(221, 14, 1, 2, 6),
(222, 14, 2, 2, 5),
(223, 14, 3, 2, 4),
(224, 14, 1, 3, 9),
(225, 14, 2, 3, 7),
(226, 14, 3, 3, 8),
(227, 14, 1, 4, 12),
(228, 14, 2, 4, 11),
(229, 14, 3, 4, 10),
(230, 14, 1, 5, 15),
(231, 14, 2, 5, 13),
(232, 14, 3, 5, 14),
(233, 15, 1, 1, 2),
(234, 15, 2, 1, 3),
(235, 15, 3, 1, 1),
(236, 15, 1, 2, 5),
(237, 15, 2, 2, 6),
(238, 15, 3, 2, 4),
(239, 15, 1, 3, 8),
(240, 15, 2, 3, 9),
(241, 15, 3, 3, 7),
(242, 15, 1, 4, 12),
(243, 15, 2, 4, 11),
(244, 15, 3, 4, 10),
(245, 15, 1, 5, 14),
(246, 15, 2, 5, 13),
(247, 15, 3, 5, 15),
(248, 16, 1, 1, 2),
(249, 16, 2, 1, 2),
(250, 16, 3, 1, 2),
(251, 16, 1, 2, 4),
(252, 16, 2, 2, 4),
(253, 16, 3, 2, 4),
(254, 16, 1, 3, 9),
(255, 16, 2, 3, 9),
(256, 16, 3, 3, 9),
(257, 16, 1, 4, 11),
(258, 16, 2, 4, 11),
(259, 16, 3, 4, 11),
(260, 16, 1, 5, 13),
(261, 16, 2, 5, 13),
(262, 16, 3, 5, 13),
(263, 17, 1, 1, 3),
(264, 17, 2, 1, 3),
(265, 17, 3, 1, 3),
(266, 17, 1, 2, 5),
(267, 17, 2, 2, 5),
(268, 17, 3, 2, 5),
(269, 17, 1, 3, 7),
(270, 17, 2, 3, 7),
(271, 17, 3, 3, 7),
(272, 17, 1, 4, 12),
(273, 17, 2, 4, 12),
(274, 17, 3, 4, 12),
(275, 17, 1, 5, 14),
(276, 17, 2, 5, 14),
(277, 17, 3, 5, 14),
(278, 18, 1, 1, 3),
(279, 18, 2, 1, 2),
(280, 18, 3, 1, 1),
(281, 18, 1, 2, 6),
(282, 18, 2, 2, 5),
(283, 18, 3, 2, 4),
(284, 18, 1, 3, 9),
(285, 18, 2, 3, 8),
(286, 18, 3, 3, 7),
(287, 18, 1, 4, 12),
(288, 18, 2, 4, 11),
(289, 18, 3, 4, 10),
(290, 18, 1, 5, 15),
(291, 18, 2, 5, 14),
(292, 18, 3, 5, 13),
(293, 19, 1, 1, 1),
(294, 19, 2, 1, 3),
(295, 19, 3, 1, 2),
(296, 19, 1, 2, 4),
(297, 19, 2, 2, 6),
(298, 19, 3, 2, 5),
(299, 19, 1, 3, 7),
(300, 19, 2, 3, 9),
(301, 19, 3, 3, 8),
(302, 19, 1, 4, 10),
(303, 19, 2, 4, 12),
(304, 19, 3, 4, 11),
(305, 19, 1, 5, 13),
(306, 19, 2, 5, 15),
(307, 19, 3, 5, 14),
(308, 20, 1, 1, 3),
(309, 20, 2, 1, 2),
(310, 20, 3, 1, 1),
(311, 20, 1, 2, 6),
(312, 20, 2, 2, 5),
(313, 20, 3, 2, 4),
(314, 20, 1, 3, 9),
(315, 20, 2, 3, 8),
(316, 20, 3, 3, 7),
(317, 20, 1, 4, 12),
(318, 20, 2, 4, 11),
(319, 20, 3, 4, 10),
(320, 20, 1, 5, 15),
(321, 20, 2, 5, 14),
(322, 20, 3, 5, 13),
(323, 21, 1, 1, 3),
(324, 21, 2, 1, 3),
(325, 21, 3, 1, 3),
(326, 21, 1, 2, 5),
(327, 21, 2, 2, 5),
(328, 21, 3, 2, 5),
(329, 21, 1, 3, 7),
(330, 21, 2, 3, 7),
(331, 21, 3, 3, 7),
(332, 21, 1, 4, 12),
(333, 21, 2, 4, 12),
(334, 21, 3, 4, 12),
(335, 21, 1, 5, 14),
(336, 21, 2, 5, 14),
(337, 21, 3, 5, 14),
(338, 22, 1, 1, 1),
(339, 22, 2, 1, 2),
(340, 22, 3, 1, 3),
(341, 22, 1, 2, 5),
(342, 22, 2, 2, 4),
(343, 22, 3, 2, 6),
(344, 22, 1, 3, 9),
(345, 22, 2, 3, 7),
(346, 22, 3, 3, 8),
(347, 22, 1, 4, 10),
(348, 22, 2, 4, 11),
(349, 22, 3, 4, 10),
(350, 22, 1, 5, 13),
(351, 22, 2, 5, 15),
(352, 22, 3, 5, 14),
(353, 23, 1, 1, 1),
(354, 23, 2, 1, 2),
(355, 23, 3, 1, 3),
(356, 23, 1, 2, 5),
(357, 23, 2, 2, 4),
(358, 23, 3, 2, 6),
(359, 23, 1, 3, 9),
(360, 23, 2, 3, 7),
(361, 23, 3, 3, 8),
(362, 23, 1, 4, 10),
(363, 23, 2, 4, 11),
(364, 23, 3, 4, 10),
(365, 23, 1, 5, 13),
(366, 23, 2, 5, 15),
(367, 23, 3, 5, 14),
(368, 24, 1, 1, 1),
(369, 24, 2, 1, 2),
(370, 24, 3, 1, 1),
(371, 24, 1, 2, 4),
(372, 24, 2, 2, 6),
(373, 24, 3, 2, 4),
(374, 24, 1, 3, 7),
(375, 24, 2, 3, 8),
(376, 24, 3, 3, 7),
(377, 24, 1, 4, 10),
(378, 24, 2, 4, 12),
(379, 24, 3, 4, 10),
(380, 24, 1, 5, 13),
(381, 24, 2, 5, 15),
(382, 24, 3, 5, 13),
(383, 25, 1, 1, 3),
(384, 25, 2, 1, 1),
(385, 25, 3, 1, 2),
(386, 25, 1, 2, 6),
(387, 25, 2, 2, 4),
(388, 25, 3, 2, 5),
(389, 25, 1, 3, 9),
(390, 25, 2, 3, 7),
(391, 25, 3, 3, 8),
(392, 25, 1, 4, 12),
(393, 25, 2, 4, 10),
(394, 25, 3, 4, 11),
(395, 25, 1, 5, 15),
(396, 25, 2, 5, 13),
(397, 25, 3, 5, 14),
(652, 26, 1, 1, NULL),
(653, 26, 2, 1, NULL),
(654, 26, 3, 1, NULL),
(655, 26, 1, 2, NULL),
(656, 26, 2, 2, NULL),
(657, 26, 3, 2, NULL),
(658, 26, 1, 3, NULL),
(659, 26, 2, 3, NULL),
(660, 26, 3, 3, NULL),
(661, 26, 1, 4, NULL),
(662, 26, 2, 4, NULL),
(663, 26, 3, 4, NULL),
(664, 26, 1, 5, NULL),
(665, 26, 2, 5, NULL),
(666, 26, 3, 5, NULL),
(667, 27, 1, 1, 1),
(668, 27, 2, 1, 2),
(669, 27, 3, 1, 3),
(670, 27, 1, 2, 5),
(671, 27, 2, 2, 5),
(672, 27, 3, 2, 6),
(673, 27, 1, 3, 7),
(674, 27, 2, 3, 8),
(675, 27, 3, 3, 9),
(676, 27, 1, 4, 10),
(677, 27, 2, 4, 11),
(678, 27, 3, 4, 12),
(679, 27, 1, 5, 13),
(680, 27, 2, 5, 14),
(681, 27, 3, 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sektor`
--

CREATE TABLE `tb_sektor` (
  `id_sektor` int(11) NOT NULL,
  `nama_sektor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sektor`
--

INSERT INTO `tb_sektor` (`id_sektor`, `nama_sektor`) VALUES
(1, 'Pemukiman'),
(2, 'Infrastuktur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tb_bencana`
--
ALTER TABLE `tb_bencana`
  ADD PRIMARY KEY (`id_bencana`),
  ADD KEY `id_jenis` (`id_jenis`,`id_sektor`,`id_alternatif`);

--
-- Indexes for table `tb_bencana_detail`
--
ALTER TABLE `tb_bencana_detail`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `id_bencana` (`id_bencana`,`id_kriteria`,`id_crips`),
  ADD KEY `id_bencana_2` (`id_bencana`),
  ADD KEY `id_kriteria` (`id_kriteria`,`id_crips`);

--
-- Indexes for table `tb_crips`
--
ALTER TABLE `tb_crips`
  ADD PRIMARY KEY (`id_crips`),
  ADD KEY `nama_kriteria` (`nama_kriteria`);

--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `kode_kriteria` (`kode_kriteria`),
  ADD KEY `nama_kriteria` (`nama_kriteria`);

--
-- Indexes for table `tb_options`
--
ALTER TABLE `tb_options`
  ADD PRIMARY KEY (`option_name`);

--
-- Indexes for table `tb_pola`
--
ALTER TABLE `tb_pola`
  ADD PRIMARY KEY (`id_pola`),
  ADD KEY `id_jenis` (`id_jenis`,`id_sektor`);

--
-- Indexes for table `tb_pola_detail`
--
ALTER TABLE `tb_pola_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_alternatif` (`id_alternatif`,`id_kriteria`,`id_crips`);

--
-- Indexes for table `tb_sektor`
--
ALTER TABLE `tb_sektor`
  ADD PRIMARY KEY (`id_sektor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_bencana`
--
ALTER TABLE `tb_bencana`
  MODIFY `id_bencana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_bencana_detail`
--
ALTER TABLE `tb_bencana_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tb_crips`
--
ALTER TABLE `tb_crips`
  MODIFY `id_crips` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pola`
--
ALTER TABLE `tb_pola`
  MODIFY `id_pola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_pola_detail`
--
ALTER TABLE `tb_pola_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=682;

--
-- AUTO_INCREMENT for table `tb_sektor`
--
ALTER TABLE `tb_sektor`
  MODIFY `id_sektor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
