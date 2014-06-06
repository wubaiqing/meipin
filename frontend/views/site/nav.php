<script type="text/javascript">
$(document).ready(function(e) {
	$("#nav p").hover(function(){
    $(this).find("span").show();
	$(this).find("a img").hide();
		},function(){
	$(this).find("span").hide();
	$(this).find("a img").show();
	});
    
	$(window).scroll(function( ){
	var x = $(this).scrollTop();
	if(x<100){$("#class_new").hide();
	}else{
		$("#class_new").show().css("top",0);}
	});
	
	
	$(".X").hide();
	$(window).scroll(function( ){
	var x = $(this).scrollTop();
	if(x<300){
		$(".image").hide();
		$(".X").hide();
	}else{
		$(".image").show().css("top",200).css("left",200);
		$(".X").show().css("top",300).css("left",550);}
	}); 
	
	$(".X").click(function(){
		$(this).prev().hide();
		$(this).hide();
	});
});
	  
</script>
<div id="wrap">
    <div id="nav">
        <ul>
            <li> <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat < 1000) ? 'on' : ''; ?>" href="/">首页<i></i></a></li>
            <li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1000) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1000));?>">九块九包邮<i></i></a></li>
             <li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1001) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1001));?>">聚美品<i></i></a></li>
            <li><a href="<?php echo $this->createUrl('exchange/index');?>" class="<?php echo (Yii::app()->controller->id == 'exchange') ? 'on' : ''; ?>">积分兑换</a></li>
            <li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1002) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('/tomorrow');?>">明日预告</a></li>
            <br>
        </ul>
        <p><span><img src="/static/images/face.png"></span> <a href="javascript:;" class="signin <?php $isSignDay = User::isSignDay(); echo !$isSignDay ? 'qiandao' : 'cheng'; ?>" onmouseover="document.getElementById('con_qd').style.display = 'block'" onmouseout="document.getElementById('con_qd').style.display = 'none'"><i></i><i class="icon-mini"></i><span id='jryq'></span><img src="/static/images/pen_03_01.png">签到领积分</a></p>	
        <br>
    </div>
	<ul id="class_new">
    	<li><img src="/static/images/gift-w_33.png"> <a href="/" class="<?php echo ($cat == 0) ? 'on' : '';?>">全部</a></li>
        <li><img src="/static/images/dress-w_36.png"> <a class="<?php echo ($cat == 1) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 1));?>">潮流女装</a></li>
        <li><img src="/static/images/cloths-w_39.png"><a class="<?php echo ($cat == 4) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 4));?>">精品男装</a></li>
        <li><img src="/static/images/shoes-w_40.png"> <a class="<?php echo ($cat == 7) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 7));?>">鞋子箱包</a></li>
        <li><img src="/static/images/ring-w_39.png"/> <a class="<?php echo ($cat == 8) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 8));?>">时尚配饰</a></li>
        <li><img src="/static/images/food_36.png"> <a class="<?php echo ($cat == 9) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 9));?>">美食/特产</a></li>
        <li><img src="/static/images/3c-w_37.png"> <a class="<?php echo ($cat == 10) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 10));?>">数码家电</a></li>
        <li><a class="<?php echo ($cat == 5) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 5));?>">家具日用</a></li>
        <li><img src="/static/images/hair-w_52.png"> <a class="<?php echo ($cat == 11) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 11));?>">美容护肤</a></li>
        <li><img src="/static/images/cup-w_67.png"><a href="#">母婴用品</a></li>
        <li><img src="/static/images/zhekou-w_58.png"><a href="/" class="<?php echo ($cat == 0) ? 'on' : '';?>">综合商品</a></li>
        <br>
    </ul>
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
        <li><img src="/static/images/zhekou_26.png"><a href="/" class="<?php echo ($cat == 0) ? 'on' : '';?>">综合商品</a></li
            <br>
        </ul>   
    </div>
    
    <a class="M" href="javascript:window.external.AddFavorite('http://www.meipin.com','美品网')"><img class="image" src="/static/images/girl.png"><img class="X" src="/static/images/X_03.png"></a>     
</div>
