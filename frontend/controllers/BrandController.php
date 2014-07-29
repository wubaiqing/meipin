<?php
/**
 * 美品网首页
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class BrandController extends Controller
{
    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/index';

    /**
     * 美品网品牌
     */
    public function actionIndex($cat='5yuan',$page = 1)
    {
        $search = Goods::model()->searchbrand($cat,$page);
        if (!empty($search)) {
            $this->render('search', ['goods' => $search['data'],'pager' => $search['pager']]);
        } else {
            $this->render('searchError', ['title' => $title]);
        }
    }
}
