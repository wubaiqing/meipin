<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>
<?php echo CHtml::label('ID：', 'id')?>
<?php echo $form->textField($model,'id',array('style'=>'width:90px'));
    echo '&nbsp;';
?>

<?php echo CHtml::label('QQ', 'qq');?>
<?php echo $form->textField($model,'qq');?>
    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>

<?php $this->endWidget(); ?>
