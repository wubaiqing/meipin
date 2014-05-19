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

<?php echo CHtml::label('商品名称：', 'name'); ?>
<?php echo $form->textField($model->exchangeModel, 'name'); ?>
<?php echo CHtml::submitButton('搜索', ['class' => 'btn']); ?>

<?php $this->endWidget(); ?>
