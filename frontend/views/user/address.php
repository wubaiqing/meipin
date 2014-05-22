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
            <style>
                .sendBtn{
                    box-sizing: border-box;
                    align-items: center;
                    border: 1px solid #ccc;
                    border-image-source: initial;
                    border-image-slice: initial;
                    border-image-width: initial;
                    border-image-outset: initial;
                    border-image-repeat: initial;
                    white-space: pre;
                    -webkit-rtl-ordering: logical;
                    color: black;
                    background-color: white;
                    cursor: default;
                }
                .code_text{
                    margin-top: 5px;
                    width:58px;
                    border: 1px solid #ccc;
                    background: #fff;
                    padding: 3px;
                    height: 15px;
                    font-size: 12px;
                }
            </style>
            <tr align="center">
                <td bgcolor="#F9FAFC" align="right">
                    联系电话：
                </td>
                <td height="32" align="left">
                    <?php echo $form->textField($model, 'mobile', array('class' => 'text', 'maxLength' => '15')); ?>
                    <em>*收货时快递联系电话，很重要。</em><br/>
                    <input class="sendBtn" url="<?php echo Yii::app()->createUrl("user/sendMobileBindSmsCode") ?>" type="button" data-send="true" id="sendBtn" value="发送短信验证码"/><br/>
                    <label class="">短信验证码：</label><?php echo $form->textField($model, 'code', array('class' => 'code_text', 'maxLength' => '4')); ?><br/>
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
<div id="sendSmsCode" style="display:none;">
    <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
        <tr align="center">
            <td bgcolor="#F9FAFC" align="right">
                联系电话：
            </td>
            <td height="32" align="left">
                <?php echo $form->textField($model, 'mobile', array('class' => 'text', 'maxLength' => '15')); ?>
                <em>*收货时快递联系电话，很重要。</em><br/>
                <input class="sendBtn" url="<?php echo Yii::app()->createUrl("user/sendMobileBindSmsCode") ?>" type="button" data-send="true" id="sendBtn" value="发送短信验证码"/><br/>
                <label class="">短信验证码：</label><?php echo $form->textField($model, 'code', array('class' => 'code_text', 'maxLength' => '4')); ?><br/>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    User.Address.changeProvince();
    User.Address.sendMobileBindSmsCode();
</script>
