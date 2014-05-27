<div id="content" class="wp">
    <div class="relief_bg">
        <div class="relief_l">
            <div class="relief_r">
                <div class="tips_l"><img width="200" height="200" src="/assets/images/bg.png"></div>
                <div class="tips_r jihuo">
                    <div class="tit">
                        <strong style='width:100%;'>温馨提示！</strong>为保证您的账号安全，需先绑定手机才能继续参与积分活动。
                    </div>
                    <div class="tips_jh" style="text-align: left;">
                        <div class="reg_box ">
                            <div class="item">
                                <label><em>*</em>手机号：</label>
                                <input type="text" class="itext1" id="mobil">
                                <span class="i_codeP">
                                    <input class="sendBtn" url="<?php echo Yii::app()->createUrl("user/sendMobileBindSmsCode") ?>" type="button" data-send="true" value="发送短信验证码"/>
                                </span>
                            </div>
                            <div class="item i_code">
                                <label><em>*</em>校验码：</label>
                                <input type="text" class="itext2" id="validCodeP">
                            </div>
                            <div class="item i_txt">
                                <input type="button" class="submit" id="reg_submit_i" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
