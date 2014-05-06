<div id="content" class="wp">
    <?php $this->renderPartial('left'); ?>
    <div class="user_r r">
        <div class="box admin hei">
            <h3>
                <span>用户信息</span>
            </h3>
            <span class="t_l"></span>
            <span class="t_r"></span>
            <div class="info">
                <h6>
                    <a href="<?php echo $this->createUrl('user/info');?>" class="current">用户信息</a>|
                    <a href="<?php echo $this->createUrl('user/address');?>">收货地址</a>|
                    <a href="<?php echo $this->createUrl('user/password');?>">修改密码</a>
                </h6>
                <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
                    <tbody>
                        <tr align="center">
                            <td bgcolor="#F9FAFC" align="right" width="90">
                                用户名：
                            </td>
                            <td height="32" align="left">
                                <?php echo $model->username;?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td bgcolor="#F9FAFC" align="right">
                                电子邮箱：
                            </td>
                            <td height="32" align="left">
                                <?php echo $model->email;?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="b_tit"></p>
            </div>
        </div>
    </div>
    <span class="clear"></span>
</div>

