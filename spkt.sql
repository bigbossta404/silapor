/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.14-MariaDB : Database - spkt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `aktivitas_surat` */

DROP TABLE IF EXISTS `aktivitas_surat`;

CREATE TABLE `aktivitas_surat` (
  `id_aktivitas` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_proses` datetime DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `id_proses` int(11) DEFAULT NULL,
  `id_surat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aktivitas`),
  KEY `id_proses` (`id_proses`),
  KEY `id_surat` (`id_surat`),
  CONSTRAINT `aktivitas_surat_ibfk_1` FOREIGN KEY (`id_proses`) REFERENCES `proses` (`id_proses`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `aktivitas_surat_ibfk_2` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id_surat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `aktivitas_surat` */

insert  into `aktivitas_surat`(`id_aktivitas`,`tgl_proses`,`ket`,`id_proses`,`id_surat`) values 
(1,'2021-08-01 17:10:07',NULL,5,2),
(2,'2021-08-13 17:10:14',NULL,5,3),
(3,'2021-08-19 17:10:19','Laporan tidak jelas seperti hidup anda, hiks',0,6),
(4,'2021-10-01 23:42:12','Duit dulu dong kalo mau jalan, muehehe',0,11),
(5,'2021-08-17 18:28:05',NULL,5,15),
(6,NULL,'',1,28),
(18,NULL,'',1,40);

/*Table structure for table `berkas` */

DROP TABLE IF EXISTS `berkas`;

CREATE TABLE `berkas` (
  `id_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_berkas` varchar(255) NOT NULL,
  PRIMARY KEY (`id_berkas`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `berkas` */

insert  into `berkas`(`id_berkas`,`nama_berkas`) values 
(1,'Penangkapan'),
(2,'Izin'),
(3,'Kehilangan'),
(4,'Ganti Kerugian');

/*Table structure for table `pelapor` */

DROP TABLE IF EXISTS `pelapor`;

CREATE TABLE `pelapor` (
  `id_pelapor` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `nik` int(20) DEFAULT NULL,
  `skck` int(40) DEFAULT NULL,
  `img_skck` varchar(255) DEFAULT NULL,
  `img_ktp` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `notelp` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `is_exist` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pelapor`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `pelapor` */

insert  into `pelapor`(`id_pelapor`,`nama`,`nik`,`skck`,`img_skck`,`img_ktp`,`tgl_lahir`,`alamat`,`notelp`,`email`,`password`,`profile`,`active`,`is_exist`) values 
(1,'FakhriF',0,NULL,NULL,NULL,NULL,NULL,NULL,'fakhri@gmail','fakhri123','fakhri.jpg',1,1),
(3,'wulan lestari',NULL,2147483647,'123781749378419',NULL,NULL,'Sleman',NULL,'wulan_lest@gmail','uland','',1,1),
(4,'tajudin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'udin@gmail','at68w',NULL,1,1),
(5,'juanda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'anda@gmail','ji834',NULL,1,1),
(6,'karmila ningsi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mila@gmail','d7d684',NULL,1,1),
(7,'prastio',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'pras@gmail','ti930w',NULL,1,1),
(8,'sukron',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'sukron@gmail','suk@8',NULL,1,1),
(9,'risma',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'risma@gmail','rism34',NULL,1,1),
(10,'kiswan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'kiswn@gmail','na8232k',NULL,1,1),
(11,'rina',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'rina@gmail','84rhf',NULL,1,1),
(12,'adidasmawan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'adidas@gmail','3uahdy',NULL,1,1),
(13,'kartika',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'kartika@gmail','23827k',NULL,1,1),
(14,'abdulah',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'abdul@gmail','121js',NULL,1,1),
(15,'nina',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nina@gmail','121js',NULL,1,1),
(16,'mujiansyah',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'muji_syah@gmail','muj21o',NULL,1,1),
(17,'ahmmad fahruroji',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ahmad@gmail','1212wdsf',NULL,1,1),
(18,'eki prasetiawan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'koko@gmail','124sdfg',NULL,1,1),
(19,'sigit putra',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'sigit@gmail','S12ks',NULL,1,1),
(20,'andennin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'andenin@gmail','23dsfdsg',NULL,1,1),
(21,'urbanus olama',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'urbanus_ola@gmail','ur46#',NULL,1,1),
(22,'muhamad jodhi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'jodhi@gmail','jodhi8we',NULL,1,1),
(23,'siti fatima',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'fatime@gmail','tima189',NULL,1,1),
(24,'sriwahyu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'sri_wahyu@gmail','sri123',NULL,1,1),
(25,'viviandemingu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'vian@gmail','4jss44',NULL,1,1),
(26,'imam muchlis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'imam@gmail','1mam#',NULL,1,1),
(27,'ferdian simatupang',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'fery@gmail','2hsdi9',NULL,1,1),
(32,'Yoman',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'yoman@gmail','yoman',NULL,1,1);

/*Table structure for table `petugas` */

DROP TABLE IF EXISTS `petugas`;

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_exist` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB AUTO_INCREMENT=639292834 DEFAULT CHARSET=latin1;

/*Data for the table `petugas` */

insert  into `petugas`(`id_petugas`,`nama`,`email`,`password`,`is_exist`) values 
(8193002,'Mahmudin SH','mahmudin@gmail','ma783e3',1),
(73039593,'Edi sutrarta','Edi@gmail','syy7w29a',1),
(76100826,'Imawan,S.H','imawan@gmail','78aui',1),
(76882921,'Jono swandito','Jono@gmail','J990wjeos',1),
(79283293,'Antonius sedyo','antonius@gmail','27ayisd99',1),
(80110914,'Sukiran','sukiran@gmail','sU819',1),
(81718933,'Nur huda wijayanto','wijayanto@gmail','Biis933',1),
(87282393,'Ade bayu','bayu@gmail','6GuiAuis',1),
(638199392,'Suhartono','suhartono@gmail','77wuui9a',1),
(639292833,'Suyatno','suyatno@gmail','a628hdvf',1);

/*Table structure for table `proses` */

DROP TABLE IF EXISTS `proses`;

CREATE TABLE `proses` (
  `id_proses` int(11) NOT NULL AUTO_INCREMENT,
  `proses` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_proses`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `proses` */

insert  into `proses`(`id_proses`,`proses`) values 
(0,'Ditolak'),
(1,'Terkirim'),
(2,'Diterima'),
(3,'Dievaluasi'),
(4,'Proses'),
(5,'Selesai');

/*Table structure for table `surat` */

DROP TABLE IF EXISTS `surat`;

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL AUTO_INCREMENT,
  `no_lp` varchar(10) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` longtext NOT NULL,
  `id_pelapor` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `id_berkas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_surat`),
  KEY `id_pelapor` (`id_pelapor`),
  KEY `id_pegawai` (`id_petugas`),
  KEY `id_berkas` (`id_berkas`),
  CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`id_pelapor`) REFERENCES `pelapor` (`id_pelapor`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `surat_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `surat_ibfk_3` FOREIGN KEY (`id_berkas`) REFERENCES `berkas` (`id_berkas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `surat` */

insert  into `surat`(`id_surat`,`no_lp`,`tanggal`,`keterangan`,`id_pelapor`,`id_petugas`,`id_berkas`) values 
(1,'012235314','2019-04-08 00:00:00','Membayar denda kerusakan motor yang ditabrak',1,638199392,4),
(2,'013335314','2019-08-01 00:00:00','Korban kehilangan motor didepan rumah sekitar jam 12.00 siang',3,8193002,3),
(3,'0122820415','2020-03-18 00:00:00','Meminta persetujuan untuk mengadakan posyandu kelurahan setempat',3,80110914,2),
(4,'Lp04','2020-08-17 00:00:00','Mengadakan gotongroyo RT',4,638199392,2),
(5,'Lp05','2019-03-06 00:00:00','Melakukan pencurian motor',5,87282393,1),
(6,'017397652','2020-01-16 00:00:00','Terjadi pencurian dirumah korban dan tidak ada korban jiwa',3,76100826,3),
(7,'Lp07','2020-08-08 00:00:00','Pelaku dan teman-teman terlibat dalam perkelahian',7,80110914,1),
(8,'Lp08','2020-04-02 00:00:00','Korban kehilangan 2 motor dan terjadi pada jam 16:34 sore',8,76100826,3),
(9,'Lp09','2020-09-03 00:00:00','Menganti kerugian kaca mobil pengunjung hotel tanjung',9,87282393,4),
(10,'LP010','2020-10-22 00:00:00','Mengadakan rapat RT',10,8193002,2),
(11,'056875341','2020-06-09 00:00:00','Terlibat perkelahian',3,79283293,1),
(12,'Lp012','2020-09-11 00:00:00','Telah terjadi pencurian barang elektronik (Tv)',12,80110914,1),
(13,'Lp013','2020-05-14 00:00:00','Kehilangan sepeda',13,81718933,3),
(14,'Lp014','2020-03-02 00:00:00','Mencoba mencuri motor',14,638199392,1),
(15,'Lp015','2020-11-13 00:00:00','Terjadi percobaan pembobolan rumah',3,80110914,1),
(16,'Lp016','2020-06-20 00:00:00','Mengadakan gotongroyo RT',16,81718933,2),
(17,'Lp017','2020-11-13 00:00:00','Menganti rugi motor',17,79283293,NULL),
(18,'Lp018','2020-10-13 00:00:00','Mencoba melakukan pembobolan rumah',18,8193002,NULL),
(19,'Lp019','2020-06-18 00:00:00','Kehilangan 2 sepeda',19,76882921,NULL),
(20,'Lp020','2020-09-17 00:00:00','Kehilangan barang elektronik(Tv)',20,79283293,NULL),
(21,'Lp021','2020-10-17 00:00:00','Mengadakan posyandu RT',21,76100826,NULL),
(22,'Lp022','2020-07-21 00:00:00','Melakukan pencurian motor',22,87282393,NULL),
(23,'Lp023','2020-09-18 00:00:00','Kehilangan sepeda motor',23,87282393,NULL),
(24,'Lp024','2020-10-28 00:00:00','Menganti kerugian mobil',24,80110914,NULL),
(25,'Lp025','2020-07-20 00:00:00','Meresahkan warga sekitar',25,80110914,NULL),
(26,'Lp026','2020-10-21 00:00:00','Mengadakan gotongroyo',26,87282393,NULL),
(27,'LP027','2020-11-17 00:00:00','Terjadi pembobolan',27,638199392,NULL),
(28,'LP28','2021-10-10 23:35:11','adasdasd',1,NULL,3),
(40,'LP29','2021-10-11 01:13:46','Ilang sendal swalow di Masjid An-Nur',1,NULL,3);

/*Table structure for table `tb_berkas` */

DROP TABLE IF EXISTS `tb_berkas`;

CREATE TABLE `tb_berkas` (
  `id_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_berkas` varchar(255) NOT NULL,
  `id_pelapor` int(11) NOT NULL,
  PRIMARY KEY (`id_berkas`),
  KEY `id_pelapor` (`id_pelapor`),
  CONSTRAINT `tb_berkas_ibfk_1` FOREIGN KEY (`id_pelapor`) REFERENCES `tb_pelapor` (`id_pelapor`)
) ENGINE=InnoDB AUTO_INCREMENT=4011 DEFAULT CHARSET=latin1;

/*Data for the table `tb_berkas` */

insert  into `tb_berkas`(`id_berkas`,`nama_berkas`,`id_pelapor`) values 
(1001,'Penangkapan',5),
(1002,'Penangkapan',7),
(1003,'Penangkapan',11),
(1004,'Penangkapan',14),
(1005,'Penangkapan',18),
(1006,'Penangkapan',22),
(1007,'Penangkapan',25),
(1008,'Penangkapan',24),
(2001,'Izin',3),
(2002,'Izin',4),
(2003,'Izin',10),
(2004,'Izin',21),
(2005,'Izin',26),
(2006,'Izin',16),
(3001,'Ganti kerugian',1),
(3002,'Ganti kerugian',9),
(3003,'Ganti kerugian',17),
(4001,'Kehilangan',2),
(4002,'Kehilangan',8),
(4003,'Kehilangan',12),
(4004,'Kehilangan',13),
(4005,'Kehilangan',15),
(4006,'Kehilangan',19),
(4007,'Kehilangan',20),
(4008,'Kehilangan',23),
(4009,'Kehilangan',27),
(4010,'Kehilangan',6);

/*Table structure for table `tb_pegawai` */

DROP TABLE IF EXISTS `tb_pegawai`;

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pegawai` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=639292834 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pegawai` */

insert  into `tb_pegawai`(`id_pegawai`,`nama_pegawai`,`username`,`password`,`email`) values 
(8193002,'Mahmudin SH','mahmudin','ma783e3','mahmudin@gmail'),
(73039593,'Edi sutrarta','Edi','syy7w29a','Edi@gmail'),
(76100826,'Imawan,S.H','imawan','78aui','imawan@gmail'),
(76882921,'Jono swandito','Jono swandito','J990wjeos','Jono@gmail'),
(79283293,'Antonius sedyo','antonius','27ayisd99','antonius@gmail'),
(80110914,'Sukiran','sukiran','sU819','sukiran@gmail'),
(81718933,'Nur huda wijayanto','nur huda','Biis933','wijayanto@gmail'),
(87282393,'Ade bayu','ade bayu','6GuiAuis','bayu@gmail'),
(638199392,'Suhartono','suhartono','77wuui9a','suhartono@gmail'),
(639292833,'Suyatno','suyatno','a628hdvf','suyatno@gmail');

/*Table structure for table `tb_pelapor` */

DROP TABLE IF EXISTS `tb_pelapor`;

CREATE TABLE `tb_pelapor` (
  `id_pelapor` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelapor` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pelapor`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelapor` */

insert  into `tb_pelapor`(`id_pelapor`,`nama_pelapor`,`username`,`password`,`email`) values 
(1,'kiki','kiki','Kij922','kiki@gmail'),
(2,'rika dahyu','rika dahyu','drwo333','rika@gmail'),
(3,'wulan lestari','wulan lestari','a567d','wulan_lest@gmail'),
(4,'tajudin','tajudin','at68w','udin@gmail'),
(5,'juanda','juanda','ji834','anda@gmail'),
(6,'karmila ningsi','karmila ningsi','d7d684','mila@gmail'),
(7,'prastio','prastio','ti930w','pras@gmail'),
(8,'sukron','sukron','suk@8','sukron@gmail'),
(9,'risma','risma','rism34','risma@gmail'),
(10,'kiswan','kiswan','na8232k','kiswn@gmail'),
(11,'rina','rina','84rhf','rina@gmail'),
(12,'adidasmawan','adidasmawan','3uahdy','adidas@gmail'),
(13,'kartika','kartika','23827k','kartika@gmail'),
(14,'abdulah','abdulah','121js','abdul@gmail'),
(15,'nina','nina','121js','nina@gmail'),
(16,'mujiansyah','mujiyansyah','muj21o','muji_syah@gmail'),
(17,'ahmmad fahruroji','ahmmad fahruroji','1212wdsf','ahmad@gmail'),
(18,'eki prasetiawan','eki prasetiawan','124sdfg','koko@gmail'),
(19,'sigit putra','sigit putra','S12ks','sigit@gmail'),
(20,'andennin','andennin','23dsfdsg','andenin@gmail'),
(21,'urbanus olama','urbanus olama','ur46#','urbanus_ola@gmail'),
(22,'muhamad jodhi','muhamad jodhi','jodhi8we','jodhi@gmail'),
(23,'siti fatima','siti fatimah','tima189','fatime@gmail'),
(24,'sriwahyu','sriwahyu','sri123','sri_wahyu@gmail'),
(25,'viviandemingu','viviandemingu','4jss44','vian@gmail'),
(26,'imam muchlis','imam muchlis','1mam#','imam@gmail'),
(27,'ferdian simatupang','ferdian simatupang','2hsdi9','fery@gmail');

/*Table structure for table `tb_surat` */

DROP TABLE IF EXISTS `tb_surat`;

CREATE TABLE `tb_surat` (
  `id_surat` int(11) NOT NULL AUTO_INCREMENT,
  `no_lp` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pelapor` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `umur` int(11) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `keterangan` longtext NOT NULL,
  `unit_idk` varchar(50) NOT NULL,
  `uraian_laporan` longtext NOT NULL,
  `id_pelapor` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_surat`),
  KEY `id_pelapor` (`id_pelapor`),
  KEY `id_pegawai` (`id_pegawai`),
  CONSTRAINT `tb_surat_ibfk_1` FOREIGN KEY (`id_pelapor`) REFERENCES `tb_pelapor` (`id_pelapor`),
  CONSTRAINT `tb_surat_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `tb_surat` */

insert  into `tb_surat`(`id_surat`,`no_lp`,`tanggal`,`nama_pelapor`,`jenis_kelamin`,`umur`,`alamat`,`keterangan`,`unit_idk`,`uraian_laporan`,`id_pelapor`,`id_pegawai`) values 
(1,'Lp01','2019-04-08','kiki','laki',23,'Jl. Purwanggan 6 Purwokinanti, Pakualaman,','Ganti kerugian','BM001','Membayar denda kerusakan motor yang ditabrak',1,638199392),
(2,'Lp02','2019-08-01','rika dahyu','perempuan',20,'Bausasran, Kec. Danurejan, Kota Yogyakarta, Daerah Istimewa Yogyakarta\r\n\r\n','Kehilangan','BK001','Korban kehilangan motor didepan rumah sekitar jam 12.00 siang',2,8193002),
(3,'Lp03','2020-03-18','wulan lestari','perempuan',34,'Jl. Lempuyangan Tengah III No.578 B, RT.43/RW.11, Bausasran, Kec. Danurejan, Kota Yogyakarta\r\n\r\n','Izin','SI001','Meminta persetujuan untuk mengadakan posyandu kelurahan setempat',3,80110914),
(4,'Lp04','2020-08-17','tajudin','laki',43,'Purwokinanti, Pakualaman, Kota Yogyakarta\r\n','Izin','SI002','Mengadakan gotongroyo RT',4,638199392),
(5,'Lp05','2019-03-06','juanda','laki',36,'Jl. Tegal Panggung No.43, Tegal Panggung, Kec. Danurejan, Kota Yogyakarta\r\n\r\n','Penangkapan','SP001','Melakukan pencurian motor',5,87282393),
(6,'Lp06','2020-01-16','karmila ningsi','perempuan',38,'Jl. Ronodigdayan 54-50 Bausasran, Kec. Danurejan, Kota Yogyakarta\r\n','Kehilangan','BK010','Terjadi pencurian dirumah korban dan tidak ada korban jiwa',6,76100826),
(7,'Lp07','2020-08-08','prastio','laki',24,'Gg. Kamboja Bausasran, Kec. Danurejan, Kota Yogyakarta\r\n\r\n','Penangkapan','SP002','Pelaku dan teman-teman terlibat dalam perkelahian',7,80110914),
(8,'Lp08','2020-04-02','sukron','laki',56,'Bausasran, Kec. Danurejan, Kota Yogyakarta\r\n\r\n','Kehilangan','BK002','Korban kehilangan 2 motor dan terjadi pada jam 16:34 sore',8,76100826),
(9,'Lp09','2020-09-03','risma','perempuan',27,'Hotel Tanjung\r\nJl. Gajah Mada, Purwokinanti, Pakualaman, Kota Yogyakarta\r\n','Ganti kerugian','BM002','Menganti kerugian kaca mobil pengunjung hotel tanjung',9,87282393),
(10,'LP010','2020-10-22','kiswan','laki',45,'Bausasran, Kec. Danurejan, Kota Yogyakarta\r\n\r\n','Izin','SI003','Mengadakan rapat RT',10,8193002),
(11,'Lp011','2020-06-09','rina','perempuan',43,'Baciro, Kec. Gondokusuman, Kota Yogyakarta\r\n\r\n','Penangkapan','SP003','Terlibat perkelahian',11,79283293),
(12,'Lp012','2020-09-11','adidasmawan','laki',34,'Gg. Gantung\r\nBaciro, Kec. Gondokusuman, Kota Yogyakarta\r\n\r\n','Kehilangan','BK003','Telah terjadi pencurian barang elektronik (Tv)',12,80110914),
(13,'Lp013','2020-05-14','kartika','perempuan',35,'Balai Pelatihan Avengers, Bausasran, Kec. Danurejan, Kota Yogyakarta\r\n','Kehilangan','BK004','Kehilangan sepeda',13,81718933),
(14,'Lp014','2020-03-02','abdulah','laki',56,'Gg. Anggrek 286\r\nBausasran, Kec. Danurejan, Kota Yogyakarta','Penangkapan','SP004','Mencoba mencuri motor',14,638199392),
(15,'Lp015','2020-11-13','nina','perempuan',30,'Jl. Purwanggan 6\r\nPurwokinanti, Pakualaman, Kota Yogyakarta','Kehilangan','BK005','Terjadi percobaan pembobolan rumah',15,80110914),
(16,'Lp016','2020-06-20','mujiansyah','laki',45,'Gg. Sido Mulyo No.665, Bausasran, Kec. Danurejan, Kota Yogyakarta','Izin','SI006','Mengadakan gotongroyo RT',16,81718933),
(17,'Lp017','2020-11-13','ahmmad fahruroji','laki',30,'Angkringan Susu Ndepis Bausasran, Kec. Danurejan, Kota Yogyakarta\r\n','Ganti kerugian','BM003','Menganti rugi motor',17,79283293),
(18,'Lp018','2020-10-13','eki prasetiawan','laki',27,'Jl. Masjid No.3, Gunungketur, Pakualaman, Kota Yogyakarta','Penangkapan','SP005','Mencoba melakukan pembobolan rumah',18,8193002),
(19,'Lp019','2020-06-18','sigit putra','laki',59,'Jl. Harjowinatan No.14, Purwokinanti, Pakualaman, Kota Yogyakarta','Kehilangan','BK006','Kehilangan 2 sepeda',19,76882921),
(20,'Lp020','2020-09-17','andennin','perempuan',28,'Musholla At Taubah Bausasran Rw 12 Rt 48,, Bausasran, Kec. Danurejan, Kota Yogyakarta','Kehilangan','BK007','Kehilangan barang elektronik(Tv)',20,79283293),
(21,'Lp021','2020-10-17','urbanus olama','laki',48,'Hugo Surengjuritan PA I / 651, RT.39/RW.08, Purwokinanti','Izin','SI004','Mengadakan posyandu RT',21,76100826),
(22,'Lp022','2020-07-21','mumad jodhi','laki',29,'Jl. Jagalan - Beji No.40, Purwokinanti, Pakualaman, Kota Yogyakarta','Penangkapan','SP006','Melakukan pencurian motor',22,87282393),
(23,'Lp023','2020-09-18','siti fatima','perempuan',29,'Bausasran, Kec. Danurejan, Kota Yogyakarta\r\n\r\n','Kehilangan','BK008','Kehilangan sepeda motor',23,87282393),
(24,'Lp024','2020-10-28','sriwahyu','perempuan',36,'Jl. Purwanggan 15-33 Purwokinanti, Pakualaman, Kota Yogyakarta','Penangkapan','SP008','Menganti kerugian mobil',24,80110914),
(25,'Lp025','2020-07-20','viviandemingu','perempuan',30,'Purwokinanti, Pakualaman, Kota Yogyakarta\r\n','Penangkapan','SP007','Meresahkan warga sekitar',25,80110914),
(26,'Lp026','2020-10-21','imam muchlis','laki',49,'Baciro, Kec. Gondokusuman, Kota Yogyakarta\r\n','Izin','SI005','Mengadakan gotongroyo',26,87282393),
(27,'LP027','2020-11-17','ferdian simatupang','laki',49,'toko sabar menanti Jl. Lempuyangan Tengah III No.3, Bausasran, Kec. Danurejan, Kota Yogyakarta,','Kehilangan','BK009','Terjadi pembobolan',27,81718933);

/* Trigger structure for table `surat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_send` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_send` AFTER INSERT ON `surat` FOR EACH ROW BEGIN
	insert into aktivitas_surat values('',null,'',1,new.id_surat);
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
