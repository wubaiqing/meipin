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
                        <th width="180">商品名称</th>
                        <th width="10%">颜色分类</th>   
                        <th>订单号</th>
                        <th>下单时间</th>
                        <th>购买数量</th>
                        <th>消耗积分</th>
                        <th>支付金额(元)</th>
                        <th width="140">订单状态</th>
                    </tr>
                    <?php foreach ($welfare as $info) { ?>
                        <?php
                        if (!isset($info->order->pay_status)) {
                            continue;
                        }
                        ?>
                        <tr align="center">
                    <a style="text-decoration-line: underline;"></a>
                    <?php
                    $jm = Des::encrypt($info->exchange->id);
                    if ($info->exchange->goods_type == 0) {
                        $goodsUrl = Yii::app()->createUrl("exchange/detail_{$jm}.html");
                    } elseif ($info->exchange->goods_type == 1) {
                        $goodsUrl = Yii::app()->createUrl("exchange/raffle_{$jm}.html");
                    }
                    ?>
                    <style>.orderlistcss a:hover{color: #785E02;font-weight: 800;}</style>
                    <td bgcolor="#F9FAFC" class="orderlistcss">
                        <a href="<?php
                        if ($info->exchange->taobaoke_url) {
                            echo $info->exchange->taobaoke_url;
                        } else {
                            echo $goodsUrl;
                        };
                        ?>" target='_blank' title="<?php echo $info->exchange->name; ?>">
                               <?php echo!empty($info->exchange) ? StringHelper::Utf8Substr($info->exchange->name, 0, 15) : ''; ?>
                        </a>
                    </td>
                    <td><?php echo!empty($info->gdscolor) ? $info->gdscolor : '无'; ?></td>
                    <td><?php echo $info->order_id ?></td>
                    <td><?php echo date("Y-m-d H:i:s",$info->order->created_at); ?></td>
                    <td><?php echo $info->order->buy_count; ?></td>
                    <td><?php echo $info->order->integral; ?></td>
                    <td><?php echo $info->order->pay_price; ?></td>
                    <td>
                        <?php
                        if($info->order->pay_status != 4)
                        {
                        echo Order::getPayStatus($info->order->pay_status);
                        }
                        if ($info->order->pay_status == 0) {
                            echo "<br/>(<a target='_blank' style='color:red;text-decoration: underline;' href='" . Yii::app()->createUrl("order/pay", ['id' => Des::encrypt($info->order_id)]) . "'>继续支付</a>)";
                        }
                        if ($info->order->pay_status == 4) {
                            echo $info->status == 1 ? '已发货' : '等待发货';
                            //快递信息
                            $logisticsSystem = Yii::app()->params['logisticsSystem'];
                            if($info->status == 1 && isset($logisticsSystem[$info->logistics])){
                                echo "<div style='text-align:left;width:100%;'>快递:".$logisticsSystem[$info->logistics]."<br/>单号:".$info->logistics_code.'</div>';
                            }
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
