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
            $this->pageRedirect('no', $dataResult['data']['message'], Yii::app()->createUrl("exchange/index"));
        }

        $gdcolorstr = $dataResult['data']['exchange']->goodscolor;
        if ($gdcolorstr) {
            $gdcolorarr = explode(';', $gdcolorstr);
            //Array ( [0] => 白色:12 [1] => 黑色:30 [2] => 绿色:33 )
            foreach ($gdcolorarr as $key => $value) {
                if ($value) {
                    $gdcolorstr2 = explode(':', $value);
                    $arr[$key]['gdcolornum'] = $gdcolorstr2[1] ? $gdcolorstr2[1] : 0;
                    $arr[$key]['gdcolorname'] = $gdcolorstr2[0];
                }
            }
            $dataResult['data']['exchange']->goodscolor = $arr;
        }
        //print_r($dataResult['data']['exchange']);
        //渲染頁面
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
        $id = Yii::app()->request->getParam("id", 0);
        $goodscolor = Yii::app()->request->getParam("gdcolor", '');
        if (!$this->isLogin) {
            $url = Yii::app()->createAbsoluteUrl("user/login", ['referer' => Yii::app()->createAbsoluteUrl("exchange/order", ["id" => $id, 'gdcolor' => $goodscolor])]);
            $this->redirect($url);
            Yii::app()->end();
        }
        $goodsId = Des::decrypt($id);
        //加載数据
        $dataResult = $this->scoreService->getOrderdetail($goodsId, $this->userId);
        if ($goodscolor && !empty($dataResult['data']['exchange'])) {
            $gdcolorstr = $dataResult['data']['exchange']->goodscolor;
            $gdcolorarr = explode(';', $gdcolorstr);
            //Array ( [0] => 白色:12 [1] => 黑色:30 [2] => 绿色:33 )
            $strstr = "";
            foreach ($gdcolorarr as $key => $value) {
                if ($value) {
                    $gdcolorstr2 = explode(':', $value);
                    if ($gdcolorstr2[0] == $goodscolor) {
                        $strstr .= $gdcolorstr2[0] . ":" . ($gdcolorstr2[1] - 1) . ";";
                    } else {
                        $strstr .= $gdcolorstr2[0] . ":" . $gdcolorstr2[1] . ";";
                    }
                }
            }
            $dataResult['data']['exchange']->goodscolor = $strstr;
        }
        if (!$dataResult['status']) {
            if (isset($dataResult['data']['redirect']) && $dataResult['data']['redirect']) {
                $this->render('/exchange/bind', ['params' => ['goodsId' => $id]]);
                Yii::app()->end();
            }
            $this->pageRedirect('yes', $dataResult['data']['message'], Yii::app()->createUrl('exchange/index'));
        }
        //渲染页面
        $this->render('order', ['data' => $dataResult['data'], 'params' => ['goodsId' => $id, 'token' => $dataResult['data']['token'], 'gdscolor' => $goodscolor]]);
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
     * 页面跳转
     * @param string $status  显示图片控制
     * @param string $message 提示信息
     * @param string $url     跳转地址
     */
    private function pageRedirect($status = 'no', $message = "您访问的页面不存在", $url = '/')
    {
        $this->render('/common/success', [
            'status' => $status,
            'title' => $message,
            'url' => $url
        ]);
        Yii::app()->end();
    }

    /**
     * 幸运抽奖
     */
    public function actionRaffle()
    {
        $data = [];
        $page = Yii::app()->request->getQuery('page');
        //进行中或历史抽奖
        $timeLine = Yii::app()->request->getQuery('time', '');

        $page = $page === null ? 0 : $page;
        //积分兑换首页商品列表
        $exchangeModel = new Exchange();
        $data = $exchangeModel->showExchangeGoodsList($page, 1, $timeLine);
        //渲染頁面
        $this->render('indexRaffle', [
            'data' => $data['goods'],
            'pager' => $data['pages'],
            'goodsType' => 1,
            'timeLine' => $timeLine,
        ]);
    }

}
