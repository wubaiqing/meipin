<?php $this->renderPartial('afp'); ?>
<div id="wrapper">
	<?php $this->renderPartial('head'); ?>
	<div id="body">
		<?php $this->renderPartial('guang_banner'); ?>
		<div id="taeapp-zhe800_1_guang_php" data-componentid="comp_zhe800_1_guang_php" class="J_TScriptedModule taeapp" style="margin: 0px auto; overflow: hidden;">
			<div class="znav">
				<a <?php echo ($tagId == 23) ? 'class="on"' : '';?> href="<?php echo $this->createAbsoluteUrl('site/guang', array('tagId' => 23));?>"><i class="bg1"></i>衣服</a>
				<a <?php echo ($tagId == 27) ? 'class="on"' : '';?> href="<?php echo $this->createAbsoluteUrl('site/guang', array('tagId' => 27));?>"><i class="bg2"></i>鞋子</a>
				<a <?php echo ($tagId == 31) ? 'class="on"' : '';?> href="<?php echo $this->createAbsoluteUrl('site/guang', array('tagId' => 31));?>"><i class="bg3"></i>包包</a>
				<a <?php echo ($tagId == 24) ? 'class="on"' : '';?> href="<?php echo $this->createAbsoluteUrl('site/guang', array('tagId' => 24));?>"><i class="bg4"></i>数码周边</a>
				<a <?php echo ($tagId == 26) ? 'class="on"' : '';?> href="<?php echo $this->createAbsoluteUrl('site/guang', array('tagId' => 26));?>"><i class="bg5"></i>美食</a>
				<a <?php echo ($tagId == 29) ? 'class="on"' : '';?> href="<?php echo $this->createAbsoluteUrl('site/guang', array('tagId' => 29));?>"><i class="bg6"></i>家居生活</a>
				<a <?php echo ($tagId == 25) ? 'class="on"' : '';?> href="<?php echo $this->createAbsoluteUrl('site/guang', array('tagId' => 25));?>"><i class="bg7"></i>美妆</a>
				<a <?php echo ($tagId == 32) ? 'class="on"' : '';?> href="<?php echo $this->createAbsoluteUrl('site/guang', array('tagId' => 32));?>"><i class="bg8"></i>配饰</a>
				<a <?php echo ($tagId == 28) ? 'class="on"' : '';?> href="<?php echo $this->createAbsoluteUrl('site/guang', array('tagId' => 28));?>"><i class="bg9"></i>创意潮品</a>
			</div>
			<div class="wrap area">
				<?php 
				$html = $childHtml = null;
				$array = array(19, 39, 59, 79);
				foreach ($data as $key => $val) {
					$childHtml.= '<div class="mode">
						<p class="pic">
							<a href="'.$val->url.'" target="_blank">
								<img class="goods-item-img" data-url="'.$val->image.'" src="http://img04.taobaocdn.com/imgextra/i4/82990617/T2BclDXyNaXXXXXXXX-82990617.jpg">
							</a>
						</p>
						<h3 class="tit"><span><a href="'.$val->url.'" target="_blank">'.$val->title.'</a></span><em>￥<b>'.$val->price.'</b></em></h3>
					</div>';
					if ($key == 79 && in_array($key, $array)) {
						$html .= '<div class="right">'.$childHtml.'</div>';
						$childHtml = null;
					} else if (in_array($key, $array)) {
						$html .= '<div class="left">'.$childHtml.'</div>';
						$childHtml = null;
					}
				}
				echo $html;
				?>
				</div>
			</div>
		</div>
<?php
$this->widget(
	'CLinkPager',
	array(
		'pages' => $pager,
		'header' => false,
		'cssFile' => '',
		'maxButtonCount' => '5',
		'hiddenPageCssClass' => '',
		'selectedPageCssClass' => 'select',
		'lastPageLabel' => '尾页',
		'firstPageLabel' => '首页',
		'nextPageLabel' => '下一页',
		'prevPageLabel' => '上一页',
		'htmlOptions' => array(
			'class' => 'goods-page',
		)
	)
);
?>
	</div>
	<div id="footer">
		<?php $this->renderPartial('footer'); ?>
		<?php $this->renderPartial('fix'); ?>
	</div>
</div>
