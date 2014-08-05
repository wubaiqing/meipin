<?php

/**
 * 用户管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class Category extends ActiveRecord implements IArrayable
{
    /**
     * 验证规则
     * @return array
    */
    public function tableName()
    {
        return '{{meipin_category}}';
    }

        //验证表单域
    public function rules()
    {
        return array(
             [
                'id,name,username,parent_id,created_at,updated_at',
                'safe'
             ],
        );
    }
    //验证爱好
   
}
