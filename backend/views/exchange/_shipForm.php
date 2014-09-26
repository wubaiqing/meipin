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
    'action' => Yii::app()->createUrl("exchange/ajaxShipUpdate", array('id' => $model->id)),
        ));
CHtml::$errorSummaryCss = 'text-warning';
?>
<?php echo $form->errorSummary($model); ?>
<table border="0" class="v_table_con">
    <tr>
        <td colspan="2"  class='v_table_line'>商品信息</td>
    </tr>
    <tr>
        <td class="v_table_label">商品标题：</td>
        <td>
            <?php
            echo $model->exchange->name;
            ?>
        </td>
    </tr>
    <tr class='v_table_line'>
        <td colspan="2">兑换详情</td>
    </tr>
    <tr>
        <td class="v_table_label">兑换时间：</td>
        <td>
            <?php echo date("Y-m-d H:i:s", $model->created_at); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">收货人姓名：</td>
        <td>
            <?php echo $form->textField($model, 'name', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">联系电话：</td>
        <td>
            <?php echo $form->textField($model, 'mobile', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">邮编：</td>
        <td>
            <?php echo $form->textField($model, 'postcode', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">备注信息：</td>
        <td>
            <?php echo $form->textField($model, 'remark', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr class="exchange_detail">
        <td class="v_table_label">收货地址：</td>
        <td>
            <?php echo $form->dropDownList($model, 'province', $province, array('class' => 'userProvice', 'id' => 'userProvince', 'empty' => '请选择', 'disabled' => 'disabled')); ?>
            &nbsp;&nbsp;
            <?php echo $form->dropDownList($model, 'city_id', $city, array('class' => 'userCity', 'id' => 'userCity', 'empty' => '请选择', 'disabled' => 'disabled')); ?>
            <br/><br/>
            <?php echo $form->textArea($model, 'address', array('disabled' => 'disabled', 'maxLength' => '100')); ?>
        </td>
    </tr>
    <tr class="">
        <td class="v_table_label">&nbsp;</td>
        <td>
            <?php echo CHtml::button("编辑", array('class' => 'btn btn-primary save', 'id' => 'edit')); ?>
        </td>
    </tr>
    <?php echo $form->hiddenField($model, 'id'); ?>
    <?php echo CHtml::hiddenField("formType", 'address'); ?>
    <?php
    $this->endWidget();
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'status-form',
        'method' => 'post',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal',
        ),
        'action' => Yii::app()->createUrl("exchange/ajaxShipUpdate", array('id' => $model->id)),
    ));
    ?>
    <tr class='v_table_line'>
        <td colspan="2">操作状态</td>
    </tr>

        <!-- <tr>
        <td class="v_table_label">支付状态：</td>
        <td>
            <?php //echo $form->dropDownList($model, 'pay_status', ExchangeLog::$pay_status, array('pay_status'=>$model->pay_status)); ?>
        </td>
    </tr> -->
    <tr>
        <td class="v_table_label">发货状态：</td>
        <td>
            <?php echo CHtml::hiddenField("formType", 'status'); ?>
            <?php echo $form->hiddenField($model, 'id'); ?>
            <?php echo $form->dropDownList($model, 'status', ExchangeLog::$status, array('status'=>$model->status)); ?>

        </td>
    </tr>
    <tr>
        <td class="v_table_label">发货时间：</td>
        <td>
            <?php
            if ($model->status == 1 && $model->delivery_time>0) {
                echo date("Y-m-d H:i:s", $model->delivery_time);
            }
            ?>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">物流信息：</td>
        <td>
            <ul>
                <li>快递公司：<?php echo $form->dropDownList($model, 'logistics', Yii::app()->params['logisticsSystem']); ?></li>
                <li>快递单号：<?php echo $form->textField($model, 'logistics_code', []); ?></li>
            </ul>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">&nbsp;</td>
        <td>
            <?php echo CHtml::button("提交", array('class' => 'btn btn-primary save', 'id' => 'status_edit')); ?>
        </td>
    </tr>
</table>
<div>

</div>
<?php
$this->endWidget();
?>

<script>
</script>
