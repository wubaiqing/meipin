
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
  <?php if (empty($goods)) :?>
	<div id="wrap_p" >
	    <div id="tomorrow_css"><img src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/static/tomorrow.jpg"></div>
		</div> 
		<?php else:?>
		<?php $this->renderPartial('tomorrowWp', array('pager' => $pager)); ?>
		<?php $this->renderPartial('content', array('goods' => $goods,'exchange'=>$exchange)); ?>
		<?php $this->renderPartial('page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
	<?php endif;?>
</div>
<div id="footer" class="footer">
    <?php $this->renderPartial('footer'); ?>
</div>
