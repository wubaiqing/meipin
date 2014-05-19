<?php
$isSignDay = User::isSignDay();
?>
<div id="content" class="wp">
    <div class="w1040 clearfix">
        <!--积分广告和积分 登录开始-->
        <div class="pointsad-pointslog clearfix">
            <div class="pointsad fl">
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

                    </div>
                    <div class="pointslog-body"><p>欢迎来到美品积分商城，登陆后可查看您的个 人积分信息。</p></div>
                    <div class="pointslog-foot">
                        <dl class="clearfix">
                            <dt class="fl">

                            <a class="J_qiandao <?php echo!$isSignDay ? 'qiandao unsign' : 'signed'; ?>  " id="" href="javascript:void(0);">签到得积分</a>
                            </dt>
                            <dd class="fl"><a href="<?php echo Yii::app()->createUrl('score/index') ?>">个人中心</a><a href="<?php echo Yii::app()->createUrl('score/index') ?>">积分明细</a>
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
                                    src="http://www.meipin.com/assets/images/lazyloading.jpg" data-url="<?php echo $goods['img_url']; ?>" alt="<?php echo $goods['name']; ?> "
                                    title="<?php echo $goods['name']; ?>" class="exchange-img-list"></a>
                            <dl class="convertgood-desc">
                                <dd>
                                    <h3><a href="<?php echo $url; ?>" target="_blank"><?php echo $goods['name']; ?></a></h3>

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
<script type="text/javascript">
    $(function() {
        //懒加载
        $("img.exchange-img-list").scrollLoading();
        //滚动图
        $('.banner').unslider({
            speed: 500,
            delay: 3000,
            keys: true,
            dots: true,
            fluid: false
        });
    });
</script>
