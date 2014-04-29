<?php
/**
 * Banner管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class Banner extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_banner}}';
    }

    public static function getAll()
    {
        $cacheKey = 'get-banner-all';
        $result = Yii::app()->cache->get($cacheKey);
        if (!empty($result)) {
            return $result;
        }

        $result = Banner::model()->findAll(array(
            'index' => 'id'
        ));

        Yii::app()->cache->set($cacheKey, $result, 3600);

        return $result;
    }

}
