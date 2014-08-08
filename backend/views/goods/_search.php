<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>

 <!-- <?php //echo $form->dropDownList($model, 'status', array('1' => '显示', '2' => '隐藏'), array('class' => 'span1'))?> -->
    <?php echo $form->dropDownList($model, 'searchType', array('2' => '淘宝ID', '1' => 'id', '3' => '标题'), array('class' => 'span1'))?>
    <?php echo $form->textField($model,'searchInput'); ?>

    <?php echo CHtml::label('时间：', 'start_time');?>
    <?php echo $form->textField($model,'start_time'); ?>

    <?php echo CHtml::label('排序：', 'gdorder');?>
     <?php echo $form->dropDownList($model, 'gdorder', array('updated_at' => '更新时间', 'list_order' => '排序值'), array('class' => 'span1'))?>

    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>

<?php $this->endWidget(); ?>
