<?php

/**
 * 用户地址管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class UsersAddress extends ActiveRecord implements IArrayable
{

    public $province;
    public $city;

    /**
     * 短信验证码
     * @var integer
     */
    public $code;

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_users_address}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [
            ['postcode', 'checkPostCode'],
            ['code', 'checkCode'],
            ['city_id','checkCity'],
            ['mobile','checkMobile'],
            ['id,user_id, name, mobile, city_id, county_id, address, postcode, created_at, updated_at', 'safe'],
        ];
    }

    /**
     * 邮编验证
     */
    public function checkPostCode()
    {
        if (!is_numeric($this->postcode)) {
            $this->addError('postcode', '邮编格式错误');
        }
    }

    /**
     * 手机绑定验证码校验
     */
    public function checkCode()
    {
        $code = Yii::app()->cache->get(Sms::mobileValidateKey($this->user_id));
        $user = User::getUser($this->user_id);
        if ($user->mobile_bind == 0 && (!is_numeric($this->code) || $this->code != $code)) {
            $this->code = null;
            $this->addError('code', '验证码错误');
        }
    }
    /**
     * 校验手机号码
     */
    public function checkMobile(){
//        $mobileBind = User::getMobileBindStatus($this->mobile);
//        if($mobileBind){
//            $this->addError("mobile", "手机号码已经被其他账号绑定");
//        }
    }

    /**
     * 城市校验
     */
    public function checkCity()
    {
        if ($this->city_id <1) {
            $this->addError('city_id', '请选择省份和城市');
        }
    }

    /**
     * 根据用户ID得到用户收获地址信息
     * @param  integer $userId 用户ID
     * @return mixed
     */
    public static function getByUserId($userId)
    {
        $cacheKey = 'meipin-get-by-user-id-' . $userId;
        $result = Yii::app()->cache->get($cacheKey);
        if (!empty($result)) {
            return $result;
        }

        $address = self::model()->findByAttributes(array(
            'user_id' => $userId
        ));
        Yii::app()->cache->set($cacheKey, $address, 3600);

        return $address;
    }

    /**
     * 清空缓存key
     */
    public static function deleteCacheByUserId($userId)
    {
        $cacheKey = 'meipin-get-by-user-id-' . $userId;
        Yii::app()->cache->delete($cacheKey);
    }

    /**
     * 获取用户地址
     * @param  integer $userId 用户ID
     * @return object
     */
    public static function getModel($userId)
    {
        $address = self::getByUserId($userId);
        if (!empty($address)) {
            return $address;
        }

        return new UsersAddress();
    }

    /**
     * 设置用户修改地址属性
     * @param array $attr 地址属性
     */
    public static function setAttr($userId, $attr)
    {
        $attr['user_id'] = $userId;

        return $attr;
    }

}
