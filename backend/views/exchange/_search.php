<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>
<?php echo $form->labelEx($exchangeModel,'id');?>
<?php echo $form->textField($exchangeModel,'id',array('style'=>'width:90px'));
    echo '&nbsp;';
?>

<?php echo $form->labelEx($exchangeModel,'name');?>
<?php echo $form->textField($exchangeModel,'name',array(''));?>
    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>

<?php $this->endWidget(); ?>
