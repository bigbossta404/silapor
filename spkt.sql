-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 06:58 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkt`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_sttlp`
--

CREATE TABLE `aktivitas_sttlp` (
  `id_aktivitas` int(11) NOT NULL,
  `tgl_proses` datetime DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `proses` varchar(20) DEFAULT NULL,
  `id_sttlp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aktivitas_sttlp`
--

INSERT INTO `aktivitas_sttlp` (`id_aktivitas`, `tgl_proses`, `ket`, `proses`, `id_sttlp`) VALUES
(1, '2021-08-01 17:10:07', NULL, 'ditolak', 2),
(2, '2021-08-13 17:10:14', NULL, 'selesai', 3),
(3, '2021-08-19 17:10:19', 'Laporan tidak jelas seperti hidup anda, hiks', 'ditolak', 6),
(4, '2021-10-01 23:42:12', 'Duit dulu dong kalo mau jalan, muehehe', 'terkirim', 11),
(5, '2021-08-17 18:28:05', NULL, 'selesai', 15),
(6, '2021-10-10 19:58:05', NULL, 'terkirim', 28),
(18, '2021-10-06 22:53:50', 'Sudah dilakukan olah tkp', 'proses', 40),
(19, '2021-10-15 22:49:57', 'Kurang bukti, aman terkendali kok', 'ditolak', 41),
(20, '2021-11-12 19:59:53', NULL, 'terkirim', 42),
(21, '2021-11-28 19:56:47', '', 'terkirim', 44),
(22, '2021-11-29 19:23:32', 'Sedang diulas kembali oleh administrasi', 'dievaluasi', 11),
(27, '2021-12-01 21:19:40', '', 'diterima', 28),
(29, '2021-12-01 21:35:14', 'Tolong upload ulang kk', 'diterima', 28),
(30, '2021-12-01 21:36:17', '', 'dievaluasi', 28),
(31, '2021-12-06 20:08:22', NULL, 'proses', 28),
(32, '2021-12-06 20:09:02', NULL, 'proses', 11),
(33, '2021-12-06 20:17:53', NULL, 'diterima', 42),
(34, '2021-12-06 20:19:31', 'Mohon untuk datang ke kantor untuk keterangan lebih lanjut terkait pelaku pendobrakan paksa.', 'diterima', 42);

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `nama_berkas`) VALUES
(1, 'Penangkapan'),
(2, 'Izin'),
(3, 'Kehilangan'),
(4, 'Ganti Kerugian');

-- --------------------------------------------------------

--
-- Table structure for table `pelapor`
--

CREATE TABLE `pelapor` (
  `id_pelapor` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `img_kk` varchar(255) DEFAULT NULL,
  `img_ktp` varchar(255) DEFAULT NULL,
  `jk` enum('Pria','Wanita') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `notelp` varchar(14) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `is_exist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelapor`
--

INSERT INTO `pelapor` (`id_pelapor`, `nama`, `img_kk`, `img_ktp`, `jk`, `alamat`, `notelp`, `email`, `password`, `profile`, `active`, `is_exist`) VALUES
(1, 'Fadhlan Dantiano', '292e75ffa1885691c573f0186dfb7a1a.png', '29396b4cc40b49796fdc3316a3c34d49.jpg', 'Pria', 'Jl. Kesana Kemari Dan Tertawa', '082147483641', 'fakhri123@gmail.com', 'fakhri123', '30de617153a5f93a533ed6aa4bad239d.jpg', 1, 0),
(3, 'wulan lestari', '123781749378419', '6abfc3a23feca3f5ce0c528c3ecf23f7.png', 'Pria', 'Sleman', '0822445245621', 'wulan_lestar@gmail.com', 'uland', '2e4b6613ae12b2cba27cd693deea49d4.jpg', 1, 1),
(4, 'tajudin', NULL, NULL, 'Pria', 'Jl. Sana Sini', '082243245672', 'udin@gmail.com', 'at68w', NULL, 2, 1),
(5, 'juanda', NULL, NULL, NULL, NULL, NULL, 'anda@gmail', 'ji834', NULL, 2, 1),
(6, 'karmila ningsi', NULL, NULL, NULL, NULL, NULL, 'mila@gmail', 'd7d684', NULL, 2, 1),
(7, 'prastio', NULL, NULL, NULL, NULL, NULL, 'pras@gmail', 'ti930w', NULL, 1, 1),
(8, 'sukron', NULL, NULL, NULL, NULL, NULL, 'sukron@gmail', 'suk@8', NULL, 1, 1),
(9, 'risma', NULL, NULL, NULL, NULL, NULL, 'risma@gmail', 'rism34', NULL, 1, 1),
(10, 'kiswan', NULL, NULL, NULL, NULL, NULL, 'kiswn@gmail', 'na8232k', NULL, 1, 1),
(11, 'rina', NULL, NULL, NULL, NULL, NULL, 'rina@gmail', '84rhf', NULL, 1, 1),
(12, 'adidasmawan', NULL, NULL, NULL, NULL, NULL, 'adidas@gmail', '3uahdy', NULL, 1, 1),
(13, 'kartika', NULL, NULL, NULL, NULL, NULL, 'kartika@gmail', '23827k', NULL, 1, 1),
(14, 'abdulah', NULL, NULL, NULL, NULL, NULL, 'abdul@gmail', '121js', NULL, 1, 1),
(15, 'nina', NULL, NULL, NULL, NULL, NULL, 'nina@gmail', '121js', NULL, 1, 1),
(16, 'mujiansyah', NULL, NULL, NULL, NULL, NULL, 'muji_syah@gmail', 'muj21o', NULL, 1, 1),
(17, 'ahmmad fahruroji', NULL, NULL, NULL, NULL, NULL, 'ahmad@gmail', '1212wdsf', NULL, 1, 1),
(18, 'eki prasetiawan', NULL, NULL, NULL, NULL, NULL, 'koko@gmail', '124sdfg', NULL, 1, 1),
(19, 'sigit putra', NULL, NULL, NULL, NULL, NULL, 'sigit@gmail', 'S12ks', NULL, 1, 1),
(20, 'andennin', NULL, NULL, NULL, NULL, NULL, 'andenin@gmail', '23dsfdsg', NULL, 1, 1),
(21, 'urbanus olama', NULL, NULL, NULL, NULL, NULL, 'urbanus_ola@gmail', 'ur46#', NULL, 1, 1),
(22, 'muhamad jodhi', NULL, NULL, NULL, NULL, NULL, 'jodhi@gmail', 'jodhi8we', NULL, 1, 1),
(23, 'siti fatima', NULL, NULL, NULL, NULL, NULL, 'fatime@gmail', 'tima189', NULL, 1, 1),
(24, 'sriwahyu', NULL, NULL, NULL, NULL, NULL, 'sri_wahyu@gmail', 'sri123', NULL, 1, 1),
(25, 'viviandemingu', NULL, NULL, NULL, NULL, NULL, 'vian@gmail', '4jss44', NULL, 1, 1),
(26, 'imam muchlis', NULL, NULL, NULL, NULL, NULL, 'imam@gmail', '1mam#', NULL, 1, 1),
(27, 'ferdian simatupang', NULL, NULL, NULL, NULL, NULL, 'fery@gmail', '2hsdi9', NULL, 1, 1),
(32, 'Yoman', NULL, NULL, NULL, NULL, NULL, 'yoman@gmail', 'yoman', NULL, 1, 1),
(34, 'Rizky PW', 'dasdasasda', NULL, 'Pria', NULL, NULL, 'rizky@gmail.com', 'rizky123', NULL, 1, 1),
(35, 'Supriyanto', NULL, NULL, NULL, NULL, NULL, 'supri@gmail.com', 'supri123', NULL, 1, 1),
(36, 'Nadiem Makarim', NULL, NULL, NULL, NULL, NULL, 'nadiem@gmail.com', 'nadiem123', NULL, 0, 1),
(39, 'adasd', 'da52611ad68f65d70dd6e522d4f795cc.jpg', '41d8fe68239f1a11317a1513d484681b.jpg', NULL, NULL, NULL, 'adas@gmail.com', '12345678', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(2) DEFAULT NULL,
  `is_exist` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `email`, `password`, `active`, `is_exist`) VALUES
(8193002, 'Mahmudin SH', 'mahmudin@gmail.com', 'ma783e3', 1, 1),
(73039593, 'Edi sutrarta', 'edi@gmail.com', 'syy7w29a', 1, 1),
(76100826, 'Imawan,S.H', 'imawan@gmail', '78aui', 1, 1),
(76882921, 'Jono swandito', 'Jono@gmail', 'J990wjeos', 1, 1),
(79283293, 'Antonius sedyo', 'antonius@gmail.com', 'anton123', 1, 1),
(80110914, 'Sukiran', 'sukiran@gmail', 'sU819', 1, 1),
(81718933, 'Nur huda wijayanto', 'wijayanto@gmail', 'Biis933', 1, 1),
(87282393, 'Ade bayu', 'bayu@gmail', '6GuiAuis', 1, 1),
(638199392, 'Suhartono', 'suhartono@gmail', '77wuui9a', 1, 1),
(639292833, 'Suyatno', 'suyatno@gmail', 'a628hdvf', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `proses`
--

CREATE TABLE `proses` (
  `id_proses` int(11) NOT NULL,
  `proses` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`id_proses`, `proses`) VALUES
(0, 'Ditolak'),
(1, 'Terkirim'),
(2, 'Diterima'),
(3, 'Dievaluasi'),
(4, 'Proses'),
(5, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `sttlp`
--

CREATE TABLE `sttlp` (
  `id_sttlp` int(11) NOT NULL,
  `no_lp` varchar(10) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` longtext NOT NULL,
  `id_pelapor` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `id_berkas` int(11) DEFAULT NULL,
  `is_exist` int(11) DEFAULT NULL,
  `tgl_kejadian` datetime DEFAULT NULL,
  `tempat_kejadian` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sttlp`
--

INSERT INTO `sttlp` (`id_sttlp`, `no_lp`, `tanggal`, `keterangan`, `id_pelapor`, `id_petugas`, `id_berkas`, `is_exist`, `tgl_kejadian`, `tempat_kejadian`) VALUES
(1, '012235314', '2019-04-08 00:00:00', 'Membayar denda kerusakan motor yang ditabrak', 1, 638199392, 4, NULL, NULL, NULL),
(2, '013335314', '2019-08-01 00:00:00', 'Korban kehilangan motor didepan rumah sekitar jam 12.00 siang', 3, 8193002, 3, NULL, NULL, NULL),
(3, '0122820415', '2020-03-18 00:00:00', 'Meminta persetujuan untuk mengadakan posyandu kelurahan setempat', 3, 80110914, 2, NULL, NULL, NULL),
(4, 'Lp04', '2020-08-17 00:00:00', 'Mengadakan gotongroyo RT', 4, 638199392, 2, NULL, NULL, NULL),
(5, 'Lp05', '2019-03-06 00:00:00', 'Melakukan pencurian motor', 5, 87282393, 1, NULL, NULL, NULL),
(6, '017397652', '2020-01-16 00:00:00', 'Terjadi pencurian dirumah korban dan tidak ada korban jiwa', 3, 76100826, 3, NULL, NULL, NULL),
(7, 'Lp07', '2020-08-08 00:00:00', 'Pelaku dan teman-teman terlibat dalam perkelahian', 7, 80110914, 1, NULL, NULL, NULL),
(8, 'Lp08', '2020-04-02 00:00:00', 'Korban kehilangan 2 motor dan terjadi pada jam 16:34 sore', 8, 76100826, 3, NULL, NULL, NULL),
(9, 'Lp09', '2020-09-03 00:00:00', 'Menganti kerugian kaca mobil pengunjung hotel tanjung', 9, 87282393, 4, NULL, NULL, NULL),
(10, 'LP010', '2020-10-22 00:00:00', 'Mengadakan rapat RT', 10, 8193002, 2, NULL, NULL, NULL),
(11, '056875341', '2020-06-09 00:00:00', 'Terlibat perkelahian', 3, 79283293, 1, NULL, NULL, NULL),
(12, 'Lp012', '2020-09-11 00:00:00', 'Telah terjadi pencurian barang elektronik (Tv)', 12, 80110914, 1, NULL, NULL, NULL),
(13, 'Lp013', '2020-05-14 00:00:00', 'Kehilangan sepeda', 13, 81718933, 3, NULL, NULL, NULL),
(14, 'Lp014', '2020-03-02 00:00:00', 'Mencoba mencuri motor', 14, 638199392, 1, NULL, NULL, NULL),
(15, 'Lp015', '2020-11-13 00:00:00', 'Terjadi percobaan pembobolan rumah', 3, 80110914, 1, NULL, NULL, NULL),
(16, 'Lp016', '2020-06-20 00:00:00', 'Mengadakan gotongroyo RT', 16, NULL, 2, NULL, NULL, NULL),
(17, 'Lp017', '2020-11-13 00:00:00', 'Menganti rugi motor', 17, 79283293, NULL, NULL, NULL, NULL),
(18, 'Lp018', '2020-10-13 00:00:00', 'Mencoba melakukan pembobolan rumah', 18, NULL, NULL, NULL, NULL, NULL),
(19, 'Lp019', '2020-06-18 00:00:00', 'Kehilangan 2 sepeda', 19, NULL, NULL, NULL, NULL, NULL),
(20, 'Lp020', '2020-09-17 00:00:00', 'Kehilangan barang elektronik(Tv)', 20, NULL, NULL, NULL, NULL, NULL),
(21, 'Lp021', '2020-10-17 00:00:00', 'Mengadakan posyandu RT', 21, 76100826, NULL, NULL, NULL, NULL),
(22, 'Lp022', '2020-07-21 00:00:00', 'Melakukan pencurian motor', 22, 87282393, NULL, NULL, NULL, NULL),
(23, 'Lp023', '2020-09-18 00:00:00', 'Kehilangan sepeda motor', 23, 87282393, NULL, NULL, NULL, NULL),
(24, 'Lp024', '2020-10-28 00:00:00', 'Menganti kerugian mobil', 24, 80110914, NULL, NULL, NULL, NULL),
(25, 'Lp025', '2020-07-20 00:00:00', 'Meresahkan warga sekitar', 25, 80110914, NULL, NULL, NULL, NULL),
(26, 'Lp026', '2020-10-21 00:00:00', 'Mengadakan gotongroyo', 26, 87282393, NULL, NULL, NULL, NULL),
(27, 'LP027', '2020-11-17 00:00:00', 'Terjadi pembobolan', 27, 638199392, NULL, NULL, NULL, NULL),
(28, 'LP28', '2021-10-10 23:35:11', 'Perusakan kandang biawak oleh tetangga menyebalkan', 1, 79283293, 4, NULL, '2021-11-12 01:43:50', 'Gunung Kidul desa karangsono'),
(40, 'LP29', '2021-10-11 01:13:46', 'Ilang sendal swalow di Masjid An-Nur', 1, 81718933, 3, NULL, NULL, NULL),
(41, 'LP30', '2021-10-14 20:18:59', 'Maling kotak amal dimushola', 1, 76100826, 1, NULL, NULL, NULL),
(42, 'LP31', '2021-11-12 23:18:54', 'Salah penangkapan dengan dobrak paksa pintu rumah', 3, 79283293, 4, NULL, '2021-10-30 01:44:16', 'Wonosari Desa Girianyar RT01/RW02'),
(44, 'LP32', '2021-11-28 00:37:49', 'Penjambretan dan perampokan, pelaku dua orang lebih', 1, NULL, NULL, NULL, '2021-11-03 00:00:00', 'Sleman, bangjo jakal'),
(45, '', '0000-00-00 00:00:00', '', NULL, 79283293, NULL, NULL, NULL, NULL),
(46, '', '0000-00-00 00:00:00', '', NULL, 79283293, NULL, NULL, NULL, NULL);

--
-- Triggers `sttlp`
--
DELIMITER $$
CREATE TRIGGER `after_send` AFTER INSERT ON `sttlp` FOR EACH ROW BEGIN
	INSERT INTO aktivitas_sttlp VALUES('',NOW(),'','terkirim',new.id_sttlp);
    END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas_sttlp`
--
ALTER TABLE `aktivitas_sttlp`
  ADD PRIMARY KEY (`id_aktivitas`),
  ADD KEY `id_proses` (`proses`),
  ADD KEY `id_surat` (`id_sttlp`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `pelapor`
--
ALTER TABLE `pelapor`
  ADD PRIMARY KEY (`id_pelapor`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`id_proses`);

--
-- Indexes for table `sttlp`
--
ALTER TABLE `sttlp`
  ADD PRIMARY KEY (`id_sttlp`),
  ADD KEY `id_pelapor` (`id_pelapor`),
  ADD KEY `id_pegawai` (`id_petugas`),
  ADD KEY `id_berkas` (`id_berkas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas_sttlp`
--
ALTER TABLE `aktivitas_sttlp`
  MODIFY `id_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelapor`
--
ALTER TABLE `pelapor`
  MODIFY `id_pelapor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639292834;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sttlp`
--
ALTER TABLE `sttlp`
  MODIFY `id_sttlp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas_sttlp`
--
ALTER TABLE `aktivitas_sttlp`
  ADD CONSTRAINT `aktivitas_sttlp_ibfk_2` FOREIGN KEY (`id_sttlp`) REFERENCES `sttlp` (`id_sttlp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sttlp`
--
ALTER TABLE `sttlp`
  ADD CONSTRAINT `sttlp_ibfk_1` FOREIGN KEY (`id_pelapor`) REFERENCES `pelapor` (`id_pelapor`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sttlp_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sttlp_ibfk_3` FOREIGN KEY (`id_berkas`) REFERENCES `berkas` (`id_berkas`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
