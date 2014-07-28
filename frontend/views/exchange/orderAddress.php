<div id="address" class="address ">
    <?php
    ?>
    <h2><span></span>收货人信息</h2>
    <div class="toptxt" id="address_show_area" style="<?php echo $data['userAddress']->id > 0 ? 'display: block;' : 'display:none;' ?>">
        <p>

            <?php
            if (isset($data['userAddress']->id) && !empty($data['userAddress']->id)):
                echo $data['province'][$data['userAddress']->province] . "-" . $data['city'][$data['userAddress']->city_id] . "-" . $data['userAddress']->address;
            endif;
            ?>
        </p>
        <p >
            <a class="modify_address" href="javascript:void(0)" >修改收货地址</a>
        </p>
    </div>

    <?php
    $form = $this->beginWidget('CActiveForm', [
        'id' => 'address-form',
        'action' => Yii::app()->createUrl("user/ajaxUserAddressSave"),
        'enableClientValidation' => false,
        'clientOptions' => [
            'validateOnSubmit' => true,
        ]
    ]);
    ?>
    <ul class=" modify_form" style="<?php echo $data['userAddress']->id > 0 ? 'display: none;' : 'display:block;' ?>">
        <div style="margin:0;padding:0;display:inline">
            <input name="address_token" type="hidden" value="">
        </div>
        <li>
            <label><em>*</em>真实姓名：</label>
            <?php echo $form->textField($data['userAddress'], 'name', array('class' => 'text', 'maxLength' => '8')); ?>
        </li>
        <li>
            <label><em>*</em>收货地址：</label>
            <?php echo $form->dropDownList($data['userAddress'], 'province', $data['province'], array('id' => 'userProvince', 'empty' => '请选择')); ?>
            &nbsp;&nbsp;
            <?php echo $form->dropDownList($data['userAddress'], 'city_id', $data['city'], array('id' => 'userCity', 'empty' => '请选择')); ?>
            &nbsp;&nbsp;
            <?php echo $form->textField($data['userAddress'], 'address', array('class' => 'text', 'maxLength' => '100')); ?>

        </li>
        <li>
            <label><em>*</em>手机号码：</label>
            <em id="li_mobile">
                <?php echo $form->textField($data['userAddress'], 'mobile', array('class' => 'text', 'maxLength' => '15')); ?>
            </em>
        </li>
        <li>
            <label>电子邮箱：</label>
            <em id="li_mobile">
                <?php echo $form->textField($data['userAddress'], 'email', array('class' => 'text', 'maxLength' => '25')); ?>
            </em>
        </li>
        <li>
            <label>邮政编码：</label>
            <?php echo $form->textField($data['userAddress'], 'postcode', array('class' => 'text', 'maxLength' => '10')); ?>
        </li>
        <li class="tj">
            <label>&nbsp;</label>
            <input class="btn" id="address_save_btn" type="button" value="">
        </li>

    </ul>
    <?php $this->endWidget(); ?>
</div>
