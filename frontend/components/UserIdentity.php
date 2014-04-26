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

        if ($user === false) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->id = $user->id;
            $this->name = $user->username;

            // 设置最后一次登录时间
            $currentTime = time();

            // 设置用户属性
            Yii::app()->user->setState( 'singleLoginTime' , $currentTime );
            Yii::app()->user->setState( 'id' , $user->id );
            Yii::app()->user->setState( 'name' , $user->username );

            // 更新用户最后登陆时间
            $affect = User::model()->updateByPk($user->id, array(
                'last_login' => $currentTime,
                'last_ip' => Yii::app()->request->userHostAddress
            ));

            // 两个用户同一时间数据库报错
            if ($affect !== 1) {
                throw new CHttpException( '403' , '登录失败' );
            }
            $this->errorCode=self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
