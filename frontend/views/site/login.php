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
                    <span class="nav_split">|</span>
                </li>
            <?php } else { ?>
                <li>
                    您好，欢迎来到美品网！请
                    <a href="<?php echo $this->createUrl('user/login'); ?>" target="_self">[登录]</a>或<a href="<?php echo $this->createUrl('user/register'); ?>">[免费注册]</a>
                </li>
            <?php } ?>
            <li class="qd qd_ok">
                <span href="javascript:;" onmouseover="document.getElementById('con_qd').style.display = 'block'" onmouseout="document.getElementById('con_qd').style.display = 'none'"class='qiandao'>&nbsp;
                    <div id="con_qd" style="">
                        <em>连签：<strong class="big" id="dr_count"><?php echo $this->user->dr_count ?></strong> 天，积分<strong id="nowScore">
                                +<?php
                                $scoreList = Yii::app()->params['dayRegistionNum'];
                                echo ($this->user->dr_count)>3?3:$scoreList[$this->user->dr_count];
            ?>
                            </strong></em>
                        <em>明日签到可得<strong id="nextCount"><?php echo ($this->user->dr_count)>3?3:($scoreList[$this->user->dr_count]+1);?></strong>积分 | <a href="/help/index.html">积分攻略</a></em>
                    </div>
                </span>
            </li>
        </ul>
        <ul>
            <li class="a">
            </li>
        </ul>
    </div>
</div>
