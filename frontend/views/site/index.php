
<?php $this->renderPartial('login'); ?>
<?php $this->renderPartial('head'); ?>
<?php $this->renderPartial('nav_person', array('cat' => $cat)); ?>
<?php $this->renderPartial('nav', array('cat' => $cat)); ?>

<?php
    if ($cat < 1 && $page < 2) {
        $this->renderPartial('banner');
    }
?>

<div id="content" class="wp">
    <?php $this->renderPartial('menuWp', array('pager' => $pager)); ?>
    <?php $this->renderPartial('content', array('goods' => $goods,'exchange'=>$exchange,'brand'=>$brand)); ?>
    <?php $this->renderPartial('page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
</div>
<?php $this->renderPartial('right'); ?>

<div id="footer" class="footer">
    <?php $this->renderPartial('footer'); ?>
</div>
