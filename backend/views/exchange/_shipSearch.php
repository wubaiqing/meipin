<?php

$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array('class' => 'form-search')
        ));
?>
<?php echo CHtml::label('发货状态：', 'status') ?>
<?php

echo $form->dropDownList($model, 'status', ExchangeLog::$statusSearch,['style'=>'width:100px;']);
echo '&nbsp;';
?>

<?php echo CHtml::label('支付状态：', 'pay_status') ?>
<?php

echo $form->dropDownList($model, 'pay_status', ExchangeLog::$pay_status,['style'=>'width:100px;']);
echo '&nbsp;';
?>
<?php  $actionname = $this->getAction()->getId();    ?>
<?php if($actionname=='raffleShipAdmin'):?>
<?php echo CHtml::label('中奖分类：', 'user_id') ?>
<?php

echo $form->dropDownList($model, 'user_id', ExchangeLog::$zhushui,['style'=>'width:100px;']);
echo '&nbsp;';
endif;
?>
<?php echo $form->hiddenField($model,'goods_id');?>  
<?php echo CHtml::label('商品名称：', 'name'); ?>
<?php echo $form->textField($model->exchangeModel, 'name'); ?>

<?php echo CHtml::label('用户名：', 'username'); ?>
<?php echo $form->textField($model->userModel, 'username'); ?>
<?php echo CHtml::submitButton('搜索', ['class' => 'btn']); ?>

<?php $this->endWidget(); ?>
