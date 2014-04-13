<?php
/**
 * 美品网下载页面
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class DownController extends Controller
{
    /**
     * 下载桌面链接
     */
    public function actionUrl()
    {
        $Shortcut="
            [InternetShortcut]
            URL=http://www.meipin.com/
            IconIndex=1
            IDList=
            [{000214A0-0000-0000-C000-000000000046}]
            Prop3=19,2
        ";
        Header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=美品网.url;");
        die($Shortcut);
    }
}
