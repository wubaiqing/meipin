<?php
/**
 * 用户登录
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class LoginForm extends CFormModel
{
    /**
     * @var string 用户名
     */
    public $username;

    /**
     * @var string 密码
     */
    public $password;

    /**
     * @var string 验证码
     */
    public $verifyCode;

    /**
     * @var repospone 身份
     */
    private $_identity;

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [
            ['username, password,verifyCode', 'required'],
        ];
    }

    /**
     * 美品网登陆
     * @return boolean
     */
    public function login()
    {
        // 校验验证码
        $code = Yii::app()->controller->createAction('captcha')->verifyCode;
        if (empty($this->verifyCode)) {
            $this->addError('verifyCode', '验证码不允许为空');

            return false;
        } elseif ($this->verifyCode != $code) {
            $this->addError('verifyCode', '验证码不正确');

            return false;
        }

        // 身份识别
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }

        // 验证信息
        if ($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_INVALID || $this->_identity->errorCode == UserIdentity::ERROR_PASSWORD_INVALID) {
            $this->addError('username', '用户名或密码不正确');
        } elseif ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            Yii::app()->user->login($this->_identity, 0);
            $this->setReferer();

            return true;
        } else {
            return false;
        }
    }



    /**
     * 美品网登陆
     * @return boolean
     */
    public function QQlogin()
    {
        // 身份识别
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->Qloginouth();
        }

        // 验证信息
       if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) 
       {
            Yii::app()->user->login($this->_identity, 0);
            $this->setReferer();

            return true;
        } else {
            return false;
        }
    }

    /**
     * 美品网登陆
     * @return boolean
     */
    public function Tblogin()
    {
        // 身份识别
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->Tbloginouth();
        }

        // 验证信息
       if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) 
       {
            Yii::app()->user->login($this->_identity, 0);
            $this->setReferer();

            return true;
        } else {
            return false;
        }
    }

    /**
     * 设置跳转页面的cookie
     */
    public function setReferer()
    {
        $referer = Yii::app()->request->getQuery('referer');
        if ($referer == '') {
            return false;
        }
        $cookie = new CHttpCookie('referer', $referer);
        Yii::app()->request->cookies->add('referer', $cookie);
    }
}
