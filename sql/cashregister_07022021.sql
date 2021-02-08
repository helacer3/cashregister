/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.14-MariaDB : Database - cashregister
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `cashregister` */

DROP TABLE IF EXISTS `cashregister`;

CREATE TABLE `cashregister` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `currency_id` int(5) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cashregister` */

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `enabled` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `currency` */

insert  into `currency`(`id`,`value`,`enabled`) values 
(1,50,1),
(2,100,1),
(3,200,1),
(4,500,1),
(5,1000,1),
(6,5000,1),
(7,10000,1),
(8,20000,1),
(9,50000,1),
(10,100000,1);

/*Table structure for table `movements` */

DROP TABLE IF EXISTS `movements`;

CREATE TABLE `movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('entry','exit') DEFAULT NULL,
  `currency_id` int(5) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `movements` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
