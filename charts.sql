/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.6.20 : Database - dashboard_charts
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dashboard_charts` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dashboard_charts`;

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ci_sessions` */

/*Table structure for table `data_graph1` */

DROP TABLE IF EXISTS `data_graph1`;

CREATE TABLE `data_graph1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_graph1` int(11) NOT NULL,
  `value` double NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_graph1` (`id_graph1`),
  CONSTRAINT `data_graph1_ibfk_1` FOREIGN KEY (`id_graph1`) REFERENCES `graph1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `data_graph1` */

insert  into `data_graph1`(`id`,`id_graph1`,`value`,`label`) values (1,1,65,'January'),(2,1,59,'February'),(3,1,80,'March'),(4,1,81,'April'),(5,1,56,'May'),(6,1,55,'June'),(7,1,40,'July'),(8,2,28,'January'),(9,2,48,'February'),(10,2,40,'March'),(11,2,19,'April'),(12,2,86,'May'),(13,2,27,'June'),(14,2,90,'July'),(15,3,700,NULL),(16,4,500,NULL),(17,5,400,NULL),(18,6,600,NULL),(19,7,300,NULL),(20,8,100,NULL);

/*Table structure for table `drilldown_graph2` */

DROP TABLE IF EXISTS `drilldown_graph2`;

CREATE TABLE `drilldown_graph2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_graph2` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_graph2` (`id_graph2`),
  CONSTRAINT `drilldown_graph2_ibfk_1` FOREIGN KEY (`id_graph2`) REFERENCES `graph2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `drilldown_graph2` */

insert  into `drilldown_graph2`(`id`,`id_graph2`,`name`,`value`) values (1,1,'v11.0',24.13),(2,1,'v8.0',17.2),(3,1,'v9.0',8.11),(4,1,'v10.0',5.33),(5,1,'v6.0',1.06),(6,1,'v7.0',0.5),(7,2,'v40.0',5),(8,2,'v41.0',4.32),(9,2,'v42.0',3.68),(10,2,'v39.0',2.96),(11,2,'v36.0',2.53),(12,2,'v43.0',1.45),(13,2,'v31.0',1.24),(14,2,'v35.0',0.85),(15,2,'v38.0',0.6),(16,2,'v32.0',0.55),(17,2,'v37.0',0.38),(18,2,'v33.0',0.19),(19,2,'v34.0',0.14),(20,2,'v30.0',0.14),(21,3,'v35',2.76),(22,3,'v36',2.32),(23,3,'v37',2.31),(24,3,'v34',1.27),(25,3,'v38',1.02),(26,3,'v31',0.33),(27,3,'v33',0.22),(28,3,'v32',0.15),(29,4,'v8.0',2.56),(30,4,'v7.1',0.77),(31,4,'v5.1',0.42),(32,4,'v5.0',0.3),(33,4,'v6.1',0.29),(34,4,'v7.0',0.26),(35,4,'v6.2',0.17),(36,5,'v12.x',0.34),(37,5,'v28',0.24),(38,5,'v27',0.17),(39,5,'v29',0.16);

/*Table structure for table `graph1` */

DROP TABLE IF EXISTS `graph1`;

CREATE TABLE `graph1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label_data` varchar(255) DEFAULT NULL,
  `tipe_graph` varchar(255) DEFAULT NULL,
  `fillColor` varchar(255) DEFAULT NULL,
  `strokeColor` varchar(255) DEFAULT NULL,
  `pointColor` varchar(255) DEFAULT NULL,
  `pointStrokeColor` varchar(255) DEFAULT NULL,
  `pointHighlightFill` varchar(255) DEFAULT NULL,
  `pointHighlightStroke` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `highlight` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `graph1` */

insert  into `graph1`(`id`,`label_data`,`tipe_graph`,`fillColor`,`strokeColor`,`pointColor`,`pointStrokeColor`,`pointHighlightFill`,`pointHighlightStroke`,`color`,`highlight`) values (1,'Electronics','areaChart','rgba(210, 214, 222, 1)','rgba(210, 214, 222, 1)','rgba(210, 214, 222, 1)','#c1c7d1','#fff','rgba(220,220,220,1)',NULL,NULL),(2,'Digital Goods','areaChart','rgba(60,141,188,0.9)','rgba(60,141,188,0.8)','#3b8bba','rgba(60,141,188,1)','#fff','rgba(60,141,188,1)',NULL,NULL),(3,'Chrome','pieChart',NULL,NULL,NULL,NULL,NULL,NULL,'#f56954','#f56954'),(4,'IE','pieChart',NULL,NULL,NULL,NULL,NULL,NULL,'#00a65a','#00a65a'),(5,'FireFox','pieChart',NULL,NULL,NULL,NULL,NULL,NULL,'#00c0ef','#00c0ef'),(6,'Opera','pieChart',NULL,NULL,NULL,NULL,NULL,NULL,'#3c8dbc','#3c8dbc'),(7,'Navigator','pieChart',NULL,NULL,NULL,NULL,NULL,NULL,'#d2d6de','#d2d6de');

/*Table structure for table `graph2` */

DROP TABLE IF EXISTS `graph2`;

CREATE TABLE `graph2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `graph2` */

insert  into `graph2`(`id`,`name`,`value`) values (1,'Microsoft Internet Explorer',56.33),(2,'Chrome',24.03),(3,'Firefox',10.38),(4,'Safari',4.77),(5,'Opera',0.91),(6,'Proprietary or Undetectable',0.2);

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`) values (1,'admin','Administrators'),(2,'members','Members');

/*Table structure for table `label_graph1` */

DROP TABLE IF EXISTS `label_graph1`;

CREATE TABLE `label_graph1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_graph1` int(11) NOT NULL,
  `nama_label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_graph1` (`id_graph1`),
  CONSTRAINT `label_graph1_ibfk_1` FOREIGN KEY (`id_graph1`) REFERENCES `graph1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `label_graph1` */

insert  into `label_graph1`(`id`,`id_graph1`,`nama_label`) values (1,1,'January'),(2,1,'February'),(3,1,'March'),(4,1,'April'),(5,1,'May'),(6,1,'June'),(7,1,'July');

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(100) NOT NULL,
  `slug` varchar(10) NOT NULL,
  `language_directory` varchar(100) NOT NULL,
  `language_code` varchar(20) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `languages` */

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

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) values (1,'127.0.0.1','administrator','$2y$08$G0h47xFzvBDD3DjwWD13XeCfwGuZgqtSodh5ARhDJLLWPRv0jSgfG','','nor.khakim@gmail.com','',NULL,NULL,NULL,1268889823,1488867821,1,'Admin','istrator','ADMIN','0');

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
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values (3,1,1);

/* Function  structure for function  `get_nilai` */

/*!50003 DROP FUNCTION IF EXISTS `get_nilai` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_nilai`(`p_noreg` VARCHAR(20),`mk_id` VARCHAR(20)) RETURNS varchar(20) CHARSET latin1
BEGIN
	DECLARE hasil VARCHAR(20);
	
SELECT 
    if(AK_NILAI is null,'-',AK_NILAI) as AK_NILAI
    into hasil
  FROM
    t_ang_kel B,
    t_kel_prak C,
    t_prak_tawar D 
  WHERE B.KP_ID = C.KP_ID 
    AND C.PRA_ID = D.PRA_ID 
    AND D.MK_ID = mk_id
    AND B.MHS_NOREG = p_noreg
    AND B.AK_NILAI IS NOT NULL 
    ORDER BY B.AK_NILAI ASC LIMIT 0,1; 
  
  RETURN hasil;
  
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
