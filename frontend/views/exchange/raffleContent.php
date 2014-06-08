<div class="today-goods-list">
    <!--单个商品 start-->
    <div class="area">
        <?php
        foreach ($goods as $item) :
            $goodsUrl = Yii::app()->createUrl("exchange/reffle", ['id' => Des::encrypt($item['id'])]);
            ?>
            <div class="dealbox">
                <div class="deal raffle">
                    <div class="">
                        <p>
                            <a href="/out/50f227fb8aa40834.html" target="_blank">
                                <img class="goods-item-img" data-url="http://static.meipin.com/static/images/2014/06/06/7AhFD1402021025539124a135b94.jpg" src="http://static.meipin.com/static/images/2014/06/06/7AhFD1402021025539124a135b94.jpg" title="冰丝蔓藤沙发垫[多规格可选] 6.8元包邮" alt="冰丝蔓藤沙发垫[多规格可选] 6.8元包邮" width="290" height="190">
                            </a>
                        </p>
                        <p class="time" date='<?php echo date("Y-m-d H:i:s", $item['end_time']) ?>' url='<?php echo $goodsUrl ?>'>
                            <?php
                            $md = date("Y", $item['end_time']) > date("Y") ? date("Y.n.j", $item['end_time']) : date("n.j", $item['end_time']);
                            ?>
                            <span>截至<?php echo $md ?>日<i><?php echo date("H:i", $item['end_time']) ?></i></span><em></em>
                        </p>
                        <h2>
                            <strong>
                                <a href="<?php echo $goodsUrl ?>" target="_blank">
                                    【0元包邮】
                                </a>
                            </strong>
                            <a href="<?php echo $goodsUrl ?>" target="_blank">
                                <?php echo $item['name'] ?>
                            </a>
                        </h2>
                        <p>
                            <em><?php echo 29 ?>人已参与</em><span>价值：<?php echo $item['price'] ?>元</span> 中奖名额：<b><?php echo 1 ?></b>
                        </p>
                        <h4 class="<?php echo ($history == 'history') ? 'raffle_history' : ''; ?>">
                            <span>
                                <em style="font-size: 12px;">
                                    <em><?php echo $item['integral'] ?></em>
                                    积分
                                </em>
                            </span>
                            <?php if ($history == 'history'): ?>
                                <a class="raffle_history">我要抽奖</a>
                            <?php else: ?>
                                <a class="raffle" href="<?php echo $goodsUrl ?>" target="_blank">我要抽奖</a>
                            <?php endif; ?>
                        </h4>
                        <span class="mgicon"></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div style="clear:both;"></div>
</div>
<div id="contentD" class="area">
    <a href="<?php echo Yii::app()->createUrl("site/raffle", ['cat' => $cat, 'history' => 'history']) ?>" target="_blank">查看历史抽奖活动&gt;&gt;</a>
</div>
<script type="text/javascript">

    /* by zhangxinxu 2010-07-27 
     * http://www.zhangxinxu.com/
     * 倒计时的实现
     */
    var fnTimeCountDown = function(d, o,url) {
        var f = {
            zero: function(n) {
                var n = parseInt(n, 10);
                if (n > 0) {
                    if (n <= 9) {
                        n = "0" + n;
                    }
                    return String(n);
                } else {
                    return "00";
                }
            },
            dv: function() {

                d = d || Date.UTC(2050, 0, 1); //如果未定义时间，则我们设定倒计时日期是2050年1月1日
                var future = new Date(d), now = new Date();

                //现在将来秒差值
                var dur = Math.round((future.getTime() - now.getTime()) / 1000), pms = {
                    sec: "00",
                    mini: "00",
                    hour: "00",
                    day: "00",
                    month: "00",
                    year: "0"
                };
                if (dur > 0) {
                    pms.sec = f.zero(dur % 60);
                    pms.mini = Math.floor((dur / 60)) > 0 ? f.zero(Math.floor((dur / 60)) % 60) : "00";
                    pms.hour = Math.floor((dur / 3600)) > 0 ? f.zero(Math.floor((dur / 3600)) % 24) : "00";
                    pms.day = Math.floor((dur / 86400)) > 0 ? f.zero(Math.floor((dur / 86400))) : "00";
                }
                return pms;
            },
            ui: function() {
                var str = "剩余：";
                str += "<b>" + f.dv().day + "</b>天";
                str += "<b>" + f.dv().hour + "</b>小时";
                str += "<b>" + f.dv().mini + "</b>分";
                str += "<b>" + f.dv().sec + "</b>秒";
                if ( f.dv().sec =='00' && f.dv().mini =='00' && f.dv().hour =='00' && f.dv().day =='00') {
                    $(o).html("<a href="+url+" target='_blank'>查看結果>><a>");
                } else {
                    $(o).html(str);
                }
//                setTimeout(f.ui, 1000);
            }
        };
        f.ui();
    };
    $(function() {
        $("p.time").each(function(i) {
            var str = $(this).attr("date").toString();
            str = str.replace(/-/g, "/");
            var d = new Date(str);
            fnTimeCountDown(d, $(this).find("em"),$(this).attr("url"));
        });
    });
</script>