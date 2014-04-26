<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * 管理员ID
	 * @var type
	 */
	private $id;

	/**
	 * 管理员名称
	 * @var string
	 */
	private $name;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// 获取用户信息
        $user = User::model()->findByAttributes(array(
            'username' => $this->username
        ));

		if ($user === false)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if (!$user->validatePassword($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->id = $user->id;
			$this->name = $user->username;

			// 设置最后一次登录时间
			$currentTime = time();

			// 设置用户属性
			Yii::app()->user->setState( 'singleLoginTime' , $currentTime );
			Yii::app()->user->setState( 'id' , $user->id );

			// 更新用户最后登陆时间
			$affect = User::model()->updateByPk($user->id, array(
				'last_login' => $currentTime,
				'last_ip' => Yii::app()->request->userHostAddress
			));

			// 两个用户同一时间数据库报错
			if ( $affect !== 1 ) {
				throw new CHttpException( '403' , '登录失败' );
			}
		}
		return $this->errorCode == self::ERROR_NONE;
	}

	public function getId()
	{
		return $this->adminid;
	}

	public function getName()
	{
		return $this->admin_name;
	}

	public function getCityId() {
		return $this->city_id;
	}

        public function getSourceId() {
		return $this->source_id;
	}

	public function getActionList() {
		return $this->action_list;
	}

	public function getPersistentStates()
	{
		return array('adminid'=>$this->adminid,
			'admin_id'=>$this->admin_id,
			'admin_name'=>$this->admin_name,
			'city_id'=>$this->city_id,
                        'source_id'=>$this->source_id,
			'action_list'=>$this->action_list
			);
	}

}

