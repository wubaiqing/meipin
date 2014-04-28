<div class="menu_wp">
    <div class="junav">
        <span>全部折扣<em>(<?php $count = count(Goods::getGoodsList(0, 0, 0)['data']);echo $count;?>)</em></span>
        
        <div class="new_bg r">
            <ul>
                <li class="on"><a href="/">最热<em></em></a></li>
                <li class="<?php $hot = Yii::app()->request->getQuery('hot'); echo ($hot == 1) ? 'on' : ''; ?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 0, 'hot' => 1));?>">最新<em></em></a></li>
            </ul>
        </div>
        <h5>小编会从早9点到晚21点，每整点更新一次给力宝贝！</h5>
    </div>
</div>
