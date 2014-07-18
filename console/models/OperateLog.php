<?php

/**
 * 用户管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class OperateLog extends ActiveRecord implements IArrayable
{


    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_operatelog}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [

            ['id, log_type, operatedata, created_at, updated_at', 'safe'],
        ];
    }


}
