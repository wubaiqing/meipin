ALTER TABLE `meipin_users`
ADD COLUMN `qq_openid`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'qq登陆唯一openid' AFTER `mobile`;
  //添加qq登路唯一id

ALTER TABLE `meipin_users_address`
ADD COLUMN `email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '添加邮箱' AFTER `updated_at`;
