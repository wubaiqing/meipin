<ul class="menu">
    <li class="j <?php echo ($cat == 0) ? 'on' : '';?>"><a href="/"><em></em>所有商品</a></li>
    <li class="k <?php echo ($cat == 1) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 1));?>" _hover-ignore="1"><em></em>时尚女装</a></li>
    <li class="b <?php echo ($cat == 4) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 4));?>" _hover-ignore="1"><em></em>时尚男装</a></li>
    <li class="a <?php echo ($cat == 10) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 10));?>"><em></em>数码家电</a></li>
    <li class="c <?php echo ($cat == 7) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 7));?>"><em></em>箱包鞋靴</a></li>
    <li class="d <?php echo ($cat == 9) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 9));?>"><em></em>食品酒水</a></li>
    <li class="e <?php echo ($cat == 8) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 8));?>" _hover-ignore="1"><em></em>配饰百货</a></li>
    <li class="f <?php echo ($cat == 11) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 11));?>"><em></em>化妆护理</a></li>
    <li class="h <?php echo ($cat == 12) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 12));?>"><em></em>文娱体育</a></li>
    <li class="g <?php echo ($cat == 6) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 6));?>"><em></em>母婴玩具</a></li>
    <li class="i <?php echo ($cat == 5) ? 'on' : '';?>"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 5));?>"><em></em>家居生活</a></li>
</ul>
