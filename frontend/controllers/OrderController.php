<?php

/**
 * 订单控制器
 * @author liujickson <lijickson@gmail.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class OrderController extends Controller
{

    /**
     * @var string $layout
     */
    public $layout = '//layouts/user';

    /**
     * 访问权限
     */
    public function accessRules()
    {
        return array_merge([
            [
                'deny',
                'actions' => ['index', 'ajax', 'welfare'],
                'users' => ['?'],
            ]
                ], parent::accessRules());
    }

    public function actionPay($id = 0)
    {
        $id = Des::decrypt($id);
        $data = OrderService::pay($id, $this->userId);
        if ($data['status'] == false) {
            echo $data['data']['message'];
        } else {
            echo $data['data']['message'];
        }
    }

    public function actionResult()
    {
        $data = OrderService::result();
        $this->layout = '//layouts/exchange';
        if ($data['status']) {
            $this->pageRedirect('yes', $data['data']['message'], '/', '/common/pay');
        } else {
            $this->pageRedirect('no', $data['data']['message'], '/', '/common/pay');
        }
    }

    public function actionNotify()
    {
        OrderService::notify();
    }

    /**
     * 订单列表
     */
    public function actionList($page = 1)
    {
        $welfare = ExchangeLog::getWelfare($this->userId, $page, 1);
        $this->render('/score/order', [
            'welfare' => $welfare['data'],
            'pager' => $welfare['pager'],
        ]);
    }

}
