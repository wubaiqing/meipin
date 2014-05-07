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
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_city}}';
    }

    /**
     * 以父级ID获取数据
     * @param integer $parentId 
     * @return object
     */
    public static function getByParentId($parentId)
    {
        $cacheKey = 'meipin-city-get-by-parent-id-'.$parentId;
        $result = Yii::app()->cache->get($cacheKey);
        $result = false;
        if (!empty($result)) {
            return $result;
        }

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

        Yii::app()->cache->set($cacheKey, $array, 3600);
        return $parent;
    }

    /**
     * 获取城市每一行数据模板
     * @param object $city 城市对象
     * @return string 每一个城市模板
     */
    public static function getItem($city)
    {
        $string = "";
        foreach ($city as $item) {
            $string .= "<option value='{$item->id}'>{$item->city_name}</option>";
        }
        return $string;
    }

}

