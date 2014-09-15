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
            $comment =  iconv('UTF-8', 'GBK//IGNORE', $val->comment);
			//$catname = iconv('UTF-8', 'GBK//IGNORE', $val->category->name);
            $catname = $val->cat_id;
		    $data[$key]->title = urlencode($title);
			$data[$key]->goods_type = urlencode($catname);
            $json = $taobao->getPicsurl($val->tb_id);
            //var_dump($json);
            if($json)
            {
                $pic_url=(array)($json->pic_url);
                $item_url = (array)$json->item_url;

                $data[$key]->picture = $pic_url[0];
                $starttime = date("Y-m-d H:i:s",$val->start_time);
                $endtime = date("Y-m-d H:i:s",$val->end_time);
                $findtime = date("Y-m-d H:i:s",$val->updated_at);
                $str .= "insert into huodong (id,cid,gourl,title,imgurl,yuanjia,huodongjia,starttime,endtime,findtime,dianpuleixing,shangpinfenlei,paixu,is_zhe800,change_price,mark,pnum,pbuy,comment)values('{$val->id}','{$val->tb_id}','{$item_url[0]}','{$title}','{$pic_url[0]}','{$val->origin_price}','{$val->price}','{$starttime}','{$endtime}','{$findtime}','b','{$catname}','{$val->list_order}','{$val->is_zhe800}','{$val->change_price}','{$val->mark}','{$val->pnum}','{$val->pbuy}','{$comment}');";
            }
		 }
         //$file_pointer = fopen("aa.sql","a+");        
         //fwrite($file_pointer,$str);
         //fclose($file_pointer);
         echo $str;
		 //$this->returnData(1, $data);
	 }

    /**
     * 爱淘宝接口
     */
    public function actionFenlei()
    {
        $model = new Category();
        $data = $model->findAll();
        $str = "";
        foreach($data as $key=>$val)
        {
            $name =  iconv('UTF-8', 'GBK//IGNORE', $val->name);
            $str .= "insert into dapailei (sid,gname)values('{$val->id}','$name');<br/>";
        }
        echo $str;
    }

    /**
     *  淘宝优站晒单列表
     */
    public function actionShai($limit="100",$page=1)
    {
        $model = new Shai();
        $data = $model->getshaiAll($limit,$page);
        $str = "";
        foreach($data as $key=>$val)
        {
            $username =  iconv('UTF-8', 'GBK//IGNORE', $val->username);
            if($val->content)
            //$content = iconv('UTF-8', 'GBK//IGNORE', $val->content);
            $content = mb_convert_encoding( $val->content, 'GBK', 'UTF-8'); 
            $str .= "INSERT INTO `meipin_shai` (id,username,content,ptime,img,goods_id,updated_at,created_at,is_delete) VALUES ('{$val->id}', '{$username}', '{$content}', '{$val->ptime}', '{$val->img}', '{$val->goods_id}', '{$val->updated_at}', '{$val->created_at}', '{$val->is_delete}');<br/>";
        }
        echo $str;
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

    }
}
