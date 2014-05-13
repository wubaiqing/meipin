<div id="header">
    <?php // $this->renderPartial('//site/prompt'); ?>
    <?php // $this->renderPartial('//site/login'); ?>
    <?php // $this->renderPartial('//site/head'); ?>
    <?php // $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>

<div id="contentA" class="area">
    <div class="left">
        <div class="pt">
            <img src="<?php echo $data->exchange->img_url; ?>">
            <span class="bsr"></span>
        </div>
        <div class="blockA">
            <h2>热门兑换活动...</h2>
            <ul>
                <?php
                foreach ($data->hotExchangeGoods as $goods):
                    $goodsUrl = Yii::app()->createUrl("exchange/exchangeIndex", array("id" => Des::encrypt($goods->id)));
                    ?>
                    <li>
                        <a href="<?php echo $goodsUrl; ?>" target="_blank">
                            <img src="<?php echo $goods->img_url ?>">
                        </a>
                        <h3>
                            <a href="<?php echo $goodsUrl; ?>" target="_blank" title="<?php echo $goods->name; ?>">
                                <?php echo $goods->name; ?>
                            </a>
                        </h3>
                        <p><strong><?php echo $goods->user_count; ?></strong>人已参与</p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>


<!--        <div class="blockB">
            <h2>谁兑换了礼品？</h2>
            <ul class="clear">
                <li>
                    <a href="http://www.tuan800.com/user/给生活松绑" target="_blank">
                        <img alt="给生活松绑" src="http://p12.tuanimg.com/user/avatar/0391/0509/small/9a2ece48-9bb4-4d74-96a0-b2e3a27ea9b6.jpg" title="给生活松绑">
                    </a>
                </li>
            </ul>
        </div>-->
    </div>

    <div class="right dhdeal">
        <form action="<?php echo Yii::app()->createUrl("exchange/order")?>" method="post">
            <?php
                $start = "zt3";
                if($data->exchange->start_time > time()){
                    $start = "zt1";
                }else if($data->exchange->start_time < time() && $data->exchange->end_time > time()){
                     $start = "zt2";
                }
            ?>
            <div class="deal <?php echo $start?>" info="d,129424,1400115600000,1398753000000,2" id="deal129424">
                <input name="id" type="hidden" value="129424">
                <input name="url_name" type="hidden" value="0yuanbaoyo_129424">
                <h2>
                    <span><?php echo $data->exchange->name; ?></span>
                </h2>
                <h3>
                    <span>所需积分</span><em><?php echo $data->exchange->integral; ?></em>积分<br>
                    <span>价值</span><strong><i>￥</i><?php echo $data->exchange->price; ?></strong><br>
                    <span>兑奖名额</span><b><?php echo $data->exchange->num; ?></b>
                </h3>
                <!--<h5><b>剩余时间</b><i>2</i>天<em class="one">13</em> 小时 <em class="two">33</em> 分钟 <em>31</em> 秒</h5>-->
                <h4>
                    <?php echo CHtml::hiddenField("id",$params['goodsId']);?>
                    <input class="btn" type="submit" value=""><span></span>
                    <a class="hasbd" href="javascript:void(0);"><?php echo $data->exchange->user_count ?>人已兑换</a>
                    <em>(当前库存<b><?php
                            $leftNum = $data->exchange->num - $data->exchange->sale_num;
                            echo $leftNum > 0 ? $leftNum : 0;
                            ?></b>件)</em>
                </h4>
            </div>
        </form>
        <script type="text/javascript">
            $(".tb-tabbar").find("li").live("click", function() {
                $(".tb-tabbar").find("li").removeClass("selected");
                $(this).addClass("selected");
                $(".displayIF").addClass('hid');
                $("." + $(this).attr("id")).removeClass("hid");
            });
        </script>
        <?php
        $page = Yii::app()->request->getQuery("page");
        ?>
        <div class="J_TabBarWrap clear l">
            <ul class="tb-tabbar">
                <li id="exchangerule" <?php echo empty($page) ? "class='selected'" : ""; ?>>
                    <a href="javascript:void(0)" hidefocus="true">兑奖规则</a>
                </li>
                <li id="recordstab" <?php echo!empty($page) && $page > 0 ? "class='selected'" : ""; ?>>
                    <a href="javascript:void(0)" hidefocus="true">兑换记录(<em><?php echo $data->logList['pager']->getItemCount(); ?></em>)</a>
                </li>
            </ul>
        </div>

        <div class="l displayIF exchangerule <?php echo empty($page) ? "" : "hid"; ?>" id="">
            <div class="topinfo"></div>
            <div class="blockCJ ">
                <strong>兑换礼品规则</strong>
                1、活动开始后，所有注册会员均可点击“我要兑换”按钮进行礼品兑换       <br>
                2、为了更好的回馈金折会员，所有礼品不收取任何费用，我们包邮为您送到家      <br>
                3、兑换礼品需要花费相应的积分，积分不足不能兑换      <br>
                4、一旦兑换即扣除相应积分，所兑换的礼品将在后台审核后发出。如审核过程中发现该用户积分行为异常，兑换礼品将不予发放，已扣除积分不退还。如该用户恶意积分行为严重，我们保留不另行通知而直接封禁该用户账号的权利。<br>

                <strong>注意事项</strong>
                1、金折内部员工禁止参加积分兑换中的任何兑换活动      <br>
                2、数量有限，请先登录账号再进行兑换，这样才能快人一步      <br>
                3、请准确填写<a target="_blank" href="<?php echo Yii::app()->createUrl('user/address'); ?>">收货地址</a>和电话,如因填写的地址或电话有误导致的快递丢失,积分不退    <br>
                4、积分兑换中的礼品，一经换出不予退换<br>
                5、金折网有权在活动未开始前对活动信息进行更改，活动信息以兑换活动开始后的为准。
            </div>
        </div>
        <div class="l  displayIF recordstab <?php echo!empty($page) && $page > 0 ? "" : "hid"; ?>" id="records" >
            <div class="topinfo"></div>
            <div class="uslist">
                <?php
                $this->renderPartial('exchangeLogList', array('logList' => $data->logList));
                ?>
            </div> 
        </div>
    </div>

</div>


<?php $this->renderPartial('//site/side'); ?>
<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
