<div id="t-top">
    <div class="topnav">
    <div class="wp">
        <ul class="logininfo r" id="sign">
        <?php if (Yii::app()->user->id) { ?>

            <li>
            欢迎您，
            <a href="javascript:void(0);">
                <?php echo Yii::app()->user->name; ?>
            </a>
            <a href="javascript:void(0);" class="level v0"></a>
            <span class="nav_split">|</span>
            <a href="<?php echo $this->createUrl('score/index'); ?>">个人中心</a>
            <span class="nav_split">|</span>
            <a title="退出" class="lnk_logout" href="<?php echo $this->createUrl('user/logout'); ?>">退出</a>
            </li>
        <?php } else { ?>
            <li>
            您好，欢迎来到美品网！请
            <a href="<?php echo $this->createUrl('user/login'); ?>" target="_self">[登录]</a>或<a href="<?php echo $this->createUrl('user/register'); ?>">[免费注册]</a>
            </li>
        <?php } ?>
        <?php
        $isSignDay = User::isSignDay();
        ?>
        <li class="qd <?php echo $isSignDay ? 'qd_ok' : ''; ?>">
        <span href="javascript:;"
            <?php if (!empty($this->user)): ?>
            onmouseover="document.getElementById('con_qd').style.display = 'block'" onmouseout="document.getElementById('con_qd').style.display = 'none'"
            <?php endif; ?>
              class='<?php echo!$isSignDay ? 'qiandao' : ''; ?>'>&nbsp;
                    <?php if (!empty($this->user)): ?>
                    <div id="con_qd">
                        <?php if (!empty($this->user)): ?>
                            <em>连签：<strong class="big" id="dr_count"><?php echo $this->user->dr_count ?></strong> 天，积分<strong id="nowScore">
                                    +<?php
                                    if ($this->user->dr_count == 0) {
                                        echo "0";
                                    } else {
                                        $scoreList = Yii::app()->params['dayRegistionNum'];
                                        echo ($this->user->dr_count) > 3 ? 3 : $scoreList[$this->user->dr_count];
                                    }
                                    ?>
                                </strong></em>
                            <em>明日签到可得<strong id="nextCount"><?php
                                    if ($this->user->dr_count == 0) {
                                        echo "1";
                                    } else {
                                        echo ($this->user->dr_count) > 3 ? 3 : ($scoreList[$this->user->dr_count]+1);
                                    }
                                    ?></strong>积分 </em>
            <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </span>
        </li>

        </ul>
    </div>
    <?php echo CHtml::hiddenField('unlogin_url', Yii::app()->createAbsoluteUrl("user/login")); ?>
    </div>
</div>
