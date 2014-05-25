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
     * @param  integer $goodsId 需要兑换的商品ID
     * @return type    Description
     */
    public function showExchangeIndex($goodsId, $page)
    {
        //获取兑换积分商品
        $exchange = Exchange::model()->findByPk($goodsId);
        //校验
        if (empty($exchange)) {
            return CommonHelper::getDataResult(false, ['message' => "商品已下线或不存在"]);
        }
        //获取兑换热门商品
        $hotExchangeGoods = Exchange::getHotExchangeGoods($goodsId);
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
        $nowTime = time();
        //默认跳转
        $url = Yii::app()->createUrl("exchange/index");
        $order = self::formatPostValue($order);
        //是否提交
        if (empty($order)) {
            return CommonHelper::getDataResult(false, [
                        'message' => "您访问的页面不存在",
                        'url' => $url
            ]);
        }
        $goodsId = $order['goods_id'];
        if (empty($userId)) {
            return CommonHelper::getDataResult(false, [
                        'message' => "对不起，请先登录",
                        'url' => Yii::app()->createUrl("user/login")
            ]);
        }
        //验证提交
        $cacheKey = Exchange::getExchangeCacheKey($userId, $goodsId);
        $token = Yii::app()->cache->get($cacheKey);
        if (!$token) {
            return CommonHelper::getDataResult(false, [
                        'message' => "本次操作已经失效,正在跳转商品兑换页",
                        'url' => Yii::app()->createUrl("exchange/exchangeIndex", ['id' => Des::encrypt($goodsId)])
            ]);
        }
        //
        if ($order['token'] != $token) {
            return CommonHelper::getDataResult(false, [
                        'message' => "请不要重复提交,点击查看更多商品",
                        'url' => $url
            ]);
        }

        //查询兑换商品数据
        $goods = Exchange::model()->findByPk($goodsId);
        if (empty($goods)) {
            return CommonHelper::getDataResult(false, ['message' => "对不起，您所兑换的商品不存在，您可以查看其他兑换商品",
                        'url' => $url]);
        }
        //校验商品
        if ($goods->start_time > $nowTime) {
            return CommonHelper::getDataResult(false, ['message' => "真遗憾！活动还未开始，您可以查看其他兑换商品",
                        'url' => $url]);
        }
        if ($goods->end_time <= $nowTime) {
            return CommonHelper::getDataResult(false, ['message' => "真遗憾！活动已经结束，您可以查看更多兑换商品",
                        'url' => $url]);
        }
        $user = User::getUser($userId);
        if (($goods->num - $goods->sale_num) <= 0) {
            return CommonHelper::getDataResult(false, ['message' => "真遗憾！没有更多库存了，您可以查看更多兑换商品",
                        'url' => $url]);
        }
        //配送地址
        $userAddress = UsersAddress::model()->find('user_id=:user_id', [':user_id' => $userId]);
        if (empty($userAddress)) {
            return CommonHelper::getDataResult(false, [
                        'message' => "配送地址不存在，请将配送地址信息补充完整",
                        'url' => Yii::app()->createUrl("user/address")]);
        }

        //判断库存
        if ($user->score < $goods->integral) {
            return CommonHelper::getDataResult(false, [
                        'message' => "真遗憾！您只有" . $user->score . "积分,不足以兑换此商品,您可以到每天签到，领取更多积分",
                        'url' => Yii::app()->createUrl("exchange/index")
            ]);
        }
        if ($user->mobile_bind == 0) {
            return CommonHelper::getDataResult(false, [
                        'message' => "您必须先进行电话绑定后才能进行商品兑换",
                        'url' => Yii::app()->createUrl("user/address")
            ]);
        }
        $bool = self::saveDoExchange($order, $userAddress, $cacheKey, $goods, $user, $nowTime);
        if (!$bool) {
            return CommonHelper::getDataResult(false, [
                        'message' => "系统忙，请返回重试",
                        'url' => Yii::app()->createUrl("exchange/exchangeIndex", ['id' => Des::encrypt($goods->id)])
            ]);
        }

        return CommonHelper::getDataResult(true, [
                    'message' => "商品兑换成功",
                    'url' => $url
        ]);
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
        //执行兑换
        $transaction = Yii::app()->db->beginTransaction();
        try {
            //更新用戶积分
            User::model()->updateByPk($user->id, ['score' => new CDbExpression('score-' . $goods->integral)]);
            //写入兑换日志
            $exchangeLog = new ExchangeLog();
            $exchangeLog->attributes = [
                'user_id' => $user->id,
                'name' => $userAddress->name,
                'username' => $user->username,
                'created_at' => $nowTime,
                'goods_id' => $goods->id,
                'remark' => $order['remark'],
                'city_id' => $userAddress->city_id,
                'address' => $userAddress->address,
                'postcode' => $userAddress->postcode,
                'mobile' => $userAddress->mobile,
            ];
            $exchangeLog->insert();

            $userCount = ExchangeLog::model()->count([
                'condition' => 'goods_id=:goods_id',
                'params' => [":goods_id" => $goods->id],
                'group' => 'user_id'
            ]);
            //更新兑换商品数量
            Exchange::model()->updateByPk($goods->id, [
                'sale_num' => new CDbExpression('sale_num+1'),
                'user_count' => $userCount
            ]);
            //兑换扣积分记录
            $score = new Score();
            $score->attributes = [
                'score' => $goods->integral * -1,
                'user_id' => $user->id,
                'reason' => 2,
                'remark' => "积分兑换:" . $goods->name
            ];
            $score->insert();
            //删除放重复提交token
            Yii::app()->cache->delete($cacheKey);
            //清除记录缓存
            ExchangeLog::deleteExchangeLogListCache($goods->id);
            //清除积分缓存列表
            Score::deleteScoreListCache($user->id);
            $transaction->commit();
        } catch (\Exception $ex) {
            $transaction->rollback();
            throw new Exception($ex);

            return false;
        }

        return true;
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
     * 积分兑换首页商品列表
     * @return array
     *               @author zhangchao
     */
    public function showExchangeGoodsList($currentPage = 0)
    {
        //组装查询条件
        $criteria = new CDbCriteria();
        $criteria->order = ' id desc ';
        $criteria->compare('is_delete', 0);
        //分页类开始
        $pages = new CPagination();
        $pages->currentPage = $currentPage;
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
     * @param  integer $goodsId 兑换商品ID
     * @param  integer $userId  用户ID
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
        $province = City::getByParentId(0);
        $userAddress->province = City::getProvinceId($userAddress->city_id);
        $city = City::getCityList($userAddress->province);

        //查询兑换商品数据
        $exchange = Exchange::model()->findByPk($goodsId);

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
            $user->update([
                'score',
                'dr_count',
                'last_dr_time'
            ]);

            //保存积分日志

            $score = new Score();
            $score->attributes = [
                'score' => $num,
                'user_id' => $userId,
                'reason' => 1,
                'remark' => "每日签到"
            ];

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
                    'dr_count' => $user->dr_count,
                    'nextScore' => ($num < 3) ? ($num + 1) : 3,
                    'score' => $num
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

                return CommonHelper::getDataResult(true, ['message' => '操作成功','errors'=>[]]);
            }
        }

        return CommonHelper::getDataResult(false, ['message' => '操作失败','errors'=>$model->getErrors()]);
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

}
