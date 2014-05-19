<?php

/**
 * 系统中常用常量定义
 *
 * @author liukui<liujickson@gmail.com>
 */
class Constants
{

    /**
     * 1/秒
     * @var integer 
     */
    const T_SECOND = 1;

    /**
     * 5/秒
     * @var integer 
     */
    const T_SECOND_FIVE = 5;
    /**
     * 10/秒
     * @var integer 
     */
    const T_SECOND_TEN = 10;

    /**
     * 一分钟时间/秒
     * @var integer 
     */
    const T_MONUTE = 60;

    /**
     * 五分钟时间/秒
     * @var integer 
     */
    const T_FIVE_MONUTE = 300;

    /**
     * 十分钟时间/秒
     * @var integer 
     */
    const T_TEN_MONUTE = 600;

    /**
     * 半小时/秒
     * @var integer 
     */
    const T_HALF_HOUR = 1800;

    /**
     * 一小时/秒
     * @var integer 
     */
    const T_HOUR = 3600;

    /**
     * 二小时/秒
     * @var integer 
     */
    const T_TWO_HOUR = 7200;

    /**
     * 四小时/秒
     * @var integer 
     */
    const T_FOUR_HOUR = 14400;

    /**
     * 一天/秒
     * @var integer 
     */
    const T_DAY = 86400;

    /**
     * 状态码【未登录】
     * @var integer 
     */
    const S_NOT_LOGIN = 10001;

    /**
     * 状态码【收货地址未填写】
     * @var integer 
     */
    const S_NOT_ADDRESS = 10002;

    /**
     * 状态码【商品不存在】
     * @var integer 
     */
    const S_GOODS_NOT_EXIST = 10003;

    /**
     * 状态码【活动还未开始】
     * @var integer 
     */
    const S_ACT_NO_START = 10004;

    /**
     * 状态码【活动已经结束】
     * @var integer 
     */
    const S_ACT_ENDED = 10005;

    /**
     * 状态码【积分不足】
     * @var integer 
     */
    const S_SCORE_NOT_ENOUGH = 10006;

    /**
     * 状态码【庫存不足】
     * @var integer 
     */
    const S_STORE_NOT_ENOUGH = 10007;

    /**
     * 状态码【正整数】
     * @var integer 
     */
    const S_NUMBER_POSITIVE = 10008;

    /**
     * 状态码【数据库更新错误】
     * @var integer 
     */
    const S_DB_UPDATE_ERR = 10008;

    /**
     * 状态码【操作错误】
     * @var integer 
     */
    const S_OPT_ERR = 10009;
    /**
     * 状态码【重复操作】
     * @var integer 
     */
    const S_OPT_REPEAT = 10009;

}
