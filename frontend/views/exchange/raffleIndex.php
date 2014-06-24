<div id="contentA" class="contentA">
    <div class="left">
        <div class="pt">
            <img src="<?php echo $data['exchange']->img_url; ?>">
            <span class="bsr"></span>
        </div>
        <?php
        $this->renderPartial('hotExchange', array('goodsList' => $data['hotExchangeGoods'], 'goodsType' => $data['exchange']->goods_type));
        ?>

    </div>

    <div class="right dhdeal">
        <form action="<?php echo Yii::app()->createUrl("exchange/order") ?>" method="POST" <?php if ($data['exchange']->goodscolor): ?> onsubmit="return checkcolor()" <?php endif; ?> >
            <?php
            $start = "zt7";
            if ($data['exchange']->start_time > time()) {
                $start = "zt1";
            } elseif ($data['exchange']->start_time < time() && $data['exchange']->end_time > time()) {
                $start = "zt5";
            }
            ?>
            <div class="deal <?php echo $start ?>">
                <h2>
                    <span><?php echo $data['exchange']->name; ?></span>
                </h2>
                <h3>
                    <span>所需积分</span><em><?php echo $data['exchange']->integral; ?></em>积分<br>
                    <span>价值&nbsp;&nbsp;&nbsp;&nbsp;</span><strong><i>&nbsp;&nbsp;&nbsp;￥</i><?php echo $data['exchange']->price; ?></strong><br>
                    <span>中奖名额</span><b><?php echo $data['exchange']->limit_count; ?></b><br/>
                    <span class="time" date="<?php echo date("Y-m-d H:i:s",$data['exchange']->end_time)?>">距离抽奖结束：<i>8</i>天<label><em class="one">19</em><em class="two">20</em><em class="three">38</em></label></span>
                </h3>
                <h4>
                    <?php echo CHtml::hiddenField("gdcolor", '', array('id' => 'gdcolor')); ?>
                    <?php echo CHtml::hiddenField("id", $params['goodsId']); ?>
                    <?php echo CHtml::hiddenField("goods_type", $data['exchange']->goods_type); ?>
                    <input class="btn" type="submit" value=""><span></span>
                    <a class="hasbd" href="javascript:void(0);"><?php echo $data['exchange']->user_count ?>人已参与</a>
                </h4>
                <div class="blockA" >
                    <h2>中奖名单
                    <ul class="">
                        <?php foreach($winnerList as $winner):?>
                        <li><?php echo "<b>".$winner->username."</b>&nbsp;于".date("Y年m月d日",$winner->created_at)."中奖";?> </li>
                        <?php endforeach;?>
                    </ul>
                    </h2>
                </div>
            </div>
        </form>
        <?php
        $page = Yii::app()->request->getQuery("page");
        ?>
        <div class="J_TabBarWrap clear l">
            <ul class="tb-tabbar">
                <li id="exchangerule" class=' <?php echo empty($page) ? "selected" : ""; ?>'>
                    <a href="javascript:void(0)" hidefocus="true">抽奖规则</a>
                </li>
                <li id="recordstab" class='<?php echo!empty($page) && $page > 0 ? "selected" : ""; ?>'>
                    <a href="javascript:void(0)" hidefocus="true">抽奖记录(<em><?php echo $data['logList']['pager']->getItemCount(); ?></em>)</a>
                </li>
            </ul>
        </div>

        <div class="l displayIF exchangerule <?php echo empty($page) ? "" : "hid"; ?>" id="">
            <div class="topinfo"></div>
            <div class="blockCJ ">
                <p class="cj"></p>
                <strong>抽奖礼品规则</strong>
                1、活动开始后，所有注册会员均可点击“我要抽奖”按钮进行礼品抽奖       <br>
                2、为了更好的回馈美品网会员，所有礼品不收取任何费用，我们包邮为您送到家      <br>
                3、抽奖礼品需要花费相应的积分，积分不足不能抽奖      <br>
                4、一旦抽奖即扣除相应积分，所抽奖的礼品将在后台审核后发出。如审核过程中发现该用户积分行为异常，抽奖礼品将不予发放，已扣除积分不退还。如该用户恶意积分行为严重，我们保留不另行通知而直接封禁该用户账号的权利。<br>

                <strong>注意事项</strong>
                1、美品网内部员工禁止参加积分抽奖中的任何抽奖活动      <br>
                2、数量有限，请先登录账号再进行抽奖，这样才能快人一步      <br>
                3、请准确填写<a target="_blank" href="<?php echo Yii::app()->createUrl('user/address'); ?>">收货地址</a>和电话,如因填写的地址或电话有误导致的快递丢失,积分不退    <br>
                4、积分抽奖中的礼品，一经换出不予退换<br>
                5、美品网有权在活动未开始前对活动信息进行更改，活动信息以抽奖活动开始后的为准。
            </div>
        </div>
        <div class="l  displayIF recordstab <?php echo!empty($page) && $page > 0 ? "" : "hid"; ?>" id="records" >
            <div class="topinfo"></div>
            <div class="uslist">
                <?php
                $this->renderPartial('exchangeLogList', array('logList' => $data['logList'], 'goodsType' => $data['exchange']->goods_type));
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //倒计时
    $("span.time").each(function(i) {
        var str = $(this).attr("date").toString();
        str = str.replace(/-/g, "/");
        var d = new Date(str);
        fnTimeCountDown(d, this, null,'detail');
    });
</script>