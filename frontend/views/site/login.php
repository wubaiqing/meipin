<div class="topnav">
    <div class="wp">
        <ul class="logininfo r" id="sign">
            <?php if (Yii::app()->user->id) {?>
            <li>
                欢迎您，
                <a href="javascript:void(0);">
                    <?php echo Yii::app()->user->name;?>
                </a>
                <a href="javascript:void(0);" class="level v0"></a>
                <span class="nav_split">|</span>
                <a href="<?php echo $this->createUrl('score/index');?>">个人中心</a>
                <span class="nav_split">|</span>
                <a title="退出" class="lnk_logout" href="<?php echo $this->createUrl('user/logout');?>">退出</a>
                <span class="nav_split">|</span>
            </li>
            <?php } else {?>
            <li>
                您好，欢迎来到美品网！请
                <a href="<?php echo $this->createUrl('user/login');?>" target="_self">[登录]</a>或<a href="<?php echo $this->createUrl('user/register');?>">[免费注册]</a>
            </li>
            <?php }?>
            <li class="qd">
                <a href="javascript:;" class='qiandao'><span>签到</span></a>
            </li>
        </ul>
        <ul>
	    <li class="a">
	    </li>
        </ul>
    </div>
</div>
