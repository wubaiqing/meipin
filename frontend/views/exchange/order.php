<div id="confirm_exchange" class="exchange contentA">
    <div id="address" class="address ">
        <?php

        ?>
        <h2><span></span>收货人信息</h2>
        <div class="toptxt" id="address_show_area" style="<?php echo $data['userAddress']->id > 0 ? 'display: block;' : 'display:none;' ?>">
            <p>

                <?php
                if (isset($data['userAddress']->id) && !empty($data['userAddress']->id)):
                    echo $data['province'][$data['userAddress']->province] . "-" . $data['city'][$data['userAddress']->city_id] . "-" . $data['userAddress']->address;
                endif;
                ?>
            </p>
            <p >
                <a class="modify_address" href="javascript:void(0)" >修改收货地址</a>
            </p>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', [
            'id' => 'address-form',
            'action' => Yii::app()->createUrl("user/ajaxUserAddressSave"),
            'enableClientValidation' => false,
            'clientOptions' => [
                'validateOnSubmit' => true,
            ]
        ]);
        ?>
        <ul class=" modify_form" style="<?php echo $data['userAddress']->id > 0 ? 'display: none;' : 'display:block;' ?>">
            <div style="margin:0;padding:0;display:inline">
                <input name="address_token" type="hidden" value="">
            </div>
            <li>
                <label><em>*</em>真实姓名：</label>
                <?php echo $form->textField($data['userAddress'], 'name', array('class' => 'text', 'maxLength' => '8')); ?>
            </li>
            <li>
                <label><em>*</em>收货地址：</label>
                <?php echo $form->dropDownList($data['userAddress'], 'province', $data['province'], array('id' => 'userProvince', 'empty' => '请选择')); ?>
                &nbsp;&nbsp;
                <?php echo $form->dropDownList($data['userAddress'], 'city_id', $data['city'], array('id' => 'userCity', 'empty' => '请选择')); ?>
                &nbsp;&nbsp;
                <?php echo $form->textField($data['userAddress'], 'address', array('class' => 'text', 'maxLength' => '100')); ?>

            </li>
            <li>
                <label><em>*</em>手机号码：</label>
                <?php echo $form->textField($data['userAddress'], 'mobile', array('class' => 'text', 'maxLength' => '15')); ?>
            </li>
            <li>
                <label>邮政编码：</label>
                <?php echo $form->textField($data['userAddress'], 'postcode', array('class' => 'text', 'maxLength' => '10')); ?>
            </li>
            <li class="tj">
                <label>&nbsp;</label>
                <input class="btn" id="address_save_btn" type="button" value="">
            </li>

        </ul>
        <?php $this->endWidget(); ?>
    </div>
    <div class="paycls">
        <h2><span></span>支付及配送方式</h2>
        <p>
            <em>0元包邮</em>
            <strong>1.</strong>为了更好的回馈折会员，所有礼品不收取任何费用，我们包邮为您送到家<br>
            <strong>2.</strong>由于参与兑换的人数较多，工作人员会在兑换成功后的15-20个工作日内将礼品发出<br>
            <strong>3.</strong>兑换成功后您可以到 <strong>个人中心</strong> &gt; <strong>我的礼品</strong> 中根据快递单号查看您的订单配送情况
        </p>
    </div>
    <div class="confcls">
        <h2><span></span>确认订单信息</h2>
        <form accept-charset="UTF-8" action="<?php echo Yii::app()->createUrl("exchange/doExchange"); ?>" method="post" onsubmit="return validOrderConfirm();">
            <div class="gift">
                <p><span>礼品详情</span><span>花费积分</span></p>
                <div class="">
                    <dl class="ginfo">
                        <dt>
                        <?php
                        echo CHtml::hiddenField("Exchange[token]", $params['token']);
                        echo CHtml::hiddenField("Exchange[goods_id]", Des::encrypt($data['exchange']->id));
                        echo CHtml::hiddenField("Exchange[city_id]", $data['userAddress']->city_id);
                        $goodsUrl = Yii::app()->createUrl('exchange/exchangeIndex', array('id' => Des::encrypt($data['exchange']->id)));
                        ?>
                        <a href="<?php echo $goodsUrl; ?>" target="_blank">
                            <img src="<?php echo $data['exchange']->img_url; ?>">
                        </a>
                        </dt>
                        <dd>
                            <span class="maxh40"><a target="_blank" href="<?php echo $goodsUrl; ?>"><?php echo $data['exchange']->name; ?></a></span>
                        </dd>
                    </dl>
                    <dl class="jifn">
                        <dt><em><?php echo $data['exchange']->integral; ?></em><span></span></dt>
                        <dd>提示：兑换礼品后您将减少<?php echo $data['exchange']->integral; ?>积分，一旦兑换成功，积分将不退还！请确定喜欢此礼品再兑换</dd>
                    </dl>
                </div>
            </div>
            <div class="jadinfo" data-must_memo="0" data-memo="">
                <span>备注信息：<input id="memo" name="Exchange[remark]" type="text"></span>
                <input class="welfare_btn" type="submit" address_id="<?php echo Des::encrypt($data['userAddress']->id)?>" value="">
            </div>
        </form>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
</div>
<input type="hidden" id="getProvinceUrl" value="<?php echo $this->createAbsoluteUrl('userAddress/getProvince') ?>" />
<?php
    echo Chtml::hiddenField("loginUrl",Yii::app()->createAbsoluteUrl("user/login"));
?>
<script type="text/javascript">
    $(".modify_address").click(function () {
        $(".modify_form").show();
    })
    $("#address_save_btn").click(function () {
        $(".error").remove();
        if ($.trim($("#UsersAddress_name").val()) == "") {
            $("#UsersAddress_name").after("<span class='error'>请填写收货人姓名</span>")

            return false;
        }
        if ($.trim($("#userProvince").val()) == ""||$.trim($("#userProvince").val()) == "请选择") {
            $("#UsersAddress_address").after("<span class='error'>请选择你收货的省份</span>")

            return false;
        }
        if ($.trim($("#userCity").val()) == ""||$.trim($("#userCity").val()) == "请选择") {
            $("#UsersAddress_address").after("<span class='error'>请选择你收货的城市</span>")

            return false;
        }
        if ($.trim($("#UsersAddress_address").val()) == "") {
            $("#UsersAddress_address").after("<span class='error'>请填写详细地址</span>")

            return false;
        }
        var url = $("#address-form").attr("action");
        var params = $("#address-form").serialize();
        $.post(url, params, function (d) {
            if (!d.data.isLogin) {
                location.href = $("#loginUrl").val();
            } else if (d.status) {
                $("#address_show_area").show();
                $(".welfare_btn").attr("address_id",d.data.address_id);
                var address = $("#userProvince").find("option:selected").text()+"-"+$("#userCity").find("option:selected").text()+"-"+$("#UsersAddress_address").val();
                $("#address_show_area").children("p").first().html(address);
                $(".modify_form").hide();
            }

        });
    });
    User.Address.changeProvince();

    function validOrderConfirm()
    {
        if ($(".welfare_btn").attr("address_id")!= "") {
            return true;
        }
        return false;
    }
</script>
