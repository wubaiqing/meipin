<?php

class Controller extends CController
{
    public $layout = '//layouts/column2';

    public $menu = array(
        array(
            'label' => '添加商品',
            'items' => array(
                array('url' => 'goods/create&goodsType=0', 'label' => '添加淘宝'),
                array('url' => 'goods/create&goodsType=1', 'label' => '添加B2C'),
                array('url' => 'goods/create&goodsType=2', 'label' => '添加活动'),
                array('url' => 'goods/getUHtml', 'label' => '添加U站'),
                array('url' => 'zhe800/admin', 'label' => '折800商品管理'),
                array('url' => 'goods/count', 'label' => '添加数量统计'),
            )
        ),
        array(
            'label' => '用户管理',
            'items' => array(
                array('url' => 'user/getGold', 'label' => '集分宝'),
            )
        ),
        array(
            'label' => 'U站',
            'items' => array(
                array('url' => 'goods/getu', 'label' => '商品推送'),
                array('url' => 'links/list', 'label' => '友情链接'),
            )
        ),
        array(
            'label' => '商品管理',
            'items' => array(
                array('url' => 'bookmark/admin', 'label' => '收藏夹'),
                array('url' => 'goods/admin', 'label' => '商品管理'),
                array('url' => 'category/create', 'label' => '创建分类'),
                array('url' => 'category/admin', 'label' => '分类管理'),
            )
        ),
        array(
            'label' => '商城管理',
            'items' => array(
                array('url' => 'store/create', 'label' => '添加商城'),
                array('url' => 'store/admin', 'label' => '商城管理'),
                array('url' => 'storecategory/create', 'label' => '创建分类'),
                array('url' => 'storecategory/admin', 'label' => '分类管理'),
            )
        ),
        array(
            'label' => '前台管理',
            'items' => array(
                array('url' => 'banner/admin', 'label' => 'Banner'),
                array('url' => 'site/clearCache', 'label' => '清空缓存'),
                array('url' => 'site/logout', 'label' => '退出登录'),
            )
        )
    );

    public $breadcrumbs = array();

    public function filters()
    {
        return array('accessControl');
    }

    public function accessRules()
    {
        return array(
            array('allow',
				'actions' => array('index', 'view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions' => array('create', 'update', 'admin', 'delete'),
				'users' => array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
        );
    }

    /**
     * 返回接口数据
     * @param integer $status 接口状态
     * @param string  $code   错误代码
     */
    public function returnData($status, $code)
    {
        header('Content-Type:application/json;');
        echo CJSON::encode(array('status' => $status, 'code' => $code));
        Yii::app()->end();
    }
}
