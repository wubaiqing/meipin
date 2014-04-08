<?php

include("initSdk.php");

define('YQF_C_KEY' , '137990134171011718');
define('YQF_C_SECRET', 'a61d9e242779f8b00140672ababec438');

$c = new YiqifaOpen;
$c->consumerKey = "137990134171011718";
$c->consumerSecret = "a61d9e242779f8b00140672ababec438";
$c->format="json";
$req = new  ProductGetRequest;
$req->setFields("pid,p_name,web_id,web_name,ori_price,cur_price,pic_url,catid,cname,p_o_url,short_intro");
$req->setPdt_url("http://item.jd.com/779351.html");
$resp = $c->execute($req);

?>
