-- 2014-06-06 增加抽奖商品类型
alter table `meipin_exchange` add goods_type tinyint(4) DEFAULT NULL COMMENT '商品类型，0:积分兑换商品；1:抽奖商品';
alter table `meipin_exchange` add limit_count tinyint(4) DEFAULT 1 COMMENT '中奖名额';