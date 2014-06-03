<?php
/**
 * 用户行为
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class User
{
    /**
     * @var array $userName 用户列表
     */
    static $userName = array(
        'wubaiqing' => '1',
        'qidalin' => '2',
        'mayue' => '3',
        'xiaotao' => '4', //刘雨
        'Guest' => '5',
        'bohe1992' => '6', //张奇
        'zozo929' => '7', //李鑫涵 
        '小艾' => '8',
        'duoduo' => '9', //侯宝多
    );

    /**
     * @var string 用户ID
     */
    public static function getUserName($name)
    {
        return self::$userName[$name];
    }

    /**
     * 清空前后台缓存
     */
    public static function deleteCache()
    {
        $frontend = Yii::getPathOfAlias('frontend');
        exec('rm -rf '.$frontend. '/runtime/cache/*');
        $backend = Yii::getPathOfAlias('backend');
        exec('rm -rf '.$backend. '/runtime/cache/*');
    }
}
