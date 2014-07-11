<?php

/**
 * 同步今天值得买数据
 */
class DataTaskCommand extends CConsoleCommand
{

    public function actionIndex()
    {
        $getJson = file_get_contents('http://admin.jtzdm.com/index.php?r=api/getgoods');
        $json = json_decode(strval($getJson), true);
        foreach ($json as $key => $val) {
            $goods = Goods::model()->findByAttributes(array('url' => $val['url']));
            if (!empty($goods)) {
                echo $goods->id . '已经存在' . "\n";
            } else {
                $goods = new Goods();
                unset($val['id']);
            }
            $goods->attributes = $val;
            $goods->start_time = date('Y-m-d H:i:s', $goods->start_time);
            $goods->end_time = date('Y-m-d H:i:s', $goods->end_time);
            $goods->goodsType = $goods->goods_type;
            $goods->save();
            echo $goods->id . "\n";
        }
    }

    /**
     * 抽奖算法
     */
    public function actionLottery()
    {

        ini_set('date.timezone', 'Asia/Shanghai');
        $goodsList = Exchange::model()->findAll('end_time<=:end_time and lottery_status=0 and goods_type=1', [':end_time' => time()]);
        $pageSize = 100;
        foreach ($goodsList as $goods) {
            //获取总数据
            $count = ExchangeLog::model()->count('goods_id=:goods_id', [':goods_id' => $goods->id]);
            $pageCount = $count % $pageSize == 0 ? (int) ($count / $pageSize) : (((int) ($count / $pageSize)) + 1);
            //抽奖人数大于限制条件
            if ($count > $goods->limit_count) {
                //保证取够人数
                if ($pageCount > 1) {
                    $cpage = rand(1, $pageCount - 1);
                } else {
                    $cpage = rand(1, $pageCount);
                }
            } else {
                $cpage = 1;
            }
            $exchangeLogList = ExchangeLog::model()->findAll(['condition' => 'goods_id=' . $goods->id . " limit " . (($cpage - 1) * $pageSize) . ',' . $pageSize]);

            $lotteryIds = [];
            foreach ($exchangeLogList as $log) {
                $lotteryIds[] = $log->id;
            }
            //抽奖
            $limit_count = $goods->limit_count;
            $result = [];
            $updated = false;
            while (true) {
                if ($limit_count <= 0) {
                    break;
                }
                $key = rand(0, count($lotteryIds) - 1);
                if (!isset($lotteryIds[$key])) {
                    break;
                }
                $result[] = $lotteryIds[$key];
                unset($lotteryIds[$key]);
                sort($lotteryIds);
                $limit_count--;
                $updated = true;
            }
            if ($updated) {
                ExchangeLog::model()->updateByPk($result, ['winner' => 1]);
                Exchange::model()->updateByPk($goods->id, ['lottery_status' => 1]);
            }
            echo date("Y-m-d H:i:s", time()) . ",抽奖运算,商品ID=" . $goods->id . ",中奖记录ID=" . json_encode($result) . "\n";
        }
    }

    /**
     * 订单过期处理
     */
    public function actionOrderpay()
    {
        $pageSize = 100;

        while (true) {
            $orderList = Order::model()->findAll('pay_status=0 and created_at < '.(time()- Yii::app()->params['payTimeout']).' limit ' . $pageSize);
            if (empty($orderList)) {
                break;
            }
            $orderIds = [];
            foreach ($orderList as $order) {
                $orderIds[] = $order->order_id;
                /*                     * ********返还积分***************** */
                $integral = $order->integral;
                User::model()->updateByPk($order->user_id, ['score' => new CDbExpression('score+' . $integral)]);
                //日志
                $score = new Score();
                $score->attributes = [
                    'score' => $integral,
                    'user_id' => $order->user_id,
                    'reason' => 2,
                    'remark' => "返还积分（加钱换购），未支付订单过期（" . $order->order_id . "）"
                ];
                $score->insert();
            }
            Order::model()->updateByPk($orderIds, ['pay_status' => 1]);
        }
    }

}
