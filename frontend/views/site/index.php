
<?php $this->renderPartial('login'); ?>
<?php $this->renderPartial('head'); ?>
<?php $this->renderPartial('nav_person', array('cat' => $cat)); ?>
<?php $this->renderPartial('nav', array('cat' => $cat)); ?>

<?php
    if ($cat < 1) {
        $this->renderPartial('banner',array('page'=>$page));
    }
?>

<div id="content" class="wp"> 
    <?php
    if ($cat) {
        $this->renderPartial('menuWp', array('pager' => $pager)); 
    }
   ?>
    <?php $this->renderPartial('content', array('goods' => $goods,'exchange'=>$exchange,'brand'=>$brand,'cat'=>$cat)); ?>
    <?php $this->renderPartial('page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
</div>
<?php $this->renderPartial('right'); ?>
<?php $this->renderPartial('map'); ?>
<div id="footer" class="footer">
    <?php $this->renderPartial('footer'); ?>
</div>
