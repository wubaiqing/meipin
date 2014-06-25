<?php $this->renderPartial('login'); ?>
<?php $this->renderPartial('head'); ?>
<?php $this->renderPartial('nav_person', array('cat' => $cat)); ?>
<?php $this->renderPartial('nav', array('cat' => $cat)); ?>
<link rel="stylesheet" type="text/css"  href="/static/css/goodsdetial.css" />
<div id="box">
<div id="wrap1">
	<div id="main">
	<h2 style="font-size:20px;"><?php echo $goods->title;?></h2>
    <div class="main-left"><img src="<?php echo $goods->picture;?>"></div>
    <div class="main-right">
    	<div class="word">
        	<p>￥<span><?php echo $goods->price;?></span>包邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p class="on">

            <!-- <a href="<?php //echo $this->createUrl('site/buy', array('id' => Des::encrypt($goods->id)));?>">去淘宝购买</a> 19886122002 -->
         <a data-type="0" biz-itemid="<?php echo $goods->tb_id;?>" data-tmpl="192x40" data-tmplid="625" data-rd="2" data-style="2" data-border="1" target="_blank"></a> 
            </p>
            <br>
        </div>
        <div class="bot">
        	<div class="zhekou">
           		<p>折扣</p>
				<h3><span><?php echo number_format(($goods->price)/($goods->origin_price),2);?></span>折</h3>
            </div>
            <div class="yuanjia">
           		<p>原价</p>
				<h3><del>￥<?php echo $goods->origin_price;?></del></h3>
            </div>
            <div class="yuanjia">
           		<p>现价</p>
				<h3><del>￥<?php echo $goods->price;?></del></h3>
            </div>
            <br> 
        </div>
        <div class="clock">
        	<img src="/static/images/clock_03.png">
            <p><span>开抢时间：</span><?php echo date('m月d日H:i分',$goods->start_time);?></p>
            <br>
        </div>
    </div>
    <br>
</div>
    <div id="bottom">
	<h3>猜你喜欢</h3>
	<?php  foreach ($xggoods as $goods1):?>
	<ul>
        <li>
            <a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($goods1->id)));?>"><img src="<?php echo $goods1->picture;?>" width=290 height=190 /></a>
            <h4><a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($goods1->id)));?>"><?php echo $goods1->title;?></a></h4>
            <p><a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($goods1->id)));?>">￥<?php echo $goods1->price;?></a></p>
         </li>      
	</ul>
	 <?php endforeach;?>
</div>
</div>
<div id="right">
        <h3>热门兑换活动</h3>
        <?php  foreach ($hotExchangeGoods as $goods):
         $goodsUrl = Yii::app()->createUrl("exchange/exchangeIndex", array("id" => Des::encrypt($goods->id)));
        ?>
        <ul>
            <li>
                <a href="<?php echo $goodsUrl; ?>"><img width=200 height=130 src="<?php echo $goods->img_url ?>"></a>
                <h4>所需积分 <?php echo $goods->integral ?></h4>
            </li>
        </ul>
       <?php endforeach; ?>
    </div>
	<br> 
</div>

<div id="content" class="wp">
    <?php $this->renderPartial('page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
</div>
<?php //$this->renderPartial('right'); ?>
<script type="text/javascript"> (function(win,doc){ var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0]; if (!win.alimamatk_show) { s.charset = "gbk"; s.async = true; s.src = "http://a.alimama.cn/tkapi.js"; h.insertBefore(s, h.firstChild); }; var o = { pid: "mm_56250611_6552067_23244345",/*推广单元ID，用于区分不同的推广渠道*/ appkey: "",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/ unid: ""/*自定义统计字段*/ }; win.alimamatk_onload = win.alimamatk_onload || []; win.alimamatk_onload.push(o); })(window,document);</script> 
<div id="footer" class="footer">
    <?php $this->renderPartial('footer'); ?>
</div>
