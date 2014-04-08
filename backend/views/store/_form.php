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
        <?php echo $form->labelEx($model,'name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'name'); ?>
            <span class="text-error"></span>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'url', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'url'); ?>
            <span class="text-error"></span>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'spread', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'spread'); ?>
            <span class="text-error"></span>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'cat_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo new TreeDropdownList(new StoreCat, 'Store[cat_id]', $model->cat_id); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'logo', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'logo', array('size' => 60, 'maxlength' => 255)); ?>
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/css/jquery.fileupload-ui.css" media="all" />
            <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
            <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
            <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/js/jquery.fileupload.js"></script>
            <img src="about:blank" width="200" style="position: absolute; z-index: 9999; margin-left: 4px;" id="picture-preview" class="hide" />
            <span class="help-inline">
                <span class="btn fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>上传</span>
                    <input class="upload-placeholder" type="file" name="file" />
                </span>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#Store_logo').hover(function () {
                            var src = $(this).val();
                            if (src != '') {
                                $('#picture-preview').position($(this).position());
                                $('#picture-preview').attr('src', src).removeClass('hide');
                            }
                        }, function () {
                            $('#picture-preview').addClass('hide');
                        });
                        $('.upload-placeholder').fileupload({
                            url: '<?php echo Yii::app()->createUrl('site/upload'); ?>',
                            dataType: 'json',
                            done: function (e, data) {
                                if (data.result.success) {
                                    $('#Store_logo').val(data.result.path);
                                } else {
                                    alert(data.result.message);
                                }
                            }
                        });
                     });
                </script>
            </span>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'status', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'status', array('1' => '显示', '2' => '隐藏' )); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save')); ?>
    </div>

<?php $this->endWidget(); ?>
