<div id="content" class="wp">
    <div class="relief_bg">
        <div class="relief_l">
            <div class="relief_r">
                <div class="tips_l"><img src="/static/images/<?php echo $status; ?>.png"></div>
                <div class="tips_r jihuo">
                    <?php echo $title; ?><br/><br/>
                    <div class="" style="color:#898a8c;font-size: 24px;text-align: left;padding-left: 100px;">
                        <?php if ($status =='yes'): ?>
                            <p class="msg_btnleft" >
                                温馨提示：小编会在3个工作日内给您发货，请注意查收！<br/>
                                您可以在 <a href="<?php echo Yii::app()->createAbsoluteUrl("score/index")?>">个人中心</a>>
                                <a href="<?php echo Yii::app()->createAbsoluteUrl("order/list")?>">我的订单</a>查看您的兑换记录。
                            </p>
                        <?php else: ?>
                            <p class="msg_btnleft">
                                <a href="javascript:" onclick="window.opener=null;window.close()">关闭本页</a>，您可以在
                                <a href="<?php echo Yii::app()->createAbsoluteUrl("score/index")?>">个人中心</a>>
                                <a href="<?php echo Yii::app()->createAbsoluteUrl("order/list")?>">我的订单</a>
                                中继续支付.
                            </p>
                        <?php endif; ?>
                            <p>
                                系统将在<span style="color:red;">5</span>秒后跳转到订单列表页！
                            </p>
                            <script language="javascript">
                                setTimeout("location.href='<?php echo Yii::app()->createAbsoluteUrl("order/list") ?>';", 5*1000);
                            </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
