<?php
/**
 * 美品网商品兑换记录
 * @author liukui <liujickson@gmail.com>
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
     * @return array 验证规则.
     */
    public function rules()
    {
        return [
            [
                'user_id,name,username,created_at,goods_id,city_id,address,postcode,mobile',
                'required'
            ],
            [
                'id, user_id,created_at,updated_at,goods_id,city_id',
                'numerical',
                'integerOnly' => true
            ],
            [
                'id,name,username,address,updated_at,remark',
                'safe'
            ],
        ];
    }

    /**
     * @return array 字段别名 (字段名=>备注)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'name' => '配送姓名',
            'username' => '用户名',
            'created_at' => '兑换时间',
            'updated_at' => '更新时间',
            'city_id' => '城市ID',
            'address' => '配送地址',
        ];
    }

    /**
     * 获取记录
     * @param integer $goodsId 兑换商品ID
     * @param integer $page    当前页数
     */
    public static function getLogListKey($goodsId, $page)
    {
        return 'get-exchangelog-list-cachekey-' . $goodsId . "-" . $page;
    }

    /**
     * 获取记录
     * @param  integer $goodsId 兑换商品ID
     * @param  integer $page    当前页数
     * @return array
     */
    public static function getLogList($goodsId, $page)
    {
        $pageSize = Yii::app()->params['exchangeLogPageSize'];
        $maxCachePageCount = Yii::app()->params['pageCahceMaxCount'];
        // 缓存名称
        $cacheKey = self::getLogListKey($goodsId, $page);

        // 读取缓存兑换记录列表
        $logList = Yii::app()->cache->get($cacheKey);
        if (!empty($logList)) {
            return $logList;
        }

        // 兑换记录列表
        $logList = [];
        $goodsPaginate = self::model()->dataList($goodsId)->paginate();
        $goodsPaginate->getPagination()->setPageSize($pageSize);
        $goodsList['pager'] = $goodsPaginate->getPagination();
        $goodsList['data'] = $goodsPaginate->data;
        // 设置缓存
        if ($page <= $maxCachePageCount) {
            Yii::app()->cache->set($cacheKey, [
                'pager' => $goodsList['pager'],
                'data' => $goodsList['data']
                    ], Constants::T_HOUR);
        }

        return $goodsList;
    }

    /**
     * 清除列表缓存
     * @param integer $goodsId 兑换商品ID
     */
    public static function deleteExchangeLogListCache($goodsId)
    {
        $maxCachePageCount = Yii::app()->params['pageCahceMaxCount'];
        for ($i = 1; $i <= $maxCachePageCount; $i++) {
            $cacheKey = self::getLogListKey($goodsId, $i);
            Yii::app()->cache->delete($cacheKey);
        }
    }

    /**
     * 数据SQL条件
     * @param  integer     $cat 分类ID
     * @return CDbCriteria
     */
    public function dataList($goodsId)
    {

        $criteria = new CDbCriteria;

        $criteria->order = 'created_at DESC';

        $criteria->compare('t.goods_id', $goodsId);

        $this->dbCriteria->mergeWith($criteria);

        return $this;
    }

}
