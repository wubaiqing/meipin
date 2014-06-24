<?php

/**
 * 积分兑换的model
 * @property integer $goods_type 商品类型
 * @author zhangchao
 */
class Exchange extends CActiveRecord
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
            ['name, img_url',
                'required'],
            ['need_level, is_delete',
                'numerical',
                'integerOnly' => true
            ],
            ['price',
                'numerical',
                'integerOnly' => false],
            ['name, support_name',
                'length',
                'max' => 50
            ],
            ['num, integral, start_time, end_time,lottery_time,limit_count, taobao_id, goods_type',
                'length',
                'max' => 11
            ],
            [
                'lottery_time', 'checkLotteryTime'
            ],
            ['price',
                'length',
                'max' => 10
            ],
            ['taobaoke_url, support_url',
                'length',
                'max' => 200
            ],
            ['img_url',
                'length',
                'max' => 100
            ],
            ['id,goodscolor,goodscolor2',
                'safe'
            ],
            ['id, name, num, price, integral, start_time, end_time,lottery_time, need_level, taobao_id, taobaoke_url, support_name, support_url, description, img_url, is_delete, goods_type',
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
            'name' => '名称',
            'num' => '总数量',
            'delenum' => '剩余数量',
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
            'goods_type' => '商品类型',
            'goodscolor' => '商品属性',
            'lottery_time' => '开奖时间',
            'limit_count' => '中奖名额'
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
        $criteria->compare('goods_type', $this->goods_type);
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
        if (isset($post['lottery_time']) && !empty($post['lottery_time'])) {
            $post['lottery_time'] = strtotime($post['lottery_time']);
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
     * 获取商品类型名称
     * @param integer $goodsType 商品类型
     * @return string 
     */
    public static function getGoodsTypeLable($goodsType)
    {
        return isset(self::$goodsType[$goodsType]) ? self::$goodsType[$goodsType] : "";
    }

    public function checkLotteryTime()
    {
        if ($this->goods_type == 1) {
            if (empty($this->lottery_time)) {
                $this->addError("lottery_time", "抽奖时间必选");
            }
        }
    }

}
