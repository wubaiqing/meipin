/*
SQLyog 企业版 - MySQL GUI v7.14 
MySQL - 5.1.36-community-log : Database - meipin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`meipin` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `meipin`;

/*Table structure for table `credit` */

DROP TABLE IF EXISTS `credit`;

CREATE TABLE `credit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `score` int(11) NOT NULL COMMENT '总积分',
  `dateline` int(10) NOT NULL COMMENT '时间',
  `date_year` int(10) NOT NULL COMMENT '年份',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `credit` */

/*Table structure for table `credit_gift` */

DROP TABLE IF EXISTS `credit_gift`;

CREATE TABLE `credit_gift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '礼品名称',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '礼品图片',
  `stock` int(11) NOT NULL COMMENT '礼品库存个数',
  `need_score` int(11) NOT NULL COMMENT '所需积分',
  `status` enum('created','published','deleted') NOT NULL DEFAULT 'created' COMMENT '状态',
  `remain_num` int(11) NOT NULL COMMENT '礼品剩余个数',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '积分描述',
  `start_time` int(10) NOT NULL COMMENT '开始时间',
  `end_time` int(10) NOT NULL COMMENT '结束时间',
  `dateline` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `credit_gift` */

/*Table structure for table `credit_record` */

DROP TABLE IF EXISTS `credit_record`;

CREATE TABLE `credit_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `credit_id` int(11) NOT NULL COMMENT '积分主表id',
  `description` varchar(150) NOT NULL DEFAULT '' COMMENT '积分详情描述',
  `change_type` enum('increase','decrease') NOT NULL DEFAULT 'increase' COMMENT '积分变化，“increase”：增加；“decrease”：消耗',
  `score` int(11) NOT NULL COMMENT '增加或消耗的积分数',
  `channel` int(11) NOT NULL COMMENT '积分增减途径',
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `credit_record` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
