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
    public $layout = '//layouts/index';

    /**
     * 今天值得买首页
     */
    public function actionIndex($page = 1, $hot = 0, $cat = 0)
    {
        $goods = Goods::getGoodsList($cat, $hot, $page);
        $this->render('index', array(
	        'cat' => $cat,
	        'hot' => $hot,
	        'page' => $page,
            'goods' => $goods['data'],
            'pager' => $goods['pager'],
        ));
    }

    /**
     * 今天值得买首页
     */
    public function actionOut($id)
    {
        $goodsId = Des::decrypt($id);
        $goods = Goods::getGoods($goodsId);
        if (!empty($goods)) {
            header("Location:{$goods->url}");
            Yii::app()->end();
        }
    }
}
