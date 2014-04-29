<?php
/**
 * 美品网首页
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class SearchController extends Controller
{
    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/main';

    /**
     * 今天值得买首页
     */
    public function actionIndex($title)
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
            $this->render('search', ['goods' => $goods,'pager' => new CPagination($count)]);
        } else {
            $this->render('searchError', ['title' => $title]);
        }
    }
}

