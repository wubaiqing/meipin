<div id="content" class="wp">
    <div class="relief_bg">
        <div class="relief_l">
            <div class="relief_r">
                <div class="tips_l"><img src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/static/<?php echo $status; ?>.png"></div>
                <div class="tips_r jihuo">
                    <?php echo $title; ?><br/><br/>
                    <div class="" style="color:#898a8c;font-size: 20px;text-align: left;padding-left: 100px;">
                        <?php if ($status == 'no'): ?>
                            <p class="msg_btnleft">
                                <a href="javascript:" onclick="window.opener = null;
                                        window.close()">关闭本页</a>，您可以在
                                <a href="<?php echo Yii::app()->createAbsoluteUrl("score/index") ?>">个人中心</a>>
                                <a href="<?php echo Yii::app()->createAbsoluteUrl("order/list") ?>">我的订单</a>
                                中继续支付.
                            </p>
                            <p class="msg_btnleft">
                                系统将在10秒后跳转到订单列表页！
                            </p>
                        <script language="javascript">
                            setTimeout("location.href='<?php echo Yii::app()->createAbsoluteUrl("order/list") ?>';", 10 * 1000);
                        </script>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
