<?php
// 去掉必填项kk
CHtml::$afterRequiredLabel = '';
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'score-form',
    'method' => 'post',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
));
CHtml::$errorSummaryCss = 'text-warning';
?>
<?php echo $form->errorSummary($user); ?>
<input type="hidden" id="getProvinceUrl" value="<?php echo $this->createAbsoluteUrl('userAddress/getProvince') ?>" />
<table border="0" class="v_table_con">
    <tr>
        <td colspan="2"  class='v_table_line'>用户信息</td>
    </tr>
    <tr>
        <td class="v_table_label">ID：</td>
        <td>
            <?php echo $form->textField($user, 'id', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">用户名称：</td>
        <td>
            <?php echo $form->textField($user, 'username', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"  class='v_table_line'>收货信息</td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">联系电话：</td>
        <td>
            <?php echo $form->textField($user, 'mobile'); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">收货地址：</td>
        <td>
            <?php echo $form->dropDownList($address, 'province', $province, array('class' => 'userProvice', 'id' => 'userProvince', 'empty' => '请选择')); ?>
            &nbsp;&nbsp;
            <?php echo $form->dropDownList($address, 'city_id', $city, array('class' => 'userCity', 'id' => 'userCity', 'empty' => '请选择')); ?>
            <br/><br/>
            <?php echo $form->textArea($address, 'address', array('maxLength' => '100')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">邮编：</td>
        <td>
            <?php echo $form->textField($address, 'postcode'); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
	<td class="v_table_label"></td>
	<td>
	    <?php echo CHtml::submitButton($user->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save')); ?>
	</td>
    </tr>
</table>
<div>

</div>
<?php
$this->endWidget();
?>

<script type="text/javascript" src="http://www.meipin.com/assets/js/user.js?v=1.0.2"></script>
<script type="text/javascript">
    User.Address.changeProvince();

</script>
