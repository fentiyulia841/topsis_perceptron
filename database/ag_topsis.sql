/*
SQLyog Ultimate v9.50 
MySQL - 5.5.5-10.4.14-MariaDB : Database - ag_topsis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ag_topsis` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ag_topsis`;

/*Table structure for table `tb_alternatif` */

DROP TABLE IF EXISTS `tb_alternatif`;

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alternatif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_alternatif` */

insert  into `tb_alternatif`(`id_alternatif`,`nama_alternatif`) values (1,'Rusak Ringan'),(2,'Rusak Sedang'),(3,'Rusak Berat');

/*Table structure for table `tb_bencana` */

DROP TABLE IF EXISTS `tb_bencana`;

CREATE TABLE `tb_bencana` (
  `id_bencana` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(255) DEFAULT NULL,
  `tanggal_kejadian` date DEFAULT NULL,
  `tanggal_input` date DEFAULT NULL,
  `id_jenis` varchar(255) DEFAULT NULL,
  `id_sektor` varchar(255) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `id_alternatif` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_bencana`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_bencana` */

insert  into `tb_bencana`(`id_bencana`,`lokasi`,`tanggal_kejadian`,`tanggal_input`,`id_jenis`,`id_sektor`,`lat`,`lng`,`id_alternatif`) values (2,'Jl. Raya Uluwatu, Ungasan, Kec. Kuta Sel., Kabupaten Badung, Bali 80364','2021-03-28','2021-03-28','2','1',-8.8104228,115.1675986,'1');

/*Table structure for table `tb_bencana_detail` */

DROP TABLE IF EXISTS `tb_bencana_detail`;

CREATE TABLE `tb_bencana_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_bencana` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_crips` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_bencana_detail` */

insert  into `tb_bencana_detail`(`ID`,`id_bencana`,`id_kriteria`,`id_crips`) values (1,1,1,1),(2,1,2,4),(3,1,3,7),(4,1,4,10),(5,1,5,13),(6,2,1,1),(7,2,2,4),(8,2,3,7),(9,2,4,10),(10,2,5,13);

/*Table structure for table `tb_crips` */

DROP TABLE IF EXISTS `tb_crips`;

CREATE TABLE `tb_crips` (
  `id_crips` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` varchar(16) DEFAULT NULL,
  `nama_crips` varchar(255) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_crips`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `tb_crips` */

insert  into `tb_crips`(`id_crips`,`id_kriteria`,`nama_crips`,`nilai`) values (1,'1','Masih Berdiri',1),(2,'1','Miring',2),(3,'1','Roboh Total',3),(4,'2','Sebagian Kecil Rusak Ringan',1),(5,'2','Sebagian Kecil Rusak',2),(6,'2','Sebagian Besar Rusak',3),(7,'3','<30%',1),(8,'3','30-50%',2),(9,'3','>50%',3),(10,'4','Tidak Berbahaya',1),(11,'4','Relatif Berbahaya',2),(12,'4','Membahayakan',3),(13,'5','Sebagian Kecil Rusak',1),(14,'5','Sebagian Besar Rusak',2),(15,'5','Rusak Total',3);

/*Table structure for table `tb_jenis` */

DROP TABLE IF EXISTS `tb_jenis`;

CREATE TABLE `tb_jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jenis` */

insert  into `tb_jenis`(`id_jenis`,`nama_jenis`) values (1,'Banjir'),(2,'Tsunami'),(4,'Gempa Bumi'),(5,'Gunung Meletus'),(6,'Kebakaran');

/*Table structure for table `tb_kriteria` */

DROP TABLE IF EXISTS `tb_kriteria`;

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `nama_kriteria` varchar(255) DEFAULT NULL,
  `nilai_kriteria` int(11) DEFAULT NULL,
  `bb` int(11) DEFAULT NULL,
  `ba` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kriteria` */

insert  into `tb_kriteria`(`id_kriteria`,`kode_kriteria`,`nama_kriteria`,`nilai_kriteria`,`bb`,`ba`) values (1,'K1','Keadaan Bangunan',1,1,3),(2,'K2','Keadaan Struktur Bangunan',2,1,3),(3,'K3','Kondisi Fisik Bangunan',3,1,3),(4,'K4','Fungsi Bangunan',1,1,3),(5,'K5','Keadaan Penunjang Lainnya',2,1,3);

/*Table structure for table `tb_options` */

DROP TABLE IF EXISTS `tb_options`;

CREATE TABLE `tb_options` (
  `option_name` varchar(16) NOT NULL,
  `option_value` text DEFAULT NULL,
  PRIMARY KEY (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_options` */

insert  into `tb_options`(`option_name`,`option_value`) values ('default_lat','-8.505399300086397'),('default_lng','115.33871577733866'),('default_zoom','10');

/*Table structure for table `tb_pola` */

DROP TABLE IF EXISTS `tb_pola`;

CREATE TABLE `tb_pola` (
  `id_pola` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) DEFAULT NULL,
  `id_sektor` int(11) DEFAULT NULL,
  `tanggal_kejadian` date DEFAULT NULL,
  `tanggal_input` date DEFAULT NULL,
  PRIMARY KEY (`id_pola`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pola` */

insert  into `tb_pola`(`id_pola`,`id_jenis`,`id_sektor`,`tanggal_kejadian`,`tanggal_input`) values (1,1,1,'2021-03-23','2021-03-23'),(2,1,2,'2021-03-23','2021-03-23'),(3,2,1,'2021-03-24','2021-03-24'),(4,4,2,'2021-03-24','2021-03-24'),(5,1,1,'2021-03-25','2021-03-24'),(6,1,1,'2021-03-29','2021-03-24'),(7,1,2,'2021-03-31','2021-03-24'),(8,2,1,'2021-03-24','2021-03-24'),(9,4,2,'2021-03-10','2021-03-24'),(10,4,1,'2021-03-09','2021-03-24'),(11,1,1,'2021-03-01','2021-03-24'),(12,1,2,'2021-03-09','2021-03-24'),(13,1,1,'2021-03-02','2021-03-24'),(14,1,1,'2021-03-06','2021-03-24'),(15,1,1,'2021-03-11','2021-03-24'),(16,1,2,'2021-02-11','2021-03-24'),(17,1,2,'2021-02-19','2021-03-24'),(18,1,2,'2021-02-28','2021-03-24'),(19,1,2,'2021-02-05','2021-03-24'),(20,1,2,'2021-02-01','2021-03-24'),(21,1,1,'2021-02-08','2021-03-24'),(22,1,1,'2021-03-24','2021-03-24'),(23,1,2,'2020-12-30','2021-03-24'),(24,1,1,'2021-01-24','2021-03-24'),(25,1,1,'2020-12-16','2021-03-24');

/*Table structure for table `tb_pola_detail` */

DROP TABLE IF EXISTS `tb_pola_detail`;

CREATE TABLE `tb_pola_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_pola` int(11) DEFAULT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_crips` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=398 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pola_detail` */

insert  into `tb_pola_detail`(`ID`,`id_pola`,`id_alternatif`,`id_kriteria`,`id_crips`) values (1,1,1,1,1),(2,1,2,1,2),(3,1,3,1,3),(4,1,1,2,5),(5,1,2,2,4),(6,1,3,2,6),(7,1,1,3,9),(8,1,2,3,7),(9,1,3,3,8),(10,1,1,4,10),(11,1,2,4,11),(12,1,3,4,10),(13,1,1,5,13),(14,1,2,5,15),(15,1,3,5,14),(16,2,1,1,NULL),(17,2,2,1,NULL),(18,2,3,1,NULL),(19,2,1,2,NULL),(20,2,2,2,NULL),(21,2,3,2,NULL),(22,2,1,3,NULL),(23,2,2,3,NULL),(24,2,3,3,NULL),(25,2,1,4,NULL),(26,2,2,4,NULL),(27,2,3,4,NULL),(28,2,1,5,NULL),(29,2,2,5,NULL),(30,2,3,5,NULL),(53,3,1,1,2),(54,3,2,1,1),(55,3,3,1,2),(56,3,1,2,5),(57,3,2,2,6),(58,3,3,2,5),(59,3,1,3,8),(60,3,2,3,9),(61,3,3,3,8),(62,3,1,4,11),(63,3,2,4,12),(64,3,3,4,12),(65,3,1,5,15),(66,3,2,5,14),(67,3,3,5,15),(68,4,1,1,3),(69,4,2,1,1),(70,4,3,1,3),(71,4,1,2,5),(72,4,2,2,6),(73,4,3,2,4),(74,4,1,3,8),(75,4,2,3,8),(76,4,3,3,9),(77,4,1,4,11),(78,4,2,4,12),(79,4,3,4,11),(80,4,1,5,14),(81,4,2,5,14),(82,4,3,5,14),(83,5,1,1,3),(84,5,2,1,3),(85,5,3,1,3),(86,5,1,2,6),(87,5,2,2,6),(88,5,3,2,6),(89,5,1,3,8),(90,5,2,3,9),(91,5,3,3,8),(92,5,1,4,12),(93,5,2,4,12),(94,5,3,4,11),(95,5,1,5,15),(96,5,2,5,14),(97,5,3,5,15),(98,6,1,1,1),(99,6,2,1,2),(100,6,3,1,3),(101,6,1,2,4),(102,6,2,2,5),(103,6,3,2,6),(104,6,1,3,7),(105,6,2,3,8),(106,6,3,3,9),(107,6,1,4,10),(108,6,2,4,11),(109,6,3,4,12),(110,6,1,5,13),(111,6,2,5,15),(112,6,3,5,15),(113,7,1,1,1),(114,7,2,1,2),(115,7,3,1,3),(116,7,1,2,4),(117,7,2,2,5),(118,7,3,2,6),(119,7,1,3,7),(120,7,2,3,8),(121,7,3,3,9),(122,7,1,4,10),(123,7,2,4,11),(124,7,3,4,12),(125,7,1,5,13),(126,7,2,5,14),(127,7,3,5,15),(128,8,1,1,1),(129,8,2,1,1),(130,8,3,1,1),(131,8,1,2,5),(132,8,2,2,5),(133,8,3,2,6),(134,8,1,3,7),(135,8,2,3,7),(136,8,3,3,9),(137,8,1,4,11),(138,8,2,4,10),(139,8,3,4,12),(140,8,1,5,13),(141,8,2,5,14),(142,8,3,5,15),(143,9,1,1,1),(144,9,2,1,2),(145,9,3,1,3),(146,9,1,2,4),(147,9,2,2,5),(148,9,3,2,6),(149,9,1,3,7),(150,9,2,3,8),(151,9,3,3,9),(152,9,1,4,10),(153,9,2,4,11),(154,9,3,4,12),(155,9,1,5,13),(156,9,2,5,14),(157,9,3,5,15),(158,10,1,1,3),(159,10,2,1,2),(160,10,3,1,1),(161,10,1,2,6),(162,10,2,2,5),(163,10,3,2,4),(164,10,1,3,9),(165,10,2,3,8),(166,10,3,3,7),(167,10,1,4,12),(168,10,2,4,11),(169,10,3,4,10),(170,10,1,5,15),(171,10,2,5,14),(172,10,3,5,13),(173,11,1,1,3),(174,11,2,1,2),(175,11,3,1,1),(176,11,1,2,6),(177,11,2,2,5),(178,11,3,2,4),(179,11,1,3,9),(180,11,2,3,8),(181,11,3,3,7),(182,11,1,4,12),(183,11,2,4,11),(184,11,3,4,10),(185,11,1,5,15),(186,11,2,5,14),(187,11,3,5,13),(188,12,1,1,1),(189,12,2,1,1),(190,12,3,1,1),(191,12,1,2,4),(192,12,2,2,4),(193,12,3,2,4),(194,12,1,3,7),(195,12,2,3,7),(196,12,3,3,7),(197,12,1,4,10),(198,12,2,4,10),(199,12,3,4,10),(200,12,1,5,13),(201,12,2,5,13),(202,12,3,5,13),(203,13,1,1,2),(204,13,2,1,2),(205,13,3,1,2),(206,13,1,2,5),(207,13,2,2,5),(208,13,3,2,5),(209,13,1,3,8),(210,13,2,3,8),(211,13,3,3,8),(212,13,1,4,11),(213,13,2,4,11),(214,13,3,4,11),(215,13,1,5,14),(216,13,2,5,14),(217,13,3,5,14),(218,14,1,1,3),(219,14,2,1,1),(220,14,3,1,2),(221,14,1,2,6),(222,14,2,2,5),(223,14,3,2,4),(224,14,1,3,9),(225,14,2,3,7),(226,14,3,3,8),(227,14,1,4,12),(228,14,2,4,11),(229,14,3,4,10),(230,14,1,5,15),(231,14,2,5,13),(232,14,3,5,14),(233,15,1,1,2),(234,15,2,1,3),(235,15,3,1,1),(236,15,1,2,5),(237,15,2,2,6),(238,15,3,2,4),(239,15,1,3,8),(240,15,2,3,9),(241,15,3,3,7),(242,15,1,4,12),(243,15,2,4,11),(244,15,3,4,10),(245,15,1,5,14),(246,15,2,5,13),(247,15,3,5,15),(248,16,1,1,2),(249,16,2,1,2),(250,16,3,1,2),(251,16,1,2,4),(252,16,2,2,4),(253,16,3,2,4),(254,16,1,3,9),(255,16,2,3,9),(256,16,3,3,9),(257,16,1,4,11),(258,16,2,4,11),(259,16,3,4,11),(260,16,1,5,13),(261,16,2,5,13),(262,16,3,5,13),(263,17,1,1,3),(264,17,2,1,3),(265,17,3,1,3),(266,17,1,2,5),(267,17,2,2,5),(268,17,3,2,5),(269,17,1,3,7),(270,17,2,3,7),(271,17,3,3,7),(272,17,1,4,12),(273,17,2,4,12),(274,17,3,4,12),(275,17,1,5,14),(276,17,2,5,14),(277,17,3,5,14),(278,18,1,1,3),(279,18,2,1,2),(280,18,3,1,1),(281,18,1,2,6),(282,18,2,2,5),(283,18,3,2,4),(284,18,1,3,9),(285,18,2,3,8),(286,18,3,3,7),(287,18,1,4,12),(288,18,2,4,11),(289,18,3,4,10),(290,18,1,5,15),(291,18,2,5,14),(292,18,3,5,13),(293,19,1,1,1),(294,19,2,1,3),(295,19,3,1,2),(296,19,1,2,4),(297,19,2,2,6),(298,19,3,2,5),(299,19,1,3,7),(300,19,2,3,9),(301,19,3,3,8),(302,19,1,4,10),(303,19,2,4,12),(304,19,3,4,11),(305,19,1,5,13),(306,19,2,5,15),(307,19,3,5,14),(308,20,1,1,3),(309,20,2,1,2),(310,20,3,1,1),(311,20,1,2,6),(312,20,2,2,5),(313,20,3,2,4),(314,20,1,3,9),(315,20,2,3,8),(316,20,3,3,7),(317,20,1,4,12),(318,20,2,4,11),(319,20,3,4,10),(320,20,1,5,15),(321,20,2,5,14),(322,20,3,5,13),(323,21,1,1,3),(324,21,2,1,3),(325,21,3,1,3),(326,21,1,2,5),(327,21,2,2,5),(328,21,3,2,5),(329,21,1,3,7),(330,21,2,3,7),(331,21,3,3,7),(332,21,1,4,12),(333,21,2,4,12),(334,21,3,4,12),(335,21,1,5,14),(336,21,2,5,14),(337,21,3,5,14),(338,22,1,1,1),(339,22,2,1,2),(340,22,3,1,3),(341,22,1,2,5),(342,22,2,2,4),(343,22,3,2,6),(344,22,1,3,9),(345,22,2,3,7),(346,22,3,3,8),(347,22,1,4,10),(348,22,2,4,11),(349,22,3,4,10),(350,22,1,5,13),(351,22,2,5,15),(352,22,3,5,14),(353,23,1,1,1),(354,23,2,1,2),(355,23,3,1,3),(356,23,1,2,5),(357,23,2,2,4),(358,23,3,2,6),(359,23,1,3,9),(360,23,2,3,7),(361,23,3,3,8),(362,23,1,4,10),(363,23,2,4,11),(364,23,3,4,10),(365,23,1,5,13),(366,23,2,5,15),(367,23,3,5,14),(368,24,1,1,1),(369,24,2,1,2),(370,24,3,1,1),(371,24,1,2,4),(372,24,2,2,6),(373,24,3,2,4),(374,24,1,3,7),(375,24,2,3,8),(376,24,3,3,7),(377,24,1,4,10),(378,24,2,4,12),(379,24,3,4,10),(380,24,1,5,13),(381,24,2,5,15),(382,24,3,5,13),(383,25,1,1,3),(384,25,2,1,1),(385,25,3,1,2),(386,25,1,2,6),(387,25,2,2,4),(388,25,3,2,5),(389,25,1,3,9),(390,25,2,3,7),(391,25,3,3,8),(392,25,1,4,12),(393,25,2,4,10),(394,25,3,4,11),(395,25,1,5,15),(396,25,2,5,13),(397,25,3,5,14);

/*Table structure for table `tb_sektor` */

DROP TABLE IF EXISTS `tb_sektor`;

CREATE TABLE `tb_sektor` (
  `id_sektor` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sektor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sektor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_sektor` */

insert  into `tb_sektor`(`id_sektor`,`nama_sektor`) values (1,'Pemukiman'),(2,'Infrastuktur');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
