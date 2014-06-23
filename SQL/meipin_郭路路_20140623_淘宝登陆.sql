ALTER TABLE `meipin_users`
ADD COLUMN `tb_user`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'qq登陆唯一openid' AFTER `mobile`;
  //添加淘宝登陆唯一id

