<?php
/**
 * 美品网商品兑换记录
 * @author liukui <liujickson@gmail.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class AuthCodeLog extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_auth_code_log}}';
    }

    /**
     * @return array 验证规则.
     */
    public function rules()
    {
        return [
            [
                'user_id,created_at,remark',
                'required'
            ],
            [
                'id,updated_at',
                'safe'
            ],
        ];
    }

    /**
     * @return array 字段别名 (字段名=>备注)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'created_at' => '兑换时间',
            'updated_at' => '更新时间',
            'remark' => '内容',
        ];
    }

    public static function log($user_id, $remark)
    {
        $log = new self();
        $log->user_id = $user_id;
        $log->created_at = time();
        $log->remark = $remark;
        $log->save();
    }
}
