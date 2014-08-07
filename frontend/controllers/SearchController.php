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
    public $layout = '//layouts/index';

    /**
     * 美品网搜索
     */
    public function actionIndex($title,$page=1)
    {
        if($title=="")
        {
            $this->redirect(array('/index.html'));
        }
        $search = Goods::model()->search($title,$page);
        //默认显示其他商品30条
        $othergoods = Goods::model()->getothergoods(30);
        if (!empty($search)) {
            $this->render('search', ['goods' => $search['data'],'pager' => $search['pager'],'othergoods'=>$othergoods]);
        } else {
            $this->render('searchError', ['title' => $title]);
        }
    }
}
