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
	    // 收取商品
        $goods = Goods::getGoodsList($cat, $hot, $page);
	    // 渲染首页
        $this->render('index', array(
	        'cat' => $cat, // 分类
	        'hot' => $hot, // 热门
	        'page' => $page, // 当前页
            'goods' => $goods['data'], // 商品数据
            'pager' => $goods['pager'], // 商品翻页
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
