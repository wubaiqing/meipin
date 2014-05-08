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

}
