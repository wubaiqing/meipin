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

    /**
     * 用戶实体
     * @var boolean $userId
     */
    public $user;
    public $menu = [
        [
            'label' => '添加商品',
            'items' => [
                ['url' => 'goods/create&goodsType=0', 'label' => '添加淘宝'],
                //['url' => 'goods/create&goodsType=1', 'label' => '添加B2C'],
                //['url' => 'goods/create&goodsType=2', 'label' => '添加活动'],
            ]
        ],
        [
            'label' => '商品管理',
            'items' => [
               // ['url' => 'bookmark/admin', 'label' => '收藏夹'],
	            ['url' => 'fetch/admin', 'label' => '抓取管理'],
                ['url' => 'goods/admin', 'label' => '商品管理'],
                ['url' => 'category/create', 'label' => '创建分类'],
                ['url' => 'category/admin', 'label' => '分类管理'],
                ['url' => 'goods/count', 'label' => '商品统计'],
            ]
        ],

         [
            'label' => '品牌管理',
            'items' => [
                ['url' => 'brand/add', 'label' => '添加品牌'],
                ['url' => 'brand/admin', 'label' => '品牌列表'],
            ]
        ],
    /*    [
            'label' => '商城管理',
            'items' => [
                ['url' => 'store/create', 'label' => '添加商城'],
                ['url' => 'store/admin', 'label' => '商城管理'],
                ['url' => 'storecategory/create', 'label' => '创建分类'],
                ['url' => 'storecategory/admin', 'label' => '分类管理'],
            ]
        ],*/
        [
            'label' => '积分商品管理',
            'items' => [
                ['url' => 'exchange/add', 'label' => '添加兑换商品'],
                ['url' => 'exchange/admin', 'label' => '兑换商品管理'],
                ['url' => 'exchange/shipAdmin', 'label' => '兑换发货管理'],
            ]
        ],
        [
            'label' => '抽奖商品管理',
            'items' => [
                ['url' => 'exchange/raffleAdd', 'label' => '添加抽奖商品'],
                ['url' => 'exchange/raffleAdmin', 'label' => '抽奖商品管理'],
                ['url' => 'exchange/raffleShipAdmin', 'label' => '中奖发货管理'],
            ]
        ],
        [
            'label' => '用户管理',
            'items' => [
		          ['url' => 'user/admin', 'label' => '用户管理'],
                  ['url' => 'feedback/admin', 'label' => '用户反馈'],
                  ['url'=>'user/userinfo','label'=>'用户统计']
            ]
        ],
        [
            'label' => '前台管理',
            'items' => [
				['url' => 'links/create', 'label' => '添加友情链接'],
                ['url' => 'links/admin', 'label' => '友情链接管理'],
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
        $platform = Yii::app()->params['platform'];
        if (!empty($platform) && $platform == 'frontend') {
            $this->user = User::getUser($this->userId);
        }
    }
    /**
     * 页面跳转
     * @param string $status  显示图片控制
     * @param string $message 提示信息
     * @param string $url     跳转地址
     */
    public function pageRedirect($status = 'no', $message = "您访问的页面不存在", $url = '/', $render = '/common/success')
    {
        $this->render($render, [
            'status' => $status,
            'title' => $message,
            'url' => $url
        ]);
        Yii::app()->end();
    }

}
