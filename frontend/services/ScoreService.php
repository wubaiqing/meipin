<?php

/**
 * 积分业务处理类
 *
 * @author liukui<liujickson@gmail.com>
 */
class ScoreService
{

    /**
     * 显示积分兑换详情页面
     * @param integer $goodsId 需要兑换的商品ID
     * @return type Description
     */
    public function showExchangeIndex($goodsId, $page)
    {
        $result = new DataResult();
        //获取兑换积分商品
        $exchange = Exchange::model()->findByPk($goodsId);
        //校验
        if (empty($exchange)) {
            $result->message = "商品已下线或不存在";
            $result->remark = "<a href='" . Yii::app()->createUrl("exchange/index") . "' style='color:blue;'>点击跳转</a>到主页";
            return $result;
        }
        //兑换商品对象
        $result->exchange = $exchange;
        //获取兑换热门商品
        $result->hotExchangeGoods = Exchange::model()->findAll(array('condition' => "id !=" . $exchange->id, 'order' => 'sale_num desc', 'limit' => 10));
        //获取兑换记录集合
        $logList = ExchangeLog::getLogList($goodsId, $page);
        $result->logList = $logList;
        //设置返回状态
        $result->setStatus(true);
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
     * 生成token用于防止页面重复提交
     * @param string $prefix 前缀
     */
    public static function getToken($prefix = '')
    {
        return md5($prefix . "-" . microtime() . "-" . session_id());
    }

    /**
     * 执行积分商品兑换
     * @param integer $goodsId 商品ID
     * @param integer $userId 用户ID
     * @return array 执行兑换结果
     */
    public function doExchange($userId, $order)
    {
        $result = new DataResult();
        $nowTime = time();
        //默认跳转
        $result->setUrl(Yii::app()->createUrl("exchange/index"));
        $order = self::formatPostValue($order);
        //是否提交
        if (empty($order)) {
            $result->setMessage("您访问的页面不存在");
            return $result;
        }
        $goodsId = $order['goods_id'];
        if (empty($userId)) {
            $result->setMessage("对不起，请先登录");
            $result->setUrl(Yii::app()->createUrl("user/login"));
            return $result;
        }
        //验证提交
        $cacheKey = self::getExchangeCacheKey($userId, $goodsId);
        $token = Yii::app()->cache->get($cacheKey);
        if (!$token) {
            $result->setMessage("本次操作已经失效,正在跳转商品兑换页");
            $result->setUrl(Yii::app()->createUrl("exchange/exchangeIndex", ['id' => Des::encrypt($goodsId)]));
            return $result;
        }
        //
        if ($order['token'] != $token) {
            $result->setMessage("请不要重复提交！");
            return $result;
        }

        //查询兑换商品数据
        $goods = Exchange::model()->findByPk($goodsId);
        if (empty($goods)) {
            $result->setMessage("对不起，您所兑换的商品不存在，您可以查看其他兑换商品");
            return $result;
        }
        //校验商品
        if ($goods->start_time > $nowTime) {
            $result->setMessage("真遗憾！活动还未开始，您可以查看其他兑换商品");
            return $result;
        }
        if ($goods->end_time <= $nowTime) {
            $result->setMessage("真遗憾！活动已经结束，您可以查看更多兑换商品");
            return $result;
        }
        $user = User::model()->findByPk($userId);
        if (($goods->num - $goods->sale_num) <= 0) {
            $result->setMessage("真遗憾！没有更多库存了，您可以查看更多兑换商品");
            return $result;
        }
        //配送地址
        $userAddress = UsersAddress::model()->find('user_id=:user_id', array(':user_id' => $userId));
        if (empty($userAddress)) {
            $result->setMessage("配送地址不存在，请将配送地址信息补充完整");
            $result->setUrl(Yii::app()->createUrl("user/address"));
            return $result;
        }

        //判断库存
        if ($user->score < $goods->integral) {
            $result->message = "真遗憾！您只有" . $goods->integral . "积分,不足以兑换此商品,您可以到每天签到，领取更多积分";
            $result->setUrl(Yii::app()->createUrl("exchange/index"));
            return $result;
        }

        //执行兑换
        $transaction = Yii::app()->db->beginTransaction();
        try {
            //更新用戶积分
            User::model()->updateByPk($userId, array('score' => new CDbExpression('score-' . $goods->integral)));
            //写入兑换日志
            $exchangeLog = new ExchangeLog();
            $exchangeLog->attributes = ['user_id' => $userId, 'username' => $user->username, 'created_at' => $nowTime,
                'goods_id' => $goodsId, 'remark' => $order['remark'], 'city_id' => $userAddress->city_id,
                'address' => $userAddress->address];
            $exchangeLog->insert();

            //删除token
            Yii::app()->cache->delete($cacheKey);

            $userCount = ExchangeLog::model()->count(array('condition' => 'goods_id=:goods_id', 'params' => array(":goods_id" => $goodsId), 'group' => 'user_id'));
            //更新兑换商品数量
            Exchange::model()->updateByPk($goodsId, array('sale_num' => new CDbExpression('sale_num+1'), 'user_count' => $userCount));

            $transaction->commit();
            $result->status = true;
            $result->setMessage("兑换成功");
        } catch (\Exception $ex) {
            $transaction->rollback();
            $result->setMessage("系统忙，请返回重试");
            $result->setUrl(Yii::app()->createUrl("exchange/exchangeIndex", array('id' => Des::encrypt($goodsId))));
        }
        return $result;
    }

    public static function formatPostValue($post)
    {
        if (isset($post['goods_id']) && !is_numeric($post)) {
            $post['goods_id'] = Des::decrypt($post['goods_id']);
        }
        return $post;
    }

    /**
     * 积分兑换首页商品列表
     * @return array
     * @author zhangchao
     */
    public function showExchangeGoodsList()
    {
        //组装查询条件
        $criteria = new CDbCriteria();
        $criteria->order = ' id desc ';
        $criteria->compare('is_delete', 0);
        //分页类开始
        $pages = new CPagination();
        //计算总数
        $pages->itemCount = Exchange::model()->count($criteria);
        //每页显示数量，配置文件中可配
        $pages->pageSize = Yii::app()->params['pagination']['exchangePageSize'];
        $pages->applyLimit($criteria);
        $data = [];
        //根据条件查询积分兑换商品
        $data['goods'] = Exchange::model()->findAll($criteria);
        //分页类
        $data['pages'] = $pages;
        return $data;
    }

    /**
     * 获取确认下单信息
     * @param integer $goodsId 兑换商品ID
     * @param integer $userId 用户ID
     * @return array 
     */
    public static function getOrderdetail($goodsId, $userId)
    {
        if (!preg_match("/^\d+$/", $goodsId)) {
            return CommonHelper::getDataResult(false, ['message' => "兑换商品不存在,您可以查看更多兑换商品"]);
        }
        //获取用户邮寄地址
        $userAddress = UsersAddress::getModel($userId);
        // 省份，城市
        $city = [];
        $province = City::getByParentId(0);
        $userAddress->province = City::getProvinceId($userAddress->city_id);
        if ($userAddress->province > 0) {
            $city = City::getCityList($userAddress->province);
        }
        //查询兑换商品数据
        $exchange = Exchange::model()->findByPk($goodsId);

        //设置兑换token用于防止重复提交
        $tokenKey = ScoreService::getExchangeCacheKey($userId, $goodsId);
        $dataToken = Yii::app()->cache->get($tokenKey);
        if (empty($dataToken)) {
            $dataToken = ScoreService::getToken();
            Yii::app()->cache->set($tokenKey, $dataToken, Constants::T_HALF_HOUR);
        }
        return CommonHelper::getDataResult(true, [
                    'province' => $province,
                    'city' => $city,
                    'userAddress' => $userAddress,
                    'exchange' => $exchange,
                    'token' => $dataToken,
                    'message' => ""
        ]);
    }

    /**
     * 积分增加
     * @param integer $userId 用户ID
     * @param integer $optType 操作方式；1：增加；2：减少
     * @param string $remark 备注
     * @return array 
     */
    public static function updateScore($userId, $optType, $remark = '')
    {
        $scoreList = Yii::app()->params['dayRegistionNum'];
        //验证
        if (!preg_match("/^\d+$/", $optType)) {
            return CommonHelper::getDataResult(false, ['message' => "系统偷懒了，请稍后再试"]);
        }
        $user = User::model()->findByPk($userId);
        if ($user->last_dr_time > 0 && date("Y-m-d", $user->last_dr_time) == date("Y-m-d", time())) {
            return CommonHelper::getDataResult(false, ['message' => "您已经签过了"]);
        }

        $transaction = Yii::app()->db->beginTransaction();
        $now = time();
        try {
            $num = 1;
            if (isset($scoreList[$user->dr_count])) {
                $num = $scoreList[$user->dr_count];
            } else if ($user->dr_count >= 3) {
                $num = 3;
            }
            //如果断签则恢复
            if (strtotime(date("Y-m-d", $user->last_dr_time)) < (strtotime('-1 day 00:00:00'))) {
                $user->dr_count = 0;
                $num = 1;
            }
            $user->attributes = ['last_dr_time' => $now, 'score' => ($user->score + $num), 'dr_count' => ($user->dr_count + 1)];
            $user->update(array('score', 'dr_count', 'last_dr_time'));

            //保存兑换记录
            $scoreLog = new ScoreLog();
            $scoreLog->attributes = ['user_id' => $userId, 'opt_type' => $optType, 'created_at' => $now,
                'remark' => $remark, 'num' => $num];
            $scoreLog->insert();

            $transaction->commit();
            return $result;
        } catch (Exception $exc) {
            $transaction->rollback();
            return CommonHelper::getDataResult(false, ['message' => "系统正在偷懒，请稍后再试"]);
        }
        return CommonHelper::getDataResult(true, ['message' => "签到成功"]);
    }

    /**
     * 保存用户地址数据
     * @param integer $userId 用户ID
     * @param array $userAddress POST过来的数据
     * @return array 
     */
    public static function saveUserAddress($userId, $userAddress)
    {

        $model = UsersAddress::getModel($userId);
        // 省份，城市
        $city = [];
        $province = City::getByParentId(0);
        $model->province = City::getProvinceId($model->city_id);
        if ($model->province > 0) {
            $city = City::getCityList($model->province);
        }
        if (!empty($userAddress)) {
            UsersAddress::setAttr($userId, $userAddress, $model);
            if ($model->save()) {
                return CommonHelper::getDataResult(true, ['message' => '地址更新成功']);
            }
        }
        return CommonHelper::getDataResult(false, ['message' => '地址更新失败']);
    }

}
