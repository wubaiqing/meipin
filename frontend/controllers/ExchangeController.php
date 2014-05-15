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

    public function actionOrder()
    {
        $id = Yii::app()->request->getQuery("id", 0);
        $userId = Yii::app()->user->id;
        if (empty($userId)) {
            $url = Yii::app()->createAbsoluteUrl("user/login") . "?referer=" . Yii::app()->createAbsoluteUrl("exchange/order", ["id" => $id]);
            $this->redirect($url);
            Yii::app()->end();
        }

        $id = Des::decrypt($id);
        //加載数据
        $data = $this->scoreService->getOrderdetail($id, $userId);
        if (!$data->status) {
            $this->render('/common/success', [
                'status' => 'yes',
                'title' => $data->message,
                'url' => $data->url,
            ]);
            Yii::app()->end();
        }

        $this->render('order', ['data' => $data, 'params' => array('goodsId' => $id, 'token' => $data->tokenData)]);
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
        $data = $this->scoreService->showExchangeGoodsList();

        $this->render('index', ['data' => $data['goods'], 'pager' => $data['pages']]);
    }

}
