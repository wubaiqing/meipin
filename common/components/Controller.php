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
            'label' => '积分管理',
            'items' => array(
                array('url' => 'exchange/add', 'label' => '添加积分兑换'),
                array('url' => 'exchange/admin', 'label' => '积分兑换管理'),
            )
        ),
        array(
            'label' => '前台管理',
            'items' => array(
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

    /**
     * 返回接口数据
     * @param integer $status 接口状态
     * @param string  $data   错误代码
     */
    public function returnData($status, $data)
    {
        header('Content-Type:application/json;');
        echo CJSON::encode(array('status' => $status, 'data' => $data));
        Yii::app()->end();
    }
}
