/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - db_projek
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_projek` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_projek`;

/*Table structure for table `bus` */

DROP TABLE IF EXISTS `bus`;

CREATE TABLE `bus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nomor_polisi` varchar(20) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `id_jenisbus` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_id_jenisbus_foreign` (`id_jenisbus`),
  CONSTRAINT `bus_id_jenisbus_foreign` FOREIGN KEY (`id_jenisbus`) REFERENCES `jenisbus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bus` */

insert  into `bus`(`id`,`nomor_polisi`,`merek`,`kapasitas`,`id_jenisbus`) values 
(1,'BA 9945 AA','AAA',21,1),
(3,'BA 9874 BB','Avanza',7,3);

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `namajabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id`,`namajabatan`) values 
(1,'ADMIN'),
(2,'PEMILIK'),
(3,'SOPIR'),
(4,'PENYEWA');

/*Table structure for table `jenisbus` */

DROP TABLE IF EXISTS `jenisbus`;

CREATE TABLE `jenisbus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenisbus` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenisbus` */

insert  into `jenisbus`(`id`,`nama_jenisbus`) values 
(1,'Aquas'),
(3,'Dorek');

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `idkaryawan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idjabatan` int(11) unsigned DEFAULT NULL,
  `nik_karyawan` varchar(50) DEFAULT NULL,
  `nama_karyawan` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `nohp` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idkaryawan`),
  KEY `karyawan_idjabatan_foreign` (`idjabatan`),
  CONSTRAINT `karyawan_idjabatan_foreign` FOREIGN KEY (`idjabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `karyawan` */

insert  into `karyawan`(`idkaryawan`,`idjabatan`,`nik_karyawan`,`nama_karyawan`,`alamat`,`nohp`,`email`,`password`) values 
(1,1,'13710706040003','Ronal Afendi','JL.Zambrud VI NO 10','081261722787','admin@gmail.com','$2y$10$WdxGZE51eBPHH.AoN5yk5OY2JRnzUbi.bKWb5YNITJI9pAyXB.ZYu'),
(5,2,'13710706040003','jol','olo','01038923','pemilik@gmail.com','$2y$10$llkhXv42kqGLVzQe4BlwJuwSCMfvekx4H9/Hh3NeuEVWtIDQRrHBC'),
(6,3,'13710706040003','JOKO','JAJAJAJAJ','01830237274274','Sopir@gmail.com','$2y$10$6NkFP/AOe9gG9osFvRY59u71fcEnIXEjfITlNg//YXOcM6NqZpvTW'),
(7,4,'13710706040003','sekor','JL.ZAMRUD VI NO.10 PAGAMBIRAN AMPALU NAN XX','081261722787','penyewa@gmail.com','$2y$10$EfaAgFnnlDndOieba4lhA.QdFYkpntbfOFaZka58EJWw1Efa6rK2a'),
(8,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2025-10-20-192216','App\\Database\\Migrations\\Jabatan','default','App',1761028336,1),
(2,'2025-10-20-192319','App\\Database\\Migrations\\Jenisbus','default','App',1761028336,1),
(3,'2025-10-20-192417','App\\Database\\Migrations\\Penyewa','default','App',1761028336,1),
(4,'2025-10-20-192524','App\\Database\\Migrations\\PaketWisata','default','App',1761028336,1),
(5,'2025-10-20-192652','App\\Database\\Migrations\\Karyawan','default','App',1761028337,1),
(6,'2025-10-20-192817','App\\Database\\Migrations\\Bus','default','App',1761028337,1),
(7,'2025-10-20-193004','App\\Database\\Migrations\\PaketBus','default','App',1761028337,1),
(8,'2025-10-20-193209','App\\Database\\Migrations\\Pemesanan','default','App',1761028337,1),
(9,'2025-10-20-193416','App\\Database\\Migrations\\PemesananDetail','default','App',1761028337,1),
(10,'2025-10-20-193552','App\\Database\\Migrations\\Pembayaran','default','App',1761028337,1),
(11,'2025-10-20-193700','App\\Database\\Migrations\\Pemberangkatan','default','App',1761028337,1);

/*Table structure for table `paket_bus` */

DROP TABLE IF EXISTS `paket_bus`;

CREATE TABLE `paket_bus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_paketwisata` int(11) unsigned NOT NULL,
  `id_bus` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paket_bus_id_paketwisata_foreign` (`id_paketwisata`),
  KEY `paket_bus_id_bus_foreign` (`id_bus`),
  CONSTRAINT `paket_bus_id_bus_foreign` FOREIGN KEY (`id_bus`) REFERENCES `bus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paket_bus_id_paketwisata_foreign` FOREIGN KEY (`id_paketwisata`) REFERENCES `paket_wisata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `paket_bus` */

insert  into `paket_bus`(`id`,`id_paketwisata`,`id_bus`) values 
(2,1,1);

/*Table structure for table `paket_wisata` */

DROP TABLE IF EXISTS `paket_wisata`;

CREATE TABLE `paket_wisata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `paket_wisata` */

insert  into `paket_wisata`(`id`,`nama_paket`,`tujuan`,`harga`) values 
(1,'MUDIK','Padang',150000);

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_pemesanan` int(11) unsigned NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_id_pemesanan_foreign` (`id_pemesanan`),
  CONSTRAINT `pembayaran_id_pemesanan_foreign` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembayaran` */

insert  into `pembayaran`(`id`,`id_pemesanan`,`tanggal_bayar`,`jumlah_bayar`,`metode_bayar`) values 
(1,1,'2025-11-05',30000,'Qris'),
(3,1,'2025-12-05',100,'1000');

/*Table structure for table `pemberangkatan` */

DROP TABLE IF EXISTS `pemberangkatan`;

CREATE TABLE `pemberangkatan` (
  `idberangkat` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idpemesanan` int(11) unsigned DEFAULT NULL,
  `idbus` int(11) unsigned DEFAULT NULL,
  `idsopir` int(11) unsigned DEFAULT NULL,
  `idkernet` int(11) unsigned DEFAULT NULL,
  `tanggalberangkat` date DEFAULT NULL,
  PRIMARY KEY (`idberangkat`),
  KEY `pemberangkatan_idpemesanan_foreign` (`idpemesanan`),
  KEY `pemberangkatan_idbus_foreign` (`idbus`),
  KEY `pemberangkatan_idsopir_foreign` (`idsopir`),
  KEY `pemberangkatan_idkernet_foreign` (`idkernet`),
  CONSTRAINT `pemberangkatan_idbus_foreign` FOREIGN KEY (`idbus`) REFERENCES `bus` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `pemberangkatan_idkernet_foreign` FOREIGN KEY (`idkernet`) REFERENCES `karyawan` (`idkaryawan`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `pemberangkatan_idpemesanan_foreign` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `pemberangkatan_idsopir_foreign` FOREIGN KEY (`idsopir`) REFERENCES `karyawan` (`idkaryawan`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pemberangkatan` */

insert  into `pemberangkatan`(`idberangkat`,`idpemesanan`,`idbus`,`idsopir`,`idkernet`,`tanggalberangkat`) values 
(3,1,1,7,7,'2025-12-09');

/*Table structure for table `pemesanan` */

DROP TABLE IF EXISTS `pemesanan`;

CREATE TABLE `pemesanan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_pesan` date NOT NULL,
  `id_penyewa` int(11) unsigned NOT NULL,
  `id_paketbus` int(11) unsigned NOT NULL,
  `total_bayar` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pemesanan_id_penyewa_foreign` (`id_penyewa`),
  KEY `pemesanan_id_paketbus_foreign` (`id_paketbus`),
  CONSTRAINT `pemesanan_id_paketbus_foreign` FOREIGN KEY (`id_paketbus`) REFERENCES `paket_bus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pemesanan_id_penyewa_foreign` FOREIGN KEY (`id_penyewa`) REFERENCES `penyewa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pemesanan` */

insert  into `pemesanan`(`id`,`tanggal_pesan`,`id_penyewa`,`id_paketbus`,`total_bayar`) values 
(1,'2025-11-13',2,2,20000),
(2,'2025-11-24',2,2,100000);

/*Table structure for table `pemesanan_detail` */

DROP TABLE IF EXISTS `pemesanan_detail`;

CREATE TABLE `pemesanan_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_pemesanan` int(11) unsigned NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `jumlah_penumpang` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pemesanan_detail_id_pemesanan_foreign` (`id_pemesanan`),
  CONSTRAINT `pemesanan_detail_id_pemesanan_foreign` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pemesanan_detail` */

insert  into `pemesanan_detail`(`id`,`id_pemesanan`,`tanggal_berangkat`,`tanggal_kembali`,`jumlah_penumpang`) values 
(2,1,'2025-11-09','2025-11-09',2),
(3,1,'2025-11-07','2025-11-16',4);

/*Table structure for table `penyewa` */

DROP TABLE IF EXISTS `penyewa`;

CREATE TABLE `penyewa` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_penyewa` varchar(100) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penyewa` */

insert  into `penyewa`(`id`,`nama_penyewa`,`alamat`,`no_telp`,`email`,`password`,`created_at`,`update_at`) values 
(2,'Ronal','olo','0138137171','mronal.afendi04@gmail.com','$2y$10$un4DvKxFfQkeHrpGQ5FJdeL8H2.Hgl6tsrMaUPrVK3YclZZyKwx8q',NULL,NULL),
(3,'asep','ehjiqhe',NULL,'ril@gmail.com','$2y$10$9xMT0UB/SppaYjLaIJhgEu.tS6MLSuijQX0MACIJv1/nXJ7V7VW5S',NULL,NULL),
(4,'jamal','1',NULL,'rey@gmail.com','$2y$10$EevvEhriJ9pRi8mrMQLiZ.X3wdabe2qrrtDJkFS.hgs4pMQOwwVW2',NULL,NULL),
(8,'MUHAMMAD RONAL AFENDI','JL.ZAMRUD VI NO.10 PAGAMBIRAN AMPALU NAN XX',NULL,'mronal.afendi04@gmail.com','$2y$10$yCnsW/k0KV7PSEMsWB6hDeSm5DdgcwH4bDiYTjpaWTlgxx4EEYQ0y',NULL,NULL),
(9,'MUHAMMAD RONAL AFENDI','JL.ZAMRUD VI NO.10 PAGAMBIRAN AMPALU NAN XX',NULL,'onal@gmail.com','$2y$10$JWP6Ojp1pt4JGyZNBKb6Q.F78uDbkM0td63KZstqEWKBQYedWOmbq',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
