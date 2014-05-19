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
            ['user_id', 'required'],
            ['postcode' ,'checkPostCode'],
            ['id, name, mobile, city_id, county_id, address, postcode, created_at, updated_at', 'safe'],
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
     * 根据用户ID得到用户收获地址信息
     * @param  integer $userId 用户ID
     * @return mixed
     */
    public static function getByUserId($userId)
    {
        $cacheKey = 'meipin-get-by-user-id-'.$userId;
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
        $cacheKey = 'meipin-get-by-user-id-'.$userId;
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
