<?php
/* @var $this GoodsController */
/* @var $model Goods */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'tb_id'); ?>
        <?php echo $form->textField($model,'tb_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'cat_id'); ?>
        <?php echo $form->textField($model,'cat_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'url'); ?>
        <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'origin_price'); ?>
        <?php echo $form->textField($model,'origin_price',array('size'=>8,'maxlength'=>8)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'price'); ?>
        <?php echo $form->textField($model,'price',array('size'=>8,'maxlength'=>8)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'discount_price'); ?>
        <?php echo $form->textField($model,'discount_price',array('size'=>8,'maxlength'=>8)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'picture'); ?>
        <?php echo $form->textField($model,'picture',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'shop_name'); ?>
        <?php echo $form->textField($model,'shop_name',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->textField($model,'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'collection_time'); ?>
        <?php echo $form->textField($model,'collection_time'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'update_time'); ?>
        <?php echo $form->textField($model,'update_time'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
