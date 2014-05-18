<?php

class Controller extends CController
{

    public $layout = '//layouts/column2';

    /**
     * 用戶是否已经登录
     * @var boolean $isLogin
     */
    public $isLogin = false;

    /**
     * 用戶ID
     * @var boolean $userId
     */
    public $userId = 0;

    public $menu = [
        [
            'label' => '添加商品',
            'items' => [
                ['url' => 'goods/create&goodsType=0', 'label' => '添加淘宝'],
                ['url' => 'goods/create&goodsType=1', 'label' => '添加B2C'],
                ['url' => 'goods/create&goodsType=2', 'label' => '添加活动'],
            ]
        ],
        [
            'label' => '商品管理',
            'items' => [
                ['url' => 'bookmark/admin', 'label' => '收藏夹'],
                ['url' => 'goods/admin', 'label' => '商品管理'],
                ['url' => 'category/create', 'label' => '创建分类'],
                ['url' => 'category/admin', 'label' => '分类管理'],
            ]
        ],
        [
            'label' => '商城管理',
            'items' => [
                ['url' => 'store/create', 'label' => '添加商城'],
                ['url' => 'store/admin', 'label' => '商城管理'],
                ['url' => 'storecategory/create', 'label' => '创建分类'],
                ['url' => 'storecategory/admin', 'label' => '分类管理'],
            ]
        ],
        [
            'label' => '积分商品管理',
            'items' => [
                ['url' => 'exchange/add', 'label' => '添加商品'],
                ['url' => 'exchange/admin', 'label' => '商品管理'],
                ['url' => 'exchange/shipAdmin', 'label' => '积分兑换管理'],
            ]
        ],
        [
            'label' => '前台管理',
            'items' => [
                ['url' => 'site/clearCache', 'label' => '清空缓存'],
                ['url' => 'site/logout', 'label' => '退出登录'],
            ]
        ]
    ];
    public $breadcrumbs = [];

    public function filters()
    {
        return ['accessControl'];
    }

    /**
     * 返回接口数据
     * @param integer $status 接口状态
     * @param string  $data   错误代码
     */
    public function returnData($status, $data)
    {
        header('Content-Type:application/json;');
        echo CJSON::encode(['status' => $status, 'data' => $data]);
        Yii::app()->end();
    }

    public function init()
    {
        parent::init();
        $this->userId = Yii::app()->user->id;
        $this->isLogin = empty($this->userId) ? false : true;
    }

}
