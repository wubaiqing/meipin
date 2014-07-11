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

    public $cat = 0;
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
        $dataResult = $this->scoreService->showExchangeDetial($goodsId, $page, 0);
        if (!$dataResult['status']) {
            $this->pageRedirect('no', $dataResult['data']['message'], Yii::app()->createUrl("exchange/index"));
        }

        if ($dataResult['data']['exchange']->active_price > 0) {
            $this->layout = '//layouts/money';
            $render = "moneyExchange";
        } else {
            $this->layout = '//layouts/exchange';
            $render = "exchangeIndex";
        }
        if($dataResult['data']['exchange']->goods_type ==0){
            $this->cat = 1004;
        }else{
            $this->cat = 1003;
        }
        //渲染頁面
        $this->render($render, [
            'data' => $dataResult['data'],
            'params' => ['goodsId' => $id, 'goodsType' => 1]
        ]);
    }

    /**
     * 商品兑换订单详情页
     */
    public function actionOrder()
    {
        $id = Yii::app()->request->getParam("id", 0);
        $goodscolor = Yii::app()->request->getParam("gdcolor", '');
        $buyCount = Yii::app()->request->getParam("buyCount", 1);
        if (!$this->isLogin) {
            $url = Yii::app()->createAbsoluteUrl("user/login", ['referer' => Yii::app()->createAbsoluteUrl("exchange/order", ["id" => $id, 'gdcolor' => $goodscolor,"buyCount"=>$buyCount])]);
            $this->redirect($url);
            Yii::app()->end();
        }
        $goodsId = Des::decrypt($id);
        //加載数据
        $dataResult = $this->scoreService->getOrderdetail($goodsId, $this->userId);
        if (!$dataResult['status']) {
            if (isset($dataResult['data']['redirect']) && $dataResult['data']['redirect']) {
                $this->render('/exchange/bind', ['params' => ['goodsId' => $id]]);
                Yii::app()->end();
            }else{
                    $this->pageRedirect('no', $dataResult['data']['message'], $dataResult['data']['url'], '/common/success');
            }
            $this->pageRedirect('yes', $dataResult['data']['message'], Yii::app()->createUrl('exchange/index'));
        }
        $render = "order";
        if ($dataResult['data']['exchange']->goods_type == 0 && $dataResult['data']['exchange']->active_price > 0) {
            $render = "moneyOrder";
        }
        if($dataResult['data']['exchange']->goods_type ==0){
            $this->cat = 1004;
        }else{
            $this->cat = 1003;
        }
        
        //渲染页面
        $this->render($render, ['data' => $dataResult['data'], 'params' => [
                'goodsId' => $id,
                'token' => $dataResult['data']['token'],
                'gdscolor' => $goodscolor,
                'buyCount' => $buyCount,
        ]]);
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
            //支付订单
            if(!empty($dataResult['data']['orderId'])){
                $payData = OrderService::pay($dataResult['data']['orderId'], $this->userId);
                if ($payData['status'] == false) {
                    $this->pageRedirect('no', $payData['data']['message'], '/', '/common/message');
                } else {
                    $this->renderPartial('/common/alipaySubmit',['title'=>$payData['data']['message']]);
                }
                Yii::app()->end();
            }
            $this->pageRedirect('yes', $dataResult['data']['message'], $dataResult['data']['url']);
        } else {
            $this->pageRedirect('no', $dataResult['data']['message'], $dataResult['data']['url']);
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
        $data = $exchangeModel->showExchangeGoodsList($page, 0);
        //渲染頁面
        $this->render('index', ['data' => $data['goods'], 'pager' => $data['pages']]);
    }

    /**
     * 手机号码绑定
     */
    public function actionBind()
    {
        //获取参数
        $post = Yii::app()->request->getPost("UsersAddress");
        $goodsId = Yii::app()->request->getPost("id");

        if (empty($goodsId) || empty($post)) {
            $this->pageRedirect();
        }
        //绑定手机
        $user = User::getUser($this->userId);
        //校验数据
        $valid = ScoreService::validMobileIsOk($this->userId, $post);
        if (!$valid['status']) {
            $this->returnData(false, ['message' => $valid['data']['message']]);
        }
        //绑定手机
        if ($user->mobile_bind == 0) {
            User::updateMobileBind($this->userId, $post['mobile'], 1);
            User::deleteCache($this->userId);
        }
        $this->returnData(true, [
            'message' => "手机绑定成功,页面正跳转至兑换页面，请稍等",
            'url' => Yii::app()->createAbsoluteUrl("exchange/order", ['id' => $goodsId])
        ]);
    }


    /**
     * 幸运抽奖
     */
    public function actionRaffle($id = 0, $page = 1)
    {
        $goodsId = Des::decrypt($id);
        $dataResult = $this->scoreService->showExchangeDetial($goodsId, $page, 1);
        if (!$dataResult['status']) {
            $this->pageRedirect('no', $dataResult['data']['message'], Yii::app()->createUrl("exchange/index"));
        }
        if ($dataResult['data']['exchange']->goods_type != 1) {
            $this->pageRedirect('no', "商品不是抽奖商品，请重新选择", Yii::app()->createUrl("site/raffle"));
        }
        if($dataResult['data']['exchange']->goods_type ==0){
            $this->cat = 1004;
        }else{
            $this->cat = 1003;
        }
        //查询中奖明细
        $winerList = ExchangeLog::getWinners($goodsId);
        //渲染頁面
        $this->render('raffleIndex', [
            'data' => $dataResult['data'],
            'winnerList' => $winerList,
            'params' => ['goodsId' => $id, 'goodsType' => 1]
        ]);
    }

}
