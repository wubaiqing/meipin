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

        //从这里判断获取的用户名是手机号，邮箱还是用户名

        /* $user = User::model()->findByAttributes(array(
            'username' => $this->username
        ));
        */
        $u_name =$this->username;
        $criteria = new CDbCriteria; 
        $criteria->select = '*';//指定的字段
        $criteria->addCondition("username='{$u_name}'",'OR');
        $criteria->addCondition("email='{$u_name}'",'OR');
        $criteria->addCondition("mobile='{$u_name}'",'OR');
        $criteria->distinct = true; //是否唯一查询 
        $user=User::model()->find($criteria); // $params isnot needed  


        if ($user == false) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;//1

            return !$this->errorCode;
        } elseif (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;//2
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
            $this->errorCode=self::ERROR_NONE;//0
        }

        return !$this->errorCode;
    }

    //qq登陆验证
    public function Qloginouth()
    {

        $openid =  $this->username;
        $nickname = User::generateNickName();

        //先检查是否存在openid 
        $user = User::model()->findByAttributes(array(
            'qq_openid' => $openid
        ));

        //不存在openid 就往数据库里面插入一条数据
        if($user == false)
        {
            $post=new User;
            $post->username = $nickname;
            $post->qq_openid= $openid;
            $post->save();
            $id = $post->attributes['id'];
            $this->id = $id;
            $this->name = $nickname;
            // 设置最后一次登录时间
            $time = time();
            // 设置用户属性
            Yii::app()->user->setState('singleLoginTime', $time);
            Yii::app()->user->setState('id', $id);
            Yii::app()->user->setState('name', $nickname);
            Yii::app()->user->setState('qid', '1');
            $this->errorCode=self::ERROR_USERNAME_INVALID;
            return !$this->errorCode;//0
        }
        else
        {  //已经存在openid  然后就开始修改 更改时间
            $this->id = $user->id;
            $this->name = $user->username;
            // 设置最后一次登录时间
            $time = time();
            // 设置用户属性
            Yii::app()->user->setState('singleLoginTime', $time);
            Yii::app()->user->setState('id', $user->id);
            Yii::app()->user->setState('name', $user->username);
            Yii::app()->user->setState('qid', '1');
            // 更新用户最后登陆时间
            $affect = User::model()->updateByPk($user->id, [
                'last_login' => $time,
                'last_ip' => Yii::app()->request->userHostAddress,
                //'username' =>$nickname
            ]);

            // 两个用户同一时间数据库报错
            if ($affect !== 1) {
                throw new CHttpException( '403' , '登录失败' );
            }
            $this->errorCode=self::ERROR_NONE;//0
        }
        return !$this->errorCode;
    }

    //淘宝登陆验证
    public function Tbloginouth()
    {
        $tb_userid =  $this->username;
        $nickname = User::getTbNickName();

        //先检查是否存在openid 
        $user = User::model()->findByAttributes(array(
            'tb_userid' => $tb_userid
        ));

        //不存在openid 就往数据库里面插入一条数据
        if($user == false)
        {
            $post=new User;
            $post->username = $nickname;
            $post->tb_userid= $tb_userid;
            $post->save();
            $id = $post->attributes['id'];
            $this->id = $id;
            $this->name = $nickname;
            // 设置最后一次登录时间
            $time = time();
            // 设置用户属性
            Yii::app()->user->setState('singleLoginTime', $time);
            Yii::app()->user->setState('id', $id);
            Yii::app()->user->setState('name', $nickname);
            Yii::app()->user->setState('qid', '2'); //设置是否是qq登陆

            $this->errorCode=self::ERROR_USERNAME_INVALID;
            return !$this->errorCode;//0
        }
        else
        {  //已经存在openid  然后就开始修改 更改时间
            $this->id = $user->id;
            $this->name = $user->username;
            // 设置最后一次登录时间
            $time = time();
            // 设置用户属性
            Yii::app()->user->setState('singleLoginTime', $time);
            Yii::app()->user->setState('id', $user->id);
            Yii::app()->user->setState('name', $user->username);
            Yii::app()->user->setState('qid', '2');
            // 更新用户最后登陆时间
            $affect = User::model()->updateByPk($user->id, [
                'last_login' => $time,
                'last_ip' => Yii::app()->request->userHostAddress,
                //'username' =>$nickname
            ]);

            // 两个用户同一时间数据库报错
            if ($affect !== 1) {
                throw new CHttpException( '403' , '登录失败' );
            }
            $this->errorCode=self::ERROR_NONE;//0
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
