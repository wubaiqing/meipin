<?php

/**
 * 通用公共函数
 *
 * @author liukui<liujickson@gmail.com>
 */
class CommonHelper
{

    /**
     * 是否使用DEBUG调试模式
     * @return boolean 
     */
    public static function getEnableDebug()
    {
        return isset(Yii::app()->params['config']['enableDebug']) ? Yii::app()->params['config']['enableDebug'] : false;
    }

    /**
     * 系統中是否使用緩存
     * @return boolean 
     */
    public static function getEnableCache()
    {
        return isset(Yii::app()->params['config']['enableDebug']) ? Yii::app()->params['config']['enableCache'] : false;
    }

    /**
     * 标准格式的
     */
    public static function getAjaxFormat($data, $status = false, $msg = '')
    {
        return array('status' => $status, 'data' => $data, 'msg' => $msg);
    }

    /**
     * 生成缓存KEY，通过前缀和参数
     * @param string $prefix 前缀
     * @param array $args
     */
    public static function generateCacheKey($prefix, $args = array())
    {
        return $prefix . md5(serialize($args));
    }

    public static function filterUsername($str)
    {
        return substr($str, 0,3)."******";
    }

}
