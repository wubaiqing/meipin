<?php $this->renderPartial('afp'); ?>

<div id="wrapper">
	<?php $this->renderPartial('head', array('cat' => $cat)); ?>
	<div id="body">
		<div class="today-wrap">
			<?php $this->renderPartial('banner'); ?>
			<div class="today-seller-tab">
				<!--商品列表 start-->
				<div class="today-goods-list">
					<!--单个商品 start-->
						<?php $this->renderPartial('content', array('data' => $data, 'tab' => $tab)); ?>
					<!--单个商品 end-->
				</div>
				<!--商品列表 end-->
			</div>
			<!--tab切换 end-->
			<!--tips文字 start-->
				<?php $this->renderPartial('page', array('pager' => $pager)); ?>
			<!--tips文字 end-->
		</div>
		<!--分享部分 start-->
			<?php $this->renderPartial('share' , array('cat' => $cat)); ?>
		<!--分享部分 end-->
	</div>
	<div id="footer">
		<?php $this->renderPartial('footer'); ?>
		<?php $this->renderPartial('fix'); ?>
	</div>
</div>
<script src="<?php echo Yii::app()->baseUrl;?>/static/common.js"></script>
<div style="display:none;">
	<script src="http://s20.cnzz.com/stat.php?id=5628978&web_id=5628978&show=pic1" language="JavaScript"></script>
</div>
