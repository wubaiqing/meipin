<div id="content" class="wp">
    <div class="relief_bg">
        <div class="relief_l">
            <div class="relief_r">
                <div class="tips_l"><img src="/static/images/<?php echo $status;?>.png"></div>
                <div class="tips_r jihuo">
                    <?php echo $message;?>
                    <div class="tips_jh">
                        <p class="msg_btnleft"><a href="<?php echo isset($url) && !empty($url) ? $url : "javascript:history.back(-1);"?>">如果您的浏览器没有自动跳转，请点击此链接</a></p>
                    </div>
                    <script language="javascript">
                        setTimeout("location.href='<?php echo isset($url) && !empty($url) ? $url : "javascript:history.back(-1);"?>';",1*1000);
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
