<div id="content" class="wp">
    <div class="relief_bg">
        <div class="relief_l">
            <div class="relief_r">
                <div class="tips_l"><img src="/assets/images/<?php echo $status; ?>.png"></div>
                <div class="tips_r jihuo">
                    <?php echo $$title; ?>
                    <div class="tips_jh">
                        <?php if (!empty($url)): ?>
                            <p class="msg_btnleft"><a href="javascript:location.href=<?php $url?>;">如果您的浏览器没有自动跳转，请点击此链接</a></p>
                            <script language="javascript">
                                setTimeout("location.href='javascript:location.href=<?php $url?>;';", 3 * 1000);
                            </script>
                        <?php else: ?>
                            <p class="msg_btnleft"><a href="javascript:history.back(-1);">如果您的浏览器没有自动跳转，请点击此链接</a></p>
                            <script language="javascript">
                                setTimeout("location.href='javascript:history.back(-1);';", 3 * 1000);
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
