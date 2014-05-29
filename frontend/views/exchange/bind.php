<div id="content" class="wp">
    <div class="relief_bg">
        <div class="relief_l">
            <div class="relief_r">
                <div class="tips_l"><img width="200" height="200" src="/static/images/bg.png"></div>
                <div class="tips_r jihuo">
                    <div class="tit">
                        <strong style='width:100%;'>温馨提示！</strong>为保证您的账号安全，需先绑定手机才能继续参与积分活动。
                    </div>
                    <div class="tips_jh" style="text-align: left;">
                        <form id="form-mobile-bind" accept-charset="UTF-8" action="<?php echo Yii::app()->createUrl("exchange/bind"); ?>" method="post" onsubmit="return validOrderConfirm();">
                            <div class="reg_box ">
                                <div class="item error" style="color:red;font-weight: bold;">
                                    
                                </div>
                                <div class="item">
                                    <label><em>*</em>手机号：</label>
                                    <input type="text" name="UsersAddress[mobile]" id="UsersAddress_mobile" class="itext1" id="mobil">
                                    <span class="i_codeP">
                                        <input class="sendBtn" url="<?php echo Yii::app()->createUrl("user/sendMobileBindSmsCode") ?>" type="button" data-send="true" value="发送短信验证码"/>
                                    </span>
                                </div>
                                <div class="item i_code">
                                    <label><em>*</em>校验码：</label>
                                    <input type="text" name="UsersAddress[code]" id="" maxlength="4" style="width: 50px;" class="itext2" id="validCodeP">
                                </div>
                                <div class="item i_txt">
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