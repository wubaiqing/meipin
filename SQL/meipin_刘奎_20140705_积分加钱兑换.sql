alter table `meipin_exchange` add active_price DECIMAL(10,2) default null comment '活动价格';
alter table `meipin_exchange_log` add logistics INT(11) default 0 comment '物流公司';
alter table `meipin_exchange_log` add logistics_code VARCHAR(50) default '' comment '物流单号';
alter table `meipin_exchange_log` add pay_status tinyint(4) default 0 comment '0：未支付；1：支付中；2：已支付；3：支付失败';
