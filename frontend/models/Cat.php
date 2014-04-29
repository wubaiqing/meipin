<?php
/**
 * 分类管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class Cat extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_category}}';
    }

    /**
     * 分类列表缓存Key
     * @return string 缓存名称
     */
    public static function getAllCatCacheKey()
    {
        return 'get-cate-all-cachekey';
    }

    /**
     * 得到所有分类
     */
    public static function getAllCat()
    {
        // 缓存名称
        $cacheName = self::getAllCatCacheKey();

        $catArr = array();
        $catArr = Yii::app()->cache->get($cacheName);
        if (!empty($catArr)) {
            return $catArr;
        }

        $cate = self::model()->findAll(array(
            'order' => 't.id asc'
        ));
        foreach ($cate as $key => $item) {
            $array = array();
            $array['id'] = $item->id;
            $array['name'] = $item->name;
            $catArr[$item->id] = $array;
        }

        Yii::app()->cache->set($cacheName, $catArr, 86400);

        return $catArr;
    }
}
