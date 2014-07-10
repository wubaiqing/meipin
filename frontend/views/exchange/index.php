<?php
$isSignDay = User::isSignDay();
?>
<link rel="stylesheet" type="text/css"  href="/static/nav_style.css"/>
<link rel="stylesheet" type="text/css"  href="/static/css/exchange2.css"/>
<div id="content" class="wp">
    <div class="w1040 clearfix">
        <!--积分广告和积分 登录开始-->
        <div class="pointsad-pointslog clearfix">
            <div class="pointsad fl">
                <div class="banner has-dots">
                    <ul>
                        <li style="display: block;">
                            <a target="_blank" href="javascript:;" title="test1">
                            <img width="650" height="210"src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/static/test1.jpg"alt="测试111"></a>
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
                            <a class="J_qiandao <?php echo!$isSignDay ? 'qiandao unsign' : 'cheng signed'; ?>  " id="jryq2" href="javascript:void(0);"><?php $isSignDay = User::isSignDay(); echo !$isSignDay ? '签到领积分' : '今日已签'; ?></a>
                            </dt>
                            <dd class="fl"><a href="<?php echo Yii::app()->createUrl('score/index') ?>">积分明细</a>
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
   <div id="wrap">
    <div id="main">
        <div>
            <ul>
            <?php foreach ($data as $goods): ?>
            <?php
                $url = Yii::app()->createUrl('exchange/exchangeIndex', array('id' => Des::encrypt($goods['id'])));
            ?>
                <li>
                    <a href="<?php echo $url; ?>" target='_blank'><img src="<?php echo $goods['img_url']; ?>" width="190px" height="124px;" /></a>
                    <h4><a href="<?php echo $url; ?>" target='_blank' title="<?php echo $goods['name']; ?>"><?php ECHO Front::truncate_utf8_string($goods['name'],12); ?></a></h4>
                    <p>剩余：<span><?php 
                    $leftNum = $goods['num'] - $goods['sale_num'];
                            echo $leftNum > 0 ? $leftNum : 0; ?><span>份</p>
                    <dl>
                        <dt><span><?php echo $goods['integral']; ?></span>分</dt>
                        <dd>
                       <?php 
                         if($goods['start_time'] > time())
                         {
                            echo "<a href='{$url}' target='_blank' class='rafflekaishi'><span>即将开始</span>";
                         }elseif ($goods['start_time'] < time() && $goods['end_time'] > time() && $leftNum >0) {
                             echo "<a href='{$url}' target='_blank' class='raffle'>我要兑换";
                         }else
                         {
                            echo "<a href='{$url}' target='_blank' class='rafflejishu'>";
                         }
                        ?> 
                        

                        </a></dd>
                        <br>
                     </dl>
                </li>
           <?php endforeach; ?>
                <br>
            </ul>
        </div>
    </div>
</div>
    <!-- 积分兑换商品开始 -->
    <!-- 分页开始 -->
    <?php $this->renderPartial('//site/page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
    <!-- 分页结束 -->
</div>
<script type="text/javascript">
    $(function () {
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
