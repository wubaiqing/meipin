<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>

<?php echo CHtml::label('ID：', 'id')?>
<?php echo $form->textField($exchangeModel,'id',array('style'=>'width:90px'));
    echo '&nbsp;';
?>
<?php echo CHtml::label('是否删除：', 'is_delete') ?>
<?php

echo $form->dropDownList($exchangeModel, 'is_delete', Exchange::$is_delete,['style'=>'width:100px;']);
echo '&nbsp;';
?>
<?php echo CHtml::label('名称：', 'name');?>
<?php echo $form->textField($exchangeModel,'name');?>
    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>


<?php $this->endWidget(); ?>
