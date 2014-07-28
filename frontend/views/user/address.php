<div class="box admin hei">
    <h3>
        <span>收货地址</span>
    </h3>
    <span class="t_l"></span>
    <span class="t_r"></span>
    <div class="info">
        <h6>
            <?php echo $this->renderPartial('info_nav', ['current' => 'address']); ?>
        </h6>
        <input type="hidden" id="getProvinceUrl" value="<?php echo $this->createAbsoluteUrl('userAddress/getProvince') ?>" />
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
                    <?php if ($model->getErrors()) :; ?>
                        <td bgcolor="#F9FAFC" align="left" colspan="2" style="padding:8px;">
                            <?php foreach ($model->getErrors() as $error) : ?>
                                <span class="user-error"><?php echo $error[0]; ?></span>
                            <?php endforeach; ?>
                        </td>
                    <?php endif; ?>
                </tr>
                <tr align="center">
                    <td bgcolor="#F9FAFC" align="right">
                        收货人姓名：
                    </td>
                    <td height="32" align="left">
                        <?php echo $form->textField($model, 'name', array('class' => 'text', 'maxLength' => '8')); ?>
                        <em>*您的收货姓名</em>
                    </td>
                </tr>
                <tr align="center">
                    <td bgcolor="#F9FAFC" align="right">
                        联系电话：
                    </td>
                    <td height="32" align="left">
                        <?php echo $form->textField($model, 'mobile', array('class' => 'text', 'maxLength' => '15', 'style' => 'background:#fff;')); ?>
                        <em>*收货时快递联系电话，很重要。</em><br/>

                    </td>
                </tr>
                <tr align="center" class="color">
                    <td bgcolor="#F9FAFC" align="right">
                        收货地址：
                    </td>
                    <td height="32" align="left">
                        <?php echo $form->dropDownList($model, 'province', $province, array('id' => 'userProvince', 'empty' => '请选择')); ?>
                        &nbsp;&nbsp;
                        <?php echo $form->dropDownList($model, 'city_id', $city, array('id' => 'userCity', 'empty' => '请选择')); ?>
                        &nbsp;&nbsp;
                        <?php echo $form->textField($model, 'address', array('class' => 'text', 'maxLength' => '100')); ?>
                        <em>*请确认快递能否寄到</em>
                    </td>
                </tr>
                <tr align="center" class="color">
                    <td bgcolor="#F9FAFC" align="right">
                        电子邮箱：
                    </td>
                    <td height="32" align="left">
                        <?php echo $form->textField($model, 'email', array('class' => 'text', 'maxLength' => '25')); ?>
                    </td>
                </tr>
                <tr align="center" class="color">
                    <td bgcolor="#F9FAFC" align="right">
                        邮编：
                    </td>
                    <td height="32" align="left">
                        <?php echo $form->textField($model, 'postcode', array('class' => 'text', 'maxLength' => '10')); ?>
                    </td>
                </tr>
                <tr align="center" class="color">
                    <td height="32" colspan="2"><input type="submit" class="submit" value="提交"></td>
                </tr>
            </tbody>
        </table>
        <?php $this->endWidget(); ?>
        <p class="b_tit">请详细填写收货地址，因为收货地址信息而导致的退货，我们将不退还积分。</p>
    </div>
</div>
<!--隐藏域-->
<div id="sendSmsCode" style="display:none;" ajax-url="<?php echo Yii::app()->createUrl("user/mobileBind") ?>">
    <div style="font-size:18px;font-weight:bold;margin:5px;">确认短信验证码</div><br/>
    <ul>
        <li>
            手机号码：<label class="codeShowMobile"></label>
            <?php echo $form->hiddenField($model, 'mobile', array('id' => 'codeHiddenMobile')); ?>
            <br/>
            <input class="sendBtn" url="<?php echo Yii::app()->createUrl("user/sendMobileBindSmsCode") ?>" type="button" data-send="true" class="sendBtn" value="发送短信验证码"/><br/>
        </li>
        <li>
            短信验证码：<?php echo $form->textField($model, 'code', array('class' => 'code_text', 'maxLength' => '4')); ?>
        </li>
        <li>
            <br/>
            <?php echo CHtml::button("确定", array('class' => 'codeOk submit')) ?> &nbsp;
            <?php echo CHtml::button("取消", array('class' => 'codeCancle submit')) ?>
        </li>
    </ul>
</div>
<script type="text/javascript">
    User.Address.changeProvince();
    User.Address.sendMobileBindSmsCode();
</script>
