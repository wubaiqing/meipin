<div class="today-goods-list">
    <!--单个商品 start-->
    <div class="area">
        <?php foreach ($goods as $item) : ?>
        <div class="dealbox">
            <div class="deal figure1 zt1">
                <div class="">
                    <p>
                        <a href="<?php echo $item->url;?>" target="_blank">
                            <img class="goods-item-img" src="<?php echo $item->picture;?>" alt="<?php echo $item->title;?>" width="290" height="290">
                        </a>
                    </p>
                    <h2>
                        <strong>
                            <a href="<?php echo $item->url;?>" target="_blank">
                                【<?php echo Store::getStoreByPk($item->relation_website);?>】
                            </a>
                        </strong>
                        <a href="<?php echo $item->url;?>" target="_blank">
                            <?php echo $item->title;?>
                        </a>
                    </h2>
                    <h4>
                        <span>
                            <em>
                                <b>¥</b>
                                <em><?php echo $item->price; ?></em>
                            </em>
                        </span>
                        <span>
                            <i>¥<?php echo $item->origin_price;?></i>
                        </span>
                        <?php if ($item->start_time > time()) :?>
                        <font><?php echo date('G', $item->start_time);?>点开始</font>
                        <?php else:?>
                        <a  href="<?php echo $this->createUrl('site/details', array('goodsId' => $item->id));?>" target="_blank" ></a>
                        <?php endif;?>
                    </h4>
                    <span class="mgicon"></span>
                    <?php 
                    $now = date('Y-m-d', time());
                    $today = date('Y-m-d', $item->created_at);
                    if ($now == $today) {
                    echo '<span class="newicon"></span>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
