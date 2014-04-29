<?php
/**
 * 用户身份识别
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class UserIdentity extends CUserIdentity
{
    /**
     * 
     * @var interger 会员ID
     */
    private $id;

    /**
     * @var string 会员名称
     */
    private $name;

    /**
     * 美品网身份识别
     * @author wubaiqing <wubaiqing@vip.qq.com>
     * @copyright Copyright (c) 2014 美品网
     * @since 1.0
     */
    public function authenticate()
    {
        // 获取用户信息
        $user = User::model()->findByAttributes(array(
            'username' => $this->username
        ));

        if ($user == false) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return !$this->errorCode;
        } elseif (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            
            // 设置用户ID、用户名称
            $this->id = $user->id;
            $this->name = $user->username;

            // 设置最后一次登录时间
            $time = time();

            // 设置用户属性
            Yii::app()->user->setState('singleLoginTime', $time);
            Yii::app()->user->setState('id', $user->id);
            Yii::app()->user->setState('name', $user->username);

            // 更新用户最后登陆时间
            $affect = User::model()->updateByPk($user->id, [
                'last_login' => $time,
                'last_ip' => Yii::app()->request->userHostAddress
            ]);

            // 两个用户同一时间数据库报错
            if ($affect !== 1) {
                throw new CHttpException( '403' , '登录失败' );
            }
            $this->errorCode=self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    /**
     * 获取用户ID
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 获取用户名称
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
