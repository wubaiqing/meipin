<?php

/**
 * 美品网商品签到日志
 * @author liukui <liujickson@gmail.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 * The followings are the available columns in table 'meipin_exchange':
 * @property integer $id
 * @property integer $user_id
 * @property integer $opt_type
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $num
 * @property string $remark
 * 
 */
class ScoreLog extends ActiveRecord implements IArrayable
{

    /**
     * 每日签到
     * @var integer 
     */
    const S_OPTTYPE_DAY_REGISTION = 1;

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_score_log}}';
    }

    /**
     * @return array 验证规则
     */
    public function rules()
    {
        return [
            ['id, opt_type, created_at,num', 'required'],
            ['id, opt_type,created_at,updated_at,num', 'numerical', 'integerOnly' => true],
            ['id,remark,updated_at', 'safe'],
        ];
    }

    /**
     * @return array 别名(name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'opt_type' => '操作类型',
            'created_at' => '创建时间',
            'num' => '积分消耗数量',
            'updated_at' => '更新时间',
            'remark' => '备注'
        ];
    }

}
