<div id="header">
    <?php $this->renderPartial('//site/prompt'); ?>
    <?php $this->renderPartial('//site/login'); ?>
    <?php $this->renderPartial('//site/head'); ?>
    <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>
<link rel="stylesheet" type="text/css" href="http://www.vip800.com/data/static/e23697d66d5f0990a6ed6607344d7b37.css">
<div id="content" class="wp">
    <style type="text/css">
        #contentA {
            background: #fff url(images/bg-y.png) repeat-y;
            padding-bottom: 50px;
        }
        #contentA .left .pt {
            width: 290px;
            padding: 20px;
            border-bottom: 1px solid #e6e6e6;
            position: relative;
        }
    </style>
    <div class="left" style="float:left">
        <div class="pt">
            <img src="http://www.vip800.com//data/upload/score_item/1309/13/5232d89a93dcb_b.jpg">
        </div>
        <div class="blockA">
            <h2>热门兑换活动...</h2>
            <ul>
                <li>
                    <a target="_blank" href="/jfsc/25.html">
                        <img src="http://www.vip800.com/data/upload/score_item/1310/30/5270a794c0bdf_s.png">
                    </a>
                    <h3><a title="全国全网手机话费充值卡20元" target="_blank" href="/jfsc/25.html">全国全网手机话费充值卡20元</a></h3>
                </li>
                <li>
                    <a target="_blank" href="/jfsc/24.html">
                        <img src="http://www.vip800.com/data/upload/score_item/1310/30/5270a776a6844_s.png">
                    </a>
                    <h3><a title="全国全网手机话费充值卡30元" target="_blank" href="/jfsc/24.html">全国全网手机话费充值卡30元</a></h3>
                </li>		</ul>
        </div>
    </div>

    <div class="right dhdeal" style="float:right">
        <div class="box2 zt2">
            <h2>
                <span>4.8超高评分正品不锈钢真空保温杯 男士女士水杯子礼品杯儿童水杯 </span>
            </h2>
            <h3>兑奖所需积分：<em>100</em>
                积分&nbsp;&nbsp;|&nbsp;&nbsp;
                价值: 70.00&nbsp;&nbsp;|&nbsp;&nbsp;
                兑奖名额<strong>10</strong>&nbsp;&nbsp;|&nbsp;&nbsp;
                需等级：<a href="/help/grade.html" target="_blank" class="level v1"></a>
            </h3>
            <h4>
                <input type="button" value="" class="btn" id="J_welfare">
                <span></span>
                <em>(当前库存10件)</em></h4>
            <p></p>
            <script language="javascript">
                $("#J_welfare").click(function() {
                    $.ajax({
                        url: "/jfsc/8.html",
                        type: "POST",
                        cache: false,
                        dataType: "json",
                        success: function($data) {
                            if ($data.status == "0") {
                                alert($data.msg);
                                return false;
                            } else if ($data.status == "2") {
                                alert($data.msg);
                                window.location = "/user/address.html";
                            } else if ($data.status == "3") {
                                commonopen();
                            } else {
                                alert("恭喜您成功兑换 4.8超高评分正品不锈钢真空保温杯 男士女士水杯子礼品杯儿童水杯 ");
                                window.location = "/user/welfare.html";
                            }
                        },
                        error: function() {
                            alert('error');
                        },
                    });
                });
            </script>
        </div>

        <div class="J_TabBarWrap clear l">
            <ul class="tb-tabbar">
                <li class="selected">
                    <a href="javascript:void(0)">兑奖规则</a>
                </li>
                <li class="" id="recordtab">
                    <a href="javascript:void(0)">兑换记录(<em>0</em>)</a>
                </li>
            </ul>
        </div>
        <div class="Commodity">
            <div class="tit"><h3 class="current" onclick="setTab('qh', 1, 2)" id="qh1">兑奖规则</h3><h3 onclick="setTab('qh', 2, 2)" id="qh2">兑换记录(<em>0</em>)</h3></div>
            <div class="con_x" id="con_qh_1">
                <div class="blockCJ">
                    <strong>兑换礼品规则</strong>
                    1、活动开始后，所有注册会员均可点击“我要兑换”按钮进行礼品兑换       <br>
                    2、为了更好的回馈金折会员，所有礼品不收取任何费用，我们包邮为您送到家      <br>
                    3、兑换礼品需要花费相应的积分，积分不足不能兑换      <br>
                    4、一旦兑换即扣除相应积分，所兑换的礼品将在后台审核后发出。如审核过程中发现该用户积分行为异常，兑换礼品将不予发放，已扣除积分不退还。如该用户恶意积分行为严重，我们保留不另行通知而直接封禁该用户账号的权利。<br>

                    <strong>注意事项</strong>
                    1、金折内部员工禁止参加积分兑换中的任何兑换活动      <br>
                    2、数量有限，请先登录账号再进行兑换，这样才能快人一步      <br>
                    3、请准确填写<a target="_blank" href="/user/address.html">收货地址</a>和电话,如因填写的地址或电话有误导致的快递丢失,积分不退    <br>
                    4、积分兑换中的礼品，一经换出不予退换<br>
                    5、金折网有权在活动未开始前对活动信息进行更改，活动信息以兑换活动开始后的为准。
                </div>
            </div>
            <div style="display:none" class="con_x" id="con_qh_2">
                <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user" style="width:100%">
                    <tbody>
                        <tr align="center">
                            <th>用户名</th>
                            <th>兑换时间</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <span class="clear"></span>
</div>
<?php $this->renderPartial('//site/side'); ?>

<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
