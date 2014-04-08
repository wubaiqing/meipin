<?php
$banner = Banner::getAll();
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
<p class="today-goods-item-tips">
合作联系qq：534095228
</p>

<div class="pr">
<!--
	<a class="footFavorite" href="javascript:void(0)" onclick="goods.utils.addFavorite('http://www.jtzdm.com','收藏这些值得买，随时发现精彩分享');"></a>
	<img src="http://www.40zhe.com/static/footFatorite_40zhe.jpg" alt="下次怎么找到我" />
-->
</div>
