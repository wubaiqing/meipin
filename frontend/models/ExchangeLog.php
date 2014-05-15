<?php

/**
 * 美品网商品兑换记录
 * @author liukui <liujickson@gmail.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 * The followings are the available columns in table 'meipin_exchange':
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $goods_id
 * @property string $remark
 * @property integer $city_id
 * @property string $address
 * 
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
            ['user_id,username,created_at,goods_id,city_id,address', 'required'],
            ['id, user_id,created_at,updated_at,goods_id,city_id', 'numerical', 'integerOnly' => true],
            ['id,username,address,updated_at', 'safe'],
        ];
    }

    /**
     * @return array 字段别名 (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'username' => '用户名',
            'created_at' => '兑换时间',
            'updated_at' => '更新时间',
            'city_id' => '城市ID',
            'address' => '配送地址',
        ];
    }

    /**
     * 获取记录
     * @param  integer  $goodsId 兑换商品ID
     * @param  integer  $page 当前页数
     */
    public static function getLogList($goodsId, $page)
    {
        // 缓存名称
        $cacheKey = 'get-exchangelog-list-cachekey-' . $goodsId . "-" . $page;

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
        $goodsPaginate->getPagination()->setPageSize(20);
        $goodsList['pager'] = $goodsPaginate->getPagination();
        $goodsList['data'] = $goodsPaginate->data;
        // 设置缓存
        if (CommonHelper::getEnableCache()) {
            Yii::app()->cache->set($cacheKey, [
                'pager' => $goodsList['pager'],
                'data' => $goodsList['data']
                    ], Constants::T_SECOND_FIVE);
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

        $criteria->order = 'created_at DESC';


        $criteria->compare('t.goods_id', $goodsId);

        $this->dbCriteria->mergeWith($criteria);

        return $this;
    }

}
