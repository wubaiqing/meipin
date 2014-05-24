<div id="header">
    <?php $this->renderPartial('//site/prompt'); ?>
    <?php $this->renderPartial('//site/login'); ?>
    <?php $this->renderPartial('//site/head'); ?>
    <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
</div>
<style>
    .banner {
        position: relative;
        overflow: auto;
    }

    .banner li {
        list-style: none;
    }

    .banner ul li {
        float: left;
    }

    .banner .dots {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }

    .banner .dots li {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin: 0 4px;
        text-indent: -999em;
        border: 2px solid #fff;
        border-radius: 6px;
        cursor: pointer;
        opacity: 4
    }

    .banner .dots li.active {
        background: #fff;
        opacity: 1
    }
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
                            <a target="_blank" href="javascript:;" title="test1"><img width="650" height="210"
                                                                                      src="/assets/images/test1.jpg"
                                                                                      alt="测试111"></a>
                        </li>
                        <li style="display: block;">
                            <a target="_blank" href="javascript:;" title="test2"><img width="650" height="210"
                                                                                      src="/assets/images/test2.jpg"
                                                                                      alt="测试222"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="points-border fl"></div>
            <div class="w250 fr">
                <!-- 积分登录开始 -->
                <div class="pointslog">
                    <div class="pointslog-head clearfix">
                        <div class="pointslog-head-left fl"><a href="/user/register">免费注册</a></div>
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
                            <dt class="fl"><a class="J_qiandao" id="qiandao" href="javascript:void(0);">签到得积分</a></dt>
                            <dd class="fl"><a href="/help/index.html">获得更多积分？</a><a href="/user/score.html">积分明细</a>
                            </dd>
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
                <?php foreach ($data as $goods): ?>
                    <?php
                        $url = Yii::app()->createUrl('exchange/exchangeIndex', array('id' => Des::encrypt($goods['id'])));
                    ?>
                    <li>
                        <div class="convertgood">
                            <a href="<?php echo $url; ?>" target="_blank" class="convertgood-pic"><img
                                    src="<?php echo $goods['img_url']; ?>" alt="<?php echo $goods['name']; ?> "
                                    title="<?php echo $goods['name']; ?>"></a>
                            <dl class="convertgood-desc">
                                <dd>
                                    <h3><?php echo $goods['name']; ?></h3>

                                    <p>剩余：<b class="green"><?php echo $goods['num']; ?></b> 份</p>

                                    <p>需积分：<b class="pink"><?php echo $goods['integral']; ?></b></p>
                                </dd>
                                <dt><a target="_blank"
                                       href="<?php echo $url; ?>"
                                       _hover-ignore="1">我要换</a></dt>
                            </dl>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!-- 积分兑换商品开始 -->
    <!-- 分页开始 -->
    <?php $this->renderPartial('//site/page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
    <!-- 分页结束 -->
</div>



<?php $this->renderPartial('//site/side'); ?>
<div id="footer" class="footer">
    <?php $this->renderPartial('//site/footer'); ?>
</div>

<script type="text/javascript">
    $(function () {
        $("#qiandao").live('click', function () {
            var signApi = '/user/DayRegistion';
            $.get(signApi,{},function (result) {
                alert(result.message);
                if (result.status == false) {
                    if(result.location != ''){
                        window.location.href = '/user/login'
                    }
                    return false;
                } else {
                    return true;
                }
            },'json');
        });

//        $(document).on('click', '#qiandao', function () {
//            var signApi = '/user/DayRegistion';
//            $.getJSON(signApi).done(function (result) {
//                alert(result.message);
//                if (result.status == false) {
//                    if(result.location != ''){
//                        window.location.href = '/user/login'
//                    }
//                    return false;
//                } else {
//                    return true;
//                }
//            }).fail(function () {
//                alert('签到失败，请刷新页面重试');
//                return false;
//            })
//        });


        $('.banner').unslider({
            speed: 500,
            delay: 3000,
            keys: true,
            dots: true,
            fluid: false
        });
    });
</script>
