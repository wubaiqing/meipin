<?php
$cat = Yii::app()->request->getQuery('cat');
$page = Yii::app()->request->getQuery('page');
$hot = Yii::app()->request->getQuery('hot', 0);
?>

<?php $this->renderPartial('//site/login'); ?>
<?php $this->renderPartial('//site/head'); ?>
<?php $this->renderPartial('//site/nav_person', array('cat' => $cat)); ?>

<div id="content" class="wp">
    <?php $this->renderPartial('//brand/menuWp', array('pager' => $pager,'cat'=>$cat)); //载入页面?>
    <?php $this->renderPartial('//site/content', array('goods' => $goods)); ?>
    <?php $this->renderPartial('//site/page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
</div>
<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
