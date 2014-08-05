<?php
class Taobao extends CComponent
{
	public function getTaobao($taobaoId)
	{
		Yii::import('common.extensions.taobao.top.*');
		Yii::import('common.extensions.taobao.top.request.*');
		Yii::import('common.extensions.taobao.lotusphp_runtime.*');

		$c = new TopClient;
		$c->appkey = '21458915';
		$c->secretKey = 'de46e97329930b7444bcb0eed6133d5c';
		$req = new TaobaokeMobileItemsConvertRequest;
		$req->setFields("click_url");
		$req->setNumIids($taobaoId);
		$req->setOuterCode("bbs");
		$resp = $c->execute($req);

		$url = 'http://www.jtzdm.com/';
		if ($resp) {
			if (isset($resp->taobaoke_items)) {
				if (isset($resp->taobaoke_items->taobaoke_item)) {
					$url = (string) $resp->taobaoke_items->taobaoke_item->click_url;
				}
			}
		}
		return $url;
	}

	public function getGoods($taobaoId)
	{
		Yii::import('common.extensions.taobao.top.*');
		Yii::import('common.extensions.taobao.top.request.*');
		Yii::import('common.extensions.taobao.lotusphp_runtime.*');

		$c = new TopClient;
		$c->appkey = '21458915';
		$c->secretKey = 'de46e97329930b7444bcb0eed6133d5c';
		$req = new TbkItemsDetailGetRequest;
		$req->setFields("num_iid,seller_id,nick,title,price,volume,pic_url,item_url,shop_url");
		$req->setNumIids($taobaoId);
		$resp = $c->execute($req);
		return $resp->tbk_items->tbk_item;
	}

	public function getPicurl($taobaoId)
	{
		Yii::import('common.extensions.taobao.top.*');
		Yii::import('common.extensions.taobao.top.request.*');
		Yii::import('common.extensions.taobao.lotusphp_runtime.*');

		$c = new TopClient;
		$c->appkey = '21458915';
		$c->secretKey = 'de46e97329930b7444bcb0eed6133d5c';
		$req = new TbkItemsDetailGetRequest;
		$req->setFields("pic_url");
		$req->setNumIids($taobaoId);
		$resp = $c->execute($req);
		return $resp->tbk_items->tbk_item;
	}
}
