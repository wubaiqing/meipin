<?php

/**
 * 用户管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class FeedBack extends ActiveRecord implements IArrayable
{

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_feedback}}';
    }

	/**
	 * 用户评论属性验证规则
	 * @return array
	 */
	public function rules()
	{
		return [
			['id, qq, email, advise, created_at, updated_at', 'safe']
		];
	}

    /**
     * 列表搜索
     * @return ActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id,true);
        $criteria->compare('qq', $this->qq,true);
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
            'qq' => 'QQ',
            'email' => '邮箱',
            'created_at' => '创建时间',
        ];
    }

}
