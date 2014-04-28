<div id="header">
    <?php $this->renderPartial('prompt'); ?>
    <?php $this->renderPartial('login'); ?>
    <?php $this->renderPartial('head'); ?>
    <?php $this->renderPartial('nav'); ?>
</div>

<?php

    $cat = Yii::app()->request->getQuery('cat');
    $page = Yii::app()->request->getQuery('page');
    if ($cat < 1 && $page < 2) {
        $this->renderPartial('banner');
    }
?>

<div id="content" class="wp">
    <?php $this->renderPartial('menu', array('cat' => $cat)); ?>
    <?php $this->renderPartial('menuWp'); ?>
    <?php $this->renderPartial('content', array('goods' => $goods)); ?>
    <?php $this->renderPartial('page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
</div>

<?php $this->renderPartial('side'); ?>

<div id="footer" class="footer">
    <?php $this->renderPartial('footer'); ?>
</div>
