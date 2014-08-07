<?php
$cat = Yii::app()->request->getQuery('cat');
$page = Yii::app()->request->getQuery('page');
$hot = Yii::app()->request->getQuery('hot', 0);
?>

<?php $this->renderPartial('//site/login'); ?>
<?php $this->renderPartial('//site/head'); ?>
<?php $this->renderPartial('//site/nav_person', array('cat' => $cat)); ?>

<div id="content" class="wp">
    <?php 
      if(!empty($goods)){
       $this->renderPartial('//site/menuWp', array('pager' => $pager)); 
      } ;
     //载入页面 ?>
    <?php $this->renderPartial('//site/content', array('goods' => $goods,'othergoods'=>$othergoods)); ?>
    <?php $this->renderPartial('//site/page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
</div>
<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>
