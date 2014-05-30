<?php
/**
 * 用户登录
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class Feedback extends CFormModel
{
 
     public $qq;
     public $advise;

    /**
     * @var string 密码
     */
    public $email;
        /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [
            ['qq, advise', 'required'],
        ];
    }

}