<?php

/**
 * 积分操作控制器
 * @author liukui<liujickson@gmail.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class ScoreController extends Controller
{

    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/main';

    /**
     * 积分兑换首页
     */
    public function actionExchangeIndex()
    {

        $this->render('exchangeIndex');
    }

    public function actionAjaxEcLogList($goodsId = null)
    {
        $result = CommonHelper::getAjaxFormat([]);

        return json_encode($result);
    }

    /**
     * 执行兑换操作
     * @param integer $goodsId 兑换商品ID
     * @return json 积分兑换返回信息
     */
    public function actionDoExchange($goodsId = null)
    {
        
    }

    /**
     * 兑换记录
     * @param integer $goodsId 兑换商品ID
     * @param integer $page 当前分页碼
     * @return json 积分兑换返回信息
     */
    public function actionAjaxEcRecords($goodsId = null, $page = 1)
    {
        $logList = ExchangeLog::getLogList($goodsId, $page);
        $this->render('exchangeLogList',array('logList'=>$logList));
    }

}
