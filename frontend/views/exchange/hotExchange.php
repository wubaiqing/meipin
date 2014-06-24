<?php
$label = "";
if ($goodsType == 0) {
    $label = "热门兑换活动";
} elseif ($goodsType == 1) {
    $label = "热门抽奖活动";
}
?>
<div class="blockA">
    <h2><?php echo $label; ?></h2>
    <ul>
        <?php
        foreach ($goodsList as $goods):
            $goodsAction = "";
            if($goods->goods_type ==0){
                $goodsAction = "exchange/exchangeIndex";
            }elseif($goods->goods_type == 1){
                $goodsAction = "exchange/raffle";
            }
            $goodsUrl = Yii::app()->createUrl($goodsAction, array("id" => Des::encrypt($goods->id)));
            ?>
            <li>
                <a href="<?php echo $goodsUrl; ?>" target="_blank">
                    <img src="<?php echo $goods->img_url ?>">
                </a>
                <h3>
                    <a href="<?php echo $goodsUrl; ?>" target="_blank" title="<?php echo $goods->name; ?>">
                        <?php echo $goods->name; ?>
                    </a>
                </h3>
                <p><strong><?php echo $goods->user_count; ?></strong>人已参与</p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>