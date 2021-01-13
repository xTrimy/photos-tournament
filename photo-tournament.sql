/*
SQLyog Community
MySQL - 10.1.37-MariaDB : Database - photo-tournament
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`photo-tournament` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `photo-tournament`;

/*Table structure for table `history` */

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `image_url` varchar(64) DEFAULT NULL,
  `win_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `history` */

insert  into `history`(`id`,`user_id`,`image_url`,`win_time`) values 
(9,1,'https://photo-voting.hiring.ipums.org/images/092.jpg',NULL),
(10,1,'https://photo-voting.hiring.ipums.org/images/041.jpg',NULL),
(11,1,'https://photo-voting.hiring.ipums.org/images/018.jpg',NULL),
(12,1,'https://photo-voting.hiring.ipums.org/images/099.jpg',NULL),
(13,2,'https://photo-voting.hiring.ipums.org/images/096.jpg',NULL),
(14,2,'https://photo-voting.hiring.ipums.org/images/117.jpg',NULL),
(15,2,'https://photo-voting.hiring.ipums.org/images/078.jpg',NULL),
(16,2,'https://photo-voting.hiring.ipums.org/images/121.jpg',NULL),
(17,2,'https://photo-voting.hiring.ipums.org/images/089.jpg',NULL),
(18,2,'https://photo-voting.hiring.ipums.org/images/032.jpg','2021-01-13 14:31:46');

/*Table structure for table `login_tokens` */

DROP TABLE IF EXISTS `login_tokens`;

CREATE TABLE `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `login_tokens` */

insert  into `login_tokens`(`id`,`token`,`user_id`) values 
(1,'2c125653c3325a597fa61998bffbb10d6bd94861',1),
(2,'b8505e7eeb0611947e13eb11617f6c6c26ebbd82',2),
(3,'e5dffe79990ec6de0ef0d884783bf019157a5ab1',2),
(4,'5c1a86b1ecf2f35869b491e51b8bdcbb9be1aa40',2);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`) values 
(1,'Abdelrahman Sayed','abdelrahman3aysh@hotmail.com','$2y$10$ceZm7xNFXiZaSuZ1FKvCCe5SJ/UzLB8nTRYO9nKeRW75vPHqaYcs.'),
(2,'Mohamed Ashraf','mohamed.ashraf881999@gmail.com','$2y$10$EzggCmBdSvQctwJ9a3h0cuJSK6FuJpVTJh.wuVx/hunZIXWfk1EyS');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
