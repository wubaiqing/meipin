<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{

	public $username;
	public $password;
	public $rememberMe;
	public $verifyCode;
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
        return array(
            // username and password are required
            array('username, password,verifyCode', 'required'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
            array('verifyCode', 'captcha')
        );
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe' => 'Remember me next time',
			'verifyCode'=>'验证码'
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			$this->_identity = new UserIdentity($this->username, $this->password);
			if (!$this->_identity->authenticate())
			{
				$this->addError('password', '密码错误');
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if ($this->_identity === null)
		{
			$this->_identity = new UserIdentity($this->username, $this->password);
			$this->_identity->authenticate();
		}
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
		{
			$duration = 0;
			Yii::app()->user->login($this->_identity, $duration);
			// 设置跳转页面的cookie
			$this->setReferer();
			return true;
        } else {
			$code = Yii::app()->controller->createAction('captcha')->verifyCode;
			if (empty($this->verifyCode)) {
				$this->addError('verifyCode', '验证码不允许为空');
			} elseif ($this->verifyCode != $code) {
				$this->addError('verifyCode', '验证码不正确');
			} else {
				if ($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_INVALID || $this->_identity->errorCode == UserIdentity::ERROR_PASSWORD_INVALID) {
					$this->addError('username', '用户名或密码不正确');
				}
			}
            return false;
        }
	}

	/**
	 * 设置跳转页面的cookie
	 */
	public function setReferer()
	{
		$referer = Yii::app()->request->getQuery('referer');
		if ($referer == '')
		{
			return false;
		}
		$cookie = new CHttpCookie('referer', $referer);
		Yii::app()->request->cookies->add('referer', $cookie);
	}
}

