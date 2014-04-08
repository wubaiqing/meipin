<?php
class Yiqifa extends CComponent
{

	public function getYiqifaGoods($url)
	{
		Yii::import('common.extensions.yiqifa.utils.*');
		Yii::import('common.extensions.yiqifa.request.*');

        $c = new YiqifaOpen(Yii::app()->params['yiqifaAppKey'], Yii::app()->params['yiqifaSecret']);
        $c->format="json";

        $req = new ProductLinkGetRequest;
        $req->setFields("pdt_o_url");
        $req->setPdt_url($url);
		$req->setWtype(1);
        $resp = $c->execute($req);

		return $resp;
	}
}
