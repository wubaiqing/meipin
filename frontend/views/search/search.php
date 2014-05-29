<?php
$cat = Yii::app()->request->getQuery('cat');
$page = Yii::app()->request->getQuery('page');
$hot = Yii::app()->request->getQuery('hot', 0);
?>

<?php $this->renderPartial('//site/login'); ?>
<?php $this->renderPartial('//site/head'); ?>
<?php $this->renderPartial('//site/nav', array('cat' => $cat)); ?>
<?php $this->renderPartial('//site/junav', array('cat' => $cat, 'hot' => $hot)); ?>

<div id="content" class="wp">
    <?php $this->renderPartial('//site/menuWp', array('pager' => $pager));// ?>
    <?php $this->renderPartial('//site/content', array('goods' => $goods)); ?>
    <?php $this->renderPartial('//site/page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
</div>

<?php $this->renderPartial('//site/side'); ?>
<?php $this->renderPartial('//site/right'); ?>

<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
