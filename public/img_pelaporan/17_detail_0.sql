-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table wfp_project.a_hak_akses
CREATE TABLE IF NOT EXISTS `a_hak_akses` (
  `idhak_akses` int NOT NULL AUTO_INCREMENT,
  `kode_fitur` text,
  `nama_fitur` text,
  `status_aktif` int DEFAULT NULL,
  PRIMARY KEY (`idhak_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.a_hak_akses: ~9 rows (approximately)
INSERT INTO `a_hak_akses` (`idhak_akses`, `kode_fitur`, `nama_fitur`, `status_aktif`) VALUES
	(1, 'm_provinsi', 'master_provinsi', 1),
	(2, 'm_kota_kabupaten', 'master_kota', 1),
	(3, 'm_dinas', 'master_dinas', 1),
	(4, 'm_jenis_fasum', 'master_jenis_fasilitas_umum', 1),
	(5, 'm_staff', 'master_staff', 1),
	(6, 'm_user', 'master_user', 1),
	(7, 't_pelaporan', 'transaksi_pelaporan', 1),
	(8, 't_pelaporan_admin', 'transaksi_pelaporan_admin', 1),
	(9, 'r_histori_perbaikkan', 'report_history_perbaikkan', 1),
	(10, 'm_fasum', 'master_fasum', 1),
	(11, 'a_hak_akses', 'hak_akses', 1);

-- Dumping structure for table wfp_project.a_hak_akses_jabatan
CREATE TABLE IF NOT EXISTS `a_hak_akses_jabatan` (
  `idhak_akses` int NOT NULL,
  `idjabatan` int NOT NULL,
  PRIMARY KEY (`idhak_akses`,`idjabatan`),
  KEY `fk_a_hak_akses_has_m_jabatan_m_jabatan1_idx` (`idjabatan`),
  KEY `fk_a_hak_akses_has_m_jabatan_a_hak_akses1_idx` (`idhak_akses`),
  CONSTRAINT `fk_a_hak_akses_has_m_jabatan_a_hak_akses1` FOREIGN KEY (`idhak_akses`) REFERENCES `a_hak_akses` (`idhak_akses`),
  CONSTRAINT `fk_a_hak_akses_has_m_jabatan_m_jabatan1` FOREIGN KEY (`idjabatan`) REFERENCES `m_jabatan` (`idjabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.a_hak_akses_jabatan: ~24 rows (approximately)
INSERT INTO `a_hak_akses_jabatan` (`idhak_akses`, `idjabatan`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(7, 2),
	(9, 2),
	(1, 3),
	(2, 3),
	(3, 3),
	(4, 3),
	(5, 3),
	(6, 3),
	(7, 3),
	(8, 3),
	(9, 3),
	(10, 3),
	(11, 3);

-- Dumping structure for table wfp_project.m_dinas
CREATE TABLE IF NOT EXISTS `m_dinas` (
  `iddinas` int NOT NULL AUTO_INCREMENT,
  `idkota_kabupaten` int NOT NULL,
  `nama` text,
  `alamat` text,
  `status_aktif` int DEFAULT '1',
  PRIMARY KEY (`iddinas`,`idkota_kabupaten`),
  KEY `fk_m_dinas_m_kota_kabupaten1_idx` (`idkota_kabupaten`),
  CONSTRAINT `fk_m_dinas_m_kota_kabupaten1` FOREIGN KEY (`idkota_kabupaten`) REFERENCES `m_kota_kabupaten` (`idkota_kabupaten`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_dinas: ~1 rows (approximately)
INSERT INTO `m_dinas` (`iddinas`, `idkota_kabupaten`, `nama`, `alamat`, `status_aktif`) VALUES
	(1, 1, 'Dinas Rungkut', 'Jalan Singosari Raya Bawah Dusun No 31', 1),
	(2, 1, 'Dinas Panjang Jiwo', 'Jalan Panjang Jiwo Senyawa Surya No 31', 0);

-- Dumping structure for table wfp_project.m_fasum
CREATE TABLE IF NOT EXISTS `m_fasum` (
  `idfasum` int NOT NULL AUTO_INCREMENT,
  `m_dinas_iddinas` int NOT NULL,
  `nama` text,
  `luas_fasum` float DEFAULT NULL,
  `kondisi_fasum` text,
  `asal_fasum` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'APBN, APBD, Swasta',
  `lat` text,
  `lng` text,
  `gambar` text,
  `status_aktif` int DEFAULT '1',
  PRIMARY KEY (`idfasum`,`m_dinas_iddinas`),
  KEY `fk_m_fasum_m_dinas_idx` (`m_dinas_iddinas`),
  CONSTRAINT `fk_m_fasum_m_dinas` FOREIGN KEY (`m_dinas_iddinas`) REFERENCES `m_dinas` (`iddinas`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_fasum: ~18 rows (approximately)
INSERT INTO `m_fasum` (`idfasum`, `m_dinas_iddinas`, `nama`, `luas_fasum`, `kondisi_fasum`, `asal_fasum`, `lat`, `lng`, `gambar`, `status_aktif`) VALUES
	(1, 1, 'Tiang Listrik', 4, 'Bengkok & penyok', 'Swasta', '0', '0', '-', 0),
	(2, 1, '', 421, 'tess', 'Swasta', '-7.3150508016307905', '112.76669740676881', NULL, 0),
	(3, 1, 'Halte A', 421, 'test', 'Swasta', '-7.3150508016307905', '112.76729822158815', NULL, 0),
	(4, 1, 'Halte B', 421, 'test', 'Swasta', '-7.3125459', '112.7740438', NULL, 0),
	(5, 1, 'Halte C', 422, 'test', 'Swasta', '-7.315263631867809', '112.76674032211305', NULL, 0),
	(6, 1, '', 422, '5ttttt', 'Swasta', '-7.3125459', '112.7740438', NULL, 0),
	(7, 1, 'Halte D', 43, '5555', 'Swasta', '-7.315093367686321', '112.76676177978517', NULL, 0),
	(8, 1, 'DhALTE e', 43, '5555', 'Swasta', '-7.315178499785182', '112.7665686607361', NULL, 0),
	(9, 1, 'Stasiun A', 433, 'ttttt', 'APBN', '-7.316881138352193', '112.76652574539185', NULL, 0),
	(10, 1, 'Stasiun B', 444, 'ttttt', 'Swasta', '-7.316583177071914', '112.76716947555543', NULL, 0),
	(11, 1, 'Stasiun', 455, 'ttt', 'Swasta', '-7.316370347464187', '112.76723384857178', NULL, 0),
	(12, 1, 'Stasiun C', 333, 'tttt', 'Swasta', '-7.316881138352193', '112.76678323745729', NULL, 0),
	(13, 1, '', 0, '', '', '', '', 'img_fasum/13_.jpg', 0),
	(14, 1, '', 0, '', '', '', '', 'img_fasum/14_.jpg', 0),
	(15, 1, 'Rumah Kucinta', 345345, 'tgegregergerge', 'APBN', '-7.325096278114431', '112.78459310531618', NULL, 0),
	(16, 1, 'Ruamh Kucinta 32', 333, 'fwrgwgrew', 'Swasta', '-7.325521928899939', '112.78369188308717', NULL, 0),
	(17, 1, '', 0, '', '', '', '', 'img_fasum/17_.png', 0),
	(18, 1, '', 0, '', '', '', '', 'img_fasum/18_.png', 0),
	(19, 1, '', 0, '', '', '', '', NULL, 0),
	(20, 1, 'Ivano Zefanya', 597348, 'kfjwbnkvjw', 'APBN', '-6.21206340201758', '106.81045532226564', 'img_fasum/20_IvanoZefanya.png', 0),
	(21, 1, 'mata sakit', 2345340, '53453HDFGGHRE', 'Swasta', '-7.323648', '112.787456', 'img_fasum/21_matasakit.jpg', 0),
	(22, 1, 'Stasiun A', 421, 'Rusak', 'Swasta', '-7.3241172797651615', '112.7839708328247', NULL, 0),
	(23, 1, 'Stasiun Kocag', 421, 'fwefwe', 'Swasta', '-7.323648', '112.7776256', 'img_fasum/23_StasiunKocag.jpg', 1),
	(24, 1, 'Stasiun Wonokromber', 421, 'baik', 'APBN', '-7.3484639041767155', '112.75506734848024', 'img_fasum/24_StasiunWonokromber.jpg', 1);

-- Dumping structure for table wfp_project.m_jabatan
CREATE TABLE IF NOT EXISTS `m_jabatan` (
  `idjabatan` int NOT NULL AUTO_INCREMENT,
  `nama` text,
  `status_aktif` int DEFAULT NULL,
  PRIMARY KEY (`idjabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_jabatan: ~3 rows (approximately)
INSERT INTO `m_jabatan` (`idjabatan`, `nama`, `status_aktif`) VALUES
	(1, 'Admin', 1),
	(2, 'User', 1),
	(3, 'Manager', 1);

-- Dumping structure for table wfp_project.m_jenis_fasum
CREATE TABLE IF NOT EXISTS `m_jenis_fasum` (
  `idjenis_fasum` int NOT NULL AUTO_INCREMENT,
  `nama` text,
  `status_aktif` int DEFAULT '1',
  PRIMARY KEY (`idjenis_fasum`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_jenis_fasum: ~3 rows (approximately)
INSERT INTO `m_jenis_fasum` (`idjenis_fasum`, `nama`, `status_aktif`) VALUES
	(1, 'Rumah Sakit', 1),
	(2, 'Poliklinik', 1),
	(3, 'Jalan Raya', 1);

-- Dumping structure for table wfp_project.m_kategori_fasum
CREATE TABLE IF NOT EXISTS `m_kategori_fasum` (
  `idkategori_fasum` int NOT NULL AUTO_INCREMENT,
  `nama` text,
  `status_aktif` int DEFAULT '1',
  PRIMARY KEY (`idkategori_fasum`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_kategori_fasum: ~4 rows (approximately)
INSERT INTO `m_kategori_fasum` (`idkategori_fasum`, `nama`, `status_aktif`) VALUES
	(1, 'Trotoar', 0),
	(4, 'Rumah Sakit', 1),
	(5, 'Jalan Tol', 1),
	(6, 'Bangunan Serbaguna', 1);

-- Dumping structure for table wfp_project.m_kategori_fasum_has_m_fasum
CREATE TABLE IF NOT EXISTS `m_kategori_fasum_has_m_fasum` (
  `m_kategori_fasum_idkategori_fasum` int NOT NULL,
  `m_fasum_idfasum` int NOT NULL,
  PRIMARY KEY (`m_kategori_fasum_idkategori_fasum`,`m_fasum_idfasum`),
  KEY `fk_m_kategori_fasum_has_m_fasum_m_fasum1_idx` (`m_fasum_idfasum`),
  KEY `fk_m_kategori_fasum_has_m_fasum_m_kategori_fasum1_idx` (`m_kategori_fasum_idkategori_fasum`),
  CONSTRAINT `fk_m_kategori_fasum_has_m_fasum_m_fasum1` FOREIGN KEY (`m_fasum_idfasum`) REFERENCES `m_fasum` (`idfasum`),
  CONSTRAINT `fk_m_kategori_fasum_has_m_fasum_m_kategori_fasum1` FOREIGN KEY (`m_kategori_fasum_idkategori_fasum`) REFERENCES `m_kategori_fasum` (`idkategori_fasum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_kategori_fasum_has_m_fasum: ~4 rows (approximately)
INSERT INTO `m_kategori_fasum_has_m_fasum` (`m_kategori_fasum_idkategori_fasum`, `m_fasum_idfasum`) VALUES
	(1, 1),
	(4, 1),
	(4, 23),
	(5, 23),
	(5, 24);

-- Dumping structure for table wfp_project.m_kota_kabupaten
CREATE TABLE IF NOT EXISTS `m_kota_kabupaten` (
  `idkota_kabupaten` int NOT NULL AUTO_INCREMENT,
  `kode` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `nama` text,
  `jenis` text,
  `status_aktif` int DEFAULT '1',
  `m_provinsi_idprovinsi` int NOT NULL,
  PRIMARY KEY (`idkota_kabupaten`,`m_provinsi_idprovinsi`),
  KEY `fk_m_kota_kabupaten_m_provinsi1_idx` (`m_provinsi_idprovinsi`),
  CONSTRAINT `FK_m_kota_kabupaten_m_provinsi` FOREIGN KEY (`m_provinsi_idprovinsi`) REFERENCES `m_provinsi` (`idprovinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_kota_kabupaten: ~3 rows (approximately)
INSERT INTO `m_kota_kabupaten` (`idkota_kabupaten`, `kode`, `nama`, `jenis`, `status_aktif`, `m_provinsi_idprovinsi`) VALUES
	(1, 'Sby', 'Kota Surabaya', 'kota', 1, 1),
	(2, 'Gto', 'Gorontalo', 'kota', 0, 1),
	(3, 'PRE', 'Pare', 'kabupaten', 1, 1);

-- Dumping structure for table wfp_project.m_provinsi
CREATE TABLE IF NOT EXISTS `m_provinsi` (
  `idprovinsi` int NOT NULL AUTO_INCREMENT,
  `kode` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `nama` text,
  `status_aktif` int DEFAULT '1',
  PRIMARY KEY (`idprovinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_provinsi: ~6 rows (approximately)
INSERT INTO `m_provinsi` (`idprovinsi`, `kode`, `nama`, `status_aktif`) VALUES
	(1, 'Jatim', 'Jawa Timur', 1),
	(2, 'Jateng', 'Jawa Tengah', 1),
	(3, 'Sulut', 'Sulawesi Utara', 0),
	(4, 'Sulut2', 'Sulawesi Utara', 0),
	(5, 'Sulut235', 'Sulawesi Utara', 0),
	(6, 'Jabar', 'Jawa Barat', 1);

-- Dumping structure for table wfp_project.m_staff
CREATE TABLE IF NOT EXISTS `m_staff` (
  `idm_staff` int NOT NULL AUTO_INCREMENT,
  `iddinas` int NOT NULL DEFAULT '-1',
  `idjabatan` int NOT NULL DEFAULT '-1',
  `nama` text,
  `username` text,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `status_aktif` int DEFAULT '1',
  `alamat` text,
  `email` text,
  PRIMARY KEY (`idm_staff`,`iddinas`,`idjabatan`),
  KEY `fk_m_staff_m_dinas1_idx` (`iddinas`),
  KEY `fk_m_staff_m_jabatan1_idx` (`idjabatan`),
  CONSTRAINT `fk_m_staff_m_dinas1` FOREIGN KEY (`iddinas`) REFERENCES `m_dinas` (`iddinas`),
  CONSTRAINT `fk_m_staff_m_jabatan1` FOREIGN KEY (`idjabatan`) REFERENCES `m_jabatan` (`idjabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_staff: ~5 rows (approximately)
INSERT INTO `m_staff` (`idm_staff`, `iddinas`, `idjabatan`, `nama`, `username`, `password`, `status_aktif`, `alamat`, `email`) VALUES
	(6, 1, 3, 'ivano', 'ivano', '$2y$10$JT.QibcHCKwjWz27UE3ND.we8ROIu9RN.Pnu4czb8ghb/zJRIbs3m', 1, NULL, NULL),
	(8, 1, 1, 'Belum Pilih', 'budi_123', '$2y$10$pSIPIrwS5tOWOLw7k2kfr.SZDXASolziTxj/ez7JjTkJi2V3cBBsS', 0, NULL, NULL),
	(9, 1, 1, 'Bagus', 'bagus', '$2y$10$pZuyqHXtE0DAtTQJSyhdnu6Gaic5pS9lm.nuFzYWX.GF5trabho.2', 1, NULL, NULL),
	(10, 1, 2, 'ridwan', 'ridwan', '$2y$10$HCfDkmO9ZQ0HHC.gDTMwIeX0GrV0ritNdwXf/nQEWY1k/oKRg2dCS', 1, 'Jalan Rungkut No 31', 'ridwan@gmail.com'),
	(11, 1, 2, 'ramli', 'ramli', '$2y$10$JT.QibcHCKwjWz27UE3ND.we8ROIu9RN.Pnu4czb8ghb/zJRIbs3m', 1, 'Jalan Rungkut No 31', 'ramli@gmail.com'),
	(12, 1, 1, 'ryan', 'ryan', '$2y$10$9kx0n5S5YBC4ffENrvrWSOIyCrLxKlsmwR6.KhugMt9StxAVCi8sK', 1, NULL, NULL);

-- Dumping structure for table wfp_project.m_user
CREATE TABLE IF NOT EXISTS `m_user` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `idkota_kabupaten` int NOT NULL,
  `idjabatan` int NOT NULL,
  `nama` text,
  `username` text,
  `password` text,
  `alamat` text,
  `no_hp` text,
  `email` text,
  `status_aktif` int DEFAULT NULL,
  `idstaff` int DEFAULT NULL,
  PRIMARY KEY (`iduser`,`idjabatan`),
  KEY `fk_m_user_m_kota_kabupaten1_idx` (`idkota_kabupaten`),
  KEY `fk_m_user_m_jabatan1_idx` (`idjabatan`),
  KEY `idstaff` (`idstaff`),
  CONSTRAINT `fk_m_user_m_jabatan1` FOREIGN KEY (`idjabatan`) REFERENCES `m_jabatan` (`idjabatan`),
  CONSTRAINT `fk_m_user_m_kota_kabupaten1` FOREIGN KEY (`idkota_kabupaten`) REFERENCES `m_kota_kabupaten` (`idkota_kabupaten`),
  CONSTRAINT `FK_m_user_m_staff` FOREIGN KEY (`idstaff`) REFERENCES `m_staff` (`idm_staff`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_user: ~3 rows (approximately)
INSERT INTO `m_user` (`iduser`, `idkota_kabupaten`, `idjabatan`, `nama`, `username`, `password`, `alamat`, `no_hp`, `email`, `status_aktif`, `idstaff`) VALUES
	(2, 1, 2, 'ridwan', 'ridwan', '$2y$10$Dnbcdv5v4BMpgcNwHy896OXCgxyDD/DkgGEXpW/kACJfU5SoVGFvq', 'Jalan Rungkut No 31', '12324525345', 'ridwan@gmail.com', 1, 10),
	(3, 1, 2, 'ramli', 'ramli', '$2y$10$XkB33y6H1i6yROocZ9/2pu6fqvGKXYFgjNx4T2nt8y6ZrOPVhcM.q', 'Jalan Rungkut No 31', '12334578', 'ramli@gmail.com', 1, 11),
	(4, 1, 3, 'ivano', 'ivano', '$2y$10$XkB33y6H1i6yROocZ9/2pu6fqvGKXYFgjNx4T2nt8y6ZrOPVhcM.q', 'Jalan Rungkut No 31', '12313425', 'ivano@gmail.com', 1, 6);

-- Dumping structure for table wfp_project.t_history_perbaikan
CREATE TABLE IF NOT EXISTS `t_history_perbaikan` (
  `idhistory_perbaikan` int NOT NULL AUTO_INCREMENT,
  `idpelaporan` int NOT NULL,
  `tgl` datetime DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`idhistory_perbaikan`,`idpelaporan`),
  KEY `fk_t_history_perbaikan_t_pelaporan1_idx` (`idpelaporan`),
  CONSTRAINT `fk_t_history_perbaikan_t_pelaporan1` FOREIGN KEY (`idpelaporan`) REFERENCES `t_pelaporan` (`idpelaporan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.t_history_perbaikan: ~0 rows (approximately)
INSERT INTO `t_history_perbaikan` (`idhistory_perbaikan`, `idpelaporan`, `tgl`, `keterangan`) VALUES
	(1, 9, '2024-12-26 10:27:49', 'Pelaporan Selesai');

-- Dumping structure for table wfp_project.t_pelaporan
CREATE TABLE IF NOT EXISTS `t_pelaporan` (
  `idpelaporan` int NOT NULL AUTO_INCREMENT,
  `nomor` text,
  `tgl_pelaporan` datetime DEFAULT NULL,
  `idm_staff` int NOT NULL,
  `iduser` int NOT NULL,
  `status_pelaporan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT '''Antri'', ''Dikerjakan'', ''Outsource'',''Selesai'',''Tidak Terselesaikan',
  `keterangan` text,
  `status_aktif` int DEFAULT '1',
  PRIMARY KEY (`idpelaporan`),
  KEY `fk_t_pelaporan_m_staff1_idx` (`idm_staff`),
  KEY `fk_t_pelaporan_m_user1_idx` (`iduser`),
  CONSTRAINT `fk_t_pelaporan_m_staff1` FOREIGN KEY (`idm_staff`) REFERENCES `m_staff` (`idm_staff`),
  CONSTRAINT `fk_t_pelaporan_m_user1` FOREIGN KEY (`iduser`) REFERENCES `m_user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.t_pelaporan: ~7 rows (approximately)
INSERT INTO `t_pelaporan` (`idpelaporan`, `nomor`, `tgl_pelaporan`, `idm_staff`, `iduser`, `status_pelaporan`, `keterangan`, `status_aktif`) VALUES
	(1, 'P/2412/0001', '2024-12-20 14:55:58', 6, 3, 'Antri', 'Test', 1),
	(3, 'P/2412/0002', '2024-12-24 13:26:45', 6, 2, 'Antri', 'tesy', 1),
	(4, 'P/2412/0002', '2024-12-24 13:28:30', 6, 2, 'Antri', 'test', 1),
	(5, 'P/2412/0004', '2024-12-24 13:28:30', 9, 3, 'Antri', 'test hapus', 0),
	(6, 'P/2412/0005', '2024-12-24 14:07:11', 9, 2, 'Antri', 'ttt6', 1),
	(7, 'P/2412/0006', '2024-12-24 14:10:26', 6, 2, 'Antri', 'tes', 1),
	(8, 'P/2412/0007', '2024-12-24 14:41:58', 6, 2, 'Antri', 'te', 1),
	(9, 'P/2412/0008', '2024-12-26 13:23:16', 8, 3, 'Selesai', 'hahaha', 1);

-- Dumping structure for table wfp_project.t_pelaporan_detail
CREATE TABLE IF NOT EXISTS `t_pelaporan_detail` (
  `iddetail` int NOT NULL AUTO_INCREMENT,
  `t_pelaporan_idpelaporan` int NOT NULL,
  `m_fasum_idfasum` int NOT NULL,
  `status_perbaikkan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT '''Sedang dikerjakan''',
  `foto_fasum` text,
  `keterangan` text,
  `idstaff` int DEFAULT NULL,
  PRIMARY KEY (`iddetail`) USING BTREE,
  KEY `fk_t_pelaporan_has_m_fasum_m_fasum1_idx` (`m_fasum_idfasum`),
  KEY `fk_t_pelaporan_has_m_fasum_t_pelaporan1_idx` (`t_pelaporan_idpelaporan`),
  KEY `idstaff` (`idstaff`),
  CONSTRAINT `FK_t_pelaporan_detail_m_staff` FOREIGN KEY (`idstaff`) REFERENCES `m_staff` (`idm_staff`),
  CONSTRAINT `fk_t_pelaporan_has_m_fasum_m_fasum1` FOREIGN KEY (`m_fasum_idfasum`) REFERENCES `m_fasum` (`idfasum`),
  CONSTRAINT `fk_t_pelaporan_has_m_fasum_t_pelaporan1` FOREIGN KEY (`t_pelaporan_idpelaporan`) REFERENCES `t_pelaporan` (`idpelaporan`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.t_pelaporan_detail: ~11 rows (approximately)
INSERT INTO `t_pelaporan_detail` (`iddetail`, `t_pelaporan_idpelaporan`, `m_fasum_idfasum`, `status_perbaikkan`, `foto_fasum`, `keterangan`, `idstaff`) VALUES
	(1, 1, 16, 'Antri', '-', 'Test 2', 11),
	(3, 4, 23, 'Antri', '-', 'ttttt', 9),
	(4, 4, 23, 'Antri', '-', 'hhhh', 10),
	(6, 5, 23, 'Antri', '-', 'test hapus', 9),
	(7, 6, 23, 'Antri', '-', 'ttt', 9),
	(8, 7, 23, 'Antri', '-', '11111', 6),
	(9, 7, 23, 'Antri', '-', '222222', 9),
	(16, 8, 23, 'Antri', 'img_pelaporan/8_detail_0.jpg', 'tttt', 6),
	(17, 8, 23, 'Outsource', 'img_pelaporan/9_detail_0.jpg', 'hhh', 9),
	(46, 9, 23, 'Dikerjakan', 'img_pelaporan/9_detail_0.jpg', 'tttt', 8),
	(47, 9, 23, 'Dikerjakan', 'img_pelaporan/9_detail_1.jpg', 'tttt', 8);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
