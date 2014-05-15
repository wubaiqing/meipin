<link rel="stylesheet" type="text/css"  href="/assets/css/score/score.css?v=201405071000" />
<!--<script type="text/javascript" src="/assets/js/score/jquery-1.4.2.min.js?v=201405071000"></script>-->
        <div class="box admin hei">
            <h3><span>我的积分</span></h3><span class="t_l"></span><span class="t_r"></span>
            <div class="info" id="score">
                <p class="tit" style="margin-bottom:10px;">
                    我的可用积分：<strong><?php echo $user->score?></strong></p>
                <h6><a href="/help/index" target="_blank" class="r">积分规则说明</a>
                <a href="/score" class="tabs_score <?php if ($type==''||$type=='index') {?>current<?php } ?>">积分明细</a>|
                <a href="/score/index/type/add" class="tabs_score <?php if ($type=='add') {?>current<?php } ?>">积分增加</a>|
                <a href="/score/index/type/reduce" class="tabs_score <?php if ($type=='reduce') {?>current<?php } ?>">积分消耗</a></h6>
                <div id="index" class="">
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
                            <td><?php echo Score::getScoreTitle($info->reason);?></td>
                            <td><strong style="color:#FF4E00"><?php echo $info->score;?></strong></td>
                        </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php $this->renderPartial('//site/page', array('pager' => isset($pager) && !empty($pager) ? $pager : '')); ?>
                </div>
                <div id="add"  class="content-box">

                </div>
                <div id="reduce" class="content-box">

                </div>
            </div>
        </div>
