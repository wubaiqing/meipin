<?php

/**
 * This is the model class for table "meipin_order".
 *
 * The followings are the available columns in table 'meipin_order':
 * @property string $order_id
 * @property integer $pay_status
 * @property integer $order_type
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $pay_time
 * @property string $remark
 * @property integer $pay_way
 * @property integer $buy_count
 * @property string $market_price
 * @property string $pay_price
 * @property integer $integral
 * @property integer $user_id
 * @property integer $goods_id
 */
class Order extends ActiveRecord implements IArrayable
{

    /**
     * 订单状态
     * @var array
     */
    public static $pay_status = [
        0 => '未支付',
        1 => '已过期',
        2 => '支付中',
        3 => '支付失败',
        4 => '已付款',
    ];

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'meipin_order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('buy_count', 'required'),
            array('pay_status, order_type, created_at, updated_at, pay_time, pay_way, buy_count, integral,user_id,goods_id', 'numerical', 'integerOnly' => true),
            array('order_id', 'length', 'max' => 20),
            array('remark', 'length', 'max' => 200),
            array('market_price, pay_price', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('order_id, pay_status, order_type, created_at, updated_at, pay_time, remark, pay_way, buy_count, market_price, pay_price, integral,user_id,goods_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'exchangeLog' => array(self::HAS_ONE, 'ExchangeLog', ['order_id' => 'order_id'], 'together' => true, 'joinType' => 'inner join'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'order_id' => '订单开头,兑换：D;',
            'pay_status' => '0：未支付；1：取消；2：支付中；3：支付失败；4：已支付；',
            'order_type' => '1:兑换订单',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'pay_time' => '支付时间',
            'remark' => '备注信息',
            'pay_way' => '支付方式',
            'buy_count' => '购买数量',
            'market_price' => '市场价格',
            'pay_price' => '支付价格',
            'integral' => '积分消耗',
            'user_id' => '用户ID',
            'goods_id' => '商品ID'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     *                             based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('order_id', $this->order_id, true);
        $criteria->compare('pay_status', $this->pay_status);
        $criteria->compare('order_type', $this->order_type);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('pay_time', $this->pay_time);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('pay_way', $this->pay_way);
        $criteria->compare('buy_count', $this->buy_count);
        $criteria->compare('market_price', $this->market_price, true);
        $criteria->compare('pay_price', $this->pay_price, true);
        $criteria->compare('integral', $this->integral);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 订单状态
     * @param  integer $status 订单状态
     * @return string
     */
    public static function getPayStatus($status)
    {
        return isset(self::$pay_status[$status]) ? self::$pay_status[$status] : "-";
    }

    /**
     * 根据订单号、用户ID获取订单
     * @param  fixed   $order_id 订单号
     * @param  integer $user_id  用户ID
     * @return Order
     */
    public static function findByUserId($order_id, $user_id)
    {
        return self::model()->findByPk($order_id, 'user_id=:user_id', [':user_id' => $user_id]);
    }

}
