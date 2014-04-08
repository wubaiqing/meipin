<?php $this->renderPartial('afp'); ?>

<div id="wrapper">
	<?php $this->renderPartial('head'); ?>
	<div id="body">
		<div class="today-wrap">
			<?php $this->renderPartial('banner'); ?>
			<div class="today-seller-tab">
				<!--热门排序 start-->
					<?php $this->renderPartial('hot', array('catId' => $catId, 'hot' => $hot)); ?>
				<!--热门排序 end-->
				<!--商品列表 start-->
				<div class="today-goods-list">
					<!--单个商品 start-->
						<?php $this->renderPartial('content', array('data' => $data)); ?>
					<!--单个商品 end-->
					<div style="clear:both;"></div>
				</div>
				<!--商品列表 end-->
			</div>
			<!--tab切换 end-->
			<!--tips文字 start-->
				<?php $this->renderPartial('page', array('pager' => $pager)); ?>
			<!--tips文字 end-->
		</div>
		<!--分享部分 start-->
			<?php $this->renderPartial('share'); ?>
		<!--分享部分 end-->
	</div>
	<div id="footer">
		<?php $this->renderPartial('footer'); ?>
		<?php $this->renderPartial('fix'); ?>
	</div>
</div>
