<?php
// 去掉必填项kk
CHtml::$afterRequiredLabel = '';
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'brand-form',
    'method' => 'post',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
        ));
CHtml::$errorSummaryCss = 'text-warning';
?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/My97DatePicker/WdatePicker.js"></script>
<?php
echo $form->errorSummary($brandModel);

?>

<div class="control-group">
    <?php echo $form->labelEx($brandModel, 'title', ['class' => 'control-label']); ?>
    <div class="controls">
        <?php echo $form->textArea($brandModel, 'title', ['maxlength' => 50]); ?>
        <label class="line-note">商品名称，最大50个汉字、字符</label>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($brandModel, 'describe', array('class' => 'control-label')); ?>
    <div class="controls">
       <?php echo $form->textArea($brandModel, 'describe', ['maxlength' => 50]); ?>
        <label class="line-note">描述</label>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($brandModel, 'brand_img', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($brandModel, 'brand_img'); ?>
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
        </span>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($brandModel, 'brand_url', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($brandModel, 'brand_url'); ?>
        <label class="line-note">图片链接</label>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($brandModel, 'start_time', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        echo $form->textField($brandModel, 'start_time', array(
            'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', startDate:'%y-%M-%d 00:00:00', onpicking:function (dp) { $('#Brand_start_time').val(dp.cal.getNewDateStr()); dp.hide();}})",
            "class" => "Wdate",
            'value' => $brandModel->start_time != 0 ? date('Y-m-d H:i:s', $brandModel->start_time) : $brandModel->start_time,
            'readonly' => 'readonly',
        ));
        ?>
        <label class="line-note">品牌开始时间</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($brandModel, 'end_time', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        echo $form->textField($brandModel, 'end_time', array(
            'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', startDate:'%y-%M-%d 00:00:00', onpicking:function (dp) { $('#Brand_end_time').val(dp.cal.getNewDateStr()); dp.hide();}})",
            "class" => "Wdate",
            'value' => $brandModel->end_time != 0 ? date('Y-m-d H:i:s', $brandModel->end_time) : $brandModel->end_time,
            'readonly' => 'readonly',
        ));
        ?>
        <label class="line-note">品牌结束时间</label>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($brandModel, 'order', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($brandModel, 'order'); ?>
    </div>
</div>

<div class="control-group">
        <?php echo $form->labelEx($brandModel,'status', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($brandModel, 'status', array('0' => '显示', '1' => '隐藏' )); ?>
        </div>
    </div>
<div class="form-actions">
    <?php
    echo CHtml::hiddenField("isChange", 0);
    echo CHtml::submitButton($brandModel->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save'));
    ?>
</div>
<?php $this->endWidget(); ?>

<script>
    //上传图片
    $('.upload-placeholder').fileupload({
        url: 'index.php?r=site/upload',
        dataType: 'json',
        done: function (e, data) {
            if (data.result.success) {
                $('#Brand_brand_img').val(data.result.path);
            } else {
                alert(data.result.message);
            }
        }
    });

//鼠标滑过显示图片
    $('#Brand_brand_img').hover(function () {
        var src = $(this).val();
        if (src != '') {
            $('#picture-preview').position($(this).position());
            $('#picture-preview').attr('src', src).removeClass('hide');
        }
    }, function () {
        $('#picture-preview').addClass('hide');
    });

</script>
