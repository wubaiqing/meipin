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
     * 商品列表
     * @param  string  $list 是否是列表
     * @param  intger  $page 当前页数
     * @param  integer $cat  当前分类
     * @return array   商品预告条件
     */
    public static function tomorrow($cat, $hot, $page)
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
        $criteria->compare('sell_status', '=1');
		if($cat ==1002){
		$criteria->addBetweenCondition('start_time',$start_time,$end_time);
		}
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
    public function search($title)
    {
        if (empty($title)) {
            return false;
        }

        $cacheKey = 'meipin-search-title-'.md5(trim($title));
        $response = Yii::app()->cache->get($cacheKey);
        if (!empty($response)) {
            return $response;
        }

        $data = ['data' => null, 'pager' => null];

        // 清空标题字符
        $title = trim($title);

        // 搜索条件
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('title', $title);
        $this->dbCriteria->mergeWith($criteria);
        $pagination = $this->paginate();

        $data['data'] = $pagination->data;
        $data['pager'] = $pagination->getPagination();

        Yii::app()->cache->set($cacheKey, $data, 3600);

        return $data;
    }

}
