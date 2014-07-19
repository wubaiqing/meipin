<?php

/**
 * 用户管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class Score extends ActiveRecord implements IArrayable
{

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_score}}';
    }

    /**
     * 用户评论属性验证规则
     * @return array
     */
    public function rules()
    {
        return [
            ['id, score, user_id, reason, remark, goods_id, updated_at', 'safe']
        ];
    }

    public function search($uid)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('user_id', $uid,false);
        $criteria->order = 'id desc';

        return new CActiveDataProvider($this,
            [
                'criteria' => $criteria,
            ]);
    }

    /**
     * 字段属性名称
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id'=>'user',
            'score' => '积分',
            'remark' => '备注',
            'created_at' => '时间',
        ];
    }

}
