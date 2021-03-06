-- 2014-06-06 增加抽奖商品类型
alter table `meipin_exchange` add goods_type tinyint(4) DEFAULT 0 COMMENT '商品类型，0:积分兑换商品；1:抽奖商品';
alter table `meipin_exchange` add limit_count tinyint(4) DEFAULT 1 COMMENT '中奖名额';
alter table `meipin_exchange` add lottery_time int DEFAULT null COMMENT '开奖时间';
alter table `meipin_exchange` add lottery_status int DEFAULT 0 COMMENT '开奖状态，1：已经开奖';
alter table `meipin_exchange_log` add user_add tinyint(4) DEFAULT null COMMENT '后台用户添加，1：后台用户添加';
alter table `meipin_exchange_log` add winner tinyint(4) DEFAULT 0 COMMENT '中奖标识,1:中奖用户';

alter table meipin_exchange_log modify gdscolor varchar(50) null default '';
alter table meipin_exchange_log modify user_id int null default 0;
alter table meipin_exchange_log modify name varchar(50) null default '';
alter table meipin_exchange_log modify city_id int null default 0;
alter table meipin_exchange_log modify address varchar(100) null default '';
alter table meipin_exchange_log modify postcode varchar(10) null default '';
alter table meipin_exchange_log modify mobile varchar(15) null default '';
