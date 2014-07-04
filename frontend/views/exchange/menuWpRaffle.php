<div class="menu_wp">
    <div class="junav">
        <?php if ($history != 'history'): ?>
            <span>正在进行<em>(<?php echo $pager->getItemCount(); ?>)</em></span>
            <div class="new_bg r">
            </div>
            <!-- <h5>小编会从早9点到晚21点，每整点更新一次给力宝贝！</h5>  -->
            <a style="float: right;padding: 10px;" href="<?php echo Yii::app()->createUrl("site/raffle", [ 't' => 'history']) ?>">历史活动>></a>
        <?php else: ?>
            <!-- <span>历史活动<em>(<?php //echo $pager->getItemCount(); ?>)</em></span -->>
            <div class="new_bg r">
            </div>
           <!--  <h5>小编会从早9点到晚21点，每整点更新一次给力宝贝！</h5>  -->

            <a style="float: right;padding: 10px;" href="<?php echo Yii::app()->createUrl("site/raffle") ?>">正在进行>></a>
        <?php endif; ?>
    </div>
</div>
