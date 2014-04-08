<div class="share-wrap widget-fixed" data-jss="marginTop:211" _fixed="true" style="top:180px; z-index:0;" data-bind-fixed="true" >
	<div class="share-container">
		<span>
			分类：
		</span>
		<a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('list' => 1, 'cat' => 999));?>">9.9包邮</a>
		<?php 
		$cat = Cat::getAllCat();
		foreach($cat as $catItem) {
		?>
			<a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('list' => 1, 'cat' => $catItem['id']));?>" title="qq空间">
				<?php echo $catItem['name']; ?>
			</a>
		<?php } ?>
	</div>
	<a href="javascript:void(0);" onclick="goods.utils.addFavorite(&#39;http://www.51cuxiao.com&#39;,&#39;收藏我要促销，随时发现精彩分享&#39;);"
		class="to-favorite">
		加入收藏夹
	</a>
</div>
