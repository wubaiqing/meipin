<div id="head_nav">
    <div class="head_nav" id="t-area">
	<div class="l">
	    <a class="on" href="http://www.meipin.com">首页<i></i></a>
	    <a href="<?php echo $this->createUrl('site/index', array('cat' => 1000));?>">九块九包邮<i></i></a>
	    <a href="<?php echo $this->createUrl('site/index', array('cat' => 1001));?>">聚美品<i></i></a>
	    <a target="_blank" href="<?php echo $this->createUrl('exchange/index');?>" class="<?php echo (Yii::app()->controller->id == 'exchange') ? 'on' : ''; ?>">积分兑换</a>
	    <span class="n"></span>
	</div>
	<div class="r_con">
	    <div class="yg_wrap">
            <a class="signin" href="http://www.zhe800.com/login?return_to=http%3A%2F%2Fwww.zhe800.com%2F"><i></i><i class="icon-mini"></i>签到领积分</a>
	    </div>
	</div>
    </div>
</div>