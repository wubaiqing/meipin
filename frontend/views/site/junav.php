<div id="junav">
    <div class="t-area">
    <span class="l">
	  <a href="http://www.zhe800.com" class="<?php echo ($cat == 0) ? 'on' : '';?>"><em>全部</em></a>
	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 1));?>">女装
	</a>
	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 4));?>">男装
	</a>
	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 5));?>">居家
	</a>
	<a class="muying" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 6));?>">母婴
	</a>
	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 7));?>">鞋包
	</a>
	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 8));?>">配饰
	</a>
	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 9));?>">美食
	</a>
	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 10));?>">数码家电
	</a>
	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 11));?>">化妆品
	</a>
	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 12));?>">文体
	</a>
    </span>
    <span class="r">
      排序：
        <a href="/" class="class="<?php echo ($hot == 0 || $hot == null) ? 'on' : ''; ?>"">最热</a>
        <a class="class="<?php echo ($hot == 1) ? 'on' : ''; ?>"" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array('cat' => 0, 'hot' => 1));?>">最新</a>
    </span>
    </div>
</div>