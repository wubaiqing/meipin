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
	 public function actionAtaobao($limit="100",$page=1)
	 {
	     $model = new Goods();
         //$time = date("Y-m-d");
         $time = "";
		 $data= $model->getaitaobao($limit,$time,$page); //条数
		 Yii::import('common.extensions.taobao.*');
         $taobao = new Taobao();
         $str = "";
		 foreach($data as $key=>$val)
		 {
		    $title =  iconv('UTF-8', 'GBK//IGNORE', $val->title);
			$catname = iconv('UTF-8', 'GBK//IGNORE', $val->category->name);
		    $data[$key]->title = urlencode($title);
			$data[$key]->goods_type = urlencode($catname);
            $json = $taobao->getPicsurl($val->tb_id);
            if($json)
            {
                $json=$json->pic_url;
                $pic_url = (array)$json;
                $data[$key]->picture = $pic_url[0];
                $starttime = date("Y-m-d H:i:s",$val->start_time);
                $endtime = date("Y-m-d H:i:s",$val->end_time);
                $findtime = date("Y-m-d H:i:s",$val->updated_at);
                $str .= "insert into huodong (id,cid,gourl,title,imgurl,yuanjia,huodongjia,starttime,endtime,findtime,dianpuleixing,shangpinfenlei,paixu)values('{$val->id}','{$val->tb_id}','{$val->url}','{$title}','{$pic_url[0]}','{$val->origin_price}','{$val->price}','{$starttime}','{$endtime}','{$findtime}','b','{$catname}','100');<br/>";
            }
		 }
         //$file_pointer = fopen("aa.sql","a+");        
         //fwrite($file_pointer,$str);
         //fclose($file_pointer);
         echo $str;
		 //$this->returnData(1, $data);
	 }
	 
    public function actionTest($limit="",$page=1)
    {
         header("content-type:text/html;charset=utf-8");
        /* //19112746137 37983493995
        Yii::import('common.extensions.taobao.*');
        $taobao = new Taobao();
        $json = $taobao->getPicsurl($taobaoId);
        var_dump($json);
        //$pic_url =  (array)$json->pic_url;
        //print_r($pic_url[0]);
         $model = new Goods();
         $time = "";
         $data= $model->getaitaobao($limit,$time,$page); //条数
         var_dump($data);*/

         //http://jiukuaiyoucom.uz.taobao.com/?m=index&cat=jujia&page=
         //http://zhe800.uz.taobao.com/list.php?tag_id=2&page=3
         include Yii::getPathOfAlias('common.extensions') . '/simple_html_dom.php';
         $fetchUrl = "http://zhe800.uz.taobao.com/list.php?tag_id=2&page=3";
         $html = file_get_html($fetchUrl, false, stream_context_create([
                'http' => [
                    'method' => "GET",
                    'timeout' => 20,
                ]
            ]));
        // print_r($html->find('.main-good')); dealinfo
        foreach ($html->find('.dealinfo') as $dealad) 
        {
 /*           $data = self::handleData9($dealad);
            echo $data['taobaoId']."<br/>";*/
            $data = self::handleData($dealad);
            //self::update11($data);
            echo $data['taobaoId']."<br/>";
            
        }



    }

    public static function update11($string)
    {
        echo $string['taobaoId'];
    }
    public static function getInt($string)
    {
        return trim(preg_replace('/([^0-9.]+)/','',$string));
    }

     public static function handleData($dealad)
    {
        $data = [];

        // 淘宝URL
        $data['url'] = $dealad->find('p', 0)->find('a', 0)->href;

        // 淘宝ID
        $data['taobaoId'] = self::getInt(substr($data['url'], -13));

        // 商品标题
        $data['title'] = self::covert($dealad->find('h2', 0)->find('a', 1)->plaintext);

        // 商品价格
        $data['price'] = self::getInt($dealad->find('h4', 0)->find('span', 0)->plaintext);

        // 商品原始价格
        $data['origin_price'] = self::getInt($dealad->find('h4', 0)->find('span', 1)->find('i', 0)->plaintext);

        // 关联网站
        $data['relation_website'] = 1;

        // 商品开始结束时间
        $H = date('H');
        if ($H >= '16') {
            // 开始结束时间
            $data['startTime'] = strtotime('+ 1 day 00:00:00');
            $data['endTime'] = strtotime('+ 5 day 23:59:59');
        } else {
            // 开始结束时间
            $data['startTime'] = strtotime(date('Y-m-d'));
            $data['endTime'] = strtotime('+ 5 day 23:59:59');
        }

        return $data;
    }


    public static function covert($string)
    {
        return mb_convert_encoding($string, 'UTF-8', 'GBK');
    }
   public static function handleData9($dealad)
    {
        $data = [];

        // 淘宝URL
        $data['url'] = $dealad->find('a', 0)->href;

        // 淘宝ID
        $data['taobaoId'] = self::getInt(substr($data['url'], -13));

        // 商品标题
        $data['title'] = $dealad->find('h3', 0)->find('a', 0)->plaintext;

        // 商品价格
        $data['price'] = self::getInt($dealad->find('h4', 0)->find('span', 0)->plaintext);

        // 商品原始价格
        $data['origin_price'] = self::getInt($dealad->find('h4', 0)->find('span', 2)->plaintext);

        // 关联网站
        $data['relation_website'] = 3;

        // 商品开始结束时间
        $H = date('H');
        if ($H >= '16') {
            // 开始结束时间
            $data['startTime'] = strtotime('+ 1 day 00:00:00');
            $data['endTime'] = strtotime('+ 5 day 23:59:59');
        } else {
            // 开始结束时间
            $data['startTime'] = strtotime(date('Y-m-d'));
            $data['endTime'] = strtotime('+ 5 day 23:59:59');
        }

        return $data;
    }


}
