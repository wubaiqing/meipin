<div id="header">
    <?php $this->renderPartial('//site/prompt'); ?>
    <?php $this->renderPartial('//site/login'); ?>
    <?php $this->renderPartial('//site/head'); ?>
    <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>

<div id="content" class="wp">
    <?php $this->renderPartial('//site/menu', array('cat' => 0)); ?>
    <?php $this->renderPartial('//site/menuWp', array('pager' => $pager)); ?>
    <?php $this->renderPartial('//site/content', array('goods' => $goods)); ?>
    <?php $this->renderPartial('//site/page', array('pager' => $pager)); ?>
</div>

<?php $this->renderPartial('//site/side'); ?>

<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
