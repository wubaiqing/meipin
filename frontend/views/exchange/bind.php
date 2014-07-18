<div id="content" class="wp">
    <div class="relief_bg">
        <div class="relief_l">
            <div class="relief_r">
                <div class="tips_l"><img width="200" height="200" src="/static/images/bg.png"></div>
                <div class="tips_r jihuo">
                    <div class="tit" style='font-size:14px;'>
                        <strong style='width:100%;font-size:14px;'>温馨提示！</strong>为保证您的账号安全，需先绑定手机才能继续参与积分活动。
                    </div>
                    <div class="tips_jh" style="text-align: left;">
                        <form id="form-mobile-bind" accept-charset="UTF-8" action="<?php echo Yii::app()->createUrl("exchange/bind"); ?>" method="post" onsubmit="return validOrderConfirm();">
                            <div class="reg_box ">
                                <div class="item error" style="color:red;font-weight: bold;">

                                </div>
                                <div class="item send_code">
                                    <label><em>*</em>手机号：</label>
                                    <input type="text" name="UsersAddress[mobile]" id="UsersAddress_mobile" maxlength="11" class="text" id="mobil">
                                    <span class="i_codeP">
                                        <input class="sendBtn " url="<?php echo Yii::app()->createUrl("user/sendMobileBindSmsCode") ?>" type="button" data-send="true" value="发送短信验证码" style="cursor:pointer"/>
                                    </span>
                                </div>
                                <div class="item i_code">
                                    <label><em>*</em>校验码：</label>
                                    <input type="text" name="UsersAddress[code]" id="" maxlength="4" style="width: 50px;" class="text" id="validCodeP">
                                </div>
                                <div class="item i_txt valid_code">
                                    <?php
                                    echo CHtml::hiddenField("id",$params['goodsId']);
                                    ?>
                                    <input type="button" class="submit " id="mobile_bind" value="免费绑定">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    User.Address.sendMobileBindSmsCode();
</script>
