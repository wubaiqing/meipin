<?php
/**
 * 美品网首页
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class SiteController extends Controller
{
    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/main';

    /**
     * 今天值得买首页
     */
    public function actionIndex($cat = 0, $page = 1, $hot = 0)
    {
        $this->render('index');
    }

}
