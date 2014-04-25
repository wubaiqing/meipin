<?php
/**
 * 用户管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class User extends ActiveRecord implements IArrayable
{
    /**
     * @var string 验证码
     */
    public $verifyCode;

    /**
     * @var string 重复密码
     */
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
            array('username', 'checkUsername'),
            array('password', 'checkPassword'),
            array('verifyCode', 'checkVerifyCode'),
        );
    }

    /**
     * 校验用户名
     */
    public function checkPassword()
    {
        if (empty($this->password) || empty($this->confirmPassword)) {
            $this->addError('password', '密码不能为空');
        } elseif ($this->password != $this->confirmPassword) {
            $this->addError('password', '两次密码不一致');
        } else {
            $this->password = md5($this->password);
        }
    }

    /**
     * 校验用户名
     */
    public function checkUsername()
    {
        if (empty($this->username)) {
            $this->addError('username', '用户名不能为空');
        } elseif (strlen($this->username) > 50) {
            $this->addError('username', '用户名不能大于50个字符');
        }
    }

    /**
     * 校验验证码
     */
    public function checkVerifyCode()
    {
        $code = Yii::app()->controller->createAction('captcha')->verifyCode;
        if (empty($this->verifyCode)) {
            $this->addError('verifyCode', '验证码不允许为空');
        } elseif ($this->verifyCode != $code) {
            $this->addError('verifyCode', '验证码不正确');
        }
    }
}

