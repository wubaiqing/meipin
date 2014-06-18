<div class="user_l l">
    <h3>用户中心</h3>
    <div class="bor">
        <h4><span class="a">我的礼品</span></h4>
        <ul>
            <li><a href="/score">我的积分</a></li>
            <li><a href="<?php echo $this->createUrl('score/welfare');?>">我的礼品</a></li>
        </ul>
        <h4><span class="c">个人信息</span></h4>
        <ul>
            <li><a href="<?php echo $this->createUrl('user/info');?>">基本信息</a></li>
            <li><a href="<?php echo $this->createUrl('user/address');?>">收货地址</a></li>
            <?php if(!Yii::app()->user->getState('qid')){?>
            <li><a href="<?php echo $this->createUrl('user/password');?>">修改密码</a></li>
            <?php }?>
        </ul>
        <div class="hr"></div>
    </div>
</div>
