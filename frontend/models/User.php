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
            ['id, username, password, email, salt, created_at, updated_at, confirmPassword, verifyCode,score,dr_count,last_dr_time'
                . ',mobile_bind,sms_day_count,last_sms_time,mobile', 'safe'],
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
    public static function getUserCacheKey($userId)
    {
        return 'meipin-get-user-' . $userId;
    }

    /**
     * 获取用户信息
     * @param integer $userId 用户ID
     */
    public static function getUser($userId)
    {
        $cacheKey = self::getUserCacheKey($userId);
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
     * 用户是否已经签到
     * @return boolean 
     */
    public static function isSignDay()
    {
        $user = User::getUser(Yii::app()->user->id);
        return !empty($user) && (date("Y-m-d", $user->last_dr_time) == date("Y-m-d", time()));
    }
    /**
     * 更新手机绑定状态
     * @param integer $userId 用户ID
     * @param string $mobile 手机号码
     * @param integer $status 绑定状态 0:未绑定；1：已绑定
     * @return boolean 
     */
    public static function updateMobileBindSataus($userId, $mobile, $status)
    {
        if (!in_array($status, [0, 1])) {
            return false;
        }
        self::model()->updateByPk($userId, ['mobile' => $mobile, 'mobile_bind' => $status]);
        return true;
    }

}
