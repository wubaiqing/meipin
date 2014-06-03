<?php 
// 去掉必填项kk
CHtml::$afterRequiredLabel = '';
$form=$this->beginWidget('CActiveForm', array(
    'id' => 'goods-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
)); 
CHtml::$errorSummaryCss = 'text-warning';

?>

    <?php echo $form->errorSummary($model); ?>

    <div class="control-group">
        <label class="control-label required" for="Links_image_url">链接名称</label>
        <div class="controls">
            <?php echo $form->textField($model,'image_url'); ?>
			<span class="text-error"></span>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label required" for="Links_image_url">链接地址</label>
        <div class="controls">
            <?php echo $form->textField($model,'url'); ?>
			<span class="text-error"></span>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save')); ?>
    </div>


<?php $this->endWidget(); ?>
