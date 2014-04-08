<?php
CHtml::$afterRequiredLabel = '';
$form=$this->beginWidget('CActiveForm', array(
    'id' => 'category-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
));
CHtml::$errorSummaryCss = 'text-warning';

?>

    <?php echo $form->errorSummary($model); ?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'name'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'parent_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo new TreeDropdownList($model, 'Cat[parent_id]', $model->parent_id); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget();
