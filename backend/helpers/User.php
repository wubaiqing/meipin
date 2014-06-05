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
        'test'=>'10',
    );

    /**
     * @var string 用户ID
     */
    public static function getUserName($name)
    {
        return self::$userName[$name];
    }

    /**
     * @var string 用户名称
     */
    public static function getUserID($id)
    {

        if($id)
        {
            $arr2 = array_flip(self::$userName);
            return $arr2[$id];
        }
    }
    /**
     * 清空前后台缓存
     */
    public static function deleteCache()
    {
        $frontend = Yii::getPathOfAlias('frontend');//获取前台文件目录
        $dirName=$frontend.'/runtime/cache';//获取清空文件目录
        if($handle = opendir("$dirName")){
           while(false !== ($item = readdir($handle))){
           if($item != "." && $item != ".."){
           if(is_dir("$dirName/$item")){
                 delFileUnderDir("$dirName/$item");
           }else{
           if(unlink("$dirName/$item")){echo"成功删除文件： $dirName/$item<br />\n";}
                }              
             }
           }
           closedir($handle);
         }
    }
}
