<?php if ($this->action->id != 'tomorrow') : ?>
<div id="wrap">
<link href="" rel="stylesheet" type="text/css" /> 
<script type="text/javascript">
$(window).scroll(function( ){
    var x = $(this).scrollTop();
    if(x<50){$("#banner").show().css("top",135);
    }else{
        $("#banner").show().css("top",-5);}
    });
</script>
<div id="banner">
	<img class="pic" src="/static/images/meipin_03.png">
    <div class="dujia">
    	<p>[独家]每天10点更新</p>
        <ul>
        	<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 1));?>" target="_blank" >女装</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 4));?>" target="_blank" >男装</a></li>
            <br>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 5));?>" target="_blank" >居家</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 6));?>" target="_blank" >母婴</a></li>
            <br>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 7));?>" target="_blank">鞋包</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 8));?>" target="_blank">配饰</a></li>
            <br>
            <!-- <li><a href="<?php //echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 9));?>"  target="_blank" >美食</a></li> -->
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 10));?>" target="_blank" >数码家电</a></li>
            <br>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 11));?>" target="_blank" >化妆品</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 12));?>" target="_blank" >文体</a></li>
            <br>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 1000));?>" target="_blank">9块9</a></li>
            <!-- <li><a href="">20元封顶</a></li>
            <br> -->
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('tomorrow');?>" target="_blank" >明日预告</a></li>
            <br/>
             <form target="_self" action="<?php echo $this->createUrl('search/index');?>" id="search">
            	<input class="search_text" type="text" name="title"  />
			    <input class="search_btn" type="submit" value="搜索"/>
            </form>
        </ul>
    </div>
    <div class="jingxuan">
    	<p>&nbsp;</p>
<!--         <ul>
	<li><a href="#">值得买</a></li>
    <li><a href="#">值得逛</a></li>
    <br>
</ul> -->
        <ol>
        	<li class="one11"><img src="/static/images/phone_07.png" height="25" width="15"><a  href="<?php echo Yii::app()->createAbsoluteUrl('site/phone');?>" target="_blank">手机APP</a><br></li>
            <li><img src="/static/images/kefu_15_15.png"><a href="tencent://message/?Menu=yes&uin=534095228&Site=&Service=200&sigT=f970984f0af8a3b91bcf76a87bd9c00aaecaff7a636976b0aff85eaffed80934b10126a03d75711a">在线客服</a></li>
        </ol>
    </div>
    <img src="/static/images/bot_06.png" width="124px;">
</div>

    <div id="class">
        <ul class="class_top">
        <li><img src="/static/images/gift_02.png"> <a href="/" class="<?php echo ($cat == 0) ? 'on' : '';?>">全部</a></li>
        <li><img src="/static/images/dress_04.png"> <a class="<?php echo ($cat == 1) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 1));?>">潮流女装</a></li>
        <li><img src="/static/images/cloths_06.png"><a class="<?php echo ($cat == 4) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 4));?>">精品男装</a></li>
        <li><img src="/static/images/shoes_08.png"> <a class="<?php echo ($cat == 7) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 7));?>">鞋子箱包</a></li>
        <li><img src="/static/images/ring_10.png"/><a class="<?php echo ($cat == 8) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 8));?>">时尚配饰</a></li>
        <!-- <li><img src="/static/images/drink_17.png"> <a class="<?php //echo ($cat == 9) ? 'on' : '';?>" href="<?php //echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 9));?>">美食/特产</a></li> -->
        <li><img src="/static/images/3c_19.png"> <a class="<?php echo ($cat == 10) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 10));?>">数码家电</a></li>
        <li><img src="/static/images/sofa_21.png"><a class="<?php echo ($cat == 5) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 5));?>">家具日用</a></li>
        <li><img src="/static/images/hair_24.png"> <a class="<?php echo ($cat == 11) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 11));?>">美容护肤</a></li>
        <li><img src="/static/images/cup_65.png"><a class="<?php echo ($cat == 6) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 6));?>">母婴用品</a></li>
        <li><img src="/static/images/zhekou_26.png"><a class="<?php echo ($cat == 12) ? 'on' : '';?>" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 12));?>">文体户外</a></li
            <br>
        </ul>   
    </div>
    <!-- 小人开始 -->
	<!--<div id='my_book'>
	 <a id="floatage-image" class="M" href="javascript:void(0);"onClick="www_meipin_com(this, 'http://www.meipin.com', '美品网，畅想折扣新主张！')">
         <img class="image" src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/static/girl.png">
    </a> 
	<a href="javascript:void(0);" id="flotage-close-button">
	     <img class="X" src="/static/images/X_03.png"/>
	</a>
	</div>-->
    <!-- 小人开始 -->
</div>
 <script type="text/javascript" src="/static/js/person_move.js?v=1.0.2"></script>
 <?php endif;?>