<div class="today-goods-list">
    <!--单个商品 start-->
    <div class="area">


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
       <?php if(!empty($exchange) && isset($exchange)) {
   
        foreach ($exchange as $item) : ?>
        <div class="dealbox">
            <div class="deal figure1 zt1">
                <div class="">
                    <p>
                       <?php $goodsUrl = Yii::app()->createUrl("exchange/exchangeIndex", array("id" => Des::encrypt($item->id)));?>
                        <a href="<?php echo $goodsUrl;?>" target="_blank">
                            <img class="goods-item-img" data-url="<?php echo $item->img_url; ?>" src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/lazyloading.jpg" title="<?php echo $item->name; ?>" alt="<?php echo $item->name; ?>" width="290" height="190">
                        </a>
                    </p>
                    <h2>
                        <strong>
                            <a href="<?php echo $goodsUrl;?>" target="_blank">
                                【美品网】
                            </a>
                        </strong>
                        <a href="<?php echo $goodsUrl;?>" target="_blank">
                            <?php echo $item->name;?>
                        </a>
                    </h2>
                    <h4>
                        <span>
                            <em>
                                <b style="font-size:16px;font-weight:normal;"><?php echo $item->active_price;?><b style="font-size:12px;font-weight:bold;">元</b>+</b>
                                <em style="font-size:16px;font-weight:bold;"><?php echo $item->integral; ?>分</em>
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
        <?php foreach ($goods as $item) : ?>
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
                        <a href="<?php echo $goodsUrl ?>" target="_blank">
                            <?php echo $item->title;?>
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
                                <b>¥</b>
                                <em><?php echo $item->price; ?></em>
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
        <?php endforeach; ?>
    </div>
<div style="clear:both;"></div>

</div>
