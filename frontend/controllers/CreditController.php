<?php
/**
 * 今天值得买首页
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class CreditController extends Controller
{

    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/main';

    /**
     * 今天值得买首页
     * @param integer $cat  当前分类
     * @param intger  $page 当前页数
     * @param integer $hot  0最热, 1热门
     */
    public function actionIndex($cat = 0, $page = 1, $hot = 0)
    {

        $this->render('index', array());
    }

}
