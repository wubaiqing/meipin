<div id="nav">
	<div class="two">
		<ul>
			<li> <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat < 1000 && $this->action->id == 'index') ? 'on' : ''; ?>" href="/">首页</a></li>
			<li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1000) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1000));?>">9.9包邮<i></i></a></li>
			<li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1001) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1001));?>">聚美品<i></i></a></li>
			<li><a href="<?php echo $this->createUrl('exchange/index');?>" class="<?php echo (Yii::app()->controller->id == 'exchange') ? 'on' : ''; ?>">积分兑换</a></li>
			<li><a class="<?php echo (Yii::app()->controller->id == 'site' && $this->action->id == 'phone') ? 'on' : ''; ?>" href="/site/phone">手机APP</a></li>
			<li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1002) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('/tomorrow');?>">明日预告</a></li>
			<br>
		</ul>

		<p class="one"><a href="/site/bsrg" target="_blank">商家报名</a></p>
		<p><span class='span1' style='display:none;'><img src="/static/images/face.png"></span> <a href="javascript:;" class="signin <?php $isSignDay = User::isSignDay(); echo !$isSignDay ? 'qiandao' : 'cheng'; ?>"><i></i><i class="icon-mini"></i><img src="/static/images/pen_03_01.png"><span id='jryq'><?php $isSignDay = User::isSignDay(); echo !$isSignDay ? '签到领积分' : '今日已签&nbsp;&nbsp;&nbsp;&nbsp;'; ?></span></a></p>

		<br>
	</div>
</div>
