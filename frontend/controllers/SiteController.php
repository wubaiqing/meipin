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
    public function actionIndex($page = 1, $hot = 0, $cat = 0)
    {
        $goods = Goods::getGoodsList($cat, $hot, $page);
        $this->render('index', array(
            'goods' => $goods['data'],
            'pager' => $goods['pager'],
        ));
    }

    /**
     * 商品搜索
     */
    public function actionSearch($title)
    {
        $cacheKey = 'index-search-'.md5($title);
        $goods = Yii::app()->cache->get($cacheKey);
        if (empty($result)) {
            $title = trim($title);
            $criteria = new CDbCriteria();
            $criteria->addSearchCondition('title', $title);

            $count = Goods::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize=15;
            $pages->applyLimit($criteria);
            $goods = Goods::model()->findAll($criteria);
            Yii::app()->cache->set($cacheKey, $goods, 3600);
        }

        if ($goods) {
            $this->render('search', array(
                'goods' => $goods,
                'pager' => new CPagination($count)
            ));
        } else {
            $this->render('searchError', array(
                'title' => $title
                
            ));
        }
    }

    /**
     * 今天值得买首页
     */
    public function actionOut($id)
    {
        $goodsId = Des::decrypt($id);
        $goods = Goods::getGoods($goodsId);
        if ($goods) {
            header("Location:{$goods->url}");
            Yii::app()->end();
        }
    }
}
