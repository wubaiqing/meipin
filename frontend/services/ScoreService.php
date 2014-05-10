<?php

/**
 * 积分业务处理类
 *
 * @author liukui<liujickson@gmail.com>
 */
class ScoreService extends AbstractService
{

    /**
     * 显示积分兑换首页
     * @param integer $goodsId 需要兑换的商品ID
     * @return type Description
     */
    public function showExchangeIndex($goodsId,$page)
    {
        $cacheKey = "service-" . __FUNCTION__ . "-" . $goodsId;

        //读取缓存
        if ($this->enableCache) {
            $result = Yii::app()->cache->get($cacheKey);
            if (!empty($result)) {
                return $result;
            }
        }

        $result = new DataResult();
        //获取兑换积分商品
        $exchange = Exchange::model()->findByPk($goodsId);
        //校验
        if (empty($exchange)) {
            $result->status = false;
            $result->message = "商品已下线或不存在";
            return $result;
        }
        $nowTime = time();
        if ($exchange->start_time > $nowTime) {
            $result->status = false;
            $result->message = "活动还未开始";
            return $result;
        }
        if ($exchange->end_time <= $nowTime) {
            $result->status = false;
            $result->message = "活动已经结束";
            return $result;
        }
        $result->exchange = $exchange;
        //获取兑换热门商品
        // @TODO
        $result->hotExchangeGoods = Exchange::model()->findAll('id>3');

        $logList = ExchangeLog::getLogList($goodsId, $page);
        $result->logList = $logList;
        $result->status = true;

        if ($this->enableCache) {
            Yii::app()->cache->set($cacheKey, $result, Constants::T_HOUR);
        }
        return $result;
    }

    /**
     * 执行积分商品兑换
     * @param integer $goodsId 商品ID
     * @param integer $userId 用户ID
     * @return array 执行兑换结果
     */
    public function doExchange($goodsId, $userId)
    {
        $result = new DataResult();
        $result->location="";
        if (empty($userId)) {
            $result->status = false;
            $result->message = "对不起，请先登录";
            $result->location = Yii::app()->createAbsoluteUrl("user/login");
            return $result;
        }
        //查询兑换商品数据
        $goods = Exchange::model()->findByPk($goodsId);
        if (empty($goods)) {
            $result->status = false;
            $result->message = "对不起，您所兑换的商品不存在";
            return $result;
        }
        $nowTime = time();
        //校验商品
        if ($goods->start_time > $nowTime) {
            $result->status = false;
            $result->message = "对不起，活动还未开始";
            return $result;
        }
        if ($goods->end_time <= $nowTime || $goods->left_num <= 0) {
            $result->status = false;
            $result->message = "对不起，活动已经结束";
            return $result;
        }
        // @TODO 积分等级校验
//        if($goods->need_level > ){
//            
//        }
        $user = User::model()->findByPk($userId);
        if($user->score < $goods->integral){
            $result->status = false;
            $result->message = "对不起，您的积分不足以兑换此商品";
            return $result;
        }
        //执行兑换
        $transaction = Yii::app()->db->beginTransaction();
        try {
            //更新用戶积分
            User::model()->updateByPk($userId, array('score' => new CDbExpression('score-'.$goods->integral)));
            //更新兑换商品数量
            Exchange::model()->updateByPk($goodsId, array('left_num'=> new CDbExpression('left_num-1')));
            //写入兑换日志
            $exchangeLog = new ExchangeLog();
            $exchangeLog->user_id=$userId;
            $exchangeLog->username = $user->username;
            $exchangeLog->created_at = $nowTime;
            $exchangeLog->goods_id = $goodsId;
            $exchangeLog->insert();
            $result->message = "兑换成功";
            $transaction->commit();
            $result->status = true;
        } catch (\Exception $ex) {
            $transaction->rollback();
            $result->status = FALSE;
            $result->message = "系统忙，请稍后再试";
            $result->errorMsg = $ex->getMessage();
        }
        $result->leftNum = $goods->left_num -1;
        return $result;
    }

}
