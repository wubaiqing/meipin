<?php
include("./top/TopClient.php");
include("./top/RequestCheckUtil.php");
include("./lotusphp_runtime/Logger/Logger.php");
include("./top/request/UserGetRequest.php");
/*$c = new TopClient;
$c->appkey = '21790400';
$c->secretKey = 'd75dab54c3eee4bad7be8769efbda7fa';
$user = new UserGetRequest;
$user->setFields("user_id,uid,nick,sex");
var_dump($user->check());
*/

/*$c = new TopClient;
$c->appkey = '1021790400';
$c->secretKey = 'sandbox4c3eee4bad7be8769efbda7fa';
$req = new UserBuyerGetRequest;
$req->setFields("nick,avatar");
$sessionKey="62006272660a7c2088d64e129afa792ba0bdfdef2af0777182558410";
$resp = $c->execute($req, $sessionKey);
var_dump($resp);*/

$c = new TopClient;
$c->appkey = '1021790400';
$c->secretKey = 'sandbox4c3eee4bad7be8769efbda7fa';
$req = new UserGetRequest;
$req->setFields("user_id,nick,sex,seller_credit,type,has_more_pic,item_img_num,item_img_size,prop_img_num,prop_img_size,auto_repost,promoted_type,status,alipay_bind,consumer_protection,avatar");

$sessionKey="620041005fa8903b50ZZb27670b7a9e587e0876a74ca9ac182558410";

$resp = $c->execute($req, $sessionKey);
var_dump($resp);

?>