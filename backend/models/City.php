<?php
/**
 * 用户地址管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class City extends ActiveRecord implements IArrayable
{
    /**
     * @return string 表名
     */
    public function tableName()
    {
        return '{{meipin_city}}';
    }

    /**
     * @return array 验证规则
     */
    public function rules()
    {
        return [
            ['id, user_id, name, mobile, city_id, address, postcode, created_at, updated_at', 'safe'],
        ];
    }

    /**
     * 以父级ID获取数据
     * @param  integer $parentId
     * @return object
     */
    public static function getByParentId($parentId)
    {
        $data = self::model()->findAllByAttributes([
            'parent_id' => $parentId,
            'is_show' => 1
        ], [
            'order' => 'id asc'
        ]);

        $array = [];
        foreach ($data as $item) {
            $array[$item->id] = $item->city_name;
        }

        return $array;
    }

    /**
     * 获取城市每一行数据模板
     * @param  object $city 城市对象
     * @return string 每一个城市模板
     */
    public static function getItem($cities)
    {
        $string = "<option>请选择</option>";
        foreach ($cities as $id => $name) {
            $string .= "<option value='{$id}'>{$name}</option>";
        }

        return $string;
    }

    /**
     * 获取省份ID
     * @param  integer $cityId 城市ID
     * @return integer
     */
    public static function getProvinceId($cityId)
    {
        $citys = 0;
        $city = self::model()->findByAttributes([
            'id' => $cityId
        ]);
        if (empty($city)) {
            return $citys;
        }

        $cityId = $city->parent_id;

        return $cityId;
    }

    /**
     * 获取当前城市列表
     */
    public static function getCityList($province)
    {
        $city = [];
        if ($province == 0) {
            return $city;
        }

        return self::getByParentId($province);
    }
}
