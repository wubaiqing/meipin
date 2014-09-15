<?php

/**
 * 积分兑换的model
 * @author zhangchao
 */
class Shai extends ActiveRecord implements IArrayable
{

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_shai}}';
    }

    public function rules()
    {
        return [
            ['username,content,ptime,img,goods_id', 'required'],
            ['id,username,content,ptime,img,goods_id,updated_at,created_at','safe'],
            ['id,username,content,ptime,img,goods_id','safe','on'=>'search'],
        ];
    }


    /**
     * 获取晒单
     * @param  integer  $goodsId  商品ID
     * @param  integer  $pageSize 返回数据大小
     * @return Exchange
     */
    public static function getshaidan2($goods_id)
    {
        $key = "shaidan-shaidan-".$goods_id;
        $IndexExchange = Yii::app()->cache->get($key);
        if (!empty($IndexExchange)) {
            return $IndexExchange;
        }
        $IndexExchange = Shai::model()->findAll(['condition' => "is_delete = 0 and goods_id={$goods_id}",]);
        Yii::app()->cache->set($key, $IndexExchange, Constants::T_HALF_HOUR);

        return $IndexExchange;
    }
    //晒单数据统计
    public static function getshaidancount($goods_id)
    {
        $key = "shaidan-shaidan111-".$goods_id;
        $IndexExchange = Yii::app()->cache->get($key);
        if (!empty($IndexExchange)) {
            return $IndexExchange;
        }
        $IndexExchange = Shai::model()->count(['condition' => "is_delete = 0 and goods_id={$goods_id}",]);
        Yii::app()->cache->set($key, $IndexExchange, Constants::T_HALF_HOUR);

        return $IndexExchange;
    }

    /**
     * 商品列表
     * @param  string  $list 是否是列表
     * @param  intger  $page 当前页数
     * @param  integer $cat  当前分类
     * @return array   商品条件
     */
    public static function getshaidan($page, $goodsid,$limit)
    {
        // 缓存名称
        $cacheKey = 'get-shaidan-list-cachekey-'.$goodsid. $page;

        // 商品列表
        $goodsList = Yii::app()->cache->get($cacheKey);
        if (!empty($goodsList)) {
            return $goodsList;
        }

        // 商品列表数据
        $goodsList = [];
        //$goodsPaginate = Goods::model()->detaiGoodsList($cat, $hot ,$goodsid )->paginate();
        $criteria = new CDbCriteria;
        $criteria->compare('t.goods_id', '=' . $goodsid);
        $criteria->compare('t.is_delete', '=0');
        $pages = new CPagination();
        if($page>=1)
        {
            $page = $page-1;
        }
        $pages->currentPage = $page;
        //计算总数
        $pages->itemCount = self::model()->count($criteria);
        //每页显示数量，配置文件中可配
        $pages->pageSize = $limit;
        $pages->applyLimit($criteria);
        $data = [];
        //根据条件查询积分兑换商品
        $shaidata = self::model()->findAll($criteria);
        foreach ($shaidata as $key => $value) {
            $img = explode(';', $value->img);
            $shaidata[$key]['img']=$img;
        }
        $goodsList['data'] = $shaidata;
        //分页类
        $goodsList['pager'] = $pages;
        //self::model()->findAll($criteria);
        /*$goodss= $this->dbCriteria->mergeWith($criteria);
        $goodsPaginate = $goodss->paginate();

        $goodsList['pager'] = $goodsPaginate->getPagination();
        $goodsList['pager']->pageSize = Yii::app()->params['pagination']['goodsdetail'];
        $goodsList['data'] = $goodsPaginate->data;*/

        // 设置缓存
        Yii::app()->cache->set($cacheKey, [
            'pager' => $goodsList['pager'],
            'data' => $goodsList['data']
        ], 1800);

        return $goodsList;
    }


    /**
     * 商品列表
     * @param  string  $list 是否是列表
     * @param  intger  $page 当前页数
     * @param  integer $cat  当前分类
     * @return array   商品条件
     */
    public static function getshaiAll($limit,$page)
    {
/*        // 缓存名称
        $cacheKey = 'get-getshaiAll-list-cachekey-'. $page;

        // 商品列表
        $goodsList = Yii::app()->cache->get($cacheKey);
        if (!empty($goodsList)) {
            return $goodsList['data'];
        }
*/
        // 商品列表数据
        $goodsList = [];
        $criteria = new CDbCriteria;
        //$criteria->compare('t.goods_id', '=' . $goodsid);
        $criteria->compare('t.is_delete', '=0');
        $pages = new CPagination();
        if($page>=1)
        {
            $page = $page-1;
        }
        $pages->currentPage = $page;
        //计算总数
        $pages->itemCount = self::model()->count($criteria);
        //每页显示数量，配置文件中可配
        $pages->pageSize = $limit;
        $pages->applyLimit($criteria);
        $data = [];
        //根据条件查询积分兑换商品
        $shaidata = self::model()->findAll($criteria);
        $goodsList['data'] = $shaidata;
        //分页类
        $goodsList['pager'] = $pages;
/*
        // 设置缓存
        Yii::app()->cache->set($cacheKey, [
            'pager' => $goodsList['pager'],
            'data' => $goodsList['data']
        ], 1800);*/

        return $goodsList['data'];
    }

}
