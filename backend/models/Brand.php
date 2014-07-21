<?php

/**
 * 积分兑换的model
 * @property integer $goods_type 商品类型
 * @author zhangchao
 */
class Brand extends ActiveRecord implements IArrayable
{

    public static $is_first= array(
        '0' => '显示',
        '1' => '隐藏',
    );
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return 'meipin_brand';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [

            ['id,title,describe,brand_img,brand_url,order,status,updated_at,created_at,is_delete,start_time,end_time',
                'safe'
            ],
            ['id,title,describe,brand_img,brand_url,order,status,updated_at,created_at,is_delete,start_time,end_time',
                'safe',
                'on' => 'search'
            ],
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
            'title' => '标题',
            'brand_img' => '图片',
            'brand_url' => '图片链接',
            'describe' => '描述',
            'status' => '状态',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'order' => '排序'
        ];
    }

    /**
     * 列表搜索
     * @return ActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id, false);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('describe', $this->describe, true);
        $criteria->compare('brand_img', $this->brand_img, true);
        $criteria->compare('brand_url', $this->brand_url, true);
        $criteria->compare('start_time', $this->start_time, true);
        $criteria->compare('end_time', $this->end_time, true);
        $criteria->compare('order', $this->order);
        $criteria->compare('is_delete', 0); //默认只查询未删除的
        $criteria->order = 't.id desc';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' =>Yii::app()->params['pagination'],
        ]);
    }

    /**
     * 验证前
     * @return ActiveDataProvider
     */
    public function beforeValidate()
    {
//        $this->start_time = strtotime($this->start_time);
//        $this->end_time = strtotime($this->end_time);

        return true;
    }

    public static function format($post)
    {
        if (isset($post['start_time']) && !empty($post['start_time'])) {
            $post['start_time'] = strtotime($post['start_time']);
        }
        if (isset($post['end_time']) && !empty($post['end_time'])) {
            $post['end_time'] = strtotime($post['end_time']);
        }
        return $post;
    }

   /**
     * 保存前前
     * @return ActiveDataProvider
     */
    public function beforeSave()
    {
        //保存之前记录一下时间、人员信息
        if ($this->isNewRecord) {
            $this->created_at = time();
            $this->creater_id = User::$userName[Yii::app()->user->id];
        }
        $this->updated_at = time();
        //$this->update_id = User::$userName[Yii::app()->user->id];

        return true;
    }

    /**
     * 获取商品缓存KEY
     */
    public static function getBrnadGoodsCacheKey($goodsId)
    {
        return "brand-findByGoodsId" . $goodsId;
    }
    /**
     * 刪除商品緩存KEY
     */
    public static function deleteCache($goodsId)
    {
        Yii::app()->cache->delete(self::getExchangeGoodsCacheKey($goodsId));
    }


    /**
     * 获取首页的积分兑换商品
     * @param  integer  $goodsId  商品ID
     * @param  integer  $pageSize 返回数据大小
     * @return Exchange
     */
    public static function getIndexBrand()
    {
        $key = "Brand-getIndexBrand-";
        $IndexExchange = Yii::app()->cache->get($key);
        if (!empty($IndexExchange)) {
            return $IndexExchange;
        }
        $now = time();
        $IndexExchange = Brand::model()->findAll(['condition' => "is_delete = 0 and status=0 and start_time <$now and end_time < $now ",
            'order' => 'order desc']);
        Yii::app()->cache->set($key, $IndexExchange, Constants::T_HALF_HOUR);

        return $IndexExchange;
    }

}
