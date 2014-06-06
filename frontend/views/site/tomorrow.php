
<?php $this->renderPartial('login'); ?>
<?php $this->renderPartial('head'); ?>
<?php $this->renderPartial('nav', array('cat' => $cat)); ?>
<?php $this->renderPartial('junav', array('cat' => $cat, 'hot' => $hot)); ?>

<?php
    if ($cat < 1 && $page < 2) {
        $this->renderPartial('banner');
    }
?>

<div id="content" class="wp">
    <?php $this->renderPartial('tomorrowWp', array('pager' => $pager)); ?>
    <?php $this->renderPartial('content', array('goods' => $goods)); ?>
    <?php $this->renderPartial('page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
</div>
<div id="footer" class="footer">
    <?php $this->renderPartial('footer'); ?>
</div>
