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
	 * @param string $list 是否是列表
	 * @param intger $page 当前页数
	 * @param integer $cat 当前分类
	 * @return array 商品条件
	 */
	public static function getGoodsList($page, $hot, $cat)
	{
		// 缓存名称
		$cacheKey = 'get-goods-list-cachekey-'.$page.'-'.$cat.'-'.$hot;

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
	 * @param integer $cat 分类ID
	 * @return object yii dbcriteria
	 */
    public function dataList($cat, $hot)
    {
		$now = strtotime('+1 day 00:00:00') - 1;
        $criteria = new CDbCriteria;
		$criteria->select = '*, FROM_UNIXTIME(t.start_time, "%Y-%m-%d") as day';

		if ($hot == 0) {
			$criteria->order = 'day DESC, t.list_order DESC, rand()';
		} else {
			$criteria->order = 't.id DESC';
		}
		$criteria->compare('t.start_time', '<='. $now);
		$criteria->compare('t.end_time', '>='. $now);
		$criteria->compare('t.status', '=1');

		if ($cat != 0 && $cat != 999) {
			$criteria->compare('t.cat_id', '='. $cat);
		} else if ($cat == 999) {
			$criteria->compare('t.price', '< 10');
		}

        $this->dbCriteria->mergeWith($criteria);

        return $this;
    }

	/**
	 * 淘宝客跳转URL缓存KEY
	 * @param integer $taobaoId
	 * @return string
	 */
	public static function getTaobaoUrlCacheKey($taobaoId)
	{
		return 'get-taobao-url-cachekey-' . $taobaoId;
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
		$criteria->compare('t.start_time', '<='. $now);
		$criteria->compare('t.end_time', '>='. $now);
		$criteria->compare('t.status', '=1');
		$criteria->compare('t.goods_type', '=0');
		return $criteria;
	}

    /**
     * 打印HTMLAPI
     * @param object $goods 商品
     */
    public static function printHtmlApi($goods)
    {
        $getCat = Cat::getAllCat();
		foreach($goods as $key => $item)
		{
            echo '
<p>
<id>'.$item->id.'</id>
<title>'.$item->title.'</title>
<price>'.$item->price.'</price>
<origin_price>'.$item->origin_price.'</origin_price>
<CategoryId>'.$item->cat_id.'</CategoryId>
<CategoryName>'.$getCat[$item->cat_id]['name'].'</CategoryName>
<CreateTime>'.date('Y-m-d H:i:s', $item->created_at).'</CreateTime>
<iid>'.$item->tb_id.'</iid>
<Tbk>'.$item->url.'</Tbk>
<ListOrder>'.$item->list_order.'</ListOrder>
<StartTime>'.date('Y-m-d H:i:s',$item->start_time).'</StartTime>
<EndTime>'.date('Y-m-d H:i:s', $item->end_time).'</EndTime>
<Commissionthan></Commissionthan>
<Recommend>1</Recommend>
<Discount></Discount>
</p>';
		}
        
    }


	/**
	 * 获取商品
	 * @param integer $goodsId
	 * @return object
	 */
	public static function getGoods($goodsId)
	{
		return Goods::model()->findByPk($goodsId);
	
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
