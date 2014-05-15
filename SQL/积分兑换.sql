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

 Date: 05/09/2014 09:46:42 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `meipin_exchange`
-- ----------------------------
CREATE TABLE `meipin_exchange` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '价格',
  `integral` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `start_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `need_level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '等级要求',
  `taobao_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '淘宝id',
  `taobaoke_url` varchar(200) NOT NULL COMMENT '淘宝客url',
  `support_name` varchar(50) DEFAULT '' COMMENT '赞助卖家昵称',
  `support_url` varchar(200) NOT NULL COMMENT '卖家店址',
  `description` text COMMENT '描述',
  `img_url` varchar(200) NOT NULL COMMENT '图片',
  `is_delete` tinyint(1) unsigned DEFAULT '0' COMMENT '是否删除0否 1是',
  `sale_num` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
  `user_count` int(11) NOT NULL DEFAULT '0' COMMENT '参与用户数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `creater_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `update_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后编辑人',
  PRIMARY KEY (`id`),
  KEY `start_time` (`start_time`) USING BTREE,
  KEY `end_time` (`end_time`) USING BTREE,
  KEY `need_level` (`need_level`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='积分活动表'
SET FOREIGN_KEY_CHECKS = 1;

-- ----------------------------
--  Table structure for `meipin_exchange_log`
-- 积分商品兑换记录
-- ----------------------------
CREATE TABLE `meipin_exchange_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `created_at` int(11) NOT NULL COMMENT '兑换时间',
  `goods_id` int(11) NOT NULL COMMENT '兑换商品ID',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `remark` varchar(500) DEFAULT '' COMMENT '备注',
  `city_id` int(11) NOT NULL COMMENT '兑换城市ID',
  `address` varchar(100) DEFAULT '' COMMENT '兑换地址',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `user_id` (`user_id`),
  KEY `goods_id` (`goods_id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COMMENT='用户积分商品兑换记录';

CREATE TABLE `meipin_score_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `opt_type` int(11) NOT NULL DEFAULT '0' COMMENT '1:增加；2；减少',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) DEFAULT '0',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '积分数目',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='积分变更日志';