<?php
// 去掉必填项kk
CHtml::$afterRequiredLabel = '';
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'goods-form',
    'method' => 'post',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'enctype'=>'multipart/form-data',
    ),
        ));
CHtml::$errorSummaryCss = 'text-warning';
?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/My97DatePicker/WdatePicker.js"></script>
<?php
echo $form->errorSummary($exchangeModel);
$online = $exchangeModel->id > 0 && $exchangeModel->start_time > 0 && ($exchangeModel->start_time < time());
?>
<!--<div class="control-group">
<?php //echo $form->labelEx($exchangeModel, 'goods_type', ['class' => 'control-label', 'maxlength' => 50]); ?>
    <div class="controls">
<?php //echo $form->dropDownList($exchangeModel, 'goods_type', Exchange::$goodsType, ['disabled' => $online ? true : false]); ?>
        <label class="line-note">用于区分积分类商品的不同类型</label>
    </div>
</div>-->
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'name', ['class' => 'control-label']); ?>
    <div class="controls">
        <?php echo $form->textArea($exchangeModel, 'name', ['maxlength' => 50]); ?>
        <label class="line-note">商品名称，最大50个汉字、字符</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'goodscolor', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($exchangeModel, 'goodscolor', ['maxlength' => 50]); ?>
        <label class="line-note">（格式: 白色:20;黑色:30;青色:10   这样总数量就是60 属性:数量;属性:数量; 注意冒号和分号用英文格式的 ）</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'num', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($exchangeModel, 'num'); ?>
        <label class="line-note">实际库存数量</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'buy_num', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($exchangeModel, 'buy_num'); ?>
        <label class="line-note">限制每人购买件数</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'price', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($exchangeModel, 'price'); ?>
        <label class="line-note">商品标准售价</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'active_price', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($exchangeModel, 'active_price'); ?>
        <label class="line-note">加钱换购金额，除积分外，用户还需要额外支付的金额</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'integral', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($exchangeModel, 'integral'); ?>
        <label class="line-note">兑换该商品所需要的积分数量</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'start_time', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        echo $form->textField($exchangeModel, 'start_time', array(
            'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', startDate:'%y-%M-%d 00:00:00', onpicking:function (dp) { $('#Exchange_start_time').val(dp.cal.getNewDateStr()); dp.hide();}})",
            "class" => "Wdate",
            'value' => $exchangeModel->start_time != 0 ? date('Y-m-d H:i:s', $exchangeModel->start_time) : $exchangeModel->start_time,
            'readonly' => 'readonly',
        ));
        ?>
        <label class="line-note">活动开始时间</label>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'end_time', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        echo $form->textField($exchangeModel, 'end_time', array(
            'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', startDate:'%y-%M-%d 00:00:00', onpicking:function (dp) { $('#Exchange_end_time').val(dp.cal.getNewDateStr()); dp.hide();}})",
            "class" => "Wdate",
            'value' => $exchangeModel->end_time != 0 ? date('Y-m-d H:i:s', $exchangeModel->end_time) : $exchangeModel->end_time,
            'readonly' => 'readonly',
        ));
        ?>
        <label class="line-note">活动结束时间</label>
    </div>
</div>
<?php if ($exchangeModel->goods_type == 1): ?>
    <div class="control-group">
        <?php echo $form->labelEx($exchangeModel, 'lottery_time', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            echo $form->textField($exchangeModel, 'lottery_time', array(
                'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', startDate:'%y-%M-%d 00:00:00', onpicking:function (dp) { $('#Exchange_lottery_time').val(dp.cal.getNewDateStr()); dp.hide();}})",
                "class" => "Wdate",
                'value' => $exchangeModel->lottery_time != 0 ? date('Y-m-d H:i:s', $exchangeModel->lottery_time) : $exchangeModel->lottery_time,
                'readonly' => 'readonly',
            ));
            ?>
            <label class="line-note">脚本在后台自动运算中奖人的时间，设定后将由后台脚本自动进行抽奖。请尽量设置为整点，且该时间必须在活动有效期内。</label>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($exchangeModel, 'limit_count', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($exchangeModel, 'limit_count', []); ?>
            <label class="line-note">最大中奖用户数</label>
        </div>
    </div>
<?php endif; ?>
<!--<div class="control-group">
<?php // echo $form->labelEx($exchangeModel,'need_level', array('class' => 'control-label'));  ?>
        <div class="controls">
<?php // echo $form->textField($exchangeModel,'need_level'); ?>
        </div>
</div>-->
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'taobaoke_url', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->urlField($exchangeModel, 'taobaoke_url'); ?>
    </div>
</div>
<!--<div class="control-group">
<?php // echo $form->labelEx($exchangeModel,'taobaoke_shop_url', array('class' => 'control-label'));  ?>
        <div class="controls">
<?php // echo $form->urlField($exchangeModel,'taobaoke_shop_url'); ?>
        </div>
</div>-->
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'support_name', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($exchangeModel, 'support_name'); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'support_url', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->urlField($exchangeModel, 'support_url'); ?>
    </div>
</div>
<div class="control-group">
<?php echo $form->labelEx($exchangeModel, 'img_url', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($exchangeModel, 'img_url'); ?>
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
        <label class="line-note">图片290*190</label>
    </div>
</div>

<div class="control-group">
<?php echo $form->labelEx($exchangeModel, 'bigimg_url', array('class' => 'control-label')); ?>
    <div class="controls">
          <?php echo CHtml::activeFileField($exchangeModel,'bigimg_url'); ?> 
          <a class="line-note" href="<?php echo $exchangeModel->bigimg_url;?>"><?php echo $exchangeModel->bigimg_url;?></a> 
          <label class="line-note">大图400*400</label>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($exchangeModel, 'description', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($exchangeModel, 'description'); ?>
        <script type="text/javascript">CKEDITOR.replace('Exchange[description]');</script>
    </div>
</div>
<div class="form-actions">
    <?php
    echo CHtml::hiddenField("isChange", 0);
    echo CHtml::submitButton($exchangeModel->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save'));
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
    $("#Exchange_goods_type").change(function () {
        $("#isChange").val(1);
        $("#goods-form").submit();
    })
</script>
