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
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `created_at` int(11) NOT NULL COMMENT '兑换时间',
  `goods_id` int(11) NOT NULL COMMENT '兑换商品ID',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `remark` varchar(500) DEFAULT '' COMMENT '备注',
  `city_id` int(11) NOT NULL COMMENT '兑换城市ID',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '兑换地址',
  `postcode` varchar(10) NOT NULL DEFAULT '' COMMENT '邮编',
  `mobile` varchar(15) NOT NULL DEFAULT '' COMMENT '手机',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '发货状态：0:未发货；1：已发货；',
  `username` varchar(50) DEFAULT NULL COMMENT '登录名',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `user_id` (`user_id`),
  KEY `goods_id` (`goods_id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8 COMMENT='用户积分商品兑换记录';
CREATE TABLE `meipin_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '积分增减',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `reason` int(4) NOT NULL COMMENT '积分操作理由(1:签到增加;2:商品兑换;)',
  `remark` varchar(100) DEFAULT '' COMMENT '备注',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `goods_id` int(11) DEFAULT '0' COMMENT '商品ID',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COMMENT='积分明细表';