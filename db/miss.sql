SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'th_ajaran', '{\"th_ajaran\":\"3\"}');

DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `photo` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `guru` (`id`, `user_id`, `nama`, `kode`, `gender`, `alamat`, `hp`, `photo`, `created`, `updated`) VALUES
(5, 424, 'Iwan Safrudin, S.Kom', 'aw', 1, 'tulakan donorojo jepara', '085758700025', 0, '2019-12-03 14:46:12', '2019-12-03 14:46:12');

DROP TABLE IF EXISTS `guru_has_mapel`;
CREATE TABLE `guru_has_mapel` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `th_ajaran_id` int(11) NOT NULL,
  `hari` int(11) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `guru_has_mapel` (`id`, `guru_id`, `mapel_id`, `kelas_id`, `th_ajaran_id`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(5, 5, 6, 11, 3, 2, '15:00:00', '18:00:00'),
(6, 5, 2, 11, 3, 3, '02:58:00', '05:58:00');

DROP TABLE IF EXISTS `jurnal`;
CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `materi` longtext NOT NULL,
  `guru_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `jurnal` (`id`, `materi`, `guru_id`, `mapel_id`, `tanggal`, `kode`) VALUES
(1, 'kisah teladan Rasulullah', 5, 2, '2019-12-04', '5_2_2019-12-04_02:58:00_05:58:00');

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kelas` (`id`, `nama`) VALUES
(11, 'X AKL 1'),
(12, 'X AKL 2'),
(4, 'X BDP 1'),
(5, 'X BDP 2'),
(6, 'X OTKP 1'),
(7, 'X OTKP 2'),
(8, 'X OTKP 3'),
(1, 'X RPL 1'),
(2, 'X RPL 2'),
(9, 'X TBSM 1'),
(10, 'X TBSM 2'),
(22, 'XI AKL 1'),
(23, 'XI AKL 2'),
(15, 'XI BDP 1'),
(16, 'XI BDP 2'),
(19, 'XI OTKP 1'),
(20, 'XI OTKP 2'),
(21, 'XI OTKP 3'),
(13, 'XI RPL 1'),
(14, 'XI RPL 2'),
(17, 'XI TBSM 1'),
(18, 'XI TBSM 2'),
(31, 'XII AKL 1'),
(32, 'XII AKL 2'),
(29, 'XII BDP 1'),
(30, 'XII BDP 2'),
(24, 'XII OTKP 1'),
(25, 'XII OTKP 2'),
(26, 'XII OTKP 3'),
(27, 'XII RPL 1'),
(28, 'XII RPL 2'),
(33, 'XII TBSM 1'),
(34, 'XII TBSM 2');

DROP TABLE IF EXISTS `mapel`;
CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `mapel` (`id`, `nama`) VALUES
(2, 'Pendidikan Agama Islam'),
(3, 'Ppkn'),
(4, 'Matematika'),
(5, 'Pemrograman Dasar'),
(6, 'Spreadsheet');

DROP TABLE IF EXISTS `presensi`;
CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `th_ajaran_id` int(11) NOT NULL,
  `keterangan` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `presensi` (`id`, `siswa_id`, `kelas_id`, `th_ajaran_id`, `keterangan`, `tanggal`) VALUES
(1, 461, 11, 3, 1, '2019-12-03'),
(2, 462, 11, 3, 1, '2019-12-03'),
(3, 463, 11, 3, 1, '2019-12-03'),
(4, 464, 11, 3, 1, '2019-12-03'),
(5, 465, 11, 3, 1, '2019-12-03'),
(6, 466, 11, 3, 1, '2019-12-03'),
(7, 467, 11, 3, 1, '2019-12-03'),
(8, 468, 11, 3, 1, '2019-12-03'),
(9, 469, 11, 3, 1, '2019-12-03'),
(10, 470, 11, 3, 1, '2019-12-03'),
(11, 471, 11, 3, 1, '2019-12-03'),
(12, 472, 11, 3, 2, '2019-12-03'),
(13, 473, 11, 3, 1, '2019-12-03'),
(14, 474, 11, 3, 1, '2019-12-03'),
(15, 475, 11, 3, 1, '2019-12-03'),
(16, 476, 11, 3, 1, '2019-12-03'),
(17, 477, 11, 3, 1, '2019-12-03'),
(18, 478, 11, 3, 1, '2019-12-03'),
(19, 479, 11, 3, 1, '2019-12-03'),
(20, 480, 11, 3, 3, '2019-12-03'),
(21, 481, 11, 3, 1, '2019-12-03'),
(22, 482, 11, 3, 1, '2019-12-03'),
(23, 483, 11, 3, 1, '2019-12-03'),
(24, 484, 11, 3, 1, '2019-12-03'),
(25, 485, 11, 3, 1, '2019-12-03'),
(26, 486, 11, 3, 1, '2019-12-03'),
(27, 487, 11, 3, 1, '2019-12-03'),
(28, 488, 11, 3, 1, '2019-12-03'),
(29, 489, 11, 3, 1, '2019-12-03'),
(30, 490, 11, 3, 1, '2019-12-03'),
(31, 491, 11, 3, 1, '2019-12-03'),
(32, 492, 11, 3, 1, '2019-12-03'),
(33, 493, 11, 3, 2, '2019-12-03'),
(34, 494, 11, 3, 1, '2019-12-03'),
(35, 495, 11, 3, 1, '2019-12-03'),
(36, 496, 11, 3, 1, '2019-12-03'),
(37, 461, 11, 3, 0, '2019-12-04'),
(38, 462, 11, 3, 0, '2019-12-04'),
(39, 463, 11, 3, 0, '2019-12-04'),
(40, 464, 11, 3, 0, '2019-12-04'),
(41, 465, 11, 3, 0, '2019-12-04'),
(42, 466, 11, 3, 0, '2019-12-04'),
(43, 467, 11, 3, 0, '2019-12-04'),
(44, 468, 11, 3, 0, '2019-12-04'),
(45, 469, 11, 3, 0, '2019-12-04'),
(46, 470, 11, 3, 0, '2019-12-04'),
(47, 471, 11, 3, 0, '2019-12-04'),
(48, 472, 11, 3, 0, '2019-12-04'),
(49, 473, 11, 3, 0, '2019-12-04'),
(50, 474, 11, 3, 0, '2019-12-04'),
(51, 475, 11, 3, 0, '2019-12-04'),
(52, 476, 11, 3, 0, '2019-12-04'),
(53, 477, 11, 3, 0, '2019-12-04'),
(54, 478, 11, 3, 0, '2019-12-04'),
(55, 479, 11, 3, 0, '2019-12-04'),
(56, 480, 11, 3, 0, '2019-12-04'),
(57, 481, 11, 3, 0, '2019-12-04'),
(58, 482, 11, 3, 0, '2019-12-04'),
(59, 483, 11, 3, 0, '2019-12-04'),
(60, 484, 11, 3, 0, '2019-12-04'),
(61, 485, 11, 3, 0, '2019-12-04'),
(62, 486, 11, 3, 0, '2019-12-04'),
(63, 487, 11, 3, 0, '2019-12-04'),
(64, 488, 11, 3, 0, '2019-12-04'),
(65, 489, 11, 3, 0, '2019-12-04'),
(66, 490, 11, 3, 0, '2019-12-04'),
(67, 491, 11, 3, 0, '2019-12-04'),
(68, 492, 11, 3, 0, '2019-12-04'),
(69, 493, 11, 3, 0, '2019-12-04'),
(70, 494, 11, 3, 0, '2019-12-04'),
(71, 495, 11, 3, 0, '2019-12-04'),
(72, 496, 11, 3, 0, '2019-12-04');

DROP TABLE IF EXISTS `presensi_has_mapel`;
CREATE TABLE `presensi_has_mapel` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `th_ajaran_id` int(11) NOT NULL,
  `keterangan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `guru_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `presensi_has_mapel` (`id`, `siswa_id`, `kelas_id`, `th_ajaran_id`, `keterangan`, `tanggal`, `guru_id`, `mapel_id`, `kode`) VALUES
(205, 461, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(206, 462, 11, 3, 3, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(207, 463, 11, 3, 2, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(208, 464, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(209, 465, 11, 3, 2, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(210, 466, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(211, 467, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(212, 468, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(213, 469, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(214, 470, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(215, 471, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(216, 472, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(217, 473, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(218, 474, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(219, 475, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(220, 476, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(221, 477, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(222, 478, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(223, 479, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(224, 480, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(225, 481, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(226, 482, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(227, 483, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(228, 484, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(229, 485, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(230, 486, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(231, 487, 11, 3, 2, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(232, 488, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(233, 489, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(234, 490, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(235, 491, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(236, 492, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(237, 493, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(238, 494, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(239, 495, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(240, 496, 11, 3, 1, '2019-12-03', 5, 6, '5_6_2019-12-03_15:00:00_18:00:00'),
(241, 461, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(242, 462, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(243, 463, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(244, 464, 11, 3, 2, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(245, 465, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(246, 466, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(247, 467, 11, 3, 2, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(248, 468, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(249, 469, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(250, 470, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(251, 471, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(252, 472, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(253, 473, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(254, 474, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(255, 475, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(256, 476, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(257, 477, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(258, 478, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(259, 479, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(260, 480, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(261, 481, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(262, 482, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(263, 483, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(264, 484, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(265, 485, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(266, 486, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(267, 487, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(268, 488, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(269, 489, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(270, 490, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(271, 491, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(272, 492, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(273, 493, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(274, 494, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(275, 495, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00'),
(276, 496, 11, 3, 1, '2019-12-04', 5, 2, '5_2_2019-12-04_02:58:00_05:58:00');

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) NOT NULL,
  `th_ajaran_id` int(11) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `agama` tinyint(1) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `tmpt_lhr` varchar(255) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `siswa` (`id`, `user_id`, `kelas_id`, `th_ajaran_id`, `angkatan`, `nama`, `nis`, `nisn`, `gender`, `agama`, `photo`, `tmpt_lhr`, `tgl_lhr`, `alamat`) VALUES
(461, 388, 11, 3, 3, 'ADITYA DAFIT SAPUTRA', '2861', '2861', 1, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(462, 389, 11, 3, 3, 'AISA FATMAJAYANTI', '2862', '2862', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(463, 390, 11, 3, 3, 'ALFINA OSSIA EFILIANI', '2863', '2863', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(464, 391, 11, 3, 3, 'AMELIA FITRIYANI', '2864', '2864', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(465, 392, 11, 3, 3, 'AMELLIA PUSPITASARI', '2865', '2865', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(466, 393, 11, 3, 3, 'ANNISA ZULKIF SYEFIRA', '2866', '2866', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(467, 394, 11, 3, 3, 'ARIF SYAIFUDIN', '2867', '2867', 1, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(468, 395, 11, 3, 3, 'AULIA FATMAWATI', '2868', '2868', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(469, 396, 11, 3, 3, 'AULIA SAFITRI', '2869', '2869', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(470, 397, 11, 3, 3, 'DEVA ATALIA ZAHRA', '2870', '2870', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(471, 398, 11, 3, 3, 'DEVI ATALIA ZAHRA', '2871', '2871', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(472, 399, 11, 3, 3, 'DIAN SEPTIYANI', '2872', '2872', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(473, 400, 11, 3, 3, 'EKA WAHYU LINDASARI', '2873', '2873', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(474, 401, 11, 3, 3, 'ELSYA RIZKIYATUSSAIDAH', '2874', '2874', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(475, 402, 11, 3, 3, 'ENDHIS VIVIENTHI', '2875', '2875', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(476, 403, 11, 3, 3, 'ERMANDA PUTRI SENDANG FERYANA', '2876', '2876', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(477, 404, 11, 3, 3, 'EUFANY AGUSTINA PURNOMO', '2877', '2877', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(478, 405, 11, 3, 3, 'EVA NOVITASARI', '2878', '2878', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(479, 406, 11, 3, 3, 'FEBY SETYANINGRUM', '2879', '2879', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(480, 407, 11, 3, 3, 'HELMI FERIYAWAN', '2880', '2880', 1, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(481, 408, 11, 3, 3, 'ILHAM ADI SANTOSO', '2881', '2881', 1, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(482, 409, 11, 3, 3, 'IMRONAH NUR LAILIYAH', '2882', '2882', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(483, 410, 11, 3, 3, 'KARISA ELVARIA MORELLA', '2883', '2883', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(484, 411, 11, 3, 3, 'MUHAMMAD ABDUL MUIZ ATTAR MIDHI', '2884', '2884', 1, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(485, 412, 11, 3, 3, 'MUHAMMAD NOOR HAFID', '2885', '2885', 1, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(486, 413, 11, 3, 3, 'NAILA SYAKHIROTUL RIZKIYAH', '2886', '2886', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(487, 414, 11, 3, 3, 'NILA ARUM SHOLIKHAH', '2887', '2887', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(488, 415, 11, 3, 3, 'NOR IVANI CHOIRUN NISA', '2888', '2888', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(489, 416, 11, 3, 3, 'PUTRI WAHYU NINGSIH', '2889', '2889', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(490, 417, 11, 3, 3, 'REIKHA SALMA ANDINI', '2890', '2890', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(491, 418, 11, 3, 3, 'RIFKHA HARWIYANA PUTRI', '2891', '2891', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(492, 419, 11, 3, 3, 'RIZTY AMINATUS SA\'ADAH', '2892', '2892', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(493, 420, 11, 3, 3, 'SEPTI PUTRI NOR QOMARIYAH', '2893', '2893', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(494, 421, 11, 3, 3, 'SRI MIRANDA', '2894', '2894', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(495, 422, 11, 3, 3, 'TRIYANI MULYANI', '2895', '2895', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri'),
(496, 423, 11, 3, 3, 'WAHYU NAILAMAHARANI', '2896', '2896', 0, 1, '', 'Jepara', '0000-00-00', 'Bangsri');

DROP TABLE IF EXISTS `th_ajaran`;
CREATE TABLE `th_ajaran` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `th_ajaran` (`id`, `title`) VALUES
(1, '2017-2018'),
(2, '2018-2019'),
(3, '2019-2020');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `username`, `password`, `email`, `token`, `active`, `created`, `updated`) VALUES
(1, 'root', '$2y$10$C3zyhmbvnu7vD0DS.xjJT.RMTOp4oTDEV9/7UFljdIz.bOBsX6NPG', 'iwan@gmail.com', '', 0, '2019-09-25 20:42:39', '2019-09-26 02:32:42'),
(388, '2861', '$2y$10$Q7TuZaHttpPJFy7U5D18GOHGh0lGrp5doBoAE7OOc8c0RLG1mYs4i', 'info@gmail.com', '', 0, '2019-12-03 14:44:22', '2019-12-04 02:05:32'),
(389, '2862', '$2y$10$MCEn1JoLivS1CKXAFEH9d.4W1lFto3M5emb3YCjis2afVMPBMI98O', '-', '', 0, '2019-12-03 14:44:22', '2019-12-03 14:44:22'),
(390, '2863', '$2y$10$GmqoJR6FmO6VIcMWI3n9UesjSblqTY.dcpkdi4RM3szL4hsd/pgRq', '-', '', 0, '2019-12-03 14:44:22', '2019-12-03 14:44:22'),
(391, '2864', '$2y$10$N0gSzjrhuUmD3wPCCTz9juSiTNLa.Efmi9ymMmmSWjWf9gSIBITzi', '-', '', 0, '2019-12-03 14:44:22', '2019-12-03 14:44:22'),
(392, '2865', '$2y$10$KHpYugwhhrjvJoYVS37XMuFxi8ibnnrUZVa8uIUygEMxPfAlfVMVS', '-', '', 0, '2019-12-03 14:44:22', '2019-12-03 14:44:22'),
(393, '2866', '$2y$10$nZKXVKBoh7RuXz4WuneKnetQen8Hjnb5vq12HcWdaFlPdEUllTtG2', '-', '', 0, '2019-12-03 14:44:22', '2019-12-03 14:44:22'),
(394, '2867', '$2y$10$JBo83SPPL8kQRSmpeY4eVeiWJszEPLTOWjVEe8nWk4p6zI7o7hl1q', '-', '', 0, '2019-12-03 14:44:22', '2019-12-03 14:44:22'),
(395, '2868', '$2y$10$oCMPYkl5kTsP8vjLJTHxy.tsXJfyxI2pQMSydiIrW4y86tiJbQ2iC', '-', '', 0, '2019-12-03 14:44:22', '2019-12-03 14:44:22'),
(396, '2869', '$2y$10$rCzI72C6RaLlTjJKKKSeouMvKNRP8W9lvX89rKYGK.1QBtOb4NHUG', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(397, '2870', '$2y$10$jYd8hCm.HHVhxNHiOJ1RguqZpo9EjamsRAYV4xISzTP8BcBSkSzuq', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(398, '2871', '$2y$10$u4RUFeHOQanFDCehiKvyG.yvtrqpa41pJb2hcfrmI.DDjN91sQ1my', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(399, '2872', '$2y$10$Sywy747GpW8w/TQRFA1baeWov2iK72sBGYpNTBjZm8OC2xjanOEwa', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(400, '2873', '$2y$10$mnPPWvmU47i/6i/LH8o19OkKKLcGxYdqgR6cL/M.fREHOo6hkbXyS', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(401, '2874', '$2y$10$SWX/YiRVAmzjf5DaHf1rd.I0JYnuumRI3m7zuCVwmVwDdY7l66NqS', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(402, '2875', '$2y$10$6Ylpa1Kq3yGxUYCNCMpGGefQr3kfhvlJvYcddrbpjO0TA8Or9./e.', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(403, '2876', '$2y$10$MvEoBwZgMBlrWFyRJkz9LOCXX1JKJIc/0nEM.yOs6Oh11SpGiuY/G', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(404, '2877', '$2y$10$dXSLSaxOT/nVNypieG3uFOGTCjk9AGjqprM97RhbC0uwzva19S8LO', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(405, '2878', '$2y$10$gSzfDEARmUPtREEswZcvCuMPBFBhVr/KDqN5RCKFTUMtiThsUQK9i', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(406, '2879', '$2y$10$CtXtcE06hE0WoYujkssWC.qgWtsjOlhBanRt7coBQhIoJ4GnhYJoO', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(407, '2880', '$2y$10$NC2AqBvSdBE2f2527PIJOem4R78nzwJUwGM1SCbvxhPQRjqlihqDe', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(408, '2881', '$2y$10$UHhC3GmJaFMbKaJpWDhCVuFzICWHHmqzhSQRVonAp02vlN1vVmOpu', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(409, '2882', '$2y$10$UaohW7SHSNNqaBTafXCxge.YI3DyWj76unUW7kmRFcQZ.Zb3KgEJu', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(410, '2883', '$2y$10$gc5b8x1mx9Pvpus3Gy4wHe52mfouRiziGcY5yVcMEDtxQPr6mhpLS', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(411, '2884', '$2y$10$lcjGGOXVjea7zfm.vb0vA.3hHgbMB2zC8l0/FPJqYm1iJYz.sk.TW', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(412, '2885', '$2y$10$5FvnCSVIFZgD8IkxVy1a/OUncQx3aaG6tyCFDBY.h7IFcUf1VWPmm', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(413, '2886', '$2y$10$J1rEN.Pgl2EWmQJEM8IBm.9SFGC2AlaJdRLDaVfzKLv89UFkfdpli', '-', '', 0, '2019-12-03 14:44:23', '2019-12-03 14:44:23'),
(414, '2887', '$2y$10$bx/8iw8V0zHTeALc5xGQMOoJXIpJeCESnJSz87nccdU2XrfxHLuly', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(415, '2888', '$2y$10$S/EWR034RRGx5q/s596/IeMed3CJTPzGt6NKNpSiourFuAjxHntGG', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(416, '2889', '$2y$10$.H2kX94EbKEXx.w9ux2Fn.QIiRq716pxlJXT56JzfHLnTyj.zkdMC', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(417, '2890', '$2y$10$JfngQaN61LdUlLLt0LajCe2CnK25zENNqZuZChg1mUNUv0dvaqur2', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(418, '2891', '$2y$10$GvV7mHS6M7Onur5Hl1qaQ.hoJvJ/Tcqu.sYy/zGOlvuvmRIlC6HIG', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(419, '2892', '$2y$10$Icm4OOfwy9q9gFkTEvxF3O88I.uuYuKNMGJ48/KkVzJ5RQDfIEVg6', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(420, '2893', '$2y$10$ojayKC17e1kKQXzNdaI0JuysSn5cNwfyv7zpTHjmAmp40oQpoI/pm', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(421, '2894', '$2y$10$9J1xW6aCKSo.tNoZmS8L5uisW8wPG2OznYWfj/MdGjDekqOcKD/O2', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(422, '2895', '$2y$10$TvrXjqcnlXtokWd6j0EHxOc7C2dYtVJB.NKVak2xGLzT48toC7cQC', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(423, '2896', '$2y$10$ddgvP0XBWymCDFpSWgtlRO4T5mQq4r3muZ29Q9mBNiuUJV1yvHfsa', '-', '', 0, '2019-12-03 14:44:24', '2019-12-03 14:44:24'),
(424, 'aw', '$2y$10$Fzu514omduDNAHDelDshNO7l6Tm3E6KfQMFKWn9ngs2r5h7/vDYIO', 'iwansafr@gmail.com', '', 0, '2019-12-03 14:46:12', '2019-12-03 14:50:43');

DROP TABLE IF EXISTS `user_has_role`;
CREATE TABLE `user_has_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_has_role` (`id`, `user_id`, `user_role_id`) VALUES
(1, 1, 1),
(78, 388, 4),
(79, 389, 4),
(80, 390, 4),
(81, 391, 4),
(82, 392, 4),
(83, 393, 4),
(84, 394, 4),
(85, 395, 4),
(86, 396, 4),
(87, 397, 4),
(88, 398, 4),
(89, 399, 4),
(90, 400, 4),
(91, 401, 4),
(92, 402, 4),
(93, 403, 4),
(94, 404, 4),
(95, 405, 4),
(96, 406, 4),
(97, 407, 4),
(98, 408, 4),
(99, 409, 4),
(100, 410, 4),
(101, 411, 4),
(102, 412, 4),
(103, 413, 4),
(104, 414, 4),
(105, 415, 4),
(106, 416, 4),
(107, 417, 4),
(108, 418, 4),
(109, 419, 4),
(110, 420, 4),
(111, 421, 4),
(112, 422, 4),
(113, 423, 4),
(114, 424, 3),
(115, 388, 5);

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `level` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_role` (`id`, `title`, `description`, `level`, `created`, `updated`) VALUES
(1, 'admin', 'user untuk admin', 1, '2019-09-25 18:53:20', '2019-09-25 18:53:20'),
(2, 'petugas', 'user untuk petugas', 2, '2019-09-25 18:54:19', '2019-09-25 19:28:51'),
(3, 'guru', 'akun untuk guru', 10, '2019-09-25 22:16:47', '2019-09-25 22:16:47'),
(4, 'siswa', 'akun untuk siswa', 15, '2019-10-08 13:10:46', '2019-10-08 13:10:46'),
(5, 'Ketua Kelas', 'akun untuk ketua kelas', 13, '2019-12-04 02:07:47', '2019-12-04 02:07:47');


ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `guru_has_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `mapel_id` (`mapel_id`),
  ADD KEY `guru_has_mapel_ibfk_3` (`kelas_id`),
  ADD KEY `th_ajaran_id` (`th_ajaran_id`);

ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `th_ajaran_id` (`th_ajaran_id`);

ALTER TABLE `presensi_has_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `th_ajaran_id` (`th_ajaran_id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `mapel_id` (`mapel_id`);

ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `th_ajaran_id` (`th_ajaran_id`),
  ADD KEY `angkatan` (`angkatan`);

ALTER TABLE `th_ajaran`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `user_has_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_role_id` (`user_role_id`);

ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `guru_has_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
ALTER TABLE `presensi_has_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=497;
ALTER TABLE `th_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;
ALTER TABLE `user_has_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_ibfk_3` FOREIGN KEY (`th_ajaran_id`) REFERENCES `th_ajaran` (`id`);

ALTER TABLE `presensi_has_mapel`
  ADD CONSTRAINT `presensi_has_mapel_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_has_mapel_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_has_mapel_ibfk_3` FOREIGN KEY (`th_ajaran_id`) REFERENCES `th_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_has_mapel_ibfk_4` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presensi_has_mapel_ibfk_5` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`th_ajaran_id`) REFERENCES `th_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_4` FOREIGN KEY (`angkatan`) REFERENCES `th_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
