ALTER TABLE `meipin_users` MODIFY COLUMN `password`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '密码' AFTER `username`; //将密码设置为空

ALTER TABLE `meipin_users` MODIFY COLUMN `email`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '邮箱' AFTER `password`; //邮箱设置为空

ALTER TABLE `meipin_users`
MODIFY COLUMN `salt`  varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '加密字符串' AFTER `email`;  //加密字符串 设置为空

ALTER TABLE `meipin_users`
MODIFY COLUMN `is_valid`  tinyint(1) NULL DEFAULT 0 COMMENT '邮箱是否验证' AFTER `last_dr_time`;
//邮箱是否验证 设置为空

ALTER TABLE `meipin_users`
ADD COLUMN `qq_openid`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'qq登陆唯一openid' AFTER `mobile`;
  //添加qq登路唯一id

ALTER TABLE `meipin_users_address`
ADD COLUMN `email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '添加邮箱' AFTER `updated_at`;

