<link rel="stylesheet" type="text/css"  href="/static/css/score/score.css?v=201405071000" />
<div class="box admin hei">
    <h3><span>我的礼品</span></h3><span class="t_l"></span><span class="t_r"></span>
    <div class="info" id="score">
        <h6></h6>
        <div id="index" class="">
            <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
                <tbody>
                <tr align="center">
                    <th width="380">礼品详情</th>
                    <th>订单状态</th>
                    <th>消耗积分</th>
                </tr>
                <?php foreach ($welfare as $info) { ?>
                    <?php $exchange = Exchange::findByGoodsId($info->goods_id); ?>
                    <tr align="center">
                     <?php
                       $jm = Des::encrypt($exchange->id);
                       $goodsUrl = Yii::app()->createUrl("exchange/detail_{$jm}.html");
                        ?>
                        <td bgcolor="#F9FAFC"><a href="<?php if($exchange->taobaoke_url){echo $exchange->taobaoke_url;}else{echo $goodsUrl;};?>" target='_blank'><?php echo !empty($exchange) ? $exchange->name : '';?></a></td>
                        <td><?php echo $info->status == 1 ? '已发货' : '未发货'; ?></td>
                        <td>-<?php echo !empty($exchange) ? $exchange->integral : ''; ?></td>
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
