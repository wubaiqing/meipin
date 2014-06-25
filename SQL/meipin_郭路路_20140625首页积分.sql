ALTER TABLE `meipin_exchange`
ADD COLUMN `is_first`  int(1) NULL DEFAULT 2 COMMENT '1显示在首页2不显示在首页' ;
ALTER TABLE `meipin_exchange`
ADD COLUMN `list_order`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '排序';