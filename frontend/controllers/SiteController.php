<?php
/**
 * 今天值得买首页
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class SiteController extends Controller
{

    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/main';

    /**
     * 页面访问权限
     * @return array 权限列表
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('downurl'),
                'users'=>array('*'),
            )
        );
    }

    /**
     * 今天值得买首页
     * @param integer $cat  当前分类
     * @param intger  $page 当前页数
     * @param integer $hot  0最热, 1热门
     */
    public function actionMobile()
    {
        $this->render('mobile', array(
        ));
    }

    /**
     * 今天值得买首页
     * @param integer $cat  当前分类
     * @param intger  $page 当前页数
     * @param integer $hot  0最热, 1热门
     */
    public function actionIndex($cat = 0, $page = 1, $hot = 0)
    {
        $goodsList = Goods::getGoodsList($page, $cat, $hot);

        $this->render('index', array(
            'hot' => $hot,
            'catId' => $cat,
            'data' => $goodsList['data'],
            'pager' => $goodsList['pager'],
        ));
    }

	public function returnData($status, $data)
	{
		echo json_encode(array('status' => $status, 'data' => $data));
		Yii::app()->end();
	}
}
