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
    public function showExchangeIndex($goodsId)
    {
        $cacheKey = "service-".__FUNCTION__."-".$goodsId;
        $result = new DataResult();
        //获取兑换积分商品
        $exchange = Exchange::model()->findByPk($goodsId);
        //校验
        if (empty($exchange)) {
            $result->status = false;
            $result->msg = "商品已下线或不存在";
            return $result;
        }
        $nowTime = time();
        if ($exchange->start_time > $nowTime) {
            $result->status = false;
            $result->msg = "兑换活动还未开始";
            return $result;
        }
        if ($exchange->end_time < $nowTime) {
            $result->status = false;
            $result->msg = "兑换活动已经结束";
            return $result;
        }
        //获取兑换热门商品
        
        $result->exchange = $exchange;
        $result->hotExchangeGoods = Exchange::model()->findAll('id>3');
        
        $result->status = true;
        
        if($this->enableCache){
            Yii::app()->cache->set($cacheKey, $result, Constants::T_DAY);
        }
        return $result;
    }

    public function doExchange($goodsId, $userId)
    {
        
    }

}
