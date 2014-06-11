<div id="contentA" class="contentA">
    <div class="left">
        <div class="pt">
            <img src="<?php echo $data['exchange']->img_url; ?>">
            <span class="bsr"></span>
        </div>
        <div class="blockA">
            <h2>热门兑换活动</h2>
            <ul>
                <?php
                foreach ($data['hotExchangeGoods'] as $goods):
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
    </div>

    <div class="right dhdeal">
        <form action="<?php echo Yii::app()->createUrl("exchange/order") ?>" method="POST" <?php if ($data['exchange']->goodscolor): ?> onsubmit="return checkcolor()" <?php endif; ?> >
            <?php
            $start = "zt3";
            if ($data['exchange']->start_time > time()) {
                $start = "zt1";
            } elseif ($data['exchange']->start_time < time() && $data['exchange']->end_time > time()) {
                $start = "zt2";
            }
            ?>
            <div class="deal <?php echo $start ?>">
                <h2>
                    <span><?php echo $data['exchange']->name; ?></span>
                </h2>
                <h3>
                    <span>所需积分</span><em><?php echo $data['exchange']->integral; ?></em>积分<br>
                    <span>价值&nbsp;&nbsp;&nbsp;&nbsp;</span><strong><i>&nbsp;&nbsp;&nbsp;￥</i><?php echo $data['exchange']->price; ?></strong><br>
                    <span>兑奖名额</span><b><?php echo $data['exchange']->num; ?></b><br/>
                    <?php if ($data['exchange']->goodscolor): ?>
                        <span class='goodcolor'>

                            <?php foreach ($data['exchange']->goodscolor as $key => $value): ?>

                                <a <?php
                                if ($value['gdcolornum'] == 0) {
                                    echo "class='be' stock='0' ";
                                } else {
                                    echo 'stock=' . $value["gdcolornum"] . '';
                                }
                                ?>  href="javascript:void(0)"><?php echo $value['gdcolorname'] . "({$value['gdcolornum']})"; ?></a>
                                <?php endforeach; ?>

                        </span>
                    <?php endif; ?>
                </h3>
                <h4>
                    <?php echo CHtml::hiddenField("gdcolor", '', array('id' => 'gdcolor')); ?>
                    <?php echo CHtml::hiddenField("id", $params['goodsId']); ?>
                    <input class="btn" type="submit" value=""><span></span>
                    <a class="hasbd" href="javascript:void(0);"><?php echo $data['exchange']->user_count ?>人已兑换</a>
                    <em>(当前库存<b><?php
                            $leftNum = $data['exchange']->num - $data['exchange']->sale_num;
                            echo $leftNum > 0 ? $leftNum : 0;
                            ?></b>件)</em>
                </h4>
            </div>
        </form>
        <?php
        $page = Yii::app()->request->getQuery("page");
        ?>
        <div class="J_TabBarWrap clear l">
            <ul class="tb-tabbar">
                <li id="exchangerule" class=' <?php echo empty($page) ? "selected" : ""; ?>'>
                    <a href="javascript:void(0)" hidefocus="true">兑奖规则</a>
                </li>
                <li id="recordstab" class='<?php echo!empty($page) && $page > 0 ? "selected" : ""; ?>'>
                    <a href="javascript:void(0)" hidefocus="true">兑换记录(<em><?php echo $data['logList']['pager']->getItemCount(); ?></em>)</a>
                </li>
            </ul>
        </div>

        <div class="l displayIF exchangerule <?php echo empty($page) ? "" : "hid"; ?>" id="">
            <div class="topinfo"></div>
            <div class="blockCJ ">
                <strong>兑换礼品规则</strong>
                1、活动开始后，所有注册会员均可点击“我要兑换”按钮进行礼品兑换       <br>
                2、为了更好的回馈美品网会员，所有礼品不收取任何费用，我们包邮为您送到家      <br>
                3、兑换礼品需要花费相应的积分，积分不足不能兑换      <br>
                4、一旦兑换即扣除相应积分，所兑换的礼品将在后台审核后发出。如审核过程中发现该用户积分行为异常，兑换礼品将不予发放，已扣除积分不退还。如该用户恶意积分行为严重，我们保留不另行通知而直接封禁该用户账号的权利。<br>

                <strong>注意事项</strong>
                1、美品网内部员工禁止参加积分兑换中的任何兑换活动      <br>
                2、数量有限，请先登录账号再进行兑换，这样才能快人一步      <br>
                3、请准确填写<a target="_blank" href="<?php echo Yii::app()->createUrl('user/address'); ?>">收货地址</a>和电话,如因填写的地址或电话有误导致的快递丢失,积分不退    <br>
                4、积分兑换中的礼品，一经换出不予退换<br>
                5、美品网有权在活动未开始前对活动信息进行更改，活动信息以兑换活动开始后的为准。
            </div>
        </div>
        <div class="l  displayIF recordstab <?php echo!empty($page) && $page > 0 ? "" : "hid"; ?>" id="records" >
            <div class="topinfo"></div>
            <div class="uslist">
                <?php
                $this->renderPartial('exchangeLogList', array('logList' => $data['logList']));
                ?>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(function() {
        try {
            $(".tb-tabbar").find("li").click(function() {
                $(".tb-tabbar").find("li").removeClass("selected");
                $(this).addClass("selected");
                $(".displayIF").addClass('hid');
                $("." + $(this).attr("id")).removeClass("hid");
            });
        } catch (e) {
            alert(e);
        }
        $('.goodcolor').find("a").click(function() {

            gdcolornum = $(this).attr("stock");
            if (gdcolornum != 0) {
                $(".goodcolor a").attr("style", '');
                gdcolor = $(this).html(); //颜色
                $(this).attr("style", "border: 2px solid red");
                $("#gdcolor").val(gdcolor);
            }
        });
    });
    function checkcolor()
    {
        if ($("#gdcolor").val() == '')
        {
            alert('请选择一个型号');
            return false;
        }
        return true;
    }
</script>
