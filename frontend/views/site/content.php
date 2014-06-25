<div class="today-goods-list">
    <!--单个商品 start-->
    <div class="area">
        <?php foreach ($goods as $item) : ?>
        <div class="dealbox">
            <div class="deal figure1 zt1">
                <div class="">
                    <p>
                        <a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($item->id)));?>" target="_blank">
                            <img class="goods-item-img" data-url="<?php echo $item->picture; ?>" src="http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/lazyloading.jpg" title="<?php echo $item->title; ?>" alt="<?php echo $item->title; ?>" width="290" height="190">
                        </a>
                    </p>
                    <h2>
                        <strong>
                            <a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($item->id)));?>" target="_blank">
                                【<?php echo Store::getStoreByPk($item->relation_website);?>】
                            </a>
                        </strong>
                        <a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($item->id)));?>" target="_blank">
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
						<span><span><a href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($item->id)));?>" target="_blank" ></a></span></span>
                        <?php elseif($item->sell_status ==2) :?> 
						<span><a  href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($item->id)));?>" target="_blank" ></a></span>
						<?php else:?>
						<a  href="<?php echo $this->createUrl('site/out', array('id' => Des::encrypt($item->id)));?>" target="_blank" ></a>
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
