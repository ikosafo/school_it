/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.7.21-log : Database - school
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`school` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `school`;

/*Table structure for table `academic_session` */

DROP TABLE IF EXISTS `academic_session`;

CREATE TABLE `academic_session` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `academicyear` varchar(256) DEFAULT NULL,
  `term` varchar(256) DEFAULT NULL,
  `date_started` date DEFAULT NULL,
  `date_ended` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `class` */

DROP TABLE IF EXISTS `class`;

CREATE TABLE `class` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(256) DEFAULT NULL,
  `class_id` varchar(256) DEFAULT NULL,
  `department` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `club` */

DROP TABLE IF EXISTS `club`;

CREATE TABLE `club` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `club_name` varchar(256) DEFAULT NULL,
  `club_id` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `course_class` */

DROP TABLE IF EXISTS `course_class`;

CREATE TABLE `course_class` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(250) DEFAULT NULL,
  `classid` int(12) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `course_id` varchar(256) DEFAULT NULL,
  `course_code` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(256) DEFAULT NULL,
  `department_id` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Table structure for table `institution_details` */

DROP TABLE IF EXISTS `institution_details`;

CREATE TABLE `institution_details` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `location` varchar(256) DEFAULT NULL,
  `telephone` varchar(256) DEFAULT NULL,
  `email_address` varchar(256) DEFAULT NULL,
  `logo` varchar(256) DEFAULT NULL,
  `logofile` varchar(256) DEFAULT NULL,
  `motto` varchar(256) DEFAULT NULL,
  `randomid` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `section` */

DROP TABLE IF EXISTS `section`;

CREATE TABLE `section` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(256) DEFAULT NULL,
  `section_id` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
