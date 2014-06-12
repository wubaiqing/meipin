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
            $result =[];
            while (true) {
                if ($limit_count <= 0) break;
                $key = rand(0,count($lotteryIds)-1);
                $result[] = $lotteryIds[$key];
                unset($lotteryIds[$key]);
                sort($lotteryIds);
                $limit_count--;
            }
            ExchangeLog::model()->updateByPk($result, ['winner'=>1]);
            Exchange::model()->updateByPk($goods->id, ['lottery_status'=>1]);
        }
    }

}
