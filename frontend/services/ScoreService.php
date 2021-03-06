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
     * @param integer $page 页码
     * @param integer $goodsType 商品类型
     * @return type    
     */
    public function showExchangeDetial($goodsId, $page, $goodsType)
    {
        //获取兑换积分商品
        $exchange = Exchange::findByGoodsId($goodsId);
        $exchange = ExchangeHelper::formatExchangeGoodsColor($exchange);

        if ($exchange->goods_type != $goodsType) {
            return CommonHelper::getDataResult(false, [
                        'message' => "该商品不是" . Exchange::getGoodsTypeLable($goodsType)
            ]);
        }

        //校验
        if (empty($exchange)) {
            return CommonHelper::getDataResult(false, ['message' => "商品已下线或不存在"]);
        }
        //获取兑换热门商品
        $hotExchangeGoods = Exchange::getHotExchangeGoods($goodsId, $goodsType);
        //获取兑换记录集合
        $logList = ExchangeLog::getLogList($goodsId, $page);

        return CommonHelper::getDataResult(true, [
                    'message' => "",
                    'logList' => $logList,
                    'hotExchangeGoods' => $hotExchangeGoods,
                    'exchange' => $exchange,
        ]);
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
     * @param  integer $goodsId 商品ID
     * @param  integer $userId  用户ID
     * @return array   执行兑换结果
     */
    public function doExchange($userId, $order)
    {
        $isPayOrder = false;
        $nowTime = time();
        $order = self::formatPostValue($order);

        //在这里将 颜色的库存改一下
        $order = ExchangeHelper::formatExchangeGoodsColorCount($order);
        //Array ( [token] => 0adda0804413b28bf510ac5e919af9cb [gdscolor] => 白色 [goodscolor] => 白色:1;红色:6; [goods_id] => 12 [city_id] => 1 [buyCount] => 1 [remark] => ) 
        //print_r($order);
        //die;
        $url = Yii::app()->createUrl("site/index");
        //是否提交
        if (empty($order)) {
            return CommonHelper::getDataResult(false, ['message' => "您访问的页面不存在", 'url' => $url]);
        }
        $goodsId = $order['goods_id'];
        if (empty($userId)) {
            return CommonHelper::getDataResult(false, ['message' => "对不起，请先登录", 'url' => Yii::app()->createUrl("user/login")]);
        }
        //查询兑换商品数据
        $goods = Exchange::findByGoodsId($goodsId);
        if (empty($goods)) {
            return CommonHelper::getDataResult(false, ['message' => "对不起，您所操作的商品信息不存在", 'url' => $url]);
        }
        //显示不同的积分操作商品类型名称
        $indexUrl = "";
        $name = "";
        if ($goods->goods_type == 0) {
            $indexUrl = Yii::app()->createUrl("exchange/index");
            $name = "兑换";
        } elseif ($goods->goods_type == 1) {
            $indexUrl = Yii::app()->createUrl("site/raffle");
            $name = "抽奖";
        }
        $goodsUrl = Yii::app()->createUrl(($goods->goods_type == 0) ? "exchange/exchangeIndex" : "exchange/raffle", ['id' => Des::encrypt($goodsId)]);
        //验证提交
        $cacheKey = Exchange::getExchangeCacheKey($userId, $goodsId);
        $token = Yii::app()->cache->get($cacheKey);
        if (!$token) {
            return CommonHelper::getDataResult(false, [
                        'message' => "本次操作已经失效,正在跳转商品兑换页",
                        'url' => $goodsUrl
            ]);
        }
        //
        if ($order['token'] != $token) {
            return CommonHelper::getDataResult(false, ['message' => "请不要重复提交,点击查看其他商品", 'url' => $indexUrl]);
        }
        //校验商品
        if ($goods->start_time > $nowTime) {
            return CommonHelper::getDataResult(false, ['message' => "真遗憾！活动还未开始，您可以查看其他商品", 'url' => $indexUrl]);
        }
        if ($goods->end_time <= $nowTime) {
            return CommonHelper::getDataResult(false, ['message' => "真遗憾！活动已经结束，您可以查看其他商品", 'url' => $indexUrl]);
        }
        $user = User::model()->findByPk($userId);
        if (($goods->num - $goods->sale_num) <= 0) {
            return CommonHelper::getDataResult(false, ['message' => "真遗憾！没有更多库存了，您可以查看其他商品", 'url' => $indexUrl]);
        }
        //校验加钱兑换商品数据
        if ($goods->goods_type == 0 && $goods->active_price > 0) {
            if (!preg_match("/^\d+$/", $order['buyCount'])) {
                return CommonHelper::getDataResult(false, ['message' => "购买数量格式不正确", 'url' => $goodsUrl]);
            }
            if ($order['buyCount'] > ($goods->num - $goods->sale_num)) {
                return CommonHelper::getDataResult(false, ['message' => "购买数量不能超过最大库存数量", 'url' => $goodsUrl]);
            }
            if ($user->score < ($order['buyCount'] * $goods->integral)) {
                return CommonHelper::getDataResult(false, ['message' => "你的积分不足以进行此次购买", 'url' => $goodsUrl]);
            }
        }
        //配送地址
        $userAddress = UsersAddress::getByUserId($userId);
        if (empty($userAddress)) {
            return CommonHelper::getDataResult(false, [
                        'message' => "配送地址不存在，请将配送地址信息补充完整",
                        'url' => Yii::app()->createUrl("user/address")]);
        }

        //判断库存
        if ($user->score < $goods->integral) {
            return CommonHelper::getDataResult(false, [
                        'message' => "真遗憾！您只有" . $user->score . "积分,不足以{$name}此商品,您可以到每天签到，领取更多积分",
                        'url' => $indexUrl
            ]);
        }
        if ($user->mobile_bind == 0) {
            return CommonHelper::getDataResult(false, [
                        'message' => "您必须先进行电话绑定后才能进行商品" . $name,
                        'url' => Yii::app()->createUrl("user/address")
            ]);
        }
        $result = self::saveDoExchange($order, $userAddress, $cacheKey, $goods, $user, $nowTime);
        if (!$result['status']) {
            return CommonHelper::getDataResult(false, [
                        'message' => "系统忙，请返回重试",
                        'url' => Yii::app()->createUrl(($goods->goods_type == 0) ? "exchange/exchangeIndex" : "exchange/raffle", ['id' => Des::encrypt($goods->id)]),
            ]);
        }
        return CommonHelper::getDataResult(true, ['message' => "商品" . $name . "成功", 'orderId' => $result['data']['order_id'], 'url' => $indexUrl]);
    }

    /**
     * 保存兑换数据
     * @param  object   $order
     * @param  string   $cacheKey 缓存KEy
     * @param  Exchange $goods    商品对象
     * @param  User     $user     用户对象
     * @param  integer  $nowTime
     * @return boolean
     */
    public static function saveDoExchange($order, $userAddress, $cacheKey, Exchange $goods, User $user, $nowTime)
    {
        $result = [];
        //执行兑换
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $payOrder = null;
            $integral = 0;
            $pay_status = 1;
            $scoreLog = (($goods->goods_type == 0) ? "积分兑换" : "积分抽奖") . ",商品:" . $goods->name;
            
            if ($goods->goods_type == 0 && $goods->active_price > 0) {
                $pay_status = 0;
            }
            //写入兑换日志
            $exchangeLog = new ExchangeLog();
            $exchangeLog->attributes = [
                'user_id' => $user->id,
                'name' => $userAddress->name,
                'username' => $user->username,
                'created_at' => $nowTime,
                'goods_id' => $goods->id,
                'remark' => $order['remark'],
                'gdscolor' => $order['gdscolor'],
                'city_id' => $userAddress->city_id,
                'address' => $userAddress->address,
                'postcode' => $userAddress->postcode,
                'mobile' => $userAddress->mobile,
                'pay_status' => $pay_status,
            ];
            $exchangeLog->insert();
            //积分加钱兑换生成订单（未支付前不扣积分）
            if ($goods->goods_type == 0 && $goods->active_price > 0) {
                $buyCount = $order['buyCount'];
                $orderId = CommonHelper::generateOrderId($exchangeLog->id);
                $integral = $buyCount * $goods->integral;
                $payOrder = new Order();
                $payOrder->attributes = [
                    'order_id' => $orderId,
                    'pay_status' => $pay_status,
                    'order_type' => 1,
                    'created_at' => $nowTime,
                    'pay_way' => 1,
                    'buy_count' => $buyCount,
                    'market_price' => $goods->price,
                    'pay_price' => $buyCount * $goods->active_price,
                    'integral' => $integral,
                    'user_id' => $user->id,
                    'goods_id' => $goods->id,
                ];
                $payOrder->insert();
                //更新关联订单号
                $exchangeLog->updateByPk($exchangeLog->id, ['order_id' => $orderId]);
                //
                $result['order_id'] = $orderId;
                $scoreLog = "积分换购,订单号:".$orderId . ",商品：".$goods->name;
            } else {
                $integral = $goods->integral;
                $result['order_id'] = '';
            }

            $userCount = ExchangeLog::getUserCount($goods->id);
            //更新兑换商品数量
            //如果是抽奖商品就不需要增加兑换商品数量了
            if ($goods->goods_type == 1) {
                $uparray = array('user_count' => $userCount,
                    'goodscolor' => $order['goodscolor']);
            } else {
                //如果兑换商品的剩余量为0，则修改结束时间为当前时间
                if ($goods->num == ($goods->sale_num + 1)) {
                    $dates = date("Y-m-d", time());
                    $uparray = array('sale_num' => new CDbExpression('sale_num+1'),
                        'user_count' => $userCount,
                        'goodscolor' => $order['goodscolor'],
                        'end_time' => strtotime($dates)
                    );
                } else {
                    $uparray = array('sale_num' => new CDbExpression('sale_num+1'),
                        'user_count' => $userCount,
                        'goodscolor' => $order['goodscolor']
                    );
                }
            }
            Exchange::model()->updateByPk($goods->id, $uparray);
            //更新用戶积分
            User::model()->updateByPk($user->id, ['score' => new CDbExpression('score-' . $integral)]);
            //兑换扣积分记录
            $score = new Score();
            $score->attributes = [
                'score' => $integral * -1,
                'user_id' => $user->id,
                'reason' => 2,
                'remark' => $scoreLog
            ];
            $score->insert();
            //删除放重复提交token
            Yii::app()->cache->delete($cacheKey);
            //清除记录缓存
            ExchangeLog::deleteExchangeLogListCache($goods->id);
            ExchangeLog::deleteWelfareCache($user->id, 1, 1);
            //清除积分缓存列表
            Score::deleteScoreListCache($user->id);
            //删除商品缓存
            Exchange::deleteCache($goods->id);
            //删除用户缓存
            User::deleteCache($user->id);

            $transaction->commit();
        } catch (\Exception $ex) {
            $transaction->rollback();

            return CommonHelper::getDataResult(false, $result);
        }

        return CommonHelper::getDataResult(true, $result);
    }

    /**
     * 格式化数据
     */
    public static function formatPostValue($post)
    {
        if (isset($post['goods_id']) && !is_numeric($post)) {
            $post['goods_id'] = Des::decrypt($post['goods_id']);
        }

        return $post;
    }

    /**
     * 获取确认下单信息
     * @param  integer $goodsId 兑换商品ID
     * @param  integer $userId  用户ID
     * @return array
     */
    public static function getOrderdetail($goodsId, $userId)
    {
        if (!preg_match("/^\d+$/", $goodsId)) {
            return CommonHelper::getDataResult(false, ['message' => "兑换商品不存在,您可以查看更多兑换商品"]);
        }
        $user = User::getUser($userId);
        //验证手机是否绑定
        $url = Yii::app()->createAbsoluteUrl("exchange/order", ['id' => Des::encrypt($goodsId)]);
        if ($user->mobile_bind == 0) {
            return CommonHelper::getDataResult(false, [
                        'message' => "您的用户账号还没有户绑定手机，请绑定手机", 'url' => $url, 'redirect' => false]);
        }
        //获取用户邮寄地址
        $userAddress = UsersAddress::getModel($userId);
        // 省份，城市
        $province = City::getByParentId(0);
        $userAddress->province = City::getProvinceId($userAddress->city_id);
        $city = City::getCityList($userAddress->province);

        //查询兑换商品数据
        $exchange = Exchange::findByGoodsId($goodsId);
        //$exchange = ExchangeHelper::formatExchangeGoodsColor($exchange);

        //$goodscolor = Yii::app()->request->getParam("gdcolor", '');
        //$buyCount = Yii::app()->request->getParam("buyCount", '');
/*        if(!empty($exchange->goodscolor) && empty($goodscolor) || empty($buyCount)){
            return CommonHelper::getDataResult(false, [
                        'message' => "参数选择错误，请重新选择", 
                        'url' => Yii::app()->createAbsoluteUrl("exchange/exchangeIndex", ['id' => Des::encrypt($goodsId)])
                ]);
        }*/
        //设置兑换token用于防止重复提交
        $tokenKey = Exchange::getExchangeCacheKey($userId, $goodsId);
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
     * @param  integer $userId 用户ID
     * @param  string  $remark 备注
     * @return array
     */
    public static function updateScore($userId, $remark = '')
    {
        $scoreList = Yii::app()->params['dayRegistionNum'];
        $user = User::model()->findByPk($userId);
        if ($user->last_dr_time > 0 && date("Y-m-d", $user->last_dr_time) == date("Y-m-d", time())) {
            return CommonHelper::getDataResult(false, ['message' => "您已经签过了"]);
        }
        //积分cookie验证签到
        if (self::isAreadyDayReg($userId)) {
            return CommonHelper::getDataResult(false, ['message' => "每台电脑每天只能签到一次"]);
        }
      
        $transaction = Yii::app()->db->beginTransaction();
        $now = time();
        try {
            $num = 1;
            $user->dr_count = $user->dr_count + 1;
            if (isset($scoreList[$user->dr_count])) {
                $num = $scoreList[$user->dr_count];
            } elseif ($user->dr_count >= 3) {
                $num = 3;
            }
            //如果断签则恢复
            if (strtotime(date("Y-m-d", $user->last_dr_time)) < (strtotime('-1 day 00:00:00'))) {
                $user->dr_count = 1;
                $num = 1;
            }
            $user->attributes = [
                'last_dr_time' => $now,
                'score' => ($user->score + $num),
                'dr_count' => $user->dr_count
            ];
            $user->update(['score', 'dr_count', 'last_dr_time']);

            //保存积分日志

            $score = new Score();
            $score->attributes = ['score' => $num, 'user_id' => $userId, 'reason' => 1, 'remark' => "每日签到"];

            //清除积分缓存列表
            Score::deleteScoreListCache($user->id);
            //清除用戶緩存
            Yii::app()->cache->delete(User::getUserCacheKey($userId));

            $score->insert();

            $transaction->commit();
            //设置签到COOKIE
            $expireTime = $now * 2 - strtotime(date("Y-m-d")) + 1;
            $cvalue = ['user_id' => $userId, 'date' => date("Y-m-d")];
            $tokenCookie = Des::encrypt(json_encode($cvalue));
            setcookie("DR", $tokenCookie, $expireTime, "/");
        } catch (Exception $exc) {
            $transaction->rollback();

            return CommonHelper::getDataResult(false, ['message' => "系统正在偷懒，请稍后再试"]);
        }

        return CommonHelper::getDataResult(true, [
                    'message' => "签到成功",
                    'message2' => "今日已签",
                    'dr_count' => $user->dr_count,
                    'nextScore' => ($num < 3) ? ($num + 1) : 3,
                    'score' => $num,
                    'myscore'=>$user->score
        ]);
    }

    /**
     * 保存用户地址数据
     * @param  integer $userId      用户ID
     * @param  array   $userAddress POST过来的数据
     * @return array
     */
    public static function saveUserAddress($userId, $userAddress)
    {

        $model = UsersAddress::getModel($userId);
        // 省份，城市
        $province = City::getByParentId(0);
        $model->province = City::getProvinceId($model->city_id);
        $city = City::getCityList($model->province);
        $user = User::getUser($userId);
        if (!empty($userAddress)) {
            $post = UsersAddress::setAttr($userId, $userAddress);
            $model->attributes = $post;
            if ($model->save()) {
                //绑定用户手机信息
                if (!empty($model->code) && $user->mobile_bind == 0) {
                    User::updateMobileBind($userId, $model->mobile, 1);
                }
                //删除地址缓存
                UsersAddress::deleteCacheByUserId($userId);
                //删除用户缓存
                User::deleteCache($userId);

                return CommonHelper::getDataResult(true, ['message' => '操作成功', 'errors' => []]);
            }
        }

        return CommonHelper::getDataResult(false, ['message' => '操作失败', 'errors' => $model->getErrors()]);
    }

    /**
     * cookie判断是否当天是否已经签到
     * @return boolean
     */
    public static function isAreadyDayReg($userId)
    {
        //积分cookie
        $cvalue = isset($_COOKIE['DR']) ? $_COOKIE['DR'] : null; //Cookie加密串
        if (!empty($cvalue)) {
            $cvalue = json_decode(Des::decrypt($cvalue), true);
            if ($cvalue['user_id'] != $userId && $cvalue['date'] == date("Y-m-d")) {
                return true;
            }
        }

        return false;
    }

    /**
     * 验证需要绑定的手机号码
     * @param  integer $userId 当前用户ID
     * @param  array   $post   提交的参数
     * @return array
     */
    public static function validMobileIsOk($userId, $post)
    {
        if (!isset($post['mobile']) || empty($post['mobile']) || !preg_match("/^1[0-9]{10}$/", $post['mobile'])) {
            return CommonHelper::getDataResult(false, [
                        'message' => "手机号码正确",
            ]);
        }
        $cacheKey = Sms::mobileValidateKey($userId);
        $cacheData = Yii::app()->cache->get($cacheKey);

        if (empty($cacheData) ||
                $post['mobile'] != $cacheData['mobile'] ||
                $cacheData['code'] != trim($post['code']) ||
                !isset($post['code']) ||
                empty($post['code'])) {
            return CommonHelper::getDataResult(false, [
                        'message' => "手机校验码错误",
            ]);
        }

        return CommonHelper::getDataResult(true, [
                    'message' => "校验通过",
        ]);
    }

}
