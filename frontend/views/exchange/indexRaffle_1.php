<?php
$isSignDay = User::isSignDay();
?>

    <!-- 抽奖商品 -->
    <div class="w1040 clearfix"  style='margin-top: 20px;'>
        <span style='font: 22px/22px "微软雅黑";'>
            <?php if ($timeLine == 'history'): ?>
                <em style='padding: 10px;background: url(http://z0.tuanimg.com/v1/jifen/auction/img/nbg.png) no-repeat -295px -50px;display: inline;margin-right: 5px;'>
                    &nbsp;
                </em>
            <?php endif; ?>
            <?php echo $timeLine != 'history' ? '正在进行的抽奖' : "历史抽奖活动" ?>
        </span>
        <span  style='font: 14px "微软雅黑";float: right;padding: 10px;'>
            <?php if ($timeLine != 'history'): ?>
                <a href='<?php echo Yii::app()->createUrl("exchange/raffle", ['time' => 'history']) ?>'>历史抽奖活动>></a>
            <?php else: ?>
                <a href='<?php echo Yii::app()->createUrl("exchange/raffle") ?>'>正在进行的抽奖>></a>
            <?php endif; ?>
        </span>
    </div>
    <!-- 积分兑换商品开始 -->
    <div class="pointsgood mt20 clearfix">
        <div class="pointsgood-body pb30 tab-pane" id="welfare2" style="display:block;">
            <?php foreach ($data as $goods): ?>
                <div class="dealbox">
                    <div class="deal figure1 zt1">
                        <div class="">
                            <p>
                                <a href="/out/55cbbac3a29d7218.html" target="_blank">
                                    <img class="goods-item-img" data-url="<?php echo $goods['img_url']; ?>" alt="<?php echo $goods['name']; ?>" src="http://www.meipin.com/static/images/lazyloading.jpg" title="<?php echo $goods['name']; ?>" width="290" height="190">
                                </a>
                            </p>
                            <div>
                                <span>截至<?php echo date("m.d日H:i");?></span><em><a href="/jifen/raffle/0yuanbaoyo_146216" target="_blank">查看结果&gt;&gt;</a></em>
                            </div>
                            <h2>
                                <strong>
                                    <a href="/out/55cbbac3a29d7218.html" target="_blank">
                                        【淘宝网】
                                    </a>
                                </strong>
                                <a href="/out/55cbbac3a29d7218.html" target="_blank">
                                    甜美高腰莫代尔字母织锦长裙圆领一步裙连衣裙 18元包邮                        </a>
                            </h2>
                            <h4>
                                <span>
                                    <em>
                                        <b>¥</b>
                                        <em>18.00</em>
                                    </em>
                                </span>
                                <span>
                                    <i>¥108.00</i>
                                </span>
                                <a href="/out/55cbbac3a29d7218.html" target="_blank"></a>
                            </h4>
                            <span class="mgicon"></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>    

            <!--            <ul class="clearfix">
            <?php foreach ($data as $goods): ?>
                <?php
                $url = Yii::app()->createUrl('exchange/exchangeIndex', array('id' => Des::encrypt($goods['id'])));
                ?>
                                                <li>
                                                    <div class="convertgood">
                                                        <a href="<?php echo $url; ?>" target="_blank" class="convertgood-pic"><img
                                                                src="http://www.meipin.com/static/images/lazyloading.jpg" data-url="<?php echo $goods['img_url']; ?>" alt="<?php echo $goods['name']; ?> "
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
                        </ul>-->
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
