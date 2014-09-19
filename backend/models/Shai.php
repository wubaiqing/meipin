<?php

/**
 * 积分兑换的model
 * @property integer $goods_type 商品类型
 * @author zhangchao
 */
class Shai extends ActiveRecord implements IArrayable
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
        return 'meipin_shai';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [
            ['username,content,ptime,img,goods_id', 'required'],
            ['id,username,content,ptime,img,goods_id,updated_at,created_at','safe'],
            ['id,username,content,ptime,img,goods_id','safe','on'=>'search'],
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
            'username' => '用户名',
            'content' => '评价内容',
            'ptime' => '评价时间',
            'img' => '评价图片',
            'goods_id' => '商品id',

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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('goods_id', $this->goods_id, true);
        $criteria->compare('is_delete', 0);
        $criteria->order = 't.id desc';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination' =>Yii::app()->params['pagination'],
            'pagination'=>array(
             'pageSize'=>Yii::app()->params['shaidanpagesize'], //代表每页显示50条信息
            ),
        ]);
    }

    public static function format($post)
    {
        if (isset($post['img']) && !empty($post['img'])) 
        {
            $str = "";
            foreach ($post['img'] as $key => $value) 
            {
               if($value)
               {
                    $datu = strrpos($value,'_' );
                    $datuimg= substr($value,0,$datu);
                    $str.=$datuimg."_220x220.jpg;";
               }
            }
            $post['img'] = $str;
        }

        return $post;
    }

    /**
     * 获取商品缓存KEY
     */
    public static function getBrnadGoodsCacheKey($goodsId)
    {
        return "shai-findByGoodsId" . $goodsId;
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
        $key = "shai-getIndexBrand-";
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
