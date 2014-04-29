<?php
/**
 * 商品管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class Goods extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{goods}}';
    }

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
        $cacheKey = 'get-goods-list-cachekey-'.$cat.'-'.$hot.'-'.$page;

        // 商品列表
        $goodsList = Yii::app()->cache->get($cacheKey);
        if (!empty($goodsList)) {
            return $goodsList;
        }

        // 商品列表数据
        $goodsList = array();
        $goodsPaginate = Goods::model()->dataList($cat, $hot)->paginate();
        $goodsList['pager'] = $goodsPaginate->getPagination();
        $goodsList['data'] = $goodsPaginate->data;

        // 设置缓存
        Yii::app()->cache->set($cacheKey, array(
            'pager' => $goodsList['pager'],
            'data' => $goodsList['data']
        ) , 1800);

        return $goodsList;
    }

    /**
     * 数据SQL条件
     * @param  integer $cat 分类ID
     * @return object  yii dbcriteria
     */
    public function dataList($cat, $hot)
    {
        $now = strtotime('+1 day 00:00:00') - 1;
        $criteria = new CDbCriteria;
        $criteria->select = '*, FROM_UNIXTIME(t.start_time, "%Y-%m-%d") as day';

        if ($hot == 0) {
            $criteria->order = 'day DESC, t.list_order DESC';
        } else {
            $criteria->order = 't.id DESC';
        }

        $criteria->compare('t.start_time', '<='. $now);
        $criteria->compare('t.end_time', '>='. $now);
        $criteria->compare('t.status', '=1');

        if ($cat == 1000) {
            $criteria->compare('t.price', '< 10');
        } elseif ($cat == 1001) {
            $criteria->compare('t.price', '>= 10');
        } elseif ($cat > 0) {
            $criteria->compare('t.cat_id', '='. $cat);
        }

        $this->dbCriteria->mergeWith($criteria);

        return $this;
    }

    /**
     * 淘宝客跳转URL缓存KEY
     * @param  integer $taobaoId
     * @return string
     */
    public static function getTaobaoUrlCacheKey($taobaoId)
    {
        return 'get-taobao-url-cachekey-' . $taobaoId;
    }

    /**
     * 获取商品
     * @param  integer $goodsId
     * @return object
     */
    public static function getGoods($goodsId)
    {
        $cacheKey = 'meipin-get-goods-'.$goodsId;
        $result = Yii::app()->cache->get($cacheKey);
        if (!empty($result)) {
            return $result;
        }
        $goods = Goods::model()->findByPk($goodsId);
        Yii::app()->cache->set($cacheKey, $goods);
        return $goods;
    }

    public static function getGoodsCateId($catId)
    {
        $cacheKey = 'get-goods-cate-id-' . $catId;
        $result = Yii::app()->cache->get($cacheKey);
        if (!empty($result)) {
            return $result;
        }

        $criteria = new CDbCriteria();
        $criteria->order = 'rand()';
        $criteria->compare('cat_id', $catId);
        $criteria->limit = 6;
        $result = Goods::model()->findAll($criteria);
        Yii::app()->cache->set($cacheKey, $result, 3600);

        return $result;
    }

}
