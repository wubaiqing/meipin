<div id="header">
    <?php $this->renderPartial('//site/prompt'); ?>
    <?php $this->renderPartial('//site/login'); ?>
    <?php $this->renderPartial('//site/head'); ?>
    <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>
<div id="contentA" class="wp">
    <style type="text/css">
    </style>
    <div class="left" style="float:left">
        <div class="pt">
            <img src="<?php echo $data->exchange->img_url; ?>">
        </div>
        <div class="blockA">
            <h2>热门兑换活动...</h2>
            <ul>
                <?php
                foreach ($data->hotExchangeGoods as $goods):
                    $goodsUrl = Yii::app()->createUrl("exchange/exchangeIndex", array("id" => Des::encrypt($goods->id)));
                    ?>
                    <li>
                        <a target="_blank" href="<?php echo $goodsUrl; ?>">
                            <img src="<?php echo $goods->img_url ?>">
                        </a>
                        <h3><a title="<?php echo $goods->name; ?>" target="_blank" href="<?php echo $goodsUrl; ?>"><?php echo $goods->name; ?></a></h3>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="right dhdeal" style="float:right">
        <div class="box2 zt2">
            <h2>
                <span><?php echo $data->exchange->name; ?> </span>
            </h2>
            <h3>兑奖所需积分：<em><?php echo $data->exchange->integral; ?></em>
                积分&nbsp;&nbsp;|&nbsp;&nbsp;
                价值: ￥<?php echo $data->exchange->price; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                兑奖名额<strong><?php echo $data->exchange->num; ?></strong>&nbsp;&nbsp;|&nbsp;&nbsp;
                需等级：<a href="/help/grade.html" target="_blank" class="level v1"></a>
            </h3>
            <h4>
                <?php
                $btnClass = "btn";
                $nowTime = time();
                if ($data->exchange->start_time > $nowTime) {
                    $btnClass = "btn_nst";
                } elseif ($data->exchange->end_time <= $nowTime) {
                    $btnClass = "btn_ed";
                }
                ?>
                <input type="button" value="" class="<?php echo $btnClass; ?>" id="J_welfare">
                <span></span>
                <em>(当前库存<a  id='exchange_sale_num'><?php echo ($data->exchange->num - $data->exchange->sale_num); ?></a>件)</em></h4>
            <p></p>
            <script language="javascript">
                $("#J_welfare").click(function() {
                    if ($(this).hasClass("btn_ed")) {
                        return false;
                    }

                    $.ajax({
                        url: "<?php echo Yii::app()->createUrl("exchange/DoExchange", array('id' => $params['goodsId'])); ?>",
                        type: "POST",
                        cache: false,
                        dataType: "json",
                        success: function(data) {
                            if (data.status == false) {
                                alert(data.message);
                            } else if (data.status == true) {
                                alert(data.message);
                                window.location.href = "";
                            }
                            if (data.location != undefined && $.trim(data.location) != "") {
                                window.location.href = data.location;
                            }
                        },
                        error: function(d) {
                            alert(d);
                        },
                    });
                });
            </script>
        </div>
        <?php
        $page = Yii::app()->request->getQuery("page");
        ?>
        <div class="Commodity">
            <div class="tit">
                <h3 <?php echo empty($page) ? "class='current'" : ""; ?> onclick="setTab('qh', 1, 2)" id="qh1">兑奖规则</h3>
                <h3 <?php echo!empty($page) && $page > 0 ? "class='current'" : ""; ?> onclick="setTab('qh', 2, 2)" id="qh2">兑换记录(<em><?php echo $data->logList['pager']->getItemCount(); ?></em>)</h3>
            </div>
            <div <?php echo empty($page) ? "" : "style='display:none'"; ?> class="con_x" id="con_qh_1">
                <div class="blockCJ">
                    <strong>兑换礼品规则</strong>
                    1、活动开始后，所有注册会员均可点击“我要兑换”按钮进行礼品兑换       <br>
                    2、为了更好的回馈金折会员，所有礼品不收取任何费用，我们包邮为您送到家      <br>
                    3、兑换礼品需要花费相应的积分，积分不足不能兑换      <br>
                    4、一旦兑换即扣除相应积分，所兑换的礼品将在后台审核后发出。如审核过程中发现该用户积分行为异常，兑换礼品将不予发放，已扣除积分不退还。如该用户恶意积分行为严重，我们保留不另行通知而直接封禁该用户账号的权利。<br>

                    <strong>注意事项</strong>
                    1、金折内部员工禁止参加积分兑换中的任何兑换活动      <br>
                    2、数量有限，请先登录账号再进行兑换，这样才能快人一步      <br>
                    3、请准确填写<a target="_blank" href="<?php echo Yii::app()->createUrl('user/address');?>">收货地址</a>和电话,如因填写的地址或电话有误导致的快递丢失,积分不退    <br>
                    4、积分兑换中的礼品，一经换出不予退换<br>
                    5、金折网有权在活动未开始前对活动信息进行更改，活动信息以兑换活动开始后的为准。
                </div>
            </div>
            <div <?php echo!empty($page) && $page > 0 ? "" : "style='display:none'"; ?> class="con_x" id="con_qh_2">
                <?php
                $this->renderPartial('exchangeLogList', array('logList' => $data->logList));
                ?>
            </div>
        </div>
    </div>
    <span class="clear"></span>
</div>
<?php $this->renderPartial('//site/side'); ?>

<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
