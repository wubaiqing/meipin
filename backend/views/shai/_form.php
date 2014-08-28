<?php
// 去掉必填项kk
CHtml::$afterRequiredLabel = '';
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'shai-form',
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
echo $form->errorSummary($shaiModel);

?>

<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'goods_id', ['class' => 'control-label']); ?>
    <div class="controls">
        <?php echo $form->textArea($shaiModel, 'goods_id', ['maxlength' => 50]); ?>
        <label class="line-note">不是淘宝id是商品id</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'username', ['class' => 'control-label']); ?>
    <div class="controls">
        <?php echo $form->textArea($shaiModel, 'username', ['maxlength' => 50]); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'content', array('class' => 'control-label')); ?>
    <div class="controls">
       <?php echo $form->textArea($shaiModel, 'content', ['class' => 'span5']); ?>
    </div>
</div>



<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'img', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($shaiModel, 'img',['class' => 'span5']); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($shaiModel, 'ptime', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        echo $form->textField($shaiModel, 'ptime', array(
            'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', onpicking:function (dp) { $('#Shai_ptime').val(dp.cal.getNewDateStr()); dp.hide();}})",
            "class" => "Wdate",
            'value' => $shaiModel->ptime != 0 ? $shaiModel->ptime : $shaiModel->ptime,
            'readonly' => 'readonly',
        ));
        ?>
    </div>
</div>

<div class="form-actions">
    <?php
    echo CHtml::hiddenField("isChange", 0);
    echo CHtml::submitButton($shaiModel->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save'));
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
