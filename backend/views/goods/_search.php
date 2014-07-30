<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>

<!--     <?php //echo $form->dropDownList($model, 'status', array('1' => '显示', '2' => '隐藏'), array('class' => 'span1'))?> -->
    <?php echo $form->dropDownList($model, 'searchType', array('2' => '淘宝ID', '1' => 'id', '3' => '标题'), array('class' => 'span1'))?>
    <?php echo $form->textField($model,'searchInput'); ?>
    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>

<?php $this->endWidget(); ?>
