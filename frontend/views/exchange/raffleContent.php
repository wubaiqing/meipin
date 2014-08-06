<div class="today-goods-list">
    <!--单个商品 start-->
    <div class="area">
        <?php
        foreach ($goods as $item) :
            //if ($history != 'history' && $item['end_time'] < time()) continue;
            if($item['end_time'] < time())
            {
                $history = "history";
            }
            $goodsUrl = Yii::app()->createUrl("exchange/raffle", ['id' => Des::encrypt($item['id'])]);
            ?>
            <div class="dealbox">
                <div class="deal raffle">
                    <div class="">
                        <p>
                            <a href="<?php echo $goodsUrl; ?>" target="_blank">
                                <img class="goods-item-img" data-url="<?php echo $item['img_url'] ?>" src="http://www.meipin.com/static/images/lazyloading.jpg" title="<?php echo $item['name'] ?>" alt="<?php echo $item['name'] ?>" width="290" height="190">
                            </a>
                        </p>
                        
                        <p class="time" date='<?php echo date("Y-m-d H:i:s", $item['end_time']) ?>' sdate='<?php if($item["start_time"]> time()){echo date("Y-m-d H:i:s", $item["start_time"]);}?>' url='<?php echo $goodsUrl ?>'>
                            <?php
                            $md = date("Y", $item['end_time']) > date("Y") ? date("Y.n.j", $item['end_time']) : date("n.j", $item['end_time']);
                            if ($item['end_time'] > time()):
                                ?>
                                <span>截至<?php echo $md ?>日<i><?php echo date("H:i", $item['end_time']) ?></i></span>
                            <?php else: ?>
                                <span><?php echo date("Y年n月j日", $item['end_time']) ?>结束</span>
                            <?php endif; ?>
                            <em></em>
                        </p>
                        <h2>
                            <strong>
                                <a href="<?php echo $goodsUrl ?>" target="_blank">
                                    【0元包邮】
                                </a>
                            </strong>
                            <a href="<?php echo $goodsUrl ?>" target="_blank" title="<?php echo $item['name'] ?>">
                                <?php ECHO Front::truncate_utf8_string($item['name'],12); ?>
                            </a>
                        </h2>
                        <p>
                            <em><span class="canyu"><?php echo $item['user_count'] ?></span>&nbsp;人已参与</em><span>价值：<?php echo $item['price'] ?>元</span> 中奖名额：<b><?php echo $item['limit_count'] ?></b>
                        </p>
                        <h4 class="<?php echo ($history == 'history') ? 'raffle_history' : ''; ?>">
                            <span>
                                <em style="font-size: 12px;">
                                    <em><?php echo $item['integral'] ?></em>
                                    积分
                                </em>
                            </span>
                            <?php if ($history == 'history'): ?>
                                <a class="raffle_history">已结束</a>
                            <?php else: ?>
                                 <?php if($item["start_time"]> time()){echo '<a class="rafflecjkaishi" href="'.$goodsUrl.'" target="_blank"><span>即将开始</span></a>';}else{echo '<a class="raffle" href="'.$goodsUrl.'" target="_blank">我要抽奖</a>';} ?>
                                
                            <?php endif; ?>
                        </h4>
                        <span class="mgicon"></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div style="clear:both;"></div>
<!-- <div id="contentD" class="area">
    <a href="<?php //echo Yii::app()->createUrl("site/raffle", [ 't' => 'history']) ?>" target="_blank">查看历史抽奖活动&gt;&gt;</a>
</div> -->
</div>
