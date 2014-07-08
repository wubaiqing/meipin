alter table `meipin_exchange` add active_price DECIMAL(10,2) default null comment '活动价格';
alter table `meipin_exchange_log` add logistics INT(11) default 0 comment '物流公司';
alter table `meipin_exchange_log` add logistics_code VARCHAR(50) default '' comment '物流单号';
alter table `meipin_exchange_log` add order_id VARCHAR(20) default '' comment '订单号';
