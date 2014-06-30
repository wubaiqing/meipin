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
     public function actionAiTbao($id)
     {
/*        $cacheKey = 'meipin-api-aitaobao-';
        $result = Yii::app()->cache->get($cacheKey);
        if (!empty($result)) {
            $this->returnData(1, $result);
        }*/
        $where = "";
        if($id){$where = "where g.id >{$id}";}
        $model = new Goods();
        //$NowTime=strtotime(date('Y-m-d 00:00:00',time()));//获取结束时间
        $sql = "select g.id, g.tb_id, g.picture,g.cat_id, g.title, g.url, g.origin_price, g.price, g.start_time, g.end_time, g.updated_at, c.name from meipin_goods as g join meipin_category as c on g.cat_id=c.id {$where} order by g.id desc limit 30 ";
        $Rumodel = yii::app()->db->createCommand($sql);
        $query =$Rumodel->queryAll();
        //Yii::app()->cache->set($cacheKey, $query, 1800);
        $this->returnData(1, $query);
     }
}
