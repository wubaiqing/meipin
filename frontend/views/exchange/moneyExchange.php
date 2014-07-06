<div id="detail" class="detail">
    <div class="deteilpic l">
        <div style="width: 400px;" id="big_img">
            <img width="380" src="<?php echo $data['exchange']->img_url; ?>">
        </div>
        <!--        <ul>
                    <li class="cur">
                        <a href="javascript:;">
                            <img src="http://z4.tuanimg.com/imagev2/trade/400x400.2a618920812b60ee22edc97feb93f7e2.58x58.jpg" bigimage-data="http://z4.tuanimg.com/imagev2/trade/400x400.2a618920812b60ee22edc97feb93f7e2.400x.jpg">
                        </a>
                    </li>
                </ul>-->
    </div>
    <div class="detailmeta r">
        <form method="POST" action="<?php echo Yii::app()->createUrl("exchange/order") ?>" onsubmit="return exchange.checkMoneyBuy();">
            <h2 ><?php echo $data['exchange']->name; ?></h2>
            <div class="panelA line_dashed_top">
                <dl class="nubA ">
                    <dt>现价：</dt>
                    <dd> <strong class="red1 fs26">￥<i info="18"><?php echo $data['exchange']->active_price; ?></i></strong>
                        +<span class="red1"><em class=" fs26"><?php echo $data['exchange']->integral; ?></em>积分</span>
                    </dd>
                </dl>
                <dl class="nubB ">
                    <dt>原价：</dt>
                    <dd>
                        <del>￥<?php echo $data['exchange']->price; ?></del>
                        <span id="discount"> （<?php echo round(($data['exchange']->active_price / $data['exchange']->price) * 10, 1) ?>折） </span>
                    </dd>
                </dl>
                <dl class="nubD line_dashed_top">
                    <dt>销量：</dt>
                    <dd>
                        <b class="red1"><?php echo $data['exchange']->sale_num; ?></b>&nbsp;件
                    </dd>
                </dl>
                <dl class="nubD ">
                    <dt>选型：</dt>
                    <dd>
                        <span class="goodcolor">
                            <?php foreach ($data['exchange']->goodscolor as $key => $value): ?>
                                <a <?php
                                if ($value['gdcolornum'] == 0) {
                                    echo "class='be' stock='0' ";
                                } else {
                                    echo 'stock=' . $value["gdcolornum"] . '' . ' sclor=' . $value["gdcolorname"] . '';
                                }
                                ?>  href="javascript:void(0)"><?php echo $value['gdcolorname'] . "({$value['gdcolornum']})"; ?></a>
                                <?php endforeach; ?>
                        </span>
                    </dd>
                </dl>
                <dl class="nubD ">
                    <dt>数量：</dt>
                    <dd>
                        <?php
                        $leftNum = $data['exchange']->num - $data['exchange']->sale_num;
                        echo CHtml::textField("buyCount", $data['exchange']->buyCount, ['id' => 'num', 'limitNum' => $leftNum,'autocomplete'=>'off']);
                        echo Chtml::link("+", "javascript:", ['class' => 'jiahao']);
                        echo Chtml::link("-", "javascript:", ['class' => 'jianhao']);

                        echo CHtml::hiddenField("gdcolor", '', ['id' => 'gdcolor']);
                        echo CHtml::hiddenField("id", $params['goodsId']);
                        echo CHtml::hiddenField("goods_type", $data['exchange']->goods_type);
                        ?>
                    </dd>
                </dl>
                <dl class="nubD ">
                    <dt>
                    <input class="submit_ok" type="submit" address_id="" value="立即购买">
                    </dt>
                </dl>
            </div>
        </form>
    </div>
    <div class="clear_div"></div>
    <div class="full_div line_solid_top">
        <img src="http://z0.tuanimg.com/shop/v1/global/img/security.png">
    </div>
    <div class="mainwrap">
        <div class="title">
            <hgroup class="">
                <p class="l">
                    <span id="productdetail" class=" cur"><a href="javascript:void(0);">宝贝详情</a></span>
                    <span id="xuzhi" class=""><a href="javascript:void(0);">购买须知</a></span>
                    <span id="record" class=""><a href="javascript:void(0);">销量明细<b>(<?php echo $data['exchange']->sale_num?>)</b></a></span>
                </p>
                <p class="r">
                    <i></i><b><?php echo $data['exchange']->active_price; ?></b><del>￥<?php echo $data['exchange']->price; ?></del>
                    <span class="s2"><a href="javascript:void(0)">立即购买</a></span>    </p>
            </hgroup>
        </div>
        <div class="dtl productdetail">
            <?php echo $data['exchange']->description ?>
        </div>
        <div class="dtl xuzhi show_none">
            须知
        </div>
        <div class="dtl record show_none">
            <?php
            $this->renderPartial('exchangeLogList', array('logList' => $data['logList'], 'goodsType' => $data['exchange']->goods_type));
            ?>
        </div>
    </div>
    <br/>
</div>