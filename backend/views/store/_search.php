<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>

    <?php echo $form->dropDownList($model, 'searchType', array('1' => '网站名称'), array('class' => 'span2'))?>
    <?php echo $form->textField($model,'searchInput'); ?>
    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>

<?php $this->endWidget(); ?>
