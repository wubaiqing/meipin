<?php

/**
 * 同步今天值得买数据
 */
class CacheClearCommand extends CConsoleCommand 
{
/**
 * 每天9:00定时删除前台缓存
 */
	public function actionIndex()
	{
        $frontend = Yii::getPathOfAlias('frontend');//获取前台文件目录
        $dirName=$frontend.'/runtime/cache';//获取清空文件目录
        if ($handle = opendir("$dirName")) {
           while (false !== ($item = readdir($handle))) {
           if ($item != "." && $item != "..") {
           if (is_dir("$dirName/$item")) {
                 delFileUnderDir("$dirName/$item");
           } else {
           if (unlink("$dirName/$item")) {echo"";}
                }
             }
           }
           closedir($handle);
         }
    }
}
