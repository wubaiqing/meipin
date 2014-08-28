<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>

<?php echo CHtml::label('ID：', 'id')?>
<?php echo $form->textField($shaiModel,'id',array('style'=>'width:90px'));
    echo '&nbsp;';
?>

<?php echo CHtml::label('商品id：', 'goods_id');?>
<?php echo $form->textField($shaiModel,'goods_id');?>
    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>

<?php $this->endWidget(); ?>
