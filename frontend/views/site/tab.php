<ul class="cls">
<li <?php echo ($tab == 1 ) ? 'class="curr"' : ''; ?>>
		<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('tab' => '1')); ?>">
			今日上新
		</a>
	</li>
	<li <?php echo ($tab == 3 ) ? 'class="curr"' : ''; ?>>
		<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('tab' => '3')); ?>">
			本周最值
			<i class="ico-head ico-hot">
			</i>
		</a>
	</li>
	<li <?php echo ($tab == 2 ) ? 'class="curr"' : ''; ?>>
		<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('tab' => '2')); ?>">
			明日预告
		</a>
	</li>
</ul>
