<?php
/**
 * 美品网商品管理
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class Goods extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_goods}}';
    }
    
    public $shainum;
    /**
     * 商品列表
     * @param  string  $list 是否是列表
     * @param  intger  $page 当前页数
     * @param  integer $cat  当前分类
     * @return array   商品条件
     */
    public static function getGoodsList($cat, $hot, $page)
    {
        // 缓存名称
        $cacheKey = 'get-goods-list-cachekey-' . $cat . '-' . $hot . '-' . $page;

        // 商品列表
        $goodsList = Yii::app()->cache->get($cacheKey);
        if (!empty($goodsList)) {
            return $goodsList;
        }

        // 商品列表数据
        $goodsList = [];
        $goodsPaginate = Goods::model()->dataList($cat, $hot)->paginate();
        $goodsList['pager'] = $goodsPaginate->getPagination();
        $goodsdata = $goodsPaginate->data;
        // 小编点评
        foreach ($goodsdata as $key => $value) {
            if($value['is_zhe800']==3)
            {
                $goodsdata[$key]['shainum']=Shai::getshaidancount($value->id);
            }
        }
        $goodsList['data'] = $goodsdata;

        // 设置缓存
        Yii::app()->cache->set($cacheKey, [
            'pager' => $goodsList['pager'],
            'data' => $goodsList['data']
        ], 1800);

        return $goodsList;
    }

    /**
     * 多表关连查询
     */
    public function relations()
    {
        return array(
            'category' => array(self::HAS_ONE, 'Category', ['id' => 'cat_id'], 'together' => true, 'joinType' => 'inner join'),
        );
    }



    public function getaitaobao($limit,$time,$page)
    {
        $criteria = new CDbCriteria;
        $criteria->select="t.id, t.tb_id, t.picture,t.cat_id, t.title, t.url, t.origin_price, t.price,t.list_order, t.start_time, t.end_time, t.updated_at, t.goods_type,t.is_zhe800,t.change_price,t.mark,t.pnum,t.pbuy,comment";
        $now = strtotime('+1 day 00:00:00') - 1;
        if($time)
        {
            $criteria->compare("FROM_UNIXTIME(t.start_time,'%Y-%m-%d')",$time);
        }
        $gstime = date('Y-m-d',time())." 00:00:00";
        $today = strtotime($gstime);
        $criteria->compare('t.status', '1');
        
        $criteria->compare('t.price', '<= 9.9');
        $criteria->addCondition('t.is_zhe800=3','OR');
        //
        //$criteria->compare('t.start_time', '<=' . $now);
        //$criteria->compare('t.end_time', '>=' . $now);
        $criteria->compare('t.start_time', '>=' . $today);
        $criteria->compare('t.start_time', '<=' . $now);
        $criteria->order = 't.updated_at desc';
        $criteria->with = ['category'];
        //$this->dbCriteria->mergeWith($criteria);
        //分页类开始
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
        $data['goods'] = self::model()->findAll($criteria);
        //分页类
        $data['pages'] = $pages;
        //self::model()->findAll($criteria);
        return $data['goods'];
    }

   /*
    * 获取搜索页面其他商品
   */
    public function getothergoods($limit)
    {
        $cacheKey = 'getothergoods'.$limit;
        $otherGoodsList = Yii::app()->cache->get($cacheKey);
        if (!empty($otherGoodsList)) {
            return $otherGoodsList;
        }
        $criteria = new CDbCriteria;
        $now = strtotime('+1 day 00:00:00') - 1;
        $criteria->compare('t.status', '1');
        $criteria->compare('t.start_time', '<=' . $now);
        $criteria->compare('t.end_time', '>=' . $now);
        $criteria->order = 't.list_order desc';
        $criteria->limit= $limit;
        $othergoods = self::model()->findAll($criteria);
        Yii::app()->cache->set($cacheKey,$othergoods);
        return $othergoods;
    }

    /**
     * 商品列表
     * @param  string  $list 是否是列表
     * @param  intger  $page 当前页数
     * @param  integer $cat  当前分类
     * @return array   商品条件
     */
    public static function getXgGoodsList($cat, $hot, $page, $goodsid)
    {
        // 缓存名称
        $cacheKey = 'get-Xggoods-list-cachekey-' . $cat . '-' . $hot . '-' .$goodsid. $page;

        // 商品列表
        $goodsList = Yii::app()->cache->get($cacheKey);
        if (!empty($goodsList)) {
            return $goodsList;
        }

        // 商品列表数据
        $goodsList = [];
        $goodsPaginate = Goods::model()->detaiGoodsList($cat, $hot ,$goodsid )->paginate();
        $goodsList['pager'] = $goodsPaginate->getPagination();
        $goodsList['pager']->pageSize = Yii::app()->params['pagination']['goodsdetail'];
        $goodsList['data'] = $goodsPaginate->data;

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
     * @return array   商品预告条件
     */
    public static function tomorrow($cat, $hot, $page)
    {
        // 缓存名称
        $cacheKey = 'get-goods-list-cachekey1-' . $cat . '-' . $hot . '-' . $page;
        // 商品列表
        $goodsList = Yii::app()->cache->get($cacheKey);
        if (!empty($goodsList)) {
            return $goodsList;
        }
        // 商品列表数据
        $goodsList = [];
        $goodsPaginate = Goods::model()->datatomorrow($cat, $hot)->paginate();
        $goodsList['pager'] = $goodsPaginate->getPagination();
        $goodsList['data'] = $goodsPaginate->data;

        // 设置缓存
        Yii::app()->cache->set($cacheKey, [
            'pager' => $goodsList['pager'],
            'data' => $goodsList['data']
        ], 1800);

        return $goodsList;
    }
    /**
     * 数据SQL条件
     * @param  integer $cat 分类ID
     * @return object  yii dbcriteria
     *商品预告前天查询获取数据
     */

    public function datatomorrow($cat, $hot){
        $start_time=strtotime(date("Y-m-d H:i:s",strtotime("1 day 00:00:00")));//获取前一天开始时间
        $end_time=strtotime(date("Y-m-d H:i:s",strtotime("1 day 23:59:59")));//获取前一天结束时间
        $criteria = new CDbCriteria();
        $criteria->compare('status', '=1');
        $criteria->compare('sell_status', '=1');
        if($cat ==1002){
        $criteria->addBetweenCondition('start_time',$start_time,$end_time);
        }
        $criteria->order = "list_order desc";
        $this->dbCriteria->mergeWith($criteria);
        return $this;
    }

    /**
     * 数据SQL条件 商品详细页
     * @param  integer $cat 分类ID
     * @return object  yii dbcriteria
     */
    public function detaiGoodsList($cat, $hot, $goodsid)
    {
        $now = strtotime('+1 day 00:00:00') - 1;

        $criteria = new CDbCriteria;
        $criteria->select = '*, FROM_UNIXTIME(t.start_time, "%Y-%m-%d") as day';

       if ($hot == 0) {
            $criteria->order = 'day DESC,head_show DESC, t.list_order DESC';
        } else {
            $criteria->order = 't.id DESC';
        }

        if ($cat == 1000) {
            $criteria->compare('t.price', '< 10');
        } elseif ($cat == 1001) {
            $criteria->compare('t.price', '>= 10');
        } elseif ($cat > 0) {
            $criteria->compare('t.cat_id', '=' . $cat);
        }
        $criteria->compare('t.id', '<>'.$goodsid);
        $criteria->compare('t.start_time', '<=' . $now);
        $criteria->compare('t.end_time', '>=' . $now);
        $criteria->compare('t.status', '=1');

        $this->dbCriteria->mergeWith($criteria);

        return $this;
    }
    /**
     * 数据SQL条件
     * @param  integer $cat 分类ID
     * @return object  yii dbcriteria
     */
    public function dataList($cat, $hot)
    {
        //$now = strtotime('+1 day 00:00:00') - 1;
        $now = time();
        $criteria = new CDbCriteria;
        $criteria->select = '*, FROM_UNIXTIME(t.start_time, "%Y-%m-%d") as day';
        if($hot === 0) 
        {
            $criteria->order = 'day DESC, t.list_order DESC';
        }elseif($hot === 'sdan')
        {
            $criteria->compare('t.is_zhe800', '=3');
            $criteria->order = 'day DESC, t.list_order DESC';
        }else
        {
            $criteria->order = 'day DESC';
        }

        if ($cat == 1000) {
            $criteria->compare('t.price', '< 10');
        } elseif ($cat == 1001) {
            $criteria->compare('t.price', '>= 10');
        } elseif ($cat == 1002) {
            $criteria->compare('t.price', '<= 5');
        } 
        elseif ($cat > 0) {
            $criteria->compare('t.cat_id', '=' . $cat);
        }

        $criteria->compare('t.start_time', '<=' . $now);
        $criteria->compare('t.end_time', '>=' . $now);
        $criteria->compare('t.status', '=1');

        $this->dbCriteria->mergeWith($criteria);

        return $this;
    }

    /**
     * 获取商品
     * @param  integer $goodsId
     * @return object
     */
    public static function getGoods($goodsId)
    {
        $cacheKey = 'meipin-get-goods-' . $goodsId;
        $result = Yii::app()->cache->get($cacheKey);
        if (!empty($result)) {
            return $result;
        }
        $goods = Goods::model()->findByPk($goodsId);
        Yii::app()->cache->set($cacheKey, $goods);

        return $goods;
    }

    /**
     * 手机端Criteria
     * @return object criteria
     */
    public static function getMobileCriteria($catId)
    {
        $now = time();
        $criteria = new CDbCriteria;
        $criteria->select = '*, FROM_UNIXTIME(t.start_time, "%Y-%m-%d") as day';
        $criteria->order = 'day DESC, t.list_order DESC';
        $criteria->limit = 300;
        if ($catId > 0) {
            $criteria->compare('t.cat_id', '=' . $catId);
        }
        $criteria->compare('t.start_time', '<=' . $now);
        $criteria->compare('t.end_time', '>=' . $now);
        $criteria->compare('t.status', '=1');
        $criteria->compare('t.goods_type', '=0');

        return $criteria;
    }

    /**
     * 商品搜索
     * @params string $title
     */
    public function search($title,$page)
    {
        if (empty($title)) {
            return false;
        }

        $cacheKey = 'meipin-search-title-'.md5(trim($title)).'-'.$page;
        $response = Yii::app()->cache->get($cacheKey);
        if (!empty($response)) {
            return $response;
        }

        $data = ['data' => null, 'pager' => null];

        // 清空标题字符
        $title = trim($title);
        $time = time();
        // 搜索条件
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('title', $title);
        $criteria->compare('status', '= 1'); //状态显示
        $criteria->addCondition('start_time <' . $time . ' and end_time > ' . $time);
        $this->dbCriteria->mergeWith($criteria);
        $pagination = $this->paginate();

        $data['data'] = $pagination->data;
        $data['pager'] = $pagination->getPagination();

        Yii::app()->cache->set($cacheKey, $data, 3600);

        return $data;
    }


    /**
     * 品牌搜索
     * @params string $title
     */
    public function searchbrand($cat,$page)
    {
        if (empty($cat)) {
            return false;
        }
 
        $cacheKey = 'meipin-search-title-'.md5(trim($cat)).'-'.$page;
        $response = Yii::app()->cache->get($cacheKey);
        if (!empty($response)) {
            return $response;
        }

        $data = ['data' => null, 'pager' => null];

        // 清空标题字符
        $cat = trim($cat);
        $time = time();
        // 搜索条件
        $criteria = new CDbCriteria();
        if($cat == '5yuan')
        {
            $criteria->compare('price', '<= 5');
        }
        $criteria->compare('status', '= 1');//状态显示
        $criteria->addCondition('start_time <' . $time . ' and end_time > ' . $time);
        $criteria->order="created_at desc";
        $this->dbCriteria->mergeWith($criteria);
        $pagination = $this->paginate();

        $data['data'] = $pagination->data;
        $data['pager'] = $pagination->getPagination();

        Yii::app()->cache->set($cacheKey, $data, 3600);

        return $data;
    }

    /*
    * 查询今日更新的商品数量
    */
    public static function gettodaynum()
    {
        $cacheKey = 'meipin-gettodaynum';
        $response = Yii::app()->cache->get($cacheKey);
        if (!empty($response)) {
            return $response;
        }
        $now = date("Y-m-d");
        $time = time();
        $criteria = new CDbCriteria;
        $criteria->compare('status', '= 1');//状态显示
        $criteria->addCondition('start_time <' . $time . ' and end_time > ' . $time);
        $criteria->compare("FROM_UNIXTIME(start_time,'%Y-%m-%d')",$now);
        $count=self::model()->count($criteria); 
        Yii::app()->cache->set($cacheKey, $count, 1800);
        return $count;
    }
}
