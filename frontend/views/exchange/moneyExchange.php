<div id="detail" class="detail">
    <div class="deteilpic l">
        <div style="width: 400px;" id="big_img">
            <img src="http://z4.tuanimg.com/imagev2/trade/400x400.2a618920812b60ee22edc97feb93f7e2.400x.jpg">
        </div>
        <ul>
            <li class="cur">
                <a href="javascript:;">
                    <img src="http://z4.tuanimg.com/imagev2/trade/400x400.2a618920812b60ee22edc97feb93f7e2.58x58.jpg" bigimage-data="http://z4.tuanimg.com/imagev2/trade/400x400.2a618920812b60ee22edc97feb93f7e2.400x.jpg">
                </a>
            </li>
            <li class="">
                <a href="javascript:;">
                    <img src="http://z4.tuanimg.com/imagev2/trade/400x400.7b3ff3d7ff22ac777e782c59d149fc4e.58x58.jpg" bigimage-data="http://z4.tuanimg.com/imagev2/trade/400x400.7b3ff3d7ff22ac777e782c59d149fc4e.400x.jpg">
                </a>
            </li>
        </ul>
    </div>
    <div class="detailmeta r">
        <h2 >男士韩版修身短袖衬衣</h2>
        <div class="panelA line_dashed_top">
            <dl class="nubA ">
                <dt>现价：</dt>
                <dd> <strong class="red1 fs26">￥<i info="18">18</i></strong>  +<span class="red1"><em class=" fs26">88</em>积分</span>
                </dd>
            </dl>
            <dl class="nubB ">
                <dt>原价：</dt>
                <dd>
                    <del>￥139</del>
                    <span id="discount"> （1.3折） </span>
                </dd>
            </dl>
            <dl class="nubD line_dashed_top">
                <dt>销量：</dt>
                <dd>
                    <b class="red1">3</b>&nbsp;件
                </dd>
            </dl>
            <dl class="nubD ">
                <dt>选型：</dt>
                <dd>
                    <span class="goodcolor">
                        <a stock="48" sclor="深蓝色M号" href="javascript:void(0)">深蓝色M号(48)</a>
                        <a stock="42" sclor="黑色M号" href="javascript:void(0)">黑色M号(42)</a>
                        <a stock="29" sclor="黑色S号" href="javascript:void(0)">黑色S号(29)</a>
                        <a stock="79" sclor="黑色L号" href="javascript:void(0)">黑色L号(79)</a>
                    </span>
                </dd>
            </dl>
            <dl class="nubD ">
                <dt>数量：</dt>
                <dd>
                    <?php
                    $leftNum = $data['exchange']->num - $data['exchange']->sale_num;
                    echo CHtml::textField("Exchange[buyCount]", $data['exchange']->buyCount, ['id' => 'num', 'limitNum' => $leftNum]);
                    echo Chtml::link("+", "javascript:", ['class' => 'jiahao']);
                    echo Chtml::link("-", "javascript:", ['class' => 'jianhao']);
                    ?>
                </dd>
            </dl>
        </div>
        <div class="submit_ok ">
            <input type="hidden" id="productState" value="3">
            <span class="s2"><input type="submit" value="立即购买" class="gbtn"></span>
        </div>  
    </div>    
</div>