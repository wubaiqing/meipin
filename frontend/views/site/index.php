<div id="header">
    <?php $this->renderPartial('prompt'); ?>
    <?php $this->renderPartial('login'); ?>
    <?php $this->renderPartial('head'); ?>
    <?php $this->renderPartial('nav'); ?>
</div>

<?php
    if ($cat < 1) {
        $this->renderPartial('banner');
    }
?>

<div id="content" class="wp">
    <?php $this->renderPartial('menu', array('cat' => $cat)); ?>
    <?php $this->renderPartial('menuWp', array('count' => $count)); ?>
    <?php $this->renderPartial('content', array('goods' => $goods)); ?>
    <?php $this->renderPartial('page'); ?>
</div>

<?php $this->renderPartial('side'); ?>

<div id="footer" class="footer">
    <?php $this->renderPartial('footer'); ?>
</div>
