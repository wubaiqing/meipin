<div id="head">
	<div class="header-module-hd cls" style="margin-bottom: 0px;">
		<div class="header-module-hd-main cls">
			<div class="header-module-logo-wrap">
				<div class="header-module-logo">
					<a href="/" title="我要促销">
						我要促销
					</a>
				</div>
			</div>
			<div class="header-module-other">
				<div class="header-module-other-main">
					<a class="header-module-favorite" href="javascript:;" onclick="goods.utils.addFavorite(&#39;http://www.51cuxiao.com&#39;,&#39;收藏我要促销，随时发现精彩分享&#39;);">
						加入收藏
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="header-module-bd cls">
		<div class="header-module-nav-main cls">
			<div class="header-module-nav">
				<ul class="cls">
					<li>
						<a href="/">首页</a>
					</li>
					<li class="tag" data-cid="508">
						<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 999));?>">9.9包邮</a>
					</li>
					
					<?php 
					$cat = Cat::getAllCat();
					foreach($cat as $catItem) {
					?>
					<li class="tag" data-cid="<?php echo $catItem['id']; ?>">
						<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => $catItem['id']));?>"><?php echo $catItem['name']; ?></a>
					</li>
					<?php } ?>

					<li>
						<i></i>
						<a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('site/guang', array('tagId' => 23));?>">值得逛</a><i class="ico-head ico-vertical"></i>
					</li>

					<li class="tag returnTop" >
						<a href="#top">回顶部</a>
					</li>
				</ul>
			</div>

            <span style="float:right; font-size:15px; color:#333;">商家合作加Q：534095228</span>
		</div> 
	</div>
</div>
