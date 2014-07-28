<?php

/**
 * 用户管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class Users extends ActiveRecord implements IArrayable
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
     * @var string 原密码
     */
    public $oldModel;

    /**
     * @var string 原密码
     */
    public $oldPassword;

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
        return [
            ['username', 'checkUsername', 'on' => 'register'],
            ['verifyCode', 'checkVerifyCode', 'on' => 'register'],
            ['email', 'required', 'message' => '邮箱不能为空', 'on' => 'register'],
            ['email', 'email', 'message' => '请填写正确邮箱地址', 'on' => 'register'],
            ['oldPassword', 'checkOldPassword', 'on' => 'password'],
            ['password', 'checkPassword', 'on' => 'register, password'],
            ['id, username, password, email, salt, created_at, updated_at, confirmPassword, verifyCode,dr_count,last_dr_time, count', 'safe'],
        ];
    }

    /**
     * 校验原始密码
     */
    public function checkOldPassword()
    {
        if ($this->oldModel->password != $this->hashPassword($this->oldPassword, $this->oldModel->salt)) {
            $this->addError('oldPassword', '原始密码不正确');
        }
    }

    /**
     * 校验用户名
     */
    public function checkPassword()
    {
        $error = $this->getErrors();
        if (empty($this->password) || empty($this->confirmPassword)) {
            $this->addError('password', '密码不能为空');
        } elseif ($this->password != $this->confirmPassword) {
            $this->addError('password', '两次密码不一致');
        } elseif (empty($error)) {
            $this->salt = self::randSalt(6);
            $this->password = $this->hashPassword($this->password, $this->salt);
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
        } else {
            $user = self::model()->findByAttributes(['username' => $this->username]);
            if (!empty($user)) {
                $this->addError('username', '用户名已被注册');
            }
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

    /**
     * 随机字符串生成
     * @param  integer $length 随机码长度
     * @return string
     */
    public function randSalt($length = 6)
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjklmnpqrstuvwxyz123456789';
        $string = '';
        for ($i = 1; $i <= $length; $i++) {
            $position = mt_rand() % strlen($chars);
            $string.=substr($chars, $position, 1);
        }

        return $string;
    }

    /**
     * 验证用户密码
     * @params string $password 密码
     * @return boolean
     */
    public function validatePassword($password)
    {
        return $this->hashPassword($password, $this->salt) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @return string hash
     */
    public function hashPassword($password, $salt)
    {
        return md5(md5($password) . $salt);
    }

    /**
     * 获取用户信息
     * @param integer $userId 用户ID
     */
    public static function getUser($userId)
    {
        $cacheKey = 'meipin-get-user-' . $userId;
        $result = Yii::app()->cache->get($cacheKey);
        if ($result) {
            return $result;
        }

        $user = self::model()->findByPk($userId);
        Yii::app()->cache->set($cacheKey, $user, 3600);

        return $user;
    }

    /**
     * 删除用户缓存
     * @param integer $userId 用户ID
     */
    public static function deleteCache($userId)
    {
        $cacheKey = 'meipin-get-user-' . $userId;
        Yii::app()->cache->delete($cacheKey);
    }

    /**
     * 清空密码
     */
    public static function clearPassword(& $model)
    {
        $model->password = '';
        $model->oldPassword = '';
        $model->confirmPassword = '';
    }

    /**
     * 列表搜索
     * @return ActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id, true);
        $criteria->compare('username', $this->username, true);
        $criteria->order = 't.id desc';

        return new CActiveDataProvider($this,
            [
                'criteria' => $criteria,
            ]);
    }


    /**
     * 用户统计
     * @return array
     */
    public function getuserinfo()
    {

        $criteria = new CDbCriteria;
        $criteria->select = "FROM_UNIXTIME(created_at,'%Y-%m-%d') as created_at,count(id) as id";
        $criteria->compare("FROM_UNIXTIME(created_at,'%Y-%m-%d')", $this->created_at);
        $criteria->group="FROM_UNIXTIME(created_at,'%Y-%m-%d')";
        $criteria->order = 'created_at desc';
        //$result = Users::model()->findAll($criteria);

       /*  foreach ($result  as $key => $value) 
        {
            $ctime = $value->created_at;
            $sql = "SELECT reason,sum(score) as score from meipin_score where FROM_UNIXTIME(created_at,'%Y-%m-%d')='{$ctime}' GROUP BY FROM_UNIXTIME(created_at,'%Y-%m-%d'),reason";
            $score = Score::model()->findAllBySql($sql);
            $result[$key]['score']=$score;
        }*/
        return new CActiveDataProvider($this,
        [
            'criteria' => $criteria,
        ]);
    }

    /**
     * 用户统计 积分数
     * @return array
     */
    public function getscore($ctime)
    {
        $criteria = new CDbCriteria;
        $criteria->select = "reason,sum(score) as score";
        $criteria->compare("FROM_UNIXTIME(created_at,'%Y-%m-%d')", $ctime);
        $criteria->group=" FROM_UNIXTIME(created_at,'%Y-%m-%d'),reason";
        $result = Score::model()->findAll($criteria);
        $arr =array('zjscore'=>'无','xhscore'=>'无');

        foreach ($result as $key => $value) {
            if($value->reason ==1)
            {
                $arr['zjscore'] = $value->score;
            }else
            {
                $arr['xhscore'] = $value->score;
            }
        }
        return $arr;
    }
    /**
     * 字段属性名称
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'mobile' => '手机号',
            'score' => '总积分',
            'created_at' => '创建时间',
            'last_ip' =>'最后一次登陆ip',
            'email'=>'邮箱',
            'last_login'=>'最后一次登陆时间'
        ];
    }

}
