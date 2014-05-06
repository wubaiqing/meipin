<div id="content" class="wp">
    <?php $this->renderPartial('left'); ?>
    <div class="user_r r">
        <div class="box admin hei">
            <h3>
                <span>修改密码</span>
            </h3>
            <span class="t_l"></span>
            <span class="t_r"></span>
            <div class="info">
                <h6>
                    <a href="<?php echo $this->createUrl('user/address');?>">收货地址修改</a>|
                    <a href="<?php echo $this->createUrl('user/password');?>" class="current">修改密码</a>
                </h6>
                <?php
                    $form = $this->beginWidget('CActiveForm', [
                        'id' => 'login-form',
                        'enableClientValidation' => false,
                        'clientOptions' => [
                            'validateOnSubmit' => true,
                        ]
                    ]);
                ?>
                <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
                    <tbody>
                        <tr align="center">
                            <?php if ($model->getErrors()) : ;?>
                            <?php foreach ($model->getErrors() as $error) :?>
                                <td bgcolor="#F9FAFC" align="left" colspan="2" style="padding:8px;">
                                    <span class="user-error"><?php echo $error[0];?></span>
                                </td>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tr>
                        <tr align="center">
                            <td bgcolor="#F9FAFC" width="100" align="right">
                                原密码：
                            </td>
                            <td height="32" align="left">
                                <?php echo $form->passwordField($model, 'oldPassword', array('class' => 'text')); ?>
                                <em>*您帐户原来的登录密码</em>
                            </td>
                        </tr>
                        <tr align="center">
                            <td bgcolor="#F9FAFC" width="100" align="right">
                                新密码：
                            </td>
                            <td height="32" align="left">
                                <?php echo $form->passwordField($model, 'password', array('class' => 'text')); ?>
                                <em>*设置新的登录密码</em>
                            </td>
                        </tr>
                        <tr align="center" class="color">
                            <td bgcolor="#F9FAFC" align="right">
                                重复新密码：
                            </td>
                            <td height="32" align="left">
                                <?php echo $form->passwordField($model, 'confirmPassword', array('class' => 'text')); ?>
                                <em>*再次输入您新的登录密码</em>
                            </td>
                        </tr>
                        <tr align="center" class="color">
                            <td height="32" colspan="2">
                                <input type="submit" class="submit" value="提交">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php $this->endWidget(); ?>
                <p class="b_tit">请详细填写密码。</p>
            </div>
        </div>
    </div>
	<span class="clear"></span>
</div>
