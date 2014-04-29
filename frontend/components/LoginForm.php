<?php
/**
 * 美品网用户登录
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
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        $code = Yii::app()->controller->createAction('captcha')->verifyCode;
        if (empty($this->verifyCode)) {
            $this->addError('verifyCode', '验证码不允许为空');
        } elseif ($this->verifyCode != $code) {
            $this->addError('verifyCode', '验证码不正确');
        }
        
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        
        if ($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_INVALID || $this->_identity->errorCode == UserIdentity::ERROR_PASSWORD_INVALID) {
            $this->addError('username', '用户名或密码不正确');
        } elseif ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            Yii::app()->user->login($this->_identity);
            // 设置跳转页面的cookie
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
