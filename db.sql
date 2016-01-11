/*
SQLyog Professional v10.42 
MySQL - 5.6.12-log : Database - penduduk234
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `agama` */

DROP TABLE IF EXISTS `agama`;

CREATE TABLE `agama` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `nama` varchar(56) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `agama` */

insert  into `agama`(`id`,`nama`) values (1,'ISLAM'),(2,'KRISTEN'),(3,'KHATOLIK'),(4,'BUDHA'),(5,'HINDU');

/*Table structure for table `anggota_keluarga` */

DROP TABLE IF EXISTS `anggota_keluarga`;

CREATE TABLE `anggota_keluarga` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `id_keluarga` int(7) NOT NULL,
  `status` varchar(32) NOT NULL,
  `id_penduduk` int(15) NOT NULL,
  `ayah` varchar(64) NOT NULL,
  `ibu` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `anggota_keluarga` */

insert  into `anggota_keluarga`(`id`,`id_keluarga`,`status`,`id_penduduk`,`ayah`,`ibu`) values (6,6,'1',57,'Sukarjo Salim','Siti Nuraeni'),(11,6,'2',58,'Sanan','Murdinah'),(12,6,'3',59,'',''),(13,6,'3',60,'',''),(14,7,'1',61,'Samsa','Kamu'),(15,7,'2',62,'Jirot','Sanimah'),(16,7,'3',63,'','');

/*Table structure for table `data-penduduk` */

DROP TABLE IF EXISTS `data-penduduk`;

CREATE TABLE `data-penduduk` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `nik` varchar(21) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `status_nikah` varchar(15) NOT NULL,
  `pekerjaan` int(7) NOT NULL,
  `penghasilan` int(20) NOT NULL,
  `pendidikan` int(7) NOT NULL,
  `agama` int(7) NOT NULL,
  `kewarganegaraan` varchar(3) NOT NULL,
  `tgl_pendaftaran` date NOT NULL,
  `tgl_update` date NOT NULL,
  `status_pindah` int(1) NOT NULL,
  `status_hidup` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

/*Data for the table `data-penduduk` */

insert  into `data-penduduk`(`id`,`nik`,`nama`,`tgl_lahir`,`tempat_lahir`,`jenis_kelamin`,`status_nikah`,`pekerjaan`,`penghasilan`,`pendidikan`,`agama`,`kewarganegaraan`,`tgl_pendaftaran`,`tgl_update`,`status_pindah`,`status_hidup`) values (57,'324343434311','Sukiman Raharjo','1986-08-12','Tasikmalaya','l','1',3,0,5,0,'WNI','2016-01-11','0000-00-00',0,0),(58,'324343434312','Sarinah','1988-09-12','Cijantung','p','1',2,0,5,0,'WNI','2016-01-11','0000-00-00',0,0),(59,'324343434313','Sayid Rohman','2004-12-12','Tasikmalaya','l','2',2,0,4,0,'WNI','2016-01-11','0000-00-00',0,0),(60,'324343434314','Ani','2014-01-01','Tasikmalaya','p','2',1,0,3,0,'WNI','2016-01-11','0000-00-00',0,0),(61,'424343434311','Uwa Takiyem','1967-08-09','Cijantung','l','1',1,0,8,0,'WNI','2016-01-11','0000-00-00',0,0),(62,'424343434312','Salimah','1970-08-12','Cijantung','p','1',3,0,7,0,'WNI','2016-01-11','0000-00-00',0,0),(63,'424343434314','Citra','1995-06-10','Cijantung','p','2',1,0,9,0,'WNI','2016-01-11','0000-00-00',0,0),(64,'213343565677','Dewa Salapan 12','1991-08-12','Tasikmalaya','l','2',1,0,9,0,'WNI','2016-01-11','0000-00-00',0,0);

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`) values (1,'admin','Administrator'),(2,'members','General User');

/*Table structure for table `keluarga` */

DROP TABLE IF EXISTS `keluarga`;

CREATE TABLE `keluarga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nikk` varchar(21) NOT NULL,
  `luas_rumah` int(11) NOT NULL,
  `status_milik` int(3) NOT NULL,
  `alamat_detail` varchar(32) NOT NULL,
  `master_kampung_id` int(7) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nikk` (`nikk`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `keluarga` */

insert  into `keluarga`(`id`,`nikk`,`luas_rumah`,`status_milik`,`alamat_detail`,`master_kampung_id`) values (6,'234123432',0,0,'Jl. Cihanjuang No. 25 Blok B12',3),(7,'234123434',0,0,'Jl. Cihanjuang No. 28 Blok B12',3);

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `login_attempts` */

/*Table structure for table `master-kampung` */

DROP TABLE IF EXISTS `master-kampung`;

CREATE TABLE `master-kampung` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `rt` int(7) NOT NULL,
  `rw` int(7) NOT NULL,
  `kampung` varchar(42) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `master-kampung` */

insert  into `master-kampung`(`id`,`rt`,`rw`,`kampung`) values (1,15,1,'Cihanjuang'),(2,1,2,'Cioray'),(3,2,1,'Cihanjuang');

/*Table structure for table `pekerjaan` */

DROP TABLE IF EXISTS `pekerjaan`;

CREATE TABLE `pekerjaan` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `nama` varchar(56) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pekerjaan` */

insert  into `pekerjaan`(`id`,`nama`) values (1,'PNS'),(2,'Lain-lain'),(3,'Karyawan Wiraswasta');

/*Table structure for table `pendidikan` */

DROP TABLE IF EXISTS `pendidikan`;

CREATE TABLE `pendidikan` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `nama` varchar(56) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `pendidikan` */

insert  into `pendidikan`(`id`,`nama`) values (3,'Tidak/Belum Sekolah'),(4,'Tamat SD'),(5,'SLTP/Sederajat'),(6,'SLTA/Sederajat'),(7,'DI/DIII'),(8,'Akademi/DIII'),(9,'DIV/S1'),(10,'S-2'),(11,'S-3');

/*Table structure for table `status_keluarga` */

DROP TABLE IF EXISTS `status_keluarga`;

CREATE TABLE `status_keluarga` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `nama` varchar(56) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `status_keluarga` */

insert  into `status_keluarga`(`id`,`nama`) values (1,'Ayah'),(2,'Ibu'),(3,'Anak'),(4,'Anak Angkat'),(5,'Lain-lain');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) values (1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,NULL,1268889823,1452507207,1,'Admin','istrator','ADMIN','0');

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values (1,1,1),(2,1,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
