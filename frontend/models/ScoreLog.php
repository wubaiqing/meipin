<?php

/**
 * 美品网商品管理
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
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, opt_type, created_at,num', 'required'),
            array('id, opt_type,created_at,updated_at,num', 'numerical', 'integerOnly' => true),
            array('id,remark,updated_at', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
        );
    }

}
