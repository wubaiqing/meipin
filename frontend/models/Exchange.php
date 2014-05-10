<?php

/**
 * 积分兑换的model
 * @author zhangchao
 *
 * The followings are the available columns in table 'meipin_exchange':
 * @property string $id
 * @property string $name
 * @property string $url_name
 * @property string $num
 * @property string $left_num
 * @property string $price
 * @property string $integral
 * @property string $start_time
 * @property string $end_time
 * @property integer $need_level
 * @property string $taobao_id
 * @property string $detail_url
 * @property string $taobaoke_url
 * @property string $support_name
 * @property string $support_url
 * @property string $taobaoke_shop_url
 * @property string $description
 * @property string $img_url
 * @property integer $is_delete
 */
class Exchange extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'meipin_exchange';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, detail_url, taobaoke_url, support_name, support_url, description, img_url', 'required'),
            array('need_level, is_delete', 'numerical', 'integerOnly' => true),
            array('price', 'numerical', 'integerOnly' => false),
            array('name, url_name, support_name', 'length', 'max' => 50),
            array('num,left_num, integral, start_time, end_time, taobao_id', 'length', 'max' => 11),
            array('price', 'length', 'max' => 10),
            array('detail_url, taobaoke_url, support_url, taobaoke_shop_url', 'length', 'max' => 200),
            array('img_url', 'length', 'max' => 100),
            array('id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, url_name, num, price, integral, start_time, end_time, need_level, taobao_id, detail_url, taobaoke_url, support_name, support_url, taobaoke_shop_url, description, img_url, is_delete', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'id',
            'name' => '名称',
            'url_name' => 'url名称',
            'num' => '数量',
            'price' => '价格',
            'integral' => '积分',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'need_level' => '等级要求',
            'taobao_id' => '淘宝id',
            'detail_url' => '详情页面url',
            'taobaoke_url' => '淘宝客url',
            'support_name' => '赞助卖家昵称',
            'support_url' => '卖家店址',
            'taobaoke_shop_url' => '淘宝客店址',
            'description' => '描述',
            'img_url' => '图片',
            'is_delete' => '是否删除0否 1是',
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
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

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
        $criteria->compare('detail_url', $this->detail_url, true);
        $criteria->compare('taobaoke_url', $this->taobaoke_url, true);
        $criteria->compare('support_name', $this->support_name, true);
        $criteria->compare('support_url', $this->support_url, true);
        $criteria->compare('taobaoke_shop_url', $this->taobaoke_shop_url, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('img_url', $this->img_url, true);
        $criteria->compare('is_delete', 0); //默认只查询未删除的
        $criteria->order = 't.id desc';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Exchange the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeValidate()
    {
        $this->start_time = strtotime($this->start_time);
        $this->end_time = strtotime($this->end_time);
        return true;
    }

    public function beforeSave()
    {
        //保存之前记录一下时间、人员信息
        if ($this->isNewRecord) {
            $this->create_time = time();
            $this->creater_id = Yii::app()->user->id;
        }
        $this->update_id = Yii::app()->user->id;
        $this->update_time = time();
        return true;
    }

    public function findByPk($pk, $condition = '', $params = array())
    {
        $cacheKey = CommonHelper::generateCacheKey("meipin-exchange-", func_get_args());
        if ($this->enableCache) {
            $data = Yii::app()->cache->get($cacheKey);
            if (!empty($data)) {
                return $data;
            }
        }
        $data = parent::findByPk($pk, $condition, $params);
        if ($this->enableCache) {
            if (empty($data)) {
                Yii::app()->cache->set($cacheKey, $data, Constants::T_SECOND_FIVE);
            }
            else{
                Yii::app()->cache->set($cacheKey, $data, Constants::T_MONUTE);
            }
        }
        return $data;
    }

}
