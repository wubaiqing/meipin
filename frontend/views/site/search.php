<div id="header">
    <?php $this->renderPartial('prompt'); ?>
    <?php $this->renderPartial('//site/login', array('cat' => 0)); ?>
    <?php $this->renderPartial('//site/head', array('cat' => 0)); ?>
    <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>

<?php
    $cat = Yii::app()->request->getQuery('cat');
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

