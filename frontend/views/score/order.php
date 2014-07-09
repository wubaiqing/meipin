<link rel="stylesheet" type="text/css"  href="/static/css/score/score.css?v=201405071000" />
<div class="box admin hei">
    <h3><span>我的订单</span></h3><span class="t_l"></span><span class="t_r"></span>
    <div class="info" id="score">
        <h6>
        </h6>
        <div id="index" class="">
            <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
                <tbody>
                    <tr align="center">
                        <th width="240">商品名称</th>
                        <th>颜色分类</th>   
                        <th>订单号</th>
                        <th>消耗积分</th>
                        <th>支付金额(元)</th>
                        <th>订单状态</th>
                    </tr>
                    <?php foreach ($welfare as $info) { ?>
                        <?php
                        if (!isset($info->order->pay_status)) {
                            continue;
                        }
                        $exchange = Exchange::findByGoodsId($info->goods_id);
                        $exchange1 = ExchangeLog::model()->findByAttributes(array('goods_id' => $info->goods_id));
                        ?>
                        <tr align="center">
                    <a style="text-decoration-line: underline;"></a>
                    <?php
                    $jm = Des::encrypt($exchange->id);
                    if ($info->exchange->goods_type == 0) {
                        $goodsUrl = Yii::app()->createUrl("exchange/detail_{$jm}.html");
                    } elseif ($info->exchange->goods_type == 1) {
                        $goodsUrl = Yii::app()->createUrl("exchange/raffle_{$jm}.html");
                    }
                    ?>
                    <td bgcolor="#F9FAFC">
                        <a href="<?php
                        if ($exchange->taobaoke_url) {
                            echo $exchange->taobaoke_url;
                        } else {
                            echo $goodsUrl;
                        };
                        ?>" target='_blank' title="<?php echo $exchange->name; ?>">
                               <?php echo!empty($exchange) ? StringHelper::Utf8Substr($exchange->name, 0, 20) : ''; ?>
                        </a>
                    </td>
                    <td><?php echo!empty($exchange1->gdscolor) ? $exchange1->gdscolor : '无'; ?></td>
                    <td><?php echo $info->order_id ?></td>
                    <td><?php echo $info->order->integral; ?></td>
                    <td><?php echo $info->order->pay_price; ?></td>
                    <td>
                        <?php
                        echo Order::getPayStatus($info->order->pay_status);
                        if ($info->order->pay_status == 0) {
                            echo "<br/>(<a target='_blank' style='color:red;text-decoration: underline;' href='" . Yii::app()->createUrl("order/pay", ['id' => Des::encrypt($info->order_id)]) . "'>继续支付</a>)";
                        }
                        if ($info->order->pay_status == 4) {
                            echo $info->status == 1 ? '(已发货)' : '(等待发货)';
                        }
                        ?>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php $this->renderPartial('//site/page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
        </div>
        <div id="add"  class="content-box">

        </div>
        <div id="reduce" class="content-box">

        </div>
    </div>
</div>
