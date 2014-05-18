<?php
// 去掉必填项kk
CHtml::$afterRequiredLabel = '';
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'score-form',
    'method' => 'post',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
        ));
CHtml::$errorSummaryCss = 'text-warning';
?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/My97DatePicker/WdatePicker.js"></script>
<?php echo $form->errorSummary($model); ?>
<style type="text/css">
    .v_table_con {
        width: 98%;
        margin: 10px auto 0px;
        margin-left: 20px;
        border: 0;
    }
    .v_table_label{
        text-align: right;
        vertical-align: top;
        width: 1px;
        color: #666;
        word-wrap: break-word;
        padding: 5px;
    }
    .v_table_line{border-bottom: 1px solid #e5e5e5;width: 100%;text-align: center;font-weight: bold;font-size: 16px;}
</style>
<table border="0" class="v_table_con">
    <tr>
        <td colspan="2"  class='v_table_line'>商品信息</td>
    </tr>
    <tr>
        <td class="v_table_label">淘宝ID：</td>
        <td>
            <?php echo!empty($model->exchange->taobao_id) ? $model->exchange->taobao_id : ""; ?>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">商品标题：</td>
        <td>
            <?php echo $model->exchange->name; ?>
        </td>
    </tr>
    <?php if (!empty($model->exchange->taobaoke_url)): ?>
        <tr>
            <td class="v_table_label">链接：</td>
            <td>
                <a href="<?php echo $model->exchange->taobaoke_url; ?>" target="_blank"><?php echo $model->exchange->taobaoke_url; ?></a>
            </td>
        </tr>
    <?php endif; ?>
    <tr class='v_table_line'>
        <td colspan="2">兑换详情</td>
    </tr>
    <tr>
        <td class="v_table_label">兑换时间：</td>
        <td>
            <?php echo date("Y-m-d H:i:s", $model->created_at); ?>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">收货人姓名：</td>
        <td>
            <?php echo $form->textField($model, 'name', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">联系电话：</td>
        <td>
            <?php echo $form->textField($model, 'mobile', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">收货地址：</td>
        <td>
            <?php echo $form->textArea($model, 'address', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">邮编：</td>
        <td>
            <?php echo $form->textField($model, 'postcode', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">&nbsp;</td>
        <td>
            <?php echo CHtml::button("编辑", array('class' => 'btn btn-primary save')); ?>
        </td>
    </tr>
    <tr>
        <td class="v_table_label">邮编：</td>
        <td>
            <?php echo $form->textField($model, 'postcode', array('disabled' => 'disabled')); ?>
        </td>
    </tr>
</table>
<!--<div class="form-actions">
<?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save')); ?>
</div>-->
<?php $this->endWidget(); ?>

<script>
    //上传图片
    $('.upload-placeholder').fileupload({
        url: 'index.php?r=site/upload',
        dataType: 'json',
        done: function(e, data) {
            if (data.result.success) {
                $('#Exchange_img_url').val(data.result.path);
            } else {
                alert(data.result.message);
            }
        }
    });

//鼠标滑过显示图片
    $('#Exchange_img_url').hover(function() {
        var src = $(this).val();
        if (src != '') {
            $('#picture-preview').position($(this).position());
            $('#picture-preview').attr('src', src).removeClass('hide');
        }
    }, function() {
        $('#picture-preview').addClass('hide');
    });
</script>
