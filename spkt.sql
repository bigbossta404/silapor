-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Feb 2022 pada 05.51
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

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
-- Struktur dari tabel `aktivitas_sttlp`
--

CREATE TABLE `aktivitas_sttlp` (
  `id_aktivitas` int(11) NOT NULL,
  `tgl_proses` datetime DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `proses` varchar(20) DEFAULT NULL,
  `id_sttlp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `nama_berkas`) VALUES
(1, 'Penganiayaan'),
(2, 'Izin'),
(3, 'Kehilangan'),
(4, 'Ganti Kerugian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelapor`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
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
-- Dumping data untuk tabel `petugas`
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
-- Struktur dari tabel `sttlp`
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
-- Trigger `sttlp`
--
DELIMITER $$
CREATE TRIGGER `after_send` AFTER INSERT ON `sttlp` FOR EACH ROW BEGIN
	INSERT INTO aktivitas_sttlp VALUES(NULL,NOW(),'','terkirim',new.id_sttlp);
    END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aktivitas_sttlp`
--
ALTER TABLE `aktivitas_sttlp`
  ADD PRIMARY KEY (`id_aktivitas`),
  ADD KEY `id_surat` (`id_sttlp`);

--
-- Indeks untuk tabel `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indeks untuk tabel `pelapor`
--
ALTER TABLE `pelapor`
  ADD PRIMARY KEY (`id_pelapor`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `sttlp`
--
ALTER TABLE `sttlp`
  ADD PRIMARY KEY (`id_sttlp`),
  ADD KEY `id_pelapor` (`id_pelapor`),
  ADD KEY `id_pegawai` (`id_petugas`),
  ADD KEY `id_berkas` (`id_berkas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aktivitas_sttlp`
--
ALTER TABLE `aktivitas_sttlp`
  MODIFY `id_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pelapor`
--
ALTER TABLE `pelapor`
  MODIFY `id_pelapor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639292834;

--
-- AUTO_INCREMENT untuk tabel `sttlp`
--
ALTER TABLE `sttlp`
  MODIFY `id_sttlp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aktivitas_sttlp`
--
ALTER TABLE `aktivitas_sttlp`
  ADD CONSTRAINT `aktivitas_sttlp_ibfk_2` FOREIGN KEY (`id_sttlp`) REFERENCES `sttlp` (`id_sttlp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sttlp`
--
ALTER TABLE `sttlp`
  ADD CONSTRAINT `sttlp_ibfk_1` FOREIGN KEY (`id_pelapor`) REFERENCES `pelapor` (`id_pelapor`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sttlp_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sttlp_ibfk_3` FOREIGN KEY (`id_berkas`) REFERENCES `berkas` (`id_berkas`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
