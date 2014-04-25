<?php
/**
 * 商品管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class User extends ActiveRecord implements IArrayable
{
    public $verifyCode;
    public $confirmPassword;

	/**
	 * 表名
	 * @return string
	 */
    public function tableName()
    {
        return '{{meipin_users}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('id, username, email, password, salt, created_at, updated_at, confirmPassword, verifyCode', 'safe'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd') ,'on'=>'register'),
            array('verifyCode', 'checkVerifyCode'),
        );
    }

    /**
     * 校验验证码
     */
    public function checkVerifyCode()
    {
        $code = Yii::app()->controller->createAction('captcha')->verifyCode;
        if ($this->verifyCode != $code) {
            $this->addError('verifyCode', '验证码不正确');
        }
    }



}

