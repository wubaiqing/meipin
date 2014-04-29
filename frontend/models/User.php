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
            ['id, username, password, email, salt, created_at, updated_at, confirmPassword, verifyCode', 'safe'],
            ['username', 'checkUsername', 'on' => 'register'],
            ['verifyCode', 'checkVerifyCode', 'on' => 'register'],
            ['email', 'required', 'message' => '邮箱不能为空', 'on' => 'register'],
            ['email', 'email', 'message' => '请填写正确邮箱地址', 'on' => 'register'],
            ['password', 'checkPassword', 'on' => 'register']
        ];
    }

    /**
     * 校验用户名
     */
    public function checkPassword()
    {
        if (empty($this->password) || empty($this->confirmPassword)) {
            $this->addError('password', '密码不能为空');
        } elseif ($this->password != $this->confirmPassword) {
            $this->addError('password', '两次密码不一致');
        } elseif (empty($this->getErrors())) {
            $this->salt = self::randSalt(6);
            $this->password = $this->hashPassword($this->password);
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
        return $this->hashPassword($password) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @return string hash
     */
    public function hashPassword($password)
    {
        return md5(md5($password).$this->salt);
    }
}
