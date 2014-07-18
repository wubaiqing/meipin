ALTER TABLE `meipin_exchange` ADD COLUMN `active_price`  decimal(10,2) NULL COMMENT '活动价格' ;
ALTER TABLE `meipin_exchange`
ADD COLUMN `buy_num2`  int(5) NULL DEFAULT 3 COMMENT '限制购买件数' ;

//创建 操作日志表
CREATE TABLE `meipin_operatelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1：人工后台；2：脚本执行',
  `log_type` int(2) DEFAULT NULL,
  `operatedata` varchar(255) DEFAULT NULL COMMENT '操作记录',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志表';


ALTER TABLE `meipin_exchange_log`ADD COLUMN `order_id`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '订单号' ;

DROP TABLE IF EXISTS `meipin_order`;
CREATE TABLE `meipin_order` (
  `order_id` varchar(20) NOT NULL DEFAULT '' COMMENT '订单开头,兑换：D;',
  `pay_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0：未支付；1：取消；2：支付中；3：支付失败；4：已支付；',
  `order_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1:兑换订单',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `remark` varchar(200) NOT NULL DEFAULT '' COMMENT '备注信息',
  `pay_way` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付方式',
  `buy_count` int(11) NOT NULL COMMENT '购买数量',
  `market_price` decimal(10,2) DEFAULT '0.00' COMMENT '市场价格',
  `pay_price` decimal(10,2) DEFAULT '0.00' COMMENT '支付价格',
  `integral` int(11) DEFAULT '0' COMMENT '积分消耗',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品ID',
  PRIMARY KEY (`order_id`),
  KEY `pay_status` (`pay_status`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `pay_time` (`pay_time`),
  KEY `user_id` (`user_id`),
  KEY `goods_id` (`goods_id`),
  KEY `pay_price` (`pay_price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单数据表';

ALTER TABLE `meipin_exchange_log`
ADD COLUMN `pay_status`  tinyint(4) NULL DEFAULT 0 COMMENT '0：未支付；1：取消；2：支付中；3：支付失败；4：已支付；'
