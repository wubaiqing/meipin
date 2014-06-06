<div id="head_nav">
    <div class="head_nav" id="t-area">
    <div class="l">
        <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat < 1000) ? 'on' : ''; ?>" href="/">首页<i></i></a>
        <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1000) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1000));?>">九块九包邮<i></i></a>
        <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1001) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1001));?>">聚美品<i></i></a>
        <a href="<?php echo $this->createUrl('exchange/index');?>" class="<?php echo (Yii::app()->controller->id == 'exchange') ? 'on' : ''; ?>">积分兑换</a>
         <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1002) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('/tomorrow');?>">明日预告<i></i></a>
        <span class="n"></span>
    </div>
    <div class="r_con">
        <div class="yg_wrap">
        <a href="javascript:;" class="signin <?php $isSignDay = User::isSignDay(); echo !$isSignDay ? 'qiandao' : 'cheng'; ?>" onmouseover="document.getElementById('con_qd').style.display = 'block'" onmouseout="document.getElementById('con_qd').style.display = 'none'"><i></i><i class="icon-mini"></i><span id='jryq'><?php $isSignDay = User::isSignDay(); echo !$isSignDay ? '签到领积分' : '今日已签'; ?></span></a>
        </div>

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
    </div>
</div>
