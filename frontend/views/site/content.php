<div class="today-goods-list">
    <!--单个商品 start-->
    <div class="area">
<script type="text/javascript">
$(document).ready(function(e) 
{ 
    $(".shop").hover(function(){
        $(this).find(".wai").show();
        $(this).find(".omg").show();
        // $(this).find(".aa").show();
        },function(){   
        $(this).find(".wai").hide();
        $(this).find(".omg").hide();
        // $(this).find(".aa").hide(); 
    });

   $(".deal div").hover(function(){
     $(this).addClass("ppppp");
   },function(){ $(this).removeClass("ppppp");  
    })

});

</script> 

     <!--首页品牌调用 start-->
       <?php if(!empty($brand) && isset($brand)) {
        foreach ($brand as $item) : ?>
        <div class="dealbox">
            <div class="deal figure1 zt1">
                <div class="">
                    <p>
                        <a href="<?php echo $item->brand_url;?>" target="_blank">
                            <img class="goods-item-img" data-url="<?php echo $item->brand_img; ?>" src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/lazyloading.jpg" title="<?php echo $item->title; ?>" alt="<?php echo $item->title; ?>" width="290" height="190">
                        </a>
                    </p>
                    <h2>
                        <strong>
                            <a href="<?php echo $item->brand_url;?>" target="_blank">
                                <?php echo $item->describe;?>
                            </a>
                        </strong>
                    </h2>
                    <h4>
                        <span style="float: left;font: 22px/36px '微软雅黑';color: #333;width: 200px;overflow: hidden;text-align: left;cursor:pointer;">
                           
                          <?php echo $item->title;?>
                            
                        </span>
                        <style type="text/css">
                            .deal div h4 .qukakan{display: inline-block;width: 67px;height: 31px;background: url('/static/images/icon5.png') no-repeat scroll 0px 0px transparent;margin-top: 5px;}
                        </style>      
                        <a class="qukakan" href="<?php echo $item->brand_url;?>" target="_blank"></a></span></span>
                    </h4>
                    <?php
                    //echo '<span class="newicon1111">去看看</span>';
                    ?>
                </div>
            </div>
        </div>
        <?php endforeach; }?>
   <!--首页品牌调用 end-->


     <!--首页积分调用 start-->
       <?php if(!empty($exchange) && isset($exchange) && isset($cat) && empty($cat)) {
   
        foreach ($exchange as $item) : ?>
        <div class="dealbox">
            <div class="deal figure1 zt1">
                <div class="">
                    <p>
                       <?php 
                       if($item->goods_type==0)
                       {
                        $goodsUrl = Yii::app()->createUrl("exchange/exchangeIndex", array("id" => Des::encrypt($item->id)));
                       }else
                       {
                         $goodsUrl = Yii::app()->createUrl("exchange/raffle", ['id' => Des::encrypt($item->id)]);

                       }

                       ?>

                        <a href="<?php echo $goodsUrl;?>" target="_blank">
                            <img class="goods-item-img" data-url="<?php echo $item->img_url; ?>" src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/lazyloading.jpg" title="<?php echo $item->name; ?>" alt="<?php echo $item->name; ?>" width="290" height="190">
                        </a>
                    </p>
                    <h2>
                        <strong>
                            <a href="<?php echo $goodsUrl;?>" target="_blank">
                             <?php if($item->goods_type==1):?>
                                【积分抽奖】
                             <?php else:?>
                                【积分兑换】
                             <?php endif;?>
                            </a>
                        </strong>
                        <a href="<?php echo $goodsUrl;?>" target="_blank" title="<?php echo $item->name;?>">
                            <?php ECHO Front::truncate_utf8_string($item->name,10); ?>
                        </a>
                    </h2>
                    <h4>
                        <span>
                            <em>
                                <b style="font-size:26px;font-weight:'微软雅黑';"><?php echo $item->active_price;?><b style="font-size:12px;font-weight:bold;">元</b>+<b style="font-size:26px;font-weight:'微软雅黑';"><?php echo $item->integral; ?>分</b></b>
                                
                            </em>
                        </span>
                        <span>
                            <i>￥<?php echo $item->price.'元';?></i>
                        </span>                       
                        <a href="<?php echo $goodsUrl;?>" target="_blank"></a></span></span>
                    </h4>
 
                </div>
            </div>
        </div>
        <?php endforeach; }?>
   <!--首页积分调用 end-->

   
        <?php 
        if(!empty($goods)): ?>
        <div id="goods">
        <?php foreach ($goods as $item) :?>
            <?php $goodsUrl = $this->createUrl('site/out', array('id' => Des::encrypt($item->id)));?>
        <div class="shop">
            <?php if($item->is_zhe800==3):?>
                <!-- <div class="aa">hkhhjkhjkhk</div> -->
             <div class="wai">
                <a href="<?php echo $goodsUrl;?>" target="_blank">&nbsp;</a>
                <p>
                <span>历史成交：</span><?php echo $item->pbuy;?>人购买 / <?php echo $item->pnum;?>人评价
                <br/>
            <span>小编点评：</span><?php echo $item->comment;?></p>
                <i><a href="<?php echo $goodsUrl;?>" target="_blank">&nbsp;</a></i>
             </div>
         <?php else:?>
             <div class="omg">
                <a href="<?php echo $goodsUrl;?>" target="_blank">&nbsp;</a>
                <i><a href="<?php echo $goodsUrl;?>" target="_blank">&nbsp;</a></i>
             </div>
            <?php endif;?>
            <a href="<?php echo $goodsUrl ?>" target="_blank"><img class="goods-item-img" data-url="<?php echo $item->picture; ?>" src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/lazyloading.jpg" title="<?php echo $item->title; ?>" alt="<?php echo $item->title; ?>" width="290" height="190"></a>
            <h2>
             <?php if($item->is_zhe800==3):?>
            【附<?php echo $item->shainum;?>张实拍图】<?php ECHO Front::truncate_utf8_string($item->title,10); ?>
            <?php else:?>
                【<?php echo Store::getStoreByPk($item->relation_website);?>】<?php ECHO Front::truncate_utf8_string($item->title,10); ?>
            <?php endif;?>
            </h2>
            <h4>
                <span>
                    <em><b>¥</b><?php echo $item->price; ?></em>
                </span>
                <span>
                    <i>¥<?php echo $item->origin_price;?></i><br>
                    <em>
                     <?php if($item->change_price==1):?>
                            <b class='i2'></b>
                    <?php elseif($item->is_zhe800==3):?>
                            <b class='i5'><?php echo $item->mark;?>评分</b><b class='i6'>晒单(<?php echo $item->shainum;?>)</b>
                    <?php endif;?>
                        <br>
                    </em>
                </span>
                <a href="<?php echo $goodsUrl ?>" target="_blank"></a>
                
            </h4>
            <?php
                    $now = date('Y-m-d', time());
                    $today = date('Y-m-d', $item->created_at);
                    $start_time = date('Y-m-d', $item->start_time);
                    if (($now == $today)||($now == $start_time)) {
                    echo '<span class="newicon"></span>';
                    }
            ?>
        </div>

    <?php endforeach;?>
        </div>
         
         <?php else: ?>
    <link rel="stylesheet" type="text/css"  href="/static/css/search.css?v=1.1.0"/>
   <div class="dsearch area">
    <div class="dsearchtit area">
      <p>没有找到与 <em id="custumize_word"><?php if(isset($_GET['title'])){echo $_GET['title'];}?></em> 相关的商品！</p>
        <p>您可以：</p>
    <div class="search_form">
      <form target="_blank" action="http://www.meipin.com/search/index">
        <span>1、</span><input class="key_word" placeholder="搜索其它关键词" name="title" type="text"><input class="submit" value="" type="submit">
      </form>
    </div>
     <p>2、查看其他商品</p>
  </div>
</div>
    <?php 
    if(isset($othergoods)): foreach ($othergoods as $item) : ?>
        <?php $goodsUrl = $this->createUrl('site/out', array('id' => Des::encrypt($item->id)));?>
        <div class="dealbox">
            <div class="deal figure1 zt1">
                <div class="">
                    <p>
                        <a href="<?php echo $goodsUrl ?>" target="_blank">
                            <img class="goods-item-img" data-url="<?php echo $item->picture; ?>" src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/lazyloading.jpg" title="<?php echo $item->title; ?>" alt="<?php echo $item->title; ?>" width="290" height="190">
                        </a>
                    </p>
                    <h2>
                        <strong>
                            <a href="<?php echo $goodsUrl ?>" target="_blank">
                                【<?php echo Store::getStoreByPk($item->relation_website);?>】
                            </a>
                        </strong>
                        <a href="<?php echo $goodsUrl ?>" target="_blank" title="<?php echo $item->title;?>">
                            <?php ECHO Front::truncate_utf8_string($item->title,10); ?>
                        </a>
                    </h2>
                    <h4>
                        <span>
                         <?php if ($item->sell_status ==2 ):?>
                            <em style='color:#a9a9a9'>
                                <b>¥</b>
                                <em style='color:#a9a9a9;text-decoration:line-through'><?php echo $item->price; ?></em>
                            </em>
                        <?php else:?>
                            <em>
                                <em><b>¥</b><?php echo $item->price; ?></em>
                            </em>
                        <?php endif;?>
                        </span>
                        <span>
                            <i>¥<?php echo $item->origin_price;?></i>
                        </span>
                        <?php if ($item->start_time > time() && $item->sell_status !=2 ) :?>
                        <span><span><a href="<?php echo $goodsUrl ?>" target="_blank" ></a></span></span>
                        <?php elseif($item->sell_status ==2) :?> 
                        <span><a  href="<?php echo $goodsUrl ?>" target="_blank" ></a></span>
                        <?php else:?>
                        <a  href="<?php echo $goodsUrl ?>" target="_blank" ></a>
                        <?php endif;?>
                    </h4>
                    <span class="mgicon"></span>
                    <?php
                    $now = date('Y-m-d', time());
                    $today = date('Y-m-d', $item->created_at);
                    $start_time = date('Y-m-d', $item->start_time);
                    if (($now == $today)||($now == $start_time)) {
                    echo '<span class="newicon"></span>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php endforeach;  endif; endif;?>
</div>
<div style="clear:both;"></div>

</div>
