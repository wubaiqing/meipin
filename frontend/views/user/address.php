<div id="content" class="wp">
    <?php $this->renderPartial('left'); ?>
    <div class="user_r r">
        <div class="box admin hei">
            <h3>
                <span>收货地址</span>
            </h3>
            <span class="t_l"></span>
            <span class="t_r"></span>
            <div class="info">
                <h6>
                    <a href="<?php echo $this->createUrl('user/info');?>">用户信息</a>|
                    <a href="<?php echo $this->createUrl('user/address');?>" class="current">收货地址</a>|
                    <a href="<?php echo $this->createUrl('user/password');?>">修改密码</a>
                </h6>
                <input type="hidden" id="getProvinceUrl" value="<?php echo $this->createAbsoluteUrl('userAddress/getProvince')?>" />
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
                                <td bgcolor="#F9FAFC" align="right">
                                    收货人姓名：
                                </td>
                                <td height="32" align="left">
                                    <?php echo $form->textField($model, 'name', array('class' => 'text')); ?>
                                    <em>*您的收货姓名</em>
                                </td>
                            </tr>
                            <tr align="center">
                                <td bgcolor="#F9FAFC" align="right">
                                    联系电话：
                                </td>
                                <td height="32" align="left">
                                    <?php echo $form->textField($model, 'mobile', array('class' => 'text')); ?>
                                    <em>*收货时快递联系电话，很重要。</em>
                                </td>
                            </tr>
                            <tr align="center" class="color">
                                <td bgcolor="#F9FAFC" align="right">
                                    收货地址：
                                </td>
                                <td height="32" align="left">
                                    <?php echo $form->dropDownList($model, 'province', $province, array('id' => 'userProvince', 'empty' => '请选择'));?>
                                    &nbsp;&nbsp;
                                    <?php echo $form->dropDownList($model, 'city_id', $city, array('id' => 'userCity', 'empty' => '请选择'));?>
                                    &nbsp;&nbsp;
                                    <?php echo $form->textField($model, 'address', array('class' => 'text')); ?>
                                    <em>*请确认快递能否寄到</em>
                                </td>
                            </tr>
                            <tr align="center" class="color">
                                <td bgcolor="#F9FAFC" align="right">
                                    邮编：
                                </td>
                                <td height="32" align="left">
                                    <?php echo $form->textField($model, 'postcode', array('class' => 'text')); ?>
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
    </div>
    <span class="clear"></span>
</div>
<script type="text/javascript">
    User.Address.changeProvince();
</script>
