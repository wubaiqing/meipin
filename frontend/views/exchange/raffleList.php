
<?php $this->renderPartial('login'); ?>
<?php $this->renderPartial('head'); ?>
<?php $this->renderPartial('nav_person', array('cat' => $cat)); ?>
<?php $this->renderPartial('nav', array('cat' => $cat)); ?>
<?php // $this->renderPartial('junav', array('cat' => $cat, 'hot' => $hot)); ?>

<?php
    if ($cat < 1 && $page < 2) {
        $this->renderPartial('banner');
    }
?>

<div id="content" class="wp">
    <?php $this->renderPartial('/exchange/menuWpRaffle', array('pager' => $pager,'history'=>$history)); ?>
    <?php $this->renderPartial('/exchange/raffleContent', array('goods' => $goods,'cat'=>$cat,'history'=>$history)); ?>
    <?php $this->renderPartial('page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
</div>

<?php // $this->renderPartial('side'); ?>
<?php $this->renderPartial('right'); ?>

<div id="footer" class="footer">
    <?php $this->renderPartial('footer'); ?>
</div>
