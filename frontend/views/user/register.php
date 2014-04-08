<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id' => 'goods-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
		'class' => 'form-horizontal',
	),
)); 
?>

<?php echo $form->errorSummary($model); ?>

<div class="control-group">
	<?php echo $form->labelEx($model, 'username');
	<div class="controls">
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
	</div>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model, 'password');
	<div class="controls">
		<?php echo $form->textField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
	</div>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model, 'repeatPassword');
	<div class="controls">
		<?php echo $form->textField($model,'repeatPassword',array('size'=>60,'maxlength'=>255)); ?>
	</div>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model, 'email');
	<div class="controls">
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>
</div>

<div class="form-actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save')); ?>
</div>
<?php $this->endWidget(); ?>
