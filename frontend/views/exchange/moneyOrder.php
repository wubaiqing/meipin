<?php
$name = ($data['exchange']->goods_type == 1) ? "抽奖" : "";
?>
<div id="confirm_exchange" class="exchange contentA">
    <!-- 地址信息 -->
    <?php echo $this->renderPartial('orderAddress', ['data' => $data]); ?>

    <div class="paycls">
        <h2><span></span>支付及配送方式</h2>
        <p>
            <em>0元包邮</em>
            <strong>1.</strong>为了更好的回馈折会员，所有礼品不收取任何费用，我们包邮为您送到家<br>
            <strong>2.</strong>由于参与<?php echo $name; ?>的人数较多，工作人员会在<?php echo $name; ?>成功后的15-20个工作日内将礼品发出<br>
            <strong>3.</strong><?php echo $name; ?>成功后您可以到 <strong>个人中心</strong> &gt; <strong>我的礼品</strong> 中根据快递单号查看您的订单配送情况
        </p>
    </div>
    <style>
        .exchange table th{border-bottom: 3px solid #0480be;margin-left: 2px;text-align: center;}
        .exchange table td{padding: 10px;text-align: center;}
        .exchange .confirm .order_list{border-bottom: 1px solid #0480be;float: left;padding-bottom: 10px;margin: 0 2px 0 2px;width: 99%;}

        .exchange .confirm  table td div.img{float:left;display:inline;margin-top:0;margin-left:5px;}
        .exchange .confirm  table td div.txt{float:left;display:inline;margin-top:20;margin-left:5px;text-align: left;padding:10px;}
        .exchange .confirm  table td div.txt a{color:#09c;font-weight: bold;}
        .exchange .confirm  table td div.txt em label{display: inline; color:lightslategray;font-weight: bold;}
        .exchange .confirm  table td div.txt em span{display: inline; color:darkgray;}

        .exchange .confirm  table td #num{border: 1px solid #CCC;width: 70px;height: 24px;text-align: center;position: absolute;float: left;}
        .exchange .confirm  table td .jianhao,.exchange table td .jianhao_disabled{display: block;width: 10px;height: 24px;line-height: 24px;position: relative;top: -23px;left: 5px;padding-left: 5px;font-size: 16px;font-weight: bold;}
        .exchange .confirm  table td .jiahao,.exchange table td .jiahao_disabled{display: block;width: 10px;height: 24px;line-height: 24px;position: relative;top: 3px;left: 55px;padding-left: 5px;font-size: 16px;font-weight: bold;}
        .font-red{color:#e02f2f;}
        .font-bold{font-weight:bold;}
        /*.exchange .confirm  table{border-bottom: 1px solid #0480be;}*/
        .exchange .confirm  .remark{width: 100%;padding: 5px;height: 30px;}
        .exchange .confirm  .remark span.r{float: right;margin: 0 100px 0 0;}
        .confirm input.text{border: 1px solid #CCCCCC;height: 22px;line-height: 22px;text-indent: 5px;width: 350px;}
    </style>
    <div class="confirm">
        <h2><span></span>确认订单信息</h2>
        <form accept-charset="UTF-8" action="<?php echo Yii::app()->createUrl("exchange/doExchange"); ?>" method="post" onsubmit="return validOrderConfirm();" target="_blank">
            <div class="gift">
                <table>
                    <thead>
                    <th style="width:48%">礼品详情</th>
                    <th style="width:10%">单价（元）</th>
                    <th style="width:10%">数量</th>
                    <th style="width:10%">小计（元）</th>
                    <th style="width:10%">消耗积分</th>
                    <th style="width:20%">配送方式</th>
                    </thead>
                    <tbody class="">
                        <tr>
                            <td style="">
                                <?php
                                echo CHtml::hiddenField("Exchange[token]", $params['token']);
                                echo CHtml::hiddenField("Exchange[gdscolor]", $params['gdscolor']);
                                echo CHtml::hiddenField("Exchange[goodscolor]", $data['exchange']->goodscolor);
                                echo CHtml::hiddenField("Exchange[goods_id]", Des::encrypt($data['exchange']->id));
                                echo CHtml::hiddenField("Exchange[city_id]", $data['userAddress']->city_id);
                                $goodsUrl = Yii::app()->createUrl('exchange/exchangeIndex', array('id' => Des::encrypt($data['exchange']->id)));
                                ?>
                                <div class="img">
                                    <a href="<?php echo $goodsUrl; ?>" target="_blank">
                                        <img  style=""width="100" src="<?php echo $data['exchange']->img_url; ?>">
                                    </a>
                                </div>
                                <div class="txt">
                                    <a target="_blank" href="<?php echo $goodsUrl; ?>">
                                        <?php echo StringHelper::Utf8Substr($data['exchange']->name, 0, 25); ?>
                                    </a><br/>
                                    <em>
                                        <?php if (!empty($params['gdscolor'])): ?>
                                            <label>选型：</label><span><?php echo $params['gdscolor']; ?></span>
                                        <?php endif; ?>
                                    </em>
                                </div>
                            </td>
                            <td id="active_price" price="<?php echo $data['exchange']->active_price ?>"><?php echo $data['exchange']->active_price ?></td>
                            <td style="float: left;padding-top: 30px;"><?php
                                $leftNum = $data['exchange']->num - $data['exchange']->sale_num;
                                echo CHtml::textField("buyCount", $params['buyCount'], ['id' => 'num', 'limitNum' => $leftNum, 'autocomplete' => 'off']);
                                echo Chtml::link("+", "javascript:", ['class' => 'jiahao']);
                                echo Chtml::link("-", "javascript:", ['class' => 'jianhao']);
                                ?>
                            </td>
                            <td><span class="font-red font-bold" id="total_price"><?php
                                        $price = floatval($data['exchange']->active_price) * $params['buyCount'];
                                        echo number_format($price, 2);
                                        ?></span></td>
                            <td><?php echo $data['exchange']->integral ?></td>
                            <td>0元包邮</td>
                        </tr>
                    </tbody>
                </table>
                <div class="remark">
                    <span class="l">补充说明：<input id="memo" name="Exchange[remark]" max="200" class="text" type="text"></span>
                </div>
                <div class="remark">
                    <span class="r">
                        <input class="submit_ok pay_btn" type="submit" address_id="<?php echo Des::encrypt($data['userAddress']->id) ?>" value="确认购买">
                    </span>
                </div>
        </form>
    </div>
</div>
<input type="hidden" id="getProvinceUrl" value="<?php echo $this->createAbsoluteUrl('userAddress/getProvince') ?>" />
<?php
echo Chtml::hiddenField("loginUrl", Yii::app()->createAbsoluteUrl("user/login"));
?>
<script type="text/javascript">
    $(".modify_address").click(function() {
        $(".modify_form").show();
    })
    $("#address_save_btn").click(function() {
        $(".error").remove();
        if ($.trim($("#UsersAddress_name").val()) == "") {
            $("#UsersAddress_name").after("<span class='error'>请填写收货人姓名</span>");

            return false;
        }
        if ($.trim($("#userProvince").val()) == "" || $.trim($("#userProvince").val()) == "请选择") {
            $("#UsersAddress_address").after("<span class='error'>请选择你收货的省份</span>");

            return false;
        }
        if ($.trim($("#userCity").val()) == "" || $.trim($("#userCity").val()) == "请选择") {
            $("#UsersAddress_address").after("<span class='error'>请选择你收货的城市</span>");

            return false;
        }
        if ($.trim($("#UsersAddress_address").val()) == "") {
            $("#UsersAddress_address").after("<span class='error'>请填写详细地址</span>");

            return false;
        }
        var mobile = $("#UsersAddress_mobile").val();
        var url = $("#address-form").attr("action");
        var params = $("#address-form").serialize();
        $(".error").remove();
        $.post(url, params, function(d) {
            $(".error").remove();
            if (!d.data.isLogin) {
                location.href = $("#loginUrl").val();
            } else if (d.status) {
                //显示拼接地址
                $("#address_show_area").show();
                $(".welfare_btn").attr("address_id", d.data.address_id);
                var address = $("#userProvince").find("option:selected").text() + "-" + $("#userCity").find("option:selected").text() + "-" + $("#UsersAddress_address").val();
                $("#address_show_area").children("p").first().html(address);
                $(".modify_form").hide();
                $("#li_mobile").html(mobile + "<em class='c_red'>(电话已与系统绑定)</em>");
                $("#li_code").remove();
            } else {
                var errors = d.data.errors;
                for (key in errors) {
                    $("#UsersAddress_" + key).after("<span class='error' style='color:red;'>" + errors[key] + "</span>")
                }
            }

        });
    });
    User.Address.changeProvince();
    User.Address.sendMobileBindSmsCode();

    function validOrderConfirm()
    {
        if ($(".welfare_btn").attr("address_id") != "") {
            return true;
        }

        return false;
    }
</script>
