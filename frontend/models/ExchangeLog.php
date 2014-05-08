<?php

/**
 * 美品网商品管理
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class ExchangeLog extends ActiveRecord implements IArrayable
{

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_exchange_log}}';
    }

    /**
     * 获取记录
     * @param  integer  $goodsId 兑换商品ID
     * @param  integer  $page 当前页数
     */
    public static function getLogList($goodsId,$page)
    {
        // 缓存名称
        $cacheKey = 'get-exchangelog-list-cachekey-' . $page;

        // 读取缓存兑换记录列表
        if (CommonHelper::getEnableCache()) {
            $logList = Yii::app()->cache->get($cacheKey);
            if (!empty($logList)) {
                return $logList;
            }
        }

        // 兑换记录列表
        $logList = [];
        $goodsPaginate = self::model()->dataList($goodsId)->paginate();
        $goodsList['pager'] = $goodsPaginate->getPagination();
        $goodsList['data'] = $goodsPaginate->data;
        // 设置缓存
        if (CommonHelper::getEnableCache()) {
            Yii::app()->cache->set($cacheKey, [
                'pager' => $goodsList['pager'],
                'data' => $goodsList['data']
                    ], 1800);
        }
        return $goodsList;
    }

    /**
     * 数据SQL条件
     * @param  integer $cat 分类ID
     * @return object  yii dbcriteria
     */
    public function dataList($goodsId)
    {

        $criteria = new CDbCriteria;

        $criteria->order = 'create_time DESC';

       
        $criteria->compare('t.goods_id', $goodsId);

        $this->dbCriteria->mergeWith($criteria);

        return $this;
    }
}
