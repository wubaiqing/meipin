ALTER TABLE meipin_goods add COLUMN head_show int(11) Null COMMENT '首页是否永久显示';
ALTER TABLE meipin_goods add COLUMN log_start_time int(11) Null COMMENT '记录创建开始时间';
ALTER TABLE meipin_goods add COLUMN log_end_time int(11) Null COMMENT '记录创建结束时间';

