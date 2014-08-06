<link rel="stylesheet" type="text/css"  href="/static/css/contents.css?v=1.0.0.01"/>
<div id="detail" class="detail">
    <div class="deteilpic l">
        <div style="width: 400px;" id="big_img">
            <img width="400" height="400" src="<?php echo $data['exchange']->bigimg_url?$data['exchange']->bigimg_url:$data['exchange']->img_url; ?>">
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
            <?php
                $leftNum = $data['exchange']->num - $data['exchange']->sale_num;
                $canBuy = ($leftNum < 1 || $data['exchange']->end_time< time())? false:true;
            ?>
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
                <?php if($data['exchange']->goodscolor):?>
                <dl class="nubD ">
                    <dt>选型：</dt>
                    <dd>
                        <span class="goodcolor" id="is_gdcolor">
                            <?php foreach ($data['exchange']->goodscolor as $key => $value): ?>
                                <a <?php
                                if ($value['gdcolornum'] == 0) {
                                    echo "class='be' stock='0' ";
                                } else {
                                    echo 'stock=' . $value["gdcolornum"] . '' . ' sclor=' . $value["gdcolorname"] . '';
                                }
                                ?>  href="javascript:void(0)" class="<?php echo $canBuy?"":'disabled bgcolor_gray'?>"><?php echo $value['gdcolorname'] . ""; ?></a>
                                <?php endforeach; ?>
                        </span>
                    </dd>
                </dl>
                <?php endif;?>
                <dl class="nubD ">
                    <dt>数量：</dt>
                    <dd>
                        <?php
                        echo CHtml::textField("buyCount", $data['exchange']->buyCount?$data['exchange']->buyCount:1, ['id' => 'num','limitNum' => $leftNum, 'autocomplete' => 'off','disabled'=>!$canBuy,'class'=>!$canBuy?'bgcolor_gray':'']);
            
                        echo Chtml::link("+", "javascript:", ['class' => 'jiahao']);

                        echo Chtml::link("-", "javascript:", ['class' => 'jianhao']);

                        echo CHtml::hiddenField("gdcolor", '', ['id' => 'gdcolor']);
                        echo CHtml::hiddenField("goods_num", '', ['id' => 'goods_num']);
                        echo CHtml::hiddenField("id", $params['goodsId'],['id'=>'gdid']);
                        echo CHtml::hiddenField("goods_type", $data['exchange']->goods_type);
                      if($count < $data['exchange']->buy_num){
                        $zhxz= $data['exchange']->buy_num - $count;}else{
                        $zhxz= $data['exchange']->buy_num;
                      }
                        echo CHtml::hiddenField("zhxz", $zhxz, array('id'=>'zhxz')); //限制件数
                        echo CHtml::hiddenField("zhkc", $zhxz,array('id'=>'zhkc'));
                        //选中商品库存数
                        ?> <a class="sykc">库存<span id='kckc_id'><?php echo $leftNum;?> </span> 件 / 限购 <span id="xg_num"> 
                        <?php echo $data['exchange']->buy_num;?></span> 件</a>
                    </dd><span id="leixing" style="color:red"><?php if($count >=$data['exchange']->buy_num){echo "您已经超过了限制购买的件数，请重新选择其他商品";} ?></span>
                </dl>

                <dl class="nubD ">
                    <dt>
                    <?php

                    if($data['exchange']->start_time > time() && $leftNum >0):
                    
                      echo '<input class="submit_jiks" type="button" address_id="" value="即将开始">';
                    
                    elseif (!$canBuy || $count >=$data['exchange']->buy_num):
                        ?>
                        <input class="submit_no" type="button" address_id="" value="立即购买">
                    <?php else: ?>
                        <input class="submit_ok" type="submit" address_id="" value="立即购买">
                    <?php endif; ?>
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
                    <span id="record" class=""><a href="javascript:void(0);">销量明细<b>(<?php echo $data['exchange']->sale_num ?>)</b></a></span>
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
            <p>商家：<strong style="line-height:1.6">官方积分商城</strong></p>

            <p>发货地点：<span style="line-height:1.6">北京市 &nbsp; &nbsp;</span></p>

            <p>配送范围：<span style="line-height:1.6">全国</span></p>

            <p>运费：<span style="line-height:1.6">内蒙古自治区,西藏自治区,甘肃省,青海省,宁夏回族自治区,新疆维吾尔自治区,台湾,香港,澳门不包邮，首件邮费20元；每加一件,邮费增加20元;全国其他地区包邮;</span></p>

            <p>收货：<span style="line-height:1.6">您确认收货后，将打款给卖家； 发货后，15天内您未操作确认收货，系统将代替您自动完成确认收货。</span></p>

            <p>包裹跟踪：<span style="line-height:1.6">您可在【<a href="<?php echo Yii::app()->createUrl("order/list")?>">我的订单</a>】中查询包裹跟踪信息；</span></p>

            <p>特卖商城售后保障：<span style="line-height:1.6">如需退货，需进入【<a href="<?php echo Yii::app()->createUrl("order/list")?>">我的订单</a>】，找到您要退换货的商品，点击对应的&ldquo;申请退款/申请退货&rdquo;，按页面提示填写并提交，商家将在页面给您回复。如与商家沟通中遇到问题，可点击&quot;我要维权&quot;，由美品网官方介入处理。</span></p>

            <p><a>退货条件说明</a></p>

            <p><a style="color:red">退货运费由买卖双方协商,所有积分换购商品，均不提供发票及收据，介意者勿换，谢谢合作</a></p>

        </div>
        <div class="dtl record show_none">
            <?php
            $this->renderPartial('exchangeLogList', array('logList' => $data['logList'], 'goodsType' => $data['exchange']->goods_type));
            ?>
        </div>
    </div>
    <br/>
</div>