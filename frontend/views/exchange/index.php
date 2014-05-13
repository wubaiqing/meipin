<div id="header">
    <?php $this->renderPartial('//site/prompt'); ?>
    <?php $this->renderPartial('//site/login'); ?>
    <?php $this->renderPartial('//site/head'); ?>
    <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>
<style>
    .banner { position: relative; overflow: auto; }
    .banner li { list-style: none; }
    .banner ul li { float: left; }
    .banner .dots {position:absolute;left:0;right:0;bottom:20px;display:inline; }
</style>
<script src="/assets/js/unslider.min.js"></script>
<div id="content" class="wp">
    <div class="w1040 clearfix">
        <!--积分广告和积分 登录开始-->
        <div class="pointsad-pointslog clearfix">
            <div class="pointsad fl">
<!--                <style type="text/css">.ad_focus_22{ width:650px; height:210px; position:relative; overflow:hidden;margin:0px auto;}-->
<!--                    .ad_focus_22 ul{ position:relative; z-index:5;}-->
<!--                    .ad_focus_22 ul li{ position:absolute; display:none;}-->
<!--                    .ad_focus_22 .num{ position:absolute;right:10px; bottom:10px; z-index:10;}-->
<!--                    .ad_focus_22 .num a{ width:15px; height:15px; line-height:15px; display:inline-block; text-align:center; margin:0 3px; cursor:pointer; text-decoration:none; background:#FFF;}-->
<!--                    .ad_focus_22 .num a.cur{ background:#ff6700;color:#fff;}-->
<!--                </style>-->
                <div class="banner has-dots">
                    <ul>
                        <li style="display: block;">
                            <a target="_blank" href="javascript:;" title="维品800商城轮播广告1"><img width="650" height="210" src="/assets/images/51e80be32a406.jpg" alt="测试111"></a>
                        </li>
                        <li style="display: block;">
                            <a target="_blank" href="javascript:;" title="维品800商城轮播广告2"><img width="650" height="210" src="http://www.29kuai.com/data/upload/ad/1307/18/51e80bf18ca9d.jpg" alt="测试222"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="points-border fl"></div>
            <div class="w250 fr">
                <!-- 积分登录开始 -->
                <div class="pointslog">
                    <div class="pointslog-head clearfix">
                        <div class="pointslog-head-left fl"><a href="/user/register.html">免费注册</a></div>
                        <div class="pointslog-head-right fr">
                            <ul class="clearfix">
                                <li><a href="/oauth/qq.html" title="QQ登录"></a></li>
                                <li><a href="/oauth/taobao.html" title="淘宝登录"></a></li>
                                <li><a href="/oauth/sina.html" title="新浪登录"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="pointslog-body"><p>欢迎来到值得买积分商城，登陆后可查看您的个 人积分信息。</p></div>
                    <div class="pointslog-foot">
                        <dl class="clearfix">
                            <dt class="fl"><a class="J_qiandao" href="javascript:commonopen();" _hover-ignore="1">签到得积分</a></dt>
                            <dd class="fl"><a href="/help/index.html">获得更多积分？</a><a href="/user/score.html">积分明细</a></dd>
                        </dl>
                    </div>
                </div>
                <!-- 积分登录结束 -->
            </div>
        </div>
        <!--积分广告和积分 登录结束-->
    </div>
    <!-- 积分兑换商品开始 -->
    <div class="pointsgood mt20">
        <div class="pointsgood-body pb30 tab-pane" id="welfare2" style="display:block;">
            <ul class="clearfix">
                <?php foreach ($data as $goods):?>
                <li>
                    <div class="convertgood">
                        <a href="/jfsc/8.html" target="_blank" class="convertgood-pic"><img src="<?php echo $goods['img_url'];?>" alt="<?php echo $goods['name'];?> " title="<?php echo $goods['name'];?>"></a>
                        <dl class="convertgood-desc">
                            <dd>
                                <h3><?php echo $goods['name'];?></h3> 
                                <p>剩余：<b class="green"><?php echo $goods['num'];?></b> 份</p>
                                <p>需积分：<b class="pink"><?php echo $goods['integral'];?></b></p>
                            </dd>
                            <dt><a target="_blank" href="/jfsc/8.html" _hover-ignore = "1">我要换</a></dt>
                        </dl>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
        <!-- 积分兑换商品开始 -->
</div>
<script type="text/javascript">
//    $(function(){
//    $backToTopFun = function() {
//    var $backToTopEle = $('#go_top');
//    var st = $(document).scrollTop(), winh = $(window).height();
//    (st > 0)? $backToTopEle.css('display','block'): $backToTopEle.css('display','none');
//    if (!window.XMLHttpRequest) {
//        $backToTopEle.css("top", st + winh - 40);
//    };
//};
//$(window).bind("scroll", $backToTopFun);	$backToTopFun();
//$('#go_topa').click(function(){
//    $('html,body').animate({'scrollTop':0},200);
//    return false;
//});});
</script>
<script type="text/javascript">
    $(function(){
        var sw = 0;
        alert(11);
        $('.banner').unslider({
            speed:500,
            delay:3000,
            keys:true,
            dots:true,
            fluid:false
        });
    });
//    $(".J_ad_focus .num a").mouseover(function(){
//        sw = $(".num a").index(this);
//        myShow(sw);
//    });
//    function myShow(i){
//        $(".J_ad_focus .num a").eq(i).addClass("cur").siblings("a").removeClass("cur");
//        $(".J_ad_focus ul li").eq(i).stop(true,true).fadeIn(600).siblings("li").fadeOut(600);
//    }
    //滑入停止动画，滑出开始动画
    
//    $(".demo").hover(function(){
//        if(myTime){
//            clearInterval(myTime);
//        }
//    },function(){
//        myTime = setInterval(function(){
//            myShow(sw)
//            sw++;
//            if(sw==3){sw=0;}
//        } , 3000);
//    });
//    //自动开始
//    var myTime = setInterval(function(){
//        myShow(sw)
//        sw++;
//        if(sw==3){sw=0;}
//    } , 3000);
//    });
//    
</script>