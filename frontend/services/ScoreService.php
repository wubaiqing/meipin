<?php

/**
 * 积分业务处理类
 *
 * @author liukui<liujickson@gmail.com>
 */
class ScoreService extends AbstractService
{

    /**
     * 显示积分兑换详情页面
     * @param integer $goodsId 需要兑换的商品ID
     * @return type Description
     */
    public function showExchangeIndex($goodsId, $page)
    {
        $cacheKey = "service-" . __FUNCTION__ . "-" . $goodsId;

        //读取缓存
//        if ($this->enableCache) {
//            $result = Yii::app()->cache->get($cacheKey);
//            if (!empty($result)) {
//                return $result;
//            }
//        }

        $result = new DataResult();
        //获取兑换积分商品
        $exchange = Exchange::model()->findByPk($goodsId);
        //校验
        if (empty($exchange)) {
            $result->status = false;
            $result->message = "商品已下线或不存在";
            return $result;
        }
        $result->exchange = $exchange;
        //获取兑换热门商品
        $result->hotExchangeGoods = Exchange::model()->findAll(array('condition' => "id !=" . $exchange->id, 'order' => 'sale_num desc', 'limit' => 10));

        $logList = ExchangeLog::getLogList($goodsId, $page);
        $result->logList = $logList;
        $result->status = true;

//        if ($this->enableCache) {
//            Yii::app()->cache->set($cacheKey, $result, Constants::T_HOUR);
//        }
        return $result;
    }

    /**
     * 设置当前兑换key
     * @param integer $user_id 
     * @param integer $goods_id
     * @return string  
     */
    public static function getExchangeCacheKey($userId, $goodsId)
    {
        return "goods-exchange-$goodsId" . "-" . $userId;
    }

    /**
     * 生成token
     */
    public static function getToken()
    {
        return md5(microtime() . "-" . session_id());
    }

    /**
     * 执行积分商品兑换
     * @param integer $goodsId 商品ID
     * @param integer $userId 用户ID
     * @param array $post 提交的信息
     * @return array 执行兑换结果
     */
    public function doExchange($userId, $order)
    {
        $order = self::formatPostValue($order);
        $result = new DataResult();
        $result->location = "";
        if (empty($userId)) {
            $result->status = false;
            $result->message = "对不起，请先登录";
            $result->code = Constants::S_NOT_LOGIN;
            $result->remark = '<a href="' . Yii::app()->createUrl("site/index") . '">返回主页</a>';
            $result->location = Yii::app()->createAbsoluteUrl("user/login");
            return $result;
        }
        //是否提交
        if (empty($order)) {
            $result->status = false;
            $result->message = "您访问的页面不存在！";
            $result->code = Constants::S_NOT_LOGIN;
            $result->location = Yii::app()->createAbsoluteUrl("/");
            return $result;
        }
        $goodsId = $order['goods_id'];
        //验证提交
        $cacheKey = self::getExchangeCacheKey($userId, $goodsId);
        $token = Yii::app()->cache->get($cacheKey);
        if (!$token) {
            $result->status = false;
            $result->message = "本次操作已经失效,或已经兑换过了！";
            $result->code = Constants::S_NOT_LOGIN;
            $result->location = Yii::app()->createAbsoluteUrl("/");
            $result->remark = '<a href="' . Yii::app()->createUrl("exchange/exchangeIndex", array('id' => Des::encrypt($goodsId))) . '">点击返回</a>';

            return $result;
        }
        if ($order['token'] != $token) {
            $result->status = false;
            $result->message = "请不要重复提交！";
            $result->code = Constants::S_NOT_LOGIN;
            $result->remark = '<a href="' . Yii::app()->createUrl("exchange/exchangeIndex", array('id' => Des::encrypt($goodsId))) . '">点击返回</a>';
            $result->location = Yii::app()->createAbsoluteUrl("/");
            return $result;
        }

        //查询兑换商品数据
        $goods = Exchange::model()->findByPk($goodsId);
        if (empty($goods)) {
            $result->status = false;
            $result->code = Constants::S_GOODS_NOT_EXIST;
            $result->message = "对不起，您所兑换的商品不存在";
            return $result;
        }
        $nowTime = time();
        //校验商品
        if ($goods->start_time > $nowTime) {
            $result->status = false;
            $result->code = Constants::S_ACT_NO_START;
            $result->message = "对不起，活动还未开始";
            return $result;
        }
        if ($goods->end_time <= $nowTime) {
            $result->status = false;
            $result->code = Constants::S_ACT_ENDED;
            $result->message = "对不起，活动已经结束";
            return $result;
        }
        $user = User::model()->findByPk($userId);
        if (($goods->num - $goods->sale_num) <= 0) {
            $result->status = false;
            $result->code = Constants::S_STORE_NOT_ENOUGH;
            $result->message = "对不起，没有更多库存了";
            $result->remark = '您可以！<a href="' . Yii::app()->createUrl("site/index") . '">查看更多</a>兑换商品';
            return $result;
        }
        //判断库存
        if ($user->score < $goods->integral) {
            $result->status = false;
            $result->code = Constants::S_SCORE_NOT_ENOUGH;
            $result->message = "对不起，您的积分不足以兑换此商品";
            $result->remark = '您当前的积分不足，每天签到可以获取更多积分哦！<a href="' . Yii::app()->createUrl("site/index") . '">返回主页</a>';
            return $result;
        }

        //执行兑换
        $transaction = Yii::app()->db->beginTransaction();
        try {
            //更新用戶积分
            User::model()->updateByPk($userId, array('score' => new CDbExpression('score-' . $goods->integral)));
            //配送地址
            $userAddress = UsersAddress::model()->find('user_id=:user_id', array(':user_id' => $userId));
            //写入兑换日志
            $exchangeLog = new ExchangeLog();
            $exchangeLog->user_id = $userId;
            $exchangeLog->username = $user->username;
            $exchangeLog->created_at = $nowTime;
            $exchangeLog->goods_id = $goodsId;
            $exchangeLog->remark = $order['remark'];

            $exchangeLog->city_id = $userAddress->city_id;
            $exchangeLog->address = $userAddress->address;
            $exchangeLog->insert();
            $result->message = "兑换成功";
            $result->remark = '<a href="' . Yii::app()->createUrl("exchange/index") . '">查看更多</a>';
            Yii::app()->cache->delete($cacheKey);
            $userCount = ExchangeLog::model()->count(array('condition' => 'goods_id=:goods_id', 'params' => array(":goods_id" => $goodsId), 'group' => 'user_id'));
            //更新兑换商品数量
            Exchange::model()->updateByPk($goodsId, array('sale_num' => new CDbExpression('sale_num+1'), 'user_count' => $userCount));

            $transaction->commit();
            $result->status = true;
        } catch (\Exception $ex) {
            $transaction->rollback();
            $result->status = FALSE;
            $result->message = "系统忙，请稍后再试";
            $result->errorMsg = $ex->getMessage();
        }
        $result->sale_num = $goods->sale_num - 1;
        return $result;
    }

    public static function formatPostValue($post)
    {
        if (isset($post['goods_id']) && !is_numeric($post)) {
            $post['goods_id'] = Des::decrypt($post['goods_id']);
        }
        return $post;
    }

    public function showExchangeGoodsList($goodsNum = 40)
    {
        $criteria = new CDbCriteria();
        $criteria->limit = 40;
        $criteria->offset = 0;
        $criteria->order = ' id desc ';
        $criteria->compare('is_delete', 0);
        return Exchange::model()->findAll($criteria);
    }

    /**
     * 获取确认下单信息
     * @param integer $goodsId 兑换商品ID
     * @return DataResult 
     */
    public function getOrderdetail($goodsId, $userId)
    {
        $result = new DataResult();
        //获取用户邮寄地址
        $userAddress = UsersAddress::model()->find('user_id=:user_id', array(':user_id' => $userId));
        //查询城市
        if (!empty($userAddress)) {
            $provinceId = City::getProvinceId($userAddress->city_id);
            $city = City::model()->findByPk($userAddress->city_id);
            $province = City::model()->findByPk($provinceId);
            $userAddress->city = $city;
            $userAddress->province = $province;
        }
        $result->userAddress = $userAddress;
        //查询兑换商品数据
        $goods = Exchange::model()->findByPk($goodsId);
        $result->exchange = $goods;
        return $result;
    }

}
