<?php
/**
 * 积分兑换的model
 * @author zhangchao
 */
class Exchange extends CActiveRecord
{
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
        return array(
            array('name, taobaoke_url, support_url, description, img_url', 'required'),
            array('need_level, is_delete', 'numerical', 'integerOnly' => true),
            array('price', 'numerical', 'integerOnly' => false),
            array('name, url_name, support_name', 'length', 'max' => 50),
            array('num, integral, start_time, end_time, taobao_id', 'length', 'max' => 11),
            array('price', 'length', 'max' => 10),
            array('detail_url, taobaoke_url, support_url, taobaoke_shop_url', 'length', 'max' => 200),
            array('img_url', 'length', 'max' => 100),
            array('id','safe'),
            array('id, name, url_name, num, price, integral, start_time, end_time, need_level, taobao_id, detail_url, taobaoke_url, support_name, support_url, taobaoke_shop_url, description, img_url, is_delete', 'safe', 'on' => 'search'),
        );
    }

    /**
     * 字段属性名称
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
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
        }
        $this->update_time = time();
        return true;
    }

    /**
     * @return model
     */
    public static function model($className = __CLASS__)
    {
	return parent::model($className);
    }

}
