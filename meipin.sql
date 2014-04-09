# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.17)
# Database: meipin
# Generation Time: 2014-04-08 14:01:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table banner
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL DEFAULT '',
  `picture` varchar(255) DEFAULT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `color` varchar(6) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;

INSERT INTO `banner` (`id`, `url`, `picture`, `width`, `height`, `color`, `created_at`, `updated_at`)
VALUES
	(1,'http://s.click.taobao.com/t?e=m%3D2%26s%3DfIXSyaT0ZowcQipKwQzePCperVdZeJvipRe%2F8jaAHci5VBFTL4hn2XF7QDp8jd1hEC56fBbgyn5VdniujcgNViqhfu7mJN3pHJGLZaCjJx0J17j8lh83Vb0CYBEjBf0rLxRPKN2FDAck%2FCKKDVvEs8hC7k91emiMomfkDJRs%2BhU%3D','http://gtms03.alicdn.com/tps/i3/T1OAlMFEpnXXaAjx6s-990-80.jpg',990,80,'d51638',0,1394242926),
	(2,'http://www.40zhe.com/static/footFatorite.jpg','http://www.40zhe.com/static/footFatorite.jpg',980,0,NULL,0,1394242926);

/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bookmark
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bookmark`;

CREATE TABLE `bookmark` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bookmark` WRITE;
/*!40000 ALTER TABLE `bookmark` DISABLE KEYS */;

INSERT INTO `bookmark` (`id`, `name`, `url`, `created_at`, `updated_at`)
VALUES
	(30,'今天值得买','http://www.jtzdm.com',1383280530,1383280530),
	(32,'天猫','http://www.tmall.com',1383280592,1383280592),
	(34,'折800文体','http://www.zhe800.com/ju_tag/taoqita',1383280963,1383280963),
	(35,'欢乐淘','http://www.chuchujie.com/huanletao/',1383281071,1383281071),
	(36,'值得买','http://www.waitao.cn/',1383281134,1383281134),
	(37,'淘牛品','http://tealife.uz.taobao.com',1383281152,1383281152),
	(38,'vip特惠','http://mytehui.uz.taobao.com',1383281222,1383281222),
	(39,'vip专享','http://jiejie.uz.taobao.com',1383281237,1383281237),
	(40,'特价猫','http://ju.tejiamao.com',1383281463,1383281463),
	(41,'淘宝值得买','http://cu.taobao.com/item_list.htm',1383281483,1383281483),
	(42,'阿里妈妈','http://www.alimama.com',1383281499,1383281499),
	(45,'超优汇','http://you.taobao.com',1383494979,1383494979),
	(46,'聚划算','http://ju.taobao.com',1383495001,1383495001),
	(48,'会员购','http://huiyuangou.uz.taobao.com',1383665344,1383665344),
	(49,'蛮便宜','http://www.manpianyi.com',1383706922,1383706922);

/*!40000 ALTER TABLE `bookmark` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `name`, `parent_id`, `created_at`, `updated_at`)
VALUES
	(1,'女装',0,1378188867,1378188867),
	(4,'男装',0,1378189569,1378189569),
	(5,'居家',0,1378192734,1378192734),
	(6,'母婴',0,1378194472,1378194472),
	(7,'鞋包',0,1378194479,1378194479),
	(8,'配饰',0,1378194502,1378194502),
	(9,'美食',0,1378194543,1378194543),
	(10,'数码家电',0,1378194554,1378194554),
	(11,'化妆品',0,1378194563,1378194563),
	(12,'文体',0,1378194572,1382927785);

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table goods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `goods`;

CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_id` bigint(20) NOT NULL,
  `relation_website` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `origin_price` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `list_order` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `is_activity` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'æ˜¯å¦æ˜¯æ´»åŠ¨ç±»å•†å“',
  `goods_type` tinyint(2) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `is_zhe800` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'æ˜¯å¦æ˜¯æŠ˜800',
  PRIMARY KEY (`id`),
  KEY `in_price` (`price`),
  KEY `in_start_time` (`start_time`),
  KEY `in_end_time` (`end_time`),
  KEY `in_list_order` (`list_order`),
  KEY `relation_website` (`relation_website`),
  KEY `in_created_at` (`created_at`),
  KEY `in_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `links`;

CREATE TABLE `links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `source` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;

INSERT INTO `links` (`id`, `image_url`, `url`, `created_at`, `updated_at`, `source`)
VALUES
	(6,'http://img01.taobaocdn.com/imgextra/i1/41553656/T2bj9BXsBaXXXXXXXX-41553656.jpg','http://zhe800.uz.taobao.com/',1387719123,1387719123,1),
	(7,'http://img04.taobaocdn.com/imgextra/i4/731736903/T2U4ZkXaBbXXXXXXXX_!!731736903.gif','http://woniu.uz.taobao.com/',1389685932,1389685932,1),
	(8,'http://img04.taobaocdn.com/imgextra/i4/677188898/T2JA1lXuxXXXXXXXXX_!!677188898.jpg','http://yunduan.uz.taobao.com/',1389850018,1389850018,1),
	(10,'http://img01.taobaocdn.com/imgextra/i1/788168289/T2ICdkXs4XXXXXXXXX_!!788168289.jpg','http://teshi.uz.taobao.com/',1389850127,1389850127,1),
	(11,'http://img03.taobaocdn.com/imgextra/i3/458339043/T2wa6EXjxaXXXXXXXX_!!458339043.gif','http://yuehui.uz.taobao.com/',1389850188,1389850188,1),
	(12,'http://img04.taobaocdn.com/imgextra/i4/1913287961/T2Kqe6XrVaXXXXXXXX-1913287961.jpg','http://198671.uz.taobao.com',1392264979,1392264979,1),
	(13,'http://img02.taobaocdn.com/imgextra/i2/32363249/T2iRG_XDpXXXXXXXXX-32363249.jpg','http://miaola.uz.taobao.com/',1392352016,1392352016,1),
	(14,'http://img03.taobaocdn.com/imgextra/i3/1922434910/T2ZpWeXBVaXXXXXXXX_!!1922434910.gif','http://shikuaiba.uz.taobao.com',1392703424,1392703424,1),
	(15,'http://img02.taobaocdn.com/imgextra/i2/1657761255/T2yMvcXxRaXXXXXXXX-1657761255.jpg','http://haowo.uz.taobao.com/',1392704259,1392704259,1),
	(20,'京东','http://www.jd.com',1393345684,1393345684,2),
	(21,'三只松鼠','http://sanzhisongshu.yhd.com',1393345700,1393345700,2);

/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table store
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `spread` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `list_order` tinyint(1) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;

INSERT INTO `store` (`id`, `cat_id`, `name`, `url`, `spread`, `logo`, `status`, `list_order`, `created_at`, `updated_at`)
VALUES
	(5,5,'京东商城','http://www.jd.com','http://p.yiqifa.com/c?s=f774215e&w=675884&c=254&i=160&l=0&e=zdm&t=http://www.jd.com/','http://static.jtzdm.com/static/images/2013/09/22/7aO391379843532523ebdcc378f5.jpg',1,NULL,1379843535,1380001242),
	(6,5,'淘宝网','http://www.taobao.com/','http://www.taobao.com/','http://static.jtzdm.com/static/images/2013/09/22/S1dYL1379845358523ec4eea3218.png',1,NULL,1379845362,1379845362),
	(7,5,'当当网','http://www.dangdang.com','http://p.yiqifa.com/c?s=b953375a&w=675884&c=247&i=159&l=0&e=zdm&t=http://www.dangdang.com','http://static.jtzdm.com/static/images/2013/09/22/ulvlt1379845448523ec5482244d.png',1,NULL,1379845450,1380001218),
	(8,5,'亚马逊','http://www.z.cn/','http://www.z.cn/','http://static.jtzdm.com/static/images/2013/09/22/TdG0f1379845523523ec593143c3.png',1,NULL,1379845524,1379845524),
	(9,5,'苏宁易购','http://www.suning.com','http://p.yiqifa.com/c?s=02bdfa05&w=675884&c=4459&i=5662&l=0&e=zdm&t=http://www.suning.com/','http://static.jtzdm.com/static/images/2013/09/22/EnsD41379845620523ec5f415bf6.png',1,NULL,1379845620,1380001187),
	(10,5,'1号店','http://www.yihaodian.com','http://p.yiqifa.com/c?s=f18c0253&w=675884&c=139&i=802&l=0&e=zdm&t=http://www.yihaodian.com/product/index.do','http://static.jtzdm.com/static/images/2013/09/22/KceYv1379845703523ec64719dbb.png',1,NULL,1379845704,1379999439),
	(11,5,'易迅网','http://www.yixun.com','http://p.yiqifa.com/c?s=42f03beb&w=675884&c=4330&i=4984&l=0&e=zdm&t=http://www.yixun.com','http://static.jtzdm.com/static/images/2013/09/22/LLUTn1379845786523ec69a6890d.png',1,NULL,1379845788,1379999405),
	(12,5,'为为网','http://www.homevv.com/','http://c.duomai.com/track.php?site_id=68664&aid=291&euid=zdm&t=http%3A%2F%2Fwww.homevv.com%2F','http://static.jtzdm.com/static/images/2013/09/22/CQ0bq1379846001523ec771e7a6e.png',1,NULL,1379846018,1379846018),
	(13,7,'库巴网','http://www.coo8.com','http://p.yiqifa.com/c?s=8aef4aba&w=675884&c=3461&i=2462&l=0&e=zdm&t=http://www.coo8.com/','http://static.jtzdm.com/static/images/2013/09/22/otmIm1379846414523ec90e8e7be.png',1,NULL,1379846416,1379999353),
	(14,7,'新蛋网','http://www.newegg.com.cn','http://p.yiqifa.com/c?s=d7fed94d&w=675884&c=280&i=240&l=0&e=zdm&t=http://www.newegg.com.cn','http://static.jtzdm.com/static/images/2013/09/22/MHvL51379846531523ec9831e62f.png',1,NULL,1379846509,1379999312),
	(15,5,'国美在线','http://www.gome.com.cn/','http://p.yiqifa.com/c?s=1c463abf&w=675884&c=5579&i=14922&l=0&e=zdm&t=http://www.gome.com.cn/ec/homeus/index.html','http://static.jtzdm.com/static/images/2013/09/22/zpsaD1379850333523ed85d0756e.png',1,NULL,1379850334,1379999270),
	(16,7,'卓美网','http://www.zm7.cn/','http://p.yiqifa.com/c?s=d8240cac&w=675884&c=5532&i=13082&l=0&e=zdm&t=http://www.zm7.cn/index.php','http://static.jtzdm.com/static/images/2013/09/22/5fMye1379850946523edac22ec63.png',1,NULL,1379850947,1379999242),
	(17,12,'唯品会','http://www.vipshop.com','http://p.yiqifa.com/c?s=c1124097&w=675884&c=4018&i=2882&l=0&e=zdm&t=http://www.vip.com','http://static.jtzdm.com/static/images/2013/09/22/JVFDC1379851014523edb063eb3d.png',1,NULL,1379851016,1386644321),
	(18,12,'聚尚网','http://www.fclub.cn','http://p.yiqifa.com/c?s=3cd04bf7&w=675884&c=4411&i=9702&l=0&e=zdm&t=http://www.fclub.cn','http://static.jtzdm.com/static/images/2013/09/22/oDnCh1379851069523edb3d3632d.png',1,NULL,1379851070,1379999182),
	(19,12,'俏物悄语','http://www.ihush.com','http://c.duomai.com/track.php?site_id=68664&aid=300&euid=zdm&t=http%3A%2F%2Fwww.ihush.com%2F','http://static.jtzdm.com/static/images/2013/09/22/l70D21379851189523edbb518373.png',1,NULL,1379851190,1379851190),
	(20,12,'走秀网','http://www.xiu.com','http://p.yiqifa.com/c?s=cd65c74b&w=675884&c=302&i=241&l=0&e=zdm&t=http://www.xiu.com','http://static.jtzdm.com/static/images/2013/09/22/YiZYI1379851272523edc083e13d.png',1,NULL,1379851274,1379999148),
	(21,12,'优购网','http://www.yougou.com/  ','http://c.duomai.com/track.php?site_id=68664&aid=366&euid=zdm&t=http%3A%2F%2Fwww.yougou.com%2F','http://static.jtzdm.com/static/images/2013/09/22/hbRti1379851405523edc8d968c2.png',1,NULL,1379851407,1379851407),
	(22,12,'银泰网','http://www.yintai.com','http://p.yiqifa.com/c?s=29a71a41&w=675884&c=4982&i=8822&l=0&e=zdm&t=http://www.yintai.com','http://static.jtzdm.com/static/images/2013/09/22/a1yj41379851480523edcd86915c.png',1,NULL,1379851481,1379999108),
	(23,6,'凡客诚品','http://www.vancl.com','http://p.yiqifa.com/c?s=60809eac&w=675884&c=255&i=150&l=0&e=zdm&t=http://www.vancl.com','http://static.jtzdm.com/static/images/2013/09/22/8S2Am1379851577523edd39be7a0.png',1,NULL,1379851578,1379999075),
	(24,6,'梦芭莎','http://www.moonbasa.com','http://p.yiqifa.com/c?s=e5759b61&w=675884&c=298&i=20483&l=0&e=zdm&t=http://www.moonbasa.com','http://static.jtzdm.com/static/images/2013/09/22/wcrRO1379851727523eddcf13dac.png',1,NULL,1379851733,1379999047),
	(25,11,'我买网','http://www.womai.com/','http://p.yiqifa.com/c?s=cefc2634&w=675884&c=4102&i=3542&l=0&e=zdm&t=http://www.womai.com','http://static.jtzdm.com/static/images/2013/09/24/XyzIv1380016960524163402f22c.png',1,NULL,1380016962,1380016962),
	(26,6,'兰缪','http://www.lamiu.com','http://p.yiqifa.com/c?s=116c66c5&w=675884&c=4220&i=4482&l=0&e=zdm&t=http://www.lamiu.com','http://static.jtzdm.com/static/images/2013/09/24/0y6XX138001892852416af0f098d.png',1,NULL,1380018930,1380018930),
	(27,6,'玛萨玛索','http://www.masamaso.com','http://p.yiqifa.com/c?s=2b6719d4&w=675884&c=900&i=1682&l=0&e=zdm&t=http://www.masamaso.com','http://static.jtzdm.com/static/images/2013/09/24/7zITn138001898052416b248de08.png',1,NULL,1380018981,1380018981),
	(28,6,'名鞋库','http://www.s.cn','http://p.yiqifa.com/c?s=dd009db4&w=675884&c=4156&i=4162&l=0&e=zdm&t=http://www.s.cn','http://static.jtzdm.com/static/images/2013/09/24/lyaQz138001903252416b580a2d7.png',1,NULL,1380019033,1380019033),
	(29,6,'拍鞋网','http://www.paixie.net/','http://p.yiqifa.com/c?s=6a87f1fa&w=675884&c=4709&i=6822&l=0&e=zdm&t=http://www.paixie.net/','http://static.jtzdm.com/static/images/2013/09/24/K1G1O138001910452416ba0b5dbd.png',1,NULL,1380019106,1380019106),
	(30,6,'麦包包','http://www.mbaobao.com','http://p.yiqifa.com/c?s=2a4039af&w=675884&c=272&i=137&l=0&e=zdm&t=http://www.mbaobao.com','http://static.jtzdm.com/static/images/2013/09/24/FcIXK138001916252416bda33d7a.png',1,NULL,1380019165,1380019165),
	(31,6,'麦网','http://www.m18.com','http://p.yiqifa.com/c?s=3fbdff9b&w=675884&c=4275&i=4662&l=0&e=zdm&t=http://www.m18.com','http://static.jtzdm.com/static/images/2013/09/24/yia9W138001928052416c50471ef.jpg',1,NULL,1380019308,1380019308),
	(32,6,'凡客vjia','http://www.vjia.com/','http://p.yiqifa.com/c?s=3ea135d5&w=675884&c=4753&i=7082&l=0&e=zdm&t=http://www.vjia.com/','http://static.jtzdm.com/static/images/2013/09/24/OxUJi13800352065241aa86d0a43.png',1,NULL,1380035208,1380035208),
	(33,9,'聚美优品','http://www.jumei.com/','http://p.yiqifa.com/c?s=baf51838&w=675884&c=5227&i=10462&l=0&e=zdm&t=http://www.jumei.com/','http://static.40zhe.com/static/images/2013/09/28/5YgSf138033669652464438cbf97.png',1,NULL,1380336697,1380336697),
	(34,9,'乐蜂网','http://www.lefeng.com/','http://p.yiqifa.com/c?s=9f5abf9d&w=648173&c=227&i=196&l=0&e=&t=http://www.lefeng.com/','http://static.40zhe.com/static/images/2013/11/06/pyTM21383728848527a06d0c7d95.png',1,NULL,1383728851,1383728851);

/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table store_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store_category`;

CREATE TABLE `store_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `store_category` WRITE;
/*!40000 ALTER TABLE `store_category` DISABLE KEYS */;

INSERT INTO `store_category` (`id`, `name`, `parent_id`, `created_at`, `updated_at`)
VALUES
	(5,'综合商城',0,1379843228,1379843228),
	(6,'服装服饰',0,1379843242,1379843242),
	(7,'数码家电',0,1379843255,1379843255),
	(8,'鞋子箱包',0,1379843267,1379843267),
	(9,'美容护肤',0,1379843277,1379843277),
	(10,'母婴童装',0,1379843305,1379843305),
	(11,'美食酒茶',0,1379843348,1379843348),
	(12,'名品打折',0,1379843359,1379843359),
	(13,'图书教育',0,1379843368,1379843368),
	(14,'居家日用',0,1379843377,1379843377),
	(15,'医疗保健',0,1379843391,1379843391),
	(16,'旅游酒店',0,1379843401,1379843401);

/*!40000 ALTER TABLE `store_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_login_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_login_log`;

CREATE TABLE `user_login_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;