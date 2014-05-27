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
        $goodsId = Des::decrypt($id);
        $dataResult = $this->scoreService->showExchangeDetial($goodsId, $page);
        if (!$dataResult['status']) {
            $this->render('/common/success', [
                'status' => 'yes',
                'title' => $dataResult['data']['message'],
                'url' => Yii::app()->createUrl("exchange/index"),
            ]);
            Yii::app()->end();
        }

        $this->render('exchangeIndex', [
            'data' => $dataResult['data'],
            'params' => ['goodsId' => $id,]
        ]);
    }

    /**
     * 商品兑换订单详情页
     */
    public function actionOrder()
    {
        $id = Yii::app()->request->getQuery("id", 0);
        if (!$this->isLogin) {
            $url = Yii::app()->createAbsoluteUrl("user/login", ['referer' => Yii::app()->createAbsoluteUrl("exchange/order", ["id" => $id])]);
            $this->redirect($url);
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
     * @param  integer $goodsId 兑换商品ID
     * @return json    积分兑换返回信息
     */
    public function actionDoExchange()
    {
        $userId = Yii::app()->user->id;
        $order = Yii::app()->request->getPost("Exchange", null);
        $dataResult = $this->scoreService->doExchange($userId, $order);
        if ($dataResult['status']) {
            $this->render('/common/success', [
                'status' => 'yes',
                'title' => $dataResult['data']['message'],
                'url' => $dataResult['data']['url'],
            ]);
        } else {
            $this->render('/common/success', [
                'status' => 'no',
                'title' => $dataResult['data']['message'],
                'url' => $dataResult['data']['url'],
            ]);
        }
    }

    /**
     * 积分兑换首页
     */
    public function actionIndex()
    {
        $data = [];
        $page = Yii::app()->request->getQuery('page');
        $page = $page === null ? 0 : $page;
        //积分兑换首页商品列表
        $exchangeModel = new Exchange();
        $data = $exchangeModel->showExchangeGoodsList($page);
        $this->render('index', ['data' => $data['goods'], 'pager' => $data['pages']]);
    }

}
