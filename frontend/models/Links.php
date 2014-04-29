<?php
/**
 * 美品网商品管理
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class Links extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_links}}';
    }

    /**
     * 获取友情链接
     * @return response
     */
    public static function getLink()
    {
        $cacheKey = 'meipin-index-links';
        $result = Yii::app()->cache->get($cacheKey);
        if (!empty($result)) {
            return $result;
        }

        $links = Links::model()->findAll([
            'condition' => 'source =:source',
            'params' => array(':source' => 2),
            'order' => 'id Desc'
        ]);
        Yii::app()->cache->set($cacheKey, $links, Yii::app()->params['linkCacheTime']);

        return $links;
    }

}
