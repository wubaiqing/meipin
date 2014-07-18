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
