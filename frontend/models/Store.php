<?php
/**
 * 美品网商城数据
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class Store extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_store}}';
    }

    /**
     * 获取商城名称
     * @param  integer $id 商城ID
     * @return string  商城名称
     */
    public static function getStoreByPk($id)
    {
        // 缓存名称
        $cacheKey = 'meipin-store-'.$id;

        // 得到缓存数据
        $name = Yii::app()->cache->get($cacheKey);
        if (!empty($name)) {
            return $name;
        }

        $array = array();
        $storeAll = self::model()->findAll();
        foreach ($storeAll as $val) {
            $array[$val->id] = $val->name;
        }
        if (!isset($array[$id])) {
            $name = '淘宝网';
        } else {
            $name = $array[$id];
        }

        Yii::app()->cache->set($cacheKey, $name, 86400);

        return $name;
    }
}
