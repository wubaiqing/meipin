<div id="junav" class="area pr">
	<div class="left" >
		<i></i>
		<a href="<?php echo $this->createAbsoluteUrl('site/index', array('cat' => $catId, 'hot' => '0'))?>" <?php echo ($hot == 0) ? 'class="on"' : ''; ?>><em>最热</em></a>
		<a href="<?php echo $this->createAbsoluteUrl('site/index', array('cat' => $catId, 'hot' => '1'))?>" <?php echo ($hot == 1) ? 'class="on"' : ''; ?>><em>最新</em></a>
	</div>
</div>

