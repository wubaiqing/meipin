<div id="nav">
	<div class="two">
		<ul>
			<li> <a class="<?php echo (Yii::app()->controller->id == 'site' && $cat < 1000 && $this->action->id == 'index') ? 'on' : ''; ?>" href="/">首页</a></li>
			<li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1000) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/index', array('cat' => 1000));?>">9.9包邮<i></i></a></li>
			<!-- <li><a class="<?php //echo (Yii::app()->controller->id == 'site' && $cat == 1001) ? 'on' : ''; ?>" href="<?php //echo $this->createUrl('site/index', array('cat' => 1001));?>">聚美品<i></i></a></li> -->
			<li><a href="<?php echo $this->createUrl('exchange/index');?>" class="<?php echo (Yii::app()->controller->id == 'exchange' && ($this->action->id == 'index' || $this->cat == 1004)) ? 'on' : ''; ?>">积分兑换</a></li>
                        <li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1003 || Yii::app()->controller->id == 'exchange' && $this->cat == 1003) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('site/raffle');?>">幸运抽奖<i></i></a></li>
			<li><a class="<?php echo (Yii::app()->controller->id == 'site' && $this->action->id == 'phone') ? 'on' : ''; ?>" href="/site/phone">手机APP</a></li>
			<li><a class="<?php echo (Yii::app()->controller->id == 'site' && $cat == 1002) ? 'on' : ''; ?>" href="<?php echo $this->createUrl('/tomorrow');?>">明日预告</a></li>
			<br>
		</ul>
<style type="text/css">
.qiandao {float:left;position:relative;}

#nav .qiandao ol {width:160px;height:70px;position:absolute;top:36px;padding-top:8px;border-bottom:1px solid red;border-left:1px solid red;border-right:1px solid red;background-color: white;z-index: 999;}

#nav .qiandao ol li {font-family:"宋体";font-size:12px;color:#333;line-height:20px;text-align:center;width:150px;padding-left:10px;}
.qiandao ol li span {color:red;}

.qiandao dl {width:160px;margin-top:36px;height:120px;border-bottom:1px solid #c11713;border-left:1px solid #c11713;border-right:1px solid #c11713;padding-left:10px;background-color: white;z-index: 999;position:absolute;padding-top: 3px;}
.qiandao dl dt {font-size:12px;color:#666;line-height:22px;width:120px;}
#nav .qiandao dl dd a {font-size:12px;color:#1b80a9;line-height:20px;background-color:white;width:150px;}
#nav .qiandao dl dt span {color:#e02f2f;font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;font-weight:bold;font-size:14px;}
</style>
		<p class="one"><a href="/site/bsrg" target="_blank">商家报名</a></p>

		 <div class="qiandao">
            <p><a href="#">签到领积分</a>
            <?php if (empty($this->user)): ?>
            <ol>
                <li>每天最多可赚：<span>3 </span>积分</li>
                <li><span style="color:#09C">登陆 </span>后才能签到</li>
            </ol>
           <?php endif;?>
            <?php if (!empty($this->user)): ?>
             <dl>
                <dt>连续签到 <?php echo $this->user->dr_count ?> 天，<span>+<?php
                                    if ($this->user->dr_count == 0) {
                                        echo "0";
                                    } else {
                                        $scoreList = Yii::app()->params['dayRegistionNum'];
                                        echo ($this->user->dr_count) > 3 ? 3 : $scoreList[$this->user->dr_count];
                                    }
                                    ?>分</span></dt>
                <dt>明天签到可得<span> <?php
                                    if ($this->user->dr_count == 0) {
                                        echo "1";
                                    } else {
                                        echo ($this->user->dr_count) > 3 ? 3 : ($scoreList[$this->user->dr_count]+1);
                                    }
                                    ?> </span>积分</dt>
                <dt>我的积分：<span><?php echo $this->user->score;?></span> </dt>
                <dd><a href="http://meipin.com/raffle">积分抽奖（1分起）>></a></dd>
                <dd><a href="http://meipin.com/exchange/index">积分兑换>></a></dd>
             </dl>
             <?php endif; ?>
            </p>
        </div>

		<br>
	</div>
</div>
