<div id="head_nav">
    <div class="head_nav" id="t-area">
	<div class="l">
	    <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat < 1000) ? 'on' : ''; ?>" href="http://www.meipin.com">首页<i></i></a>
	    <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1000) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1000));?>">九块九包邮<i></i></a>
	    <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1001) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1001));?>">聚美品<i></i></a>
	    <a href="<?php echo $this->createUrl('exchange/index');?>" class="<?php echo (Yii::app()->controller->id == 'exchange') ? 'on' : ''; ?>">积分兑换</a>
	    <span class="n"></span>
	</div>
	<div class="r_con">
	    <div class="yg_wrap">
	    <a class="signin <?php $isSignDay = User::isSignDay(); echo !$isSignDay ? 'qiandao' : ''; ?>'" onmouseover="document.getElementById('con_qd').style.display = 'block'" onmouseout="document.getElementById('con_qd').style.display = 'none'"><i></i><i class="icon-mini"></i>签到领积分</a>
	    </div>
	</div>
    </div>
</div>