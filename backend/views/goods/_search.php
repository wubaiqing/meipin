<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array('class' => 'form-search')
)); ?>

    <?php echo $form->dropDownList($model, 'is_zhe800', array('' => '来源', '1' => '折800'), array('class' => 'span1'))?>
    <?php echo $form->dropDownList($model, 'searchType', array('2' => '淘宝ID', '1' => 'id', '3' => '标题'), array('class' => 'span1'))?>
    <?php echo $form->textField($model,'searchInput'); ?>
    <?php echo CHtml::submitButton('搜索', array('class' => 'btn')); ?>

<?php $this->endWidget(); ?>
