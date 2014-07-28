<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>


<?php echo CHtml::label('时间：', 'created_at');?>
<?php echo $form->textField($usermodel,'created_at');?>
（格式:2014-7-28）
 <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>


<?php $this->endWidget(); ?>
