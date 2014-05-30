/*
Navicat MySQL Data Transfer

Source Server         : bendi
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : meipin

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2014-05-30 11:24:48
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of meipin_feedback
-- ----------------------------
INSERT INTO `meipin_feedback` VALUES ('1', 'gdg', null, 'dgd', null, null);
INSERT INTO `meipin_feedback` VALUES ('2', 'gdg', null, 'dgd', null, null);
INSERT INTO `meipin_feedback` VALUES ('3', 'gdg', null, 'dgd', null, null);
INSERT INTO `meipin_feedback` VALUES ('4', 'gdg', null, 'dgd', null, null);
INSERT INTO `meipin_feedback` VALUES ('5', 'gdg', null, 'dgd', null, null);
INSERT INTO `meipin_feedback` VALUES ('6', 'efaw', null, 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('7', 'efaw', null, 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('8', 'efaw', 'fawefw', 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('9', '121', '1212', 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('10', 'qwqwqw', '', 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('11', 'qwqwqw', 'grilas@163.com', 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('12', 'qwqwqw', 'grilas@163.com', 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('13', 'qwqwqw', 'grilas@163.com', 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('14', 'qwqwqw', 'grilas@163.com', 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('15', 'qwqwqw', 'grilas@163.com', 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('16', 'qwqwqw', '', 'wfeaw', null, null);
INSERT INTO `meipin_feedback` VALUES ('17', '1212', '', 'rerere', null, null);
INSERT INTO `meipin_feedback` VALUES ('18', '1212', '', 'rerere', null, null);
INSERT INTO `meipin_feedback` VALUES ('19', '1212', '', 'rerere', null, null);
INSERT INTO `meipin_feedback` VALUES ('20', '1212', '', 'rerere', null, null);
INSERT INTO `meipin_feedback` VALUES ('21', 'fwaefr', '', 'wefawe', null, null);
INSERT INTO `meipin_feedback` VALUES ('22', 'fawefa', '', 'wefawe', '1401415998', '1401415998');
