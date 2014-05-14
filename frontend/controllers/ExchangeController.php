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
    public $layout = '//layouts/main';

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
            // @TODO
            $moreUrl = Yii::app()->createUrl("");
            $remark = "您可以查看<a href='" . $moreUrl . "'  style='color:blue;'>更多</a>商品";
            $this->render('/common/notFound', array('title' => $data->message, 'remark' => $remark));
        } else {
            $this->render('exchangeIndex', array('data' => $data, 'params' => array('goodsId' => $id)));
        }
    }

    public function actionOrder()
    {
        $id = Yii::app()->request->getQuery("id", 0);
        $id = Des::decrypt($id);
        $userId = Yii::app()->user->id;
        //加載数据
        $data = $this->scoreService->getOrderdetail($id, $userId);

        if (!$data->status) {
            $this->render('/common/notFound', array('title' => $data->message, 'remark' => $data->remark));
            Yii::app()->end();
        }

        //设置兑换token
        $cacheKey = ScoreService::getExchangeCacheKey($userId, $id);
        $dataToken = Yii::app()->cache->get($cacheKey);
        if (empty($dataToken)) {
            $dataToken = ScoreService::getToken();
            Yii::app()->cache->set($cacheKey, $dataToken, Constants::T_HALF_HOUR);
        }
        $this->render('order', array('data' => $data, 'params' => array('goodsId' => $id, 'token' => $dataToken)));
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
            $this->render('/common/exSuccess', ['title' => $data->message, 'remark' => $data->remark]);
        } else {
            $this->render('/common/exFailure', ['title' => $data->message, 'remark' => $data->remark]);
        }
    }

    public function actionMsg($sid = "", $f = "")
    {
        $index = "<a href='" . (empty($f) ? Yii::app()->createUrl("site/index") : $f) . "'>点击跳转</a>";
        if (empty($sid)) {
            $this->render("/common/notFound", ['title' => '您要的页面不存在', 'remark' => $index]);
        } elseif ($sid == 'success') {
            $this->render("/common/exSuccess", ['title' => '操作成功', 'remark' => $index]);
        } elseif ($sid == 'failure') {
            $this->render("/common/exFailure", ['title' => '操作失败', 'remark' => $index]);
        }
    }

    /**
     * 积分兑换首页
     */
    public function actionIndex()
    {
        $data = [];
        $data = $this->scoreService->showExchangeGoodsList();
        $this->render('index', ['data' => $data]);
    }

}
