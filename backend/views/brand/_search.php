<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>

<?php echo CHtml::label('ID：', 'id')?>
<?php echo $form->textField($brandModel,'id',array('style'=>'width:90px'));
    echo '&nbsp;';
?>

<?php echo CHtml::label('标题：', 'title');?>
<?php echo $form->textField($brandModel,'title');?>
    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>

<?php $this->endWidget(); ?>
