<div class="nav">
    <ul class="wp">
        <li class="<?php echo ($cat < 1000) ? 'on' : '';?>">
            <a href="/">
                首页
            </a>
        </li>
        <li class="<?php echo ($cat == 1000) ? 'on' : '';?>">
            <a href="<?php echo $this->createUrl('site/index', array('cat' => 1000));?>">
                九块九包邮
            </a>
        </li>
        <li class="<?php echo ($cat == 1001) ? 'on' : '';?>">
            <a href="<?php echo $this->createUrl('site/index', array('cat' => 1001));?>">
                聚美品
            </a>
        </li>
        <li class="">
            <a href="<?php echo $this->createUrl('exchange/index');?>">
                积分兑换
            </a>
        </li>
        <li class="nav_r">
            <a href="javascript:;">
                商家报名
            </a>
            <a href="javascript:;">
                买家咨询
            </a>
        </li>
    </ul>
</div>
