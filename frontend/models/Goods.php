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

        if ($cat == 1000) {
            $criteria->compare('t.price', '< 10');
        } elseif ($cat == 1001) {
            $criteria->compare('t.price', '>= 10');
        } elseif ($cat > 0) {
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
    public static function getMobileCriteria()
    {
        $now = time();
        $criteria = new CDbCriteria;
        $criteria->select = '*, FROM_UNIXTIME(t.start_time, "%Y-%m-%d") as day';
        $criteria->order = 'day DESC, t.list_order DESC';
        $criteria->limit = 300;
        $criteria->compare('t.start_time', '<=' . $now);
        $criteria->compare('t.end_time', '>=' . $now);
        $criteria->compare('t.status', '=1');
        $criteria->compare('t.goods_type', '=0');
        return $criteria;
    }

}
