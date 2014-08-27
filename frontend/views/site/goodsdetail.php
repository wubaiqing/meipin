<?php $this->renderPartial('login'); ?>
<?php $this->renderPartial('head'); ?>
<?php $this->renderPartial('nav_person', array('cat' => $cat)); ?>
<?php $this->renderPartial('nav', array('cat' => $cat)); ?>
 <?php if($goods->is_zhe800==2):?>
<link rel="stylesheet" type="text/css"  href="/static/css/goodsdetialold.css" />
<?php else:?>
<link rel="stylesheet" type="text/css"  href="/static/css/goodsdetial.css" /> 
<link rel="stylesheet" href="/static/css/jquery.fancybox-1.3.1.css" type="text/css" />
<script type="text/javascript" src="/static/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.fancybox-1.3.1.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
            $("#fancybox-close").hide();
            
            $("a[rel=example_group]").fancybox({
                'transitionIn'      : 'none',
                'transitionOut'     : 'none',
                'titlePosition'     : 'over',
            });
        });
</script>
<?php endif;?> 
<div id="box">

<div id="wrap1">
	<div id="main">
	<h2 style="font-size:20px;"><?php echo $goods->title;?></h2>
    <div class="main-left"><img src="<?php echo $goods->picture;?>" width=290 height=190 ></div>
    <div class="main-right">
    	<div class="word">
        	<p>￥<span><?php echo $goods->price;?></span>包邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p class="on">
            <?php 
                $nowtime = date("Y-m-d H:i:s",time());
                $start_time = date("Y-m-d H:i:s",$goods->start_time);
                if($nowtime<$start_time)
                {
                    $url = $this->createUrl('site/buy', array('id' => Des::encrypt($goods->id)));
                    echo '<a href="'.$url.'"" target="_blank" ><img src="/static/images/jjks.png" /></a>';
                }else{
            ?>
             <a data-type="0" biz-itemid="<?php echo $goods->tb_id;?>" data-tmpl="192x40" data-tmplid="625" data-rd="2" data-style="2" data-border="1" target="_blank"></a>  
         <?php }?>
            </p>
            <br>
        </div>
    <?php if($goods->is_zhe800==2):?>
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
</div> <?php else:?>

        <div id="shaidan">
            <h5>已有<span><?php echo $goods->pbuy;?></span>人购买，<span><?php echo $goods->pnum;?></span>人评价</h5>
            <p>为您精选（<span><?php echo $shainum;?></span>）张买家实拍晒单</p>
        </div>
<?php endif;?>
        <div class="clock">
        	<img src="/static/images/clock_03.png">
            <p><span>开抢时间：</span><?php echo date('m月d日H:i分',$goods->start_time);?></p>
            <br>
        </div>
    </div>
    <br>
</div>
<?php if($goods->is_zhe800==2):?>
<div id="bottom">
    <h3>猜你喜欢</h3>
    <?php  foreach ($xggoods as $goods1):?>
    <ul>
        <li>
            <a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($goods1->id)));?>" target='_blank'><img src="<?php echo $goods1->picture;?>" width=290 height=190 target='_blank' /></a>
            <p><a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($goods1->id)));?>" target='_blank'>￥<?php echo $goods1->price;?></a></p>
            <h4><a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($goods1->id)));?>" target='_blank'><?php echo $goods1->title;?></a></h4>
         </li>      
    </ul>
     <?php endforeach;?>
</div>
<?php else:?>
    <div id="bottom">
        <h3>美品网为您找到关于这款商品（<?php echo $shainum;?>张实拍图片）</h3>
       <?php foreach ($shai as $key => $value):?>
        <div id="dress">
            <div class="time">
                <h5>【购物晒单】<?php echo $value->username;?></h5>
                <p><?php 
                $ptime= strtotime($value->ptime);
                echo date('m月d日 i:s',$ptime);
                ?></p>
                <br>
            </div>
            <p><?php echo $value->content;?></p>
             <div id="content">
                    <p>
                    <!-- <a rel="example_group" href="/static/images/222.jpg"><img src="/static/images/22.png"></a>
                        <a rel="example_group" href="/static/images/222.jpg"><img src="detail_files/22.png"></a>
                        <a rel="example_group" href="/static/images/222.jpg"><img src="/static/images/22.png"></a> -->
                        <?php 
                        $imgarr = $value->img;
                        foreach ($imgarr as $key => $value) {
                           echo "<a rel='example_group' href='{$value}_400x400.jpg'><img src='{$value}'></a>";
                        };?>
                        <br>
                   </p>
                </div>
                
               
            
        </div>
    <?php endforeach;?>

     </div>
</div>
<?php endif;?>
</div>
<script type="text/javascript">
$(function() {
    $('.qiandao').click(function() {
    })
})
</script>
<div id="right">
        <h3>热门兑换活动</h3>
        <?php  foreach ($hotExchangeGoods as $goods):
         $goodsUrl = Yii::app()->createUrl("exchange/exchangeIndex", array("id" => Des::encrypt($goods->id)));
        ?>
        <ul>
            <li>
                <a href="<?php echo $goodsUrl; ?>"><img width=200 height=130 src="<?php echo $goods->img_url ?>"></a>
                <h4 style="font-size:12px;"><span style="color:#666"><?php ECHO Front::truncate_utf8_string($goods->name,8); ?></span>  &nbsp;0元+<?php echo $goods->integral ?>分</h4>
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
