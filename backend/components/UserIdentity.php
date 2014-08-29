<?php
/**
 * 用户身份管理
 */
class UserIdentity extends CUserIdentity
{
    public $flag;
    /**
     * @var array 用户账号密码
     */
    private $users = array(
        'qidalin' => 'forget543',
        'wubaiqing' => 'wbq@123',
        'bohe1992' => '1992123bh', //张奇
        'zozo929' => '18601310545', //李鑫涵
        'Zitong' => '123456',
        'xiaotao' => 'xiaotao88', //刘雨
        'duoduo' => 'meipinwang5', //侯宝多
        'test'=>'nshd',
        'taolaoda'=>'277832054'
    );

    /**
     * 用户登录
     *  const ERROR_NONE=0;
   *  const ERROR_USERNAME_INVALID=1;
  *  const ERROR_PASSWORD_INVALID=2;
   *   const ERROR_UNKNOWN_IDENTITY=100;
     */
    public function authenticate()
    {
        if (!isset($this->users[$this->username])) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($this->users[$this->username] !== $this->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->errorCode = self::ERROR_NONE;
        }

         $flag = !$this->errorCode;
         if ($flag == self::ERROR_USERNAME_INVALID) {
           UserLoginLog::setLoginTime($this->username);
         }

        return $flag;
    }
}
