<?php

/**
 * 积分操作控制器
 * @author liukui<liujickson@gmail.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class ExchangeController extends Controller
{

    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/exchange';

    /**
     * 积分业务处理类
     * @var ScoreService 
     */
    public $scoreService;

    public function init()
    {
        parent::init();

        $this->scoreService = new ScoreService();
    }

    /**
     * 积分兑换首页
     */
    public function actionExchangeIndex($id = 0, $page = 1)
    {
        $id = Des::decrypt($id);
        $data = $this->scoreService->showExchangeIndex($id, $page);
        if ($data->status == false) {
            $this->render('/common/success', [
                'status' => 'yes',
                'title' => $data->message,
                'url' => $data->url,
            ]);
        } else {
            $this->render('exchangeIndex', [
                'data' => $data,
                'params' => ['goodsId' => $id,
            ]]);
        }
    }

    /**
     * 商品兑换订单详情页
     */
    public function actionOrder()
    {
        $id = Yii::app()->request->getQuery("id", 0);
        if (!$this->isLogin) {
            $this->redirect(CommonHelper::createLoginBackUrl(Yii::app()->createAbsoluteUrl("exchange/order", ["id" => $id])));
            Yii::app()->end();
        }
        $id = Des::decrypt($id);
        //加載数据
        $dataResult = $this->scoreService->getOrderdetail($id, $this->userId);
        if (!$dataResult['status']) {
            $this->render('/common/success', [
                'status' => 'yes',
                'title' => $dataResult['data']['message'],
                'url' => Yii::app()->createUrl('exchange/index'),
            ]);
            Yii::app()->end();
        }
        //渲染页面
        $this->render('order', ['data' => $dataResult['data'], 'params' => array('goodsId' => $id, 'token' => $dataResult['data']['token'])]);
    }

    /**
     * 执行兑换操作
     * @param integer $goodsId 兑换商品ID
     * @return json 积分兑换返回信息
     */
    public function actionDoExchange()
    {
        $userId = Yii::app()->user->id;
        $order = Yii::app()->request->getPost("Exchange", null);
        $data = $this->scoreService->doExchange($userId, $order);
        if ($data->status) {
            $this->render('/common/success', [
                'status' => 'yes',
                'title' => $data->message,
                'url' => $data->url,
            ]);
        } else {
            $this->render('/common/success', [
                'status' => 'no',
                'title' => $data->message,
                'url' => $data->url,
            ]);
        }
    }

    /**
     * 积分兑换首页
     */
    public function actionIndex()
    {
        $data = [];
        //积分兑换首页商品列表
        $data = $this->scoreService->showExchangeGoodsList();
        $this->render('index', ['data' => $data['goods'], 'pager' => $data['pages']]);
    }

}
