<?php

/**
 * 美品网API接口
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class ApiController extends Controller
{
    /**
     * 手机客户端输出JSON
     */
    public function actionIphone($catId = 0)
    {
    $cacheKey = 'meipin-api-iphone-'.$catId;
        $result = Yii::app()->cache->get($cacheKey);
        if (!empty($result)) {
            $this->returnData(1, $result);
        }

        $criteria = Goods::getMobileCriteria($catId);
        $goods = Goods::model()->findAll($criteria);
        $data = [];
        foreach ($goods as $item) {
            $data[] = [
                'tbId' => $item->tb_id,
                'title' => $item->title,
                'catId' => $item->cat_id,
                'image' => $item->picture,
                'startTime' => $item->start_time,
                'endTime' => $item->end_time,
                'price' => $item->price,
                'originPrice' => $item->origin_price,
                'click_url' => $this->createAbsoluteUrl('site/buy', ['id' => Des::encrypt($item->id)]),
            ];
        }
        Yii::app()->cache->set($cacheKey, $data, 1800);
        $this->returnData(1, $data);
    }
    
	 /**
     * 爱淘宝接口
     */
	 public function actionAtaobao()
	 {
	     $model = new Goods();
         //$time = date("Y-m-d");
         $time = "";
         $limit = "";
		 $data= $model->getaitaobao($limit,$time); //条数
		 Yii::import('common.extensions.taobao.*');
         $taobao = new Taobao();
         $str = "";
		 foreach($data as $key=>$val)
		 {
		    $title =  iconv('UTF-8', 'GBK//IGNORE', $val->title);
			$catname = iconv('UTF-8', 'GBK//IGNORE', $val->category->name);
		    $data[$key]->title = urlencode($title);
			$data[$key]->goods_type = urlencode($catname);
            $json = $taobao->getPicsurl($val->tb_id)->pic_url;
            $pic_url = (array)$json;
            $data[$key]->picture = $pic_url[0];
            $starttime = date("Y-m-d H:i:s",$val->start_time);
            $endtime = date("Y-m-d H:i:s",$val->end_time);
            $findtime = date("Y-m-d H:i:s",$val->updated_at);
            $str .= "insert into huodong (id,cid,gourl,title,imgurl,yuanjia,huodongjia,starttime,endtime,findtime,dianpuleixing,shangpinfenlei,paixu)values('{$val->id}','{$val->tb_id}','{$val->url}','{$title}','{$pic_url[0]}','{$val->origin_price}','{$val->price}','{$starttime}','{$endtime}','{$findtime}','b','{$catname}','100');\r\n";
		 }
         //$file_pointer = fopen("aa.sql","a+");        
         //fwrite($file_pointer,$str);
         //fclose($file_pointer);
         echo $str;
		 //$this->returnData(1, $data);
	 }
	 
    public function actionGetpic($taobaoId='39189765505')
    {
        Yii::import('common.extensions.taobao.*');
        $taobao = new Taobao();
        $json = $taobao->getPicurl($taobaoId);
        $pic_url =  (array)$json->pic_url;
        print_r($pic_url[0]);

    }
}
