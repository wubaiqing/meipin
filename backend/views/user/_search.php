<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>
<?php echo CHtml::label('ID：', 'id')?>
<?php echo $form->textField($model,'id',array('style'=>'width:90px'));
    echo '&nbsp;';
?>

<?php echo CHtml::label('用户名：', 'username');?>
<?php echo $form->textField($model,'username');?>
    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>

<?php $this->endWidget(); ?>
