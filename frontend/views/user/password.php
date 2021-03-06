<div class="box admin hei">
    <h3>
        <span>修改密码</span>
    </h3>
    <span class="t_l"></span>
    <span class="t_r"></span>
    <div class="info">
        <h6>
            <?php echo $this->renderPartial('info_nav', ['current' => 'password']);?>
        </h6>
        <?php
        $form = $this->beginWidget('CActiveForm', [
        'id' => 'login-form',
        'enableClientValidation' => false,
        'clientOptions' => [
        'validateOnSubmit' => true
        ]
        ]);
        ?>
        <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
            <tbody>
            <?php  ;?>
                <tr align="center">
                    <?php if ($model->getErrors()) : ;?>
                    <td bgcolor="#F9FAFC" align="left" colspan="2" style="padding:8px;">
                        <?php foreach ($model->getErrors() as $error) :?>
                        <span class="user-error"><?php echo $error[0];?></span>
                        <?php endforeach; ?>
                    </td>
                    <?php endif; ?>
                </tr>

                <?php if($model->salt){?>
                <tr align="center">
                    <td bgcolor="#F9FAFC" width="100" align="right">
                        原密码：
                    </td>
                    <td height="32" align="left">
                        <?php echo $form->passwordField($model, 'oldPassword', array('class' => 'text')); ?>
                        <em>*您帐户原来的登录密码</em>
                    </td>
                </tr>
                <?php }else{
                    $qid = Yii::app()->user->getState('qid');
                    if($qid == 1)
                    {
                        echo "<tr align='center'><td  colspan='2'>您是QQ用户,首次只需设置密码</td></tr>";
                    }else
                    {
                        echo "<tr align='center'><td  colspan='2'>您是淘宝用户,首次只需设置密码</td></tr>";
                    }
                    

                    }?>
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
