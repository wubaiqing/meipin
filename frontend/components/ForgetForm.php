<?php
/**
 * 用户登录
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class ForgetForm extends CFormModel
{
    /**
     * @var string 用户名
     */
    public $email;


    /**
     * @var string 验证码
     */
    public $verifyCode;



    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [
            ['email,verifyCode', 'required'],
        ];
    }

    /**
     * 美品网登陆
     * @return boolean
     */
    public function forgetRule()
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
        if (empty($this->email)) {
            $this->addError('email', '邮箱不能为空');
            return false;
        }


         $this->setReferer();
         return true;
     
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
