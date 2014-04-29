<?php
/**
 * 商品管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
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
     * 所有商城缓存key
     * @return string 缓存名称
     */
    public static function getAllCacheKey()
    {
        return 'get-store-all-cachekey';
    }

    /**
     * 所有商城数据
     */
    public static function getAll()
    {
        // 缓存名称
        $cacheKey = self::getAllCacheKey();

        // 得到缓存数据
        $data = array();
        $data = Yii::app()->cache->get($cacheKey);
        if (!empty($data)) {
            return $data;
        }

        // 设置缓存
        $data = self::model()->findAll(array(
            'select' => 'id, name',
        ));
        Yii::app()->cache->set($cacheKey, $data , 86400);

        return $data;
    }

    /**
     * 商城缓存
     * @param  integer $id 商城ID
     * @return string  商城缓存key
     */
    public static function getStoreCacheKeyByPk($id)
    {
        return 'get-store-cache-key-by-pk' . $id;
    }

    /**
     * 获取商城名称
     * @param  integer $id 商城ID
     * @return string  商城名称
     */
    public static function getStoreByPk($id)
    {
        // 缓存名称
        $cacheKey = self::getStoreCacheKeyByPk($id);

        // 得到缓存数据
        $name = Yii::app()->cache->get($cacheKey);
        if (!empty($name)) {
            return $name;
        }

        $data = array();
        $storeAll = self::getAll();
        foreach ($storeAll as $key => $val) {
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
