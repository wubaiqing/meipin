/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50616
 Source Host           : localhost
 Source Database       : meipin

 Target Server Type    : MySQL
 Target Server Version : 50616
 File Encoding         : utf-8

 Date: 05/08/2014 10:19:30 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `meipin_exchange`
-- ----------------------------
DROP TABLE IF EXISTS `meipin_exchange`;
CREATE TABLE `meipin_exchange` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `url_name` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'url名称',
  `num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '价格',
  `integral` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `start_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `need_level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '等级要求',
  `taobao_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '淘宝id',
  `detail_url` varchar(200) CHARACTER SET latin1 NOT NULL COMMENT '详情页面url',
  `taobaoke_url` varchar(200) CHARACTER SET latin1 NOT NULL COMMENT '淘宝客url',
  `support_name` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT '赞助卖家昵称',
  `support_url` varchar(200) CHARACTER SET latin1 NOT NULL COMMENT '卖家店址',
  `taobaoke_shop_url` varchar(200) CHARACTER SET latin1 NOT NULL DEFAULT '' COMMENT '淘宝客店址',
  `description` text CHARACTER SET latin1 NOT NULL COMMENT '描述',
  `img_url` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT '图片',
  `is_delete` tinyint(1) unsigned DEFAULT '0' COMMENT '是否删除0否 1是',
  PRIMARY KEY (`id`),
  KEY `start_time` (`start_time`) USING BTREE,
  KEY `end_time` (`end_time`) USING BTREE,
  KEY `need_level` (`need_level`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='积分活动表';

SET FOREIGN_KEY_CHECKS = 1;
