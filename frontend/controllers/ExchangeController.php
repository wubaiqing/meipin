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
    public function actionExchangeIndex($id=0, $page = 1)
    {
//        $userCount = ExchangeLog::model()->count(array('condition'=>'goods_id=:goods_id','params'=>array(":goods_id"=>3),'group'=>'user_id'));
//        var_dump($userCount);die;
        $id = Des::decrypt($id);
        $data = $this->scoreService->showExchangeIndex($id, $page);
        if ($data->status == false) {
            // @TODO
            $moreUrl = Yii::app()->createUrl("");
            $remark = "您可以查看<a href='" . $moreUrl . "'  style='color:blue;'>更多</a>商品";
            $this->render('/common/notFound', array('title' => $data->message, 'remark' => $remark));
        } else {
            $this->render('index', array('data' => $data, 'params' => array('goodsId' => $id)));
        }
    }

    public function actionOrder()
    {
        $id = Yii::app()->request->getPost("id", 0);
        if (empty($id)) {
            $location = "点击跳转到<a href='/' style='color:blue;'>主页</a>";
            $this->render('/common/notFound', array('title' => "非法操作", 'remark' => $location));
            Yii::app()->end();
        }
        //加載数据
        $data = array();
        $this->render('order', array('data' => $data, 'params' => array('goodsId' => $id)));
    }

    /**
     * 执行兑换操作
     * @param integer $goodsId 兑换商品ID
     * @return json 积分兑换返回信息
     */
    public function actionDoExchange($id = null)
    {
        $userId = Yii::app()->user->id;
        $id = Des::decrypt($id);
        $data = $this->scoreService->doExchange($id, $userId);
        echo json_encode($data);
    }

}
