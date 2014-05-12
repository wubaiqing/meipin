<?php
// 去掉必填项kk
CHtml::$afterRequiredLabel = '';
$form=$this->beginWidget('CActiveForm', array(
    'id' => 'goods-form',
    'method'=>'post',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
));
CHtml::$errorSummaryCss = 'text-warning';

?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/My97DatePicker/WdatePicker.js"></script>
    <?php echo $form->errorSummary($exchangeModel); ?>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'name', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($exchangeModel,'name');?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'num', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($exchangeModel,'num');?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'price', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($exchangeModel,'price');?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'integral', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($exchangeModel,'integral');?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'start_time', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($exchangeModel,'start_time',array(
                'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', startDate:'%y-%M-%d 00:00:00', onpicking:function (dp) { $('#Exchange_start_time').val(dp.cal.getNewDateStr()); dp.hide();}})",
                "class" => "Wdate",
                'value'=>$exchangeModel->start_time != 0 ? date('Y-m-d H:i:s' , $exchangeModel->start_time) : $exchangeModel->start_time,
        ));?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'end_time', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($exchangeModel,'end_time',array(
                'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', startDate:'%y-%M-%d 00:00:00', onpicking:function (dp) { $('#Exchange_end_time').val(dp.cal.getNewDateStr()); dp.hide();}})",
                "class" => "Wdate",
                'value'=>$exchangeModel->end_time != 0 ? date('Y-m-d H:i:s' , $exchangeModel->end_time) : $exchangeModel->end_time,
        ));?>
        </div>
</div>
<!--<div class="control-group">
        <?php // echo $form->labelEx($exchangeModel,'need_level', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php // echo $form->textField($exchangeModel,'need_level');?>
        </div>
</div>-->
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'taobaoke_url', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->urlField($exchangeModel,'taobaoke_url');?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'taobaoke_shop_url', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->urlField($exchangeModel,'taobaoke_shop_url');?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'support_name', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($exchangeModel,'support_name');?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'support_url', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->urlField($exchangeModel,'support_url');?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'description', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textArea($exchangeModel,'description');?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($exchangeModel,'img_url', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($exchangeModel,'img_url');?>
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
<div class="form-actions">
        <?php echo CHtml::submitButton($exchangeModel->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save')); ?>
    </div>
<?php $this->endWidget(); ?>

<script>
    //上传图片
$('.upload-placeholder').fileupload({
    url: 'index.php?r=site/upload',
    dataType: 'json',
    done: function (e, data) {
        if (data.result.success) {
            $('#Exchange_img_url').val(data.result.path);
        } else {
            alert(data.result.message);
        }
    }
});

//鼠标滑过显示图片
$('#Exchange_img_url').hover(function () {
    var src = $(this).val();
    if (src != '') {
        $('#picture-preview').position($(this).position());
        $('#picture-preview').attr('src', src).removeClass('hide');
    }
}, function () {
    $('#picture-preview').addClass('hide');
});
</script>
