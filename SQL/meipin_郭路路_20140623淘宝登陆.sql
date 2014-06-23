ALTER TABLE `meipin_users`
ADD COLUMN `tb_userid`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '淘宝登陆唯一id' AFTER `mobile`;
  //淘宝登陆唯一id
