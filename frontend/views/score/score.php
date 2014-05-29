<link rel="stylesheet" type="text/css"  href="/static/css/score/score.css?v=201405071000" />
<script type="text/javascript" src="/static/js/score/jquery-1.4.2.min.js?v=201405071000"></script>
<script type="text/javascript" src="/static/js/score/score.js?v=201405071000"></script>
<div id="content" class="wp">
    <?php $this->renderPartial('left'); ?>
    <div class="user_r r">
        <div class="box admin hei">
            <h3><span>我的积分</span></h3><span class="t_l"></span><span class="t_r"></span>
            <div class="info" id="score">
                <p class="tit" style="margin-bottom:10px;">
                    我的可用积分：<strong>1</strong></p>
                <h6><a href="/help/index" target="_blank" class="r">积分规则说明</a><a href="#index" class="tabs_score current">积分明细</a>|<a href="#add" class="tabs_score">积分增加</a>|<a href="#reduce" class="tabs_score">积分消耗</a></h6>
                <div id="index" class="content-box">
                    <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
                        <tbody>
                        <tr align="center">
                            <th width="180">日期</th>
                            <th>操作描述</th>
                            <th width="80">积分</th>
                        </tr>
                        <?php foreach ($score as $info) {?>
                        <tr align="center">
                            <td bgcolor="#F9FAFC"><?php echo $info->create_time ;?></td>
                            <td>签到奖励<?php echo $info->reason;?></td>
                            <td><strong style="color:#FF4E00"><?php echo $info->score;?></strong></td>
                        </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <div class="page"><span class="current">1/1</span><span class="current">1</span></div>
                </div>
                <div id="add"  class="content-box">

                </div>
                <div id="reduce" class="content-box">

                </div>
            </div>
        </div>
    </div>
    <span class="clear"></span>
</div>
