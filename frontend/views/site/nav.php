 <div id="nav">
	<div class="two">
        <ul>
            <li> <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat < 1000) ? 'on' : ''; ?>" href="/">首页</a></li>
            <li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1000) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1000));?>">九块九包邮<i></i></a></li>
             <li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1001) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1001));?>">聚美品<i></i></a></li>
            <li><a href="<?php echo $this->createUrl('exchange/index');?>" class="<?php echo (Yii::app()->controller->id == 'exchange') ? 'on' : ''; ?>">积分兑换</a></li>
			 <li><a class="<?php echo (Yii::app()->controller->id == 'site' && $this->getAction()->getId() == 'phone') ? 'on' : ''; ?>" href="/site/phone">手机APP</a></li>
            <li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1002) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('/tomorrow');?>">明日预告</a></li>
            <br>
        </ul>
		
		<p class="one"><a href="/site/bsrg" target="_blank">商家报名</a></p>
        <p><span><img src="/static/images/face.png"></span> <a href="javascript:;" class="signin <?php $isSignDay = User::isSignDay(); echo !$isSignDay ? 'qiandao' : 'cheng'; ?>"><i></i><i class="icon-mini"></i><span id='jryq'></span><img src="/static/images/pen_03_01.png">签到领积分</a></p>	
		
        <br>
		</div>
   </div>
<?php if ($this->action->id != 'tomorrow') : ?>
<div id="wrap">
	<div id="gosh">
		<ul id="class_new">
			<li><img src="/static/images/gift-w_33.png"> <a href="/" class="<?php echo ($cat == 0) ? 'on' : '';?>">全部</a></li>
			<li><img src="/static/images/dress-w_36.png"> <a class="<?php echo ($cat == 1) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 1));?>">潮流女装</a></li>
			<li><img src="/static/images/cloths-w_39.png"><a class="<?php echo ($cat == 4) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 4));?>">精品男装</a></li>
			<li><img src="/static/images/shoes-w_40.png"> <a class="<?php echo ($cat == 7) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 7));?>">鞋子箱包</a></li>
			<li><img src="/static/images/ring-w_39.png"/> <a class="<?php echo ($cat == 8) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 8));?>">时尚配饰</a></li>
			<li><img src="/static/images/food_36.png"> <a class="<?php echo ($cat == 9) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 9));?>">美食/特产</a></li>
			<li><img src="/static/images/3c-w_37.png"> <a class="<?php echo ($cat == 10) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 10));?>">数码家电</a></li>
			<li><img src="/static/images/sofa-w_46.png"><a class="<?php echo ($cat == 5) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 5));?>">家具日用</a></li>
			<li><img src="/static/images/hair-w_52.png"> <a class="<?php echo ($cat == 11) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 11));?>">美容护肤</a></li>
			<li><img src="/static/images/cup-w_67.png"><a class="<?php echo ($cat == 6) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 6));?>">母婴用品</a></li>
			<li><img src="/static/images/zhekou-w_58.png"><a class="<?php echo ($cat == 12) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 12));?>">文体户外</a></li>
			<br>
		</ul>
	</div>
    <div id="class">
        <ul class="class_top">
        <li><img src="/static/images/gift_02.png"> <a href="/" class="<?php echo ($cat == 0) ? 'on' : '';?>">全部</a></li>
        <li><img src="/static/images/dress_04.png"> <a class="<?php echo ($cat == 1) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 1));?>">潮流女装</a></li>
        <li><img src="/static/images/cloths_06.png"><a class="<?php echo ($cat == 4) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 4));?>">精品男装</a></li>
        <li><img src="/static/images/shoes_08.png"> <a class="<?php echo ($cat == 7) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 7));?>">鞋子箱包</a></li>
        <li><img src="/static/images/ring_10.png"/><a class="<?php echo ($cat == 8) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 8));?>">时尚配饰</a></li>
        <li><img src="/static/images/drink_17.png"> <a class="<?php echo ($cat == 9) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 9));?>">美食/特产</a></li>
        <li><img src="/static/images/3c_19.png"> <a class="<?php echo ($cat == 10) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 10));?>">数码家电</a></li>
        <li><img src="/static/images/sofa_21.png"><a class="<?php echo ($cat == 5) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 5));?>">家具日用</a></li>
        <li><img src="/static/images/hair_24.png"> <a class="<?php echo ($cat == 11) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 11));?>">美容护肤</a></li>
        <li><img src="/static/images/cup_65.png"><a href="#">母婴用品</a></li>
        <li><img src="/static/images/zhekou_26.png"><a class="<?php echo ($cat == 12) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 12));?>">文体户外</a></li
            <br>
        </ul>   
    </div>
	<a id="floatage-image" class="M" href="javascript:void(0);"onClick="www_meipin_com(this, 'http://www.meipin.com', '美品网，畅想折扣新主张！')">
	     <img class="image" src="/static/images/girl.png">
	</a>
	<a href="javascript:void(0);" id="flotage-close-button">
	     <img class="X" src="/static/images/X_03.png"/>
	</a>
</div>
 <?php endif;?>
