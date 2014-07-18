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
     * 生成缓存KEY，通过前缀和参数
     * @param string $prefix 前缀
     * @param array $args
     */
    public static function generateCacheKey($prefix, $args = array())
    {
        return $prefix . md5(serialize($args));
    }

    /**
     * 将字符串从第三位开始替换为*号
     * @param string $str 需要替换的字符串
     * @param integer $end 字符串結束位置
     * @return string 
     */
    public static function filterUsername($str, $end = 3)
    {
        return substr($str, 0, $end) . "******";
    }

    /**
     * 电影
     * @param boolean $status 状态值
     * @param fixed $data 返回数据对象
     * @return array 
     */
    public static function getDataResult($status, $data)
    {
        return ['status' => $status, 'data' => $data];
    }

    /**
     * 生成订单号
     * @param integer $seqNum 订单序列号
     * @param string $prefix 订单前缀
     * @return string 
     */
    public static function generateOrderId($seqNum, $prefix = '')
    {
        $seqNum = strval($seqNum);
        $orderId = $prefix;
        $orderId .= date("Ymd");
        $orderId .=str_pad(substr($seqNum, (strlen($seqNum)-8),8), 8, '0', STR_PAD_LEFT);
        return $orderId;
    }

}
