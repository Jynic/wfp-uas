-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.a_hak_akses: ~0 rows (approximately)

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

-- Dumping data for table wfp_project.a_hak_akses_jabatan: ~0 rows (approximately)

-- Dumping structure for table wfp_project.m_dinas
CREATE TABLE IF NOT EXISTS `m_dinas` (
  `iddinas` int NOT NULL AUTO_INCREMENT,
  `idkota_kabupaten` int NOT NULL,
  `nama` text,
  PRIMARY KEY (`iddinas`,`idkota_kabupaten`),
  KEY `fk_m_dinas_m_kota_kabupaten1_idx` (`idkota_kabupaten`),
  CONSTRAINT `fk_m_dinas_m_kota_kabupaten1` FOREIGN KEY (`idkota_kabupaten`) REFERENCES `m_kota_kabupaten` (`idkota_kabupaten`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_dinas: ~0 rows (approximately)
INSERT IGNORE INTO `m_dinas` (`iddinas`, `idkota_kabupaten`, `nama`) VALUES
	(1, 1, 'Dinas Rungkut');

-- Dumping structure for table wfp_project.m_fasum
CREATE TABLE IF NOT EXISTS `m_fasum` (
  `idfasum` int NOT NULL AUTO_INCREMENT,
  `m_dinas_iddinas` int NOT NULL,
  `idjenis_fasum` int NOT NULL,
  `nama` text,
  `luas_fasum` float DEFAULT NULL,
  `kondisi_fasum` text,
  `asal_fasum` text,
  `lat` text,
  `lng` text,
  `gambar` text,
  PRIMARY KEY (`idfasum`,`m_dinas_iddinas`),
  KEY `fk_m_fasum_m_dinas_idx` (`m_dinas_iddinas`),
  KEY `fk_m_fasum_m_jenis_fasum1_idx` (`idjenis_fasum`),
  CONSTRAINT `fk_m_fasum_m_dinas` FOREIGN KEY (`m_dinas_iddinas`) REFERENCES `m_dinas` (`iddinas`),
  CONSTRAINT `fk_m_fasum_m_jenis_fasum1` FOREIGN KEY (`idjenis_fasum`) REFERENCES `m_jenis_fasum` (`idjenis_fasum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_fasum: ~0 rows (approximately)

-- Dumping structure for table wfp_project.m_jabatan
CREATE TABLE IF NOT EXISTS `m_jabatan` (
  `idjabatan` int NOT NULL AUTO_INCREMENT,
  `nama` text,
  `status_aktif` int DEFAULT NULL,
  PRIMARY KEY (`idjabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_jabatan: ~0 rows (approximately)
INSERT IGNORE INTO `m_jabatan` (`idjabatan`, `nama`, `status_aktif`) VALUES
	(1, 'Admin', 1);

-- Dumping structure for table wfp_project.m_jenis_fasum
CREATE TABLE IF NOT EXISTS `m_jenis_fasum` (
  `idjenis_fasum` int NOT NULL AUTO_INCREMENT,
  `nama` text,
  `status_aktif` int DEFAULT NULL,
  PRIMARY KEY (`idjenis_fasum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_jenis_fasum: ~0 rows (approximately)

-- Dumping structure for table wfp_project.m_kategori_fasum
CREATE TABLE IF NOT EXISTS `m_kategori_fasum` (
  `idkategori_fasum` int NOT NULL AUTO_INCREMENT,
  `nama` text,
  `status_aktif` int DEFAULT NULL,
  PRIMARY KEY (`idkategori_fasum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_kategori_fasum: ~0 rows (approximately)

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

-- Dumping data for table wfp_project.m_kategori_fasum_has_m_fasum: ~0 rows (approximately)

-- Dumping structure for table wfp_project.m_kota_kabupaten
CREATE TABLE IF NOT EXISTS `m_kota_kabupaten` (
  `idkota_kabupaten` int NOT NULL AUTO_INCREMENT,
  `nama` text,
  `m_provinsi_idprovinsi` int NOT NULL,
  PRIMARY KEY (`idkota_kabupaten`,`m_provinsi_idprovinsi`),
  KEY `fk_m_kota_kabupaten_m_provinsi1_idx` (`m_provinsi_idprovinsi`),
  CONSTRAINT `FK_m_kota_kabupaten_m_provinsi` FOREIGN KEY (`m_provinsi_idprovinsi`) REFERENCES `m_provinsi` (`idprovinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_kota_kabupaten: ~0 rows (approximately)
INSERT IGNORE INTO `m_kota_kabupaten` (`idkota_kabupaten`, `nama`, `m_provinsi_idprovinsi`) VALUES
	(1, 'Kota Surabaya', 1);

-- Dumping structure for table wfp_project.m_provinsi
CREATE TABLE IF NOT EXISTS `m_provinsi` (
  `idprovinsi` int NOT NULL AUTO_INCREMENT,
  `kode` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `nama` text,
  `status_aktif` int DEFAULT '1',
  PRIMARY KEY (`idprovinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_provinsi: ~2 rows (approximately)
INSERT IGNORE INTO `m_provinsi` (`idprovinsi`, `kode`, `nama`, `status_aktif`) VALUES
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
  PRIMARY KEY (`idm_staff`,`iddinas`,`idjabatan`),
  KEY `fk_m_staff_m_dinas1_idx` (`iddinas`),
  KEY `fk_m_staff_m_jabatan1_idx` (`idjabatan`),
  CONSTRAINT `fk_m_staff_m_dinas1` FOREIGN KEY (`iddinas`) REFERENCES `m_dinas` (`iddinas`),
  CONSTRAINT `fk_m_staff_m_jabatan1` FOREIGN KEY (`idjabatan`) REFERENCES `m_jabatan` (`idjabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_staff: ~0 rows (approximately)
INSERT IGNORE INTO `m_staff` (`idm_staff`, `iddinas`, `idjabatan`, `nama`, `username`, `password`) VALUES
	(6, 1, 1, 'ivano', 'ivano', '$2y$10$k80JDnb1t9rg4HtQgKrc.uWc0I16XzSbxQxanCqLxjPJBSROfLohG');

-- Dumping structure for table wfp_project.m_user
CREATE TABLE IF NOT EXISTS `m_user` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `idkota_kabupaten` int NOT NULL,
  `idjabatan` int NOT NULL,
  `nama` text,
  `alamat` text,
  `no_hp` text,
  `email` text,
  `status_aktif` int DEFAULT NULL,
  PRIMARY KEY (`iduser`,`idjabatan`),
  KEY `fk_m_user_m_kota_kabupaten1_idx` (`idkota_kabupaten`),
  KEY `fk_m_user_m_jabatan1_idx` (`idjabatan`),
  CONSTRAINT `fk_m_user_m_jabatan1` FOREIGN KEY (`idjabatan`) REFERENCES `m_jabatan` (`idjabatan`),
  CONSTRAINT `fk_m_user_m_kota_kabupaten1` FOREIGN KEY (`idkota_kabupaten`) REFERENCES `m_kota_kabupaten` (`idkota_kabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.m_user: ~0 rows (approximately)

-- Dumping structure for table wfp_project.t_history_perbaikan
CREATE TABLE IF NOT EXISTS `t_history_perbaikan` (
  `idhistory_perbaikan` int NOT NULL AUTO_INCREMENT,
  `idpelaporan` int NOT NULL,
  `tgl` date DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`idhistory_perbaikan`,`idpelaporan`),
  KEY `fk_t_history_perbaikan_t_pelaporan1_idx` (`idpelaporan`),
  CONSTRAINT `fk_t_history_perbaikan_t_pelaporan1` FOREIGN KEY (`idpelaporan`) REFERENCES `t_pelaporan` (`idpelaporan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.t_history_perbaikan: ~0 rows (approximately)

-- Dumping structure for table wfp_project.t_pelaporan
CREATE TABLE IF NOT EXISTS `t_pelaporan` (
  `idpelaporan` int NOT NULL AUTO_INCREMENT,
  `nomor` text,
  `tgl_pelaporan` date DEFAULT NULL,
  `idm_staff` int NOT NULL,
  `iduser` int NOT NULL,
  `status_pelaporan` text,
  `keterangan` text,
  PRIMARY KEY (`idpelaporan`),
  KEY `fk_t_pelaporan_m_staff1_idx` (`idm_staff`),
  KEY `fk_t_pelaporan_m_user1_idx` (`iduser`),
  CONSTRAINT `fk_t_pelaporan_m_staff1` FOREIGN KEY (`idm_staff`) REFERENCES `m_staff` (`idm_staff`),
  CONSTRAINT `fk_t_pelaporan_m_user1` FOREIGN KEY (`iduser`) REFERENCES `m_user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.t_pelaporan: ~0 rows (approximately)

-- Dumping structure for table wfp_project.t_pelaporan_detail
CREATE TABLE IF NOT EXISTS `t_pelaporan_detail` (
  `t_pelaporan_idpelaporan` int NOT NULL,
  `m_fasum_idfasum` int NOT NULL,
  `status_perbaikkan` text,
  `foto_fasum` text,
  `keterangan` text,
  PRIMARY KEY (`t_pelaporan_idpelaporan`,`m_fasum_idfasum`),
  KEY `fk_t_pelaporan_has_m_fasum_m_fasum1_idx` (`m_fasum_idfasum`),
  KEY `fk_t_pelaporan_has_m_fasum_t_pelaporan1_idx` (`t_pelaporan_idpelaporan`),
  CONSTRAINT `fk_t_pelaporan_has_m_fasum_m_fasum1` FOREIGN KEY (`m_fasum_idfasum`) REFERENCES `m_fasum` (`idfasum`),
  CONSTRAINT `fk_t_pelaporan_has_m_fasum_t_pelaporan1` FOREIGN KEY (`t_pelaporan_idpelaporan`) REFERENCES `t_pelaporan` (`idpelaporan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table wfp_project.t_pelaporan_detail: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
