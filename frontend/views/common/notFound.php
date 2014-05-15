<div id="header">
    <?php $this->renderPartial('//site/prompt'); ?>
    <?php $this->renderPartial('//site/login'); ?>
    <?php $this->renderPartial('//site/head'); ?>
    <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>
<div id="content" class="wp">
    <div class="search">
        <div class="txt-tips">
            <p class="txt-img"><?php echo $title; ?>~</p>
            <?php if (!empty($remark)): ?>
                <p class="txt">
                    <a href="">点击</a><?php echo $remark; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $this->renderPartial('//site/side'); ?>
<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
