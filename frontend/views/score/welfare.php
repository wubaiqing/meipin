<link rel="stylesheet" type="text/css"  href="/static/css/score/score.css?v=201405071000" />
<div class="box admin hei">
    <h3><span>我的礼品</span></h3><span class="t_l"></span><span class="t_r"></span>
    <div class="info" id="score">
        <h6>
        </h6>
        <div id="index" class="">
            <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
                <tbody>
                <tr align="center">
                    <th width="240">礼品详情</th>
                    <th>颜色分类</th>
                    <th>订单状态</th>
                    <th>消耗积分</th>
                </tr>
                <?php foreach ($welfare as $info) { ?>
                    <?php 
//                    $exchange = Exchange::findByGoodsId($info->goods_id); 
//                    $exchange1 = ExchangeLog::model()->findByAttributes(array('goods_id' => $info->goods_id));
                    ?>
                    <tr align="center">
                     <?php
                       $jm = Des::encrypt($info->exchange->id);
                       if($info->exchange->goods_type == 0){
                            $goodsUrl = Yii::app()->createUrl("exchange/detail_{$jm}.html");
                       }elseif($info->exchange->goods_type == 1){
                            $goodsUrl = Yii::app()->createUrl("exchange/raffle_{$jm}.html");
                       }
                        ?>
                        <td bgcolor="#F9FAFC">
                                <a href="<?php
                                if ($info->exchange->taobaoke_url) {
                                    echo $info->exchange->taobaoke_url;
                                } else {
                                    echo $goodsUrl;
                                };
                                ?>" target='_blank' title="<?php echo $info->exchange->name;?>">
                                    <?php echo!empty($info->exchange) ? StringHelper::Utf8Substr($info->exchange->name, 0, 20) : ''; ?>
                                </a>
                        </td>
                        <td><?php echo !empty($info->gdscolor) ? $info->gdscolor : '无'; ?></td>
                        <td><?php echo $info->status == 1 ? '已发货' : '未发货'; ?></td>
                        <td><?php echo !empty($info->exchange) ? $info->exchange->integral : ''; ?></td>
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
