<?php

/**
 * 积分兑换的model
 * @author zhangchao
 */
class Exchange extends ActiveRecord
{

    /**
     * 商品类型
     * @var array 
     */
    public static $goodsType = [0 => '兑换商品', 1 => '抽奖商品'];

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return 'meipin_exchange';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [
            ['name, taobaoke_url, support_url, img_url', 'required'],
            ['need_level, is_delete,limit_count', 'numerical', 'integerOnly' => true],
            ['price', 'numerical', 'integerOnly' => false],
            ['name, support_name', 'length', 'max' => 50],
            ['num, integral, start_time, end_time, taobao_id', 'length', 'max' => 11],
            ['price', 'length', 'max' => 10],
            ['taobaoke_url, support_url', 'length', 'max' => 200],
            ['img_url', 'length', 'max' => 100],
            ['id,goodscolor', 'safe'],
            ['id, name, num, price, integral, start_time, end_time, need_level, taobao_id, taobaoke_url, support_name, support_url, description, img_url, is_delete',
                'safe', 'on' => 'search'],
        ];
    }

    /**
     * 字段属性名称
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'num' => '数量',
            'price' => '价格',
            'integral' => '积分',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'need_level' => '等级要求',
            'taobao_id' => '淘宝id',
            'taobaoke_url' => '淘宝客url',
            'support_name' => '赞助卖家昵称',
            'support_url' => '卖家店址',
            'description' => '描述',
            'img_url' => '图片',
            'is_delete' => '是否删除0否 1是',
        ];
    }

    /**
     * 列表搜索
     * @return ActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('num', $this->num, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('integral', $this->integral, true);
        $criteria->compare('start_time', $this->start_time, true);
        $criteria->compare('end_time', $this->end_time, true);
        $criteria->compare('need_level', $this->need_level);
        $criteria->compare('taobao_id', $this->taobao_id, true);
        $criteria->compare('taobaoke_url', $this->taobaoke_url, true);
        $criteria->compare('support_name', $this->support_name, true);
        $criteria->compare('support_url', $this->support_url, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('img_url', $this->img_url, true);
        $criteria->compare('is_delete', 0); //默认只查询未删除的
        $criteria->order = 't.id desc';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * 验证前
     * @return ActiveDataProvider
     */
    public function beforeValidate()
    {
        $this->start_time = strtotime($this->start_time);
        $this->end_time = strtotime($this->end_time);

        return true;
    }

    /**
     * 保存前前
     * @return ActiveDataProvider
     */
    public function beforeSave()
    {
        //保存之前记录一下时间、人员信息
        if ($this->isNewRecord) {
            $this->create_time = time();
            $this->creater_id = User::$userName[Yii::app()->user->id];
        }
        $this->update_time = time();
        $this->update_id = User::$userName[Yii::app()->user->id];

        return true;
    }

    /**
     * @return model
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * 获取热门兑换商品列表
     * @param  integer  $goodsId  商品ID
     * @param  integer  $goodsType 商品类型
     * @param  integer  $pageSize 返回数据大小
     * @return Exchange
     */
    public static function getHotExchangeGoods($goodsId, $goodsType, $pageSize = 10)
    {
        $key = "goods-getHotExchangeGoods-" . $goodsId . "-" . $goodsType . "-" . $pageSize;
        $hotExchangeGoods = Yii::app()->cache->get($key);
        if (!empty($hotExchangeGoods)) {
            return $hotExchangeGoods;
        }
        $hotExchangeGoods = Exchange::model()->findAll(['condition' => "id !=" . $goodsId
            . " and is_delete = 0 and goods_type = " . $goodsType . " and end_time > " . time(),
            'order' => 'sale_num desc',
            'limit' => 6]);
        Yii::app()->cache->set($key, $hotExchangeGoods, Constants::T_HALF_HOUR);

        return $hotExchangeGoods;
    }


    /**
     * 获取首页的积分兑换商品
     * @param  integer  $goodsId  商品ID
     * @param  integer  $pageSize 返回数据大小
     * @return Exchange
     */
    public static function getIndexExchange()
    {
        $key = "goods-getIndexExchange-";
        $IndexExchange = Yii::app()->cache->get($key);
        if (!empty($IndexExchange)) {
            return $IndexExchange;
        }
        $IndexExchange = Exchange::model()->findAll(['condition' => "is_delete = 0 and is_first=1",
            'order' => 'list_order desc']);
        Yii::app()->cache->set($key, $IndexExchange, Constants::T_HALF_HOUR);

        return $IndexExchange;
    }

    /**
     * 商品详细页获取热门兑换商品列表
     * @param  integer  $goodsId  商品ID
     * @param  integer  $pageSize 返回数据大小
     * @return Exchange
     */
    public static function getHotExchangeDetailGoods($pageSize = 10)
    {
        $key = "goods-getHotExchangedetailGoods-0000" . $pageSize;
        $hotExchangeGoods = Yii::app()->cache->get($key);
        if (!empty($hotExchangeGoods)) {
            return $hotExchangeGoods;
        }
        $hotExchangeGoods = Exchange::model()->findAll(['condition' => "is_delete = 0",
            'order' => 'sale_num desc',
            'limit' => 6]);
        Yii::app()->cache->set($key, $hotExchangeGoods, Constants::T_HALF_HOUR);

        return $hotExchangeGoods;
    }
    /**
     * 设置当前兑换key
     * @param  integer $user_id
     * @param  integer $goods_id
     * @return string
     */
    public static function getExchangeCacheKey($userId, $goodsId)
    {
        return "goods-exchange-$goodsId" . "-" . $userId;
    }

    /**
     * 获取商品缓存KEY
     */
    public static function getExchangeGoodsCacheKey($goodsId)
    {
        return "exchange-findByGoodsId-" . $goodsId;
    }

    /**
     * 获取带缓存的兑换商品数据
     * @param  integer  $goodsId 商品ID
     * @return Exchange
     */
    public static function findByGoodsId($goodsId)
    {
        $key = self::getExchangeGoodsCacheKey($goodsId);
        $data = Yii::app()->cache->get($key);
        if (!empty($data)) {
            return $data;
        }
        $data = self::model()->findByPk($goodsId);

        Yii::app()->cache->set($key, $data, Constants::T_TWO_HOUR);

        return $data;
    }

    /**
     * 刪除商品緩存KEY
     */
    public static function deleteCache($goodsId)
    {
        Yii::app()->cache->delete(self::getExchangeGoodsCacheKey($goodsId));
    }

    /**
     * 积分兑换首页商品列表
     * @param integer $currentPage 分页页码
     * @param integer $goodsType 商品类型
     * @param string $timeLine 是否过期商品
     * @return array
     * @author zhangchao
     */
    public function showExchangeGoodsList($currentPage = 0, $goodsType = 0, $timeLine = '')
    {
        $time = time();
        //缓存的key
        $cacheKey = 'exchange_list_' . md5(serialize(func_get_args()));
        $exchangeList = Yii::app()->cache->get($cacheKey);
        if ($exchangeList) {
            return $exchangeList;
        }

        $criteria = new CDbCriteria();
        $criteria->order = ' id desc ';
        $criteria->compare('is_delete', 0);

        if (empty($timeLine)) {
            $criteria->addCondition('start_time <' . $time . ' and end_time > ' . $time);
        } else if ($timeLine == 'history') {
            $criteria->addCondition('end_time <= ' . $time);
        }

        $criteria->compare('goods_type', $goodsType);

        //分页类开始
        $pages = new CPagination();
        $pages->currentPage = $currentPage;
        //计算总数
        $pages->itemCount = Exchange::model()->count($criteria);
        //每页显示数量，配置文件中可配
        $pages->pageSize = Yii::app()->params['pagination']['exchangePageSize'];
        $pages->applyLimit($criteria);
        $data = [];
        //根据条件查询积分兑换商品
        $data['goods'] = Exchange::model()->findAll($criteria);
        //分页类
        $data['pages'] = $pages;
        //写入缓存
        Yii::app()->cache->set($cacheKey, $data, Constants::T_HALF_HOUR);

        return $data;
    }

    /**
     * 获取商品类型名称
     * @param integer $goodsType 商品类型
     * @return string 
     */
    public static function getGoodsTypeLable($goodsType)
    {
        return isset(self::$goodsType[$goodsType]) ? self::$goodsType[$goodsType] : "";
    }

}
