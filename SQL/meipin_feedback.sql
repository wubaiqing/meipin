/*
Navicat MySQL Data Transfer

Source Server         : bendi
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : meipin

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2014-05-30 15:15:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `meipin_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `meipin_feedback`;
CREATE TABLE `meipin_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qq` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `advise` varchar(225) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `is_delete` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of meipin_feedback
-- ----------------------------
