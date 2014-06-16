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
        <?php echo $form->labelEx($model,'tb_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'tb_id'); ?>
            <?php echo CHtml::htmlButton('获取商品', array('id' => 'getTaobaoData', 'class' => 'btn'));?>
            <span class="text-error"></span>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'list_order', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'list_order', array('size' => 8, 'maxlength' => 8)); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'is_zhe800', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'is_zhe800', array('2' => '其他' )); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'cat_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo new TreeDropdownList(new Cat, 'Goods[cat_id]', $model->cat_id); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'title', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'span5')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'url', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'origin_price', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'origin_price', array('size' => 8,'maxlength' => 8)); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'price', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'price', array('size' => 8, 'maxlength' => 8)); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'picture', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'picture', array('size' => 60, 'maxlength' => 255,'id'=>'Goods_picture')); ?>
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

    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/My97DatePicker/WdatePicker.js"></script>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'start_time', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'start_time', array(
                'onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss', startDate:'%y-%M-%d 00:00:00', onpicking:function (dp) { $('#Goods_start_time').val(dp.cal.getNewDateStr()); dp.hide();}})",
                "class" => "Wdate"
            )); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'end_time', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'end_time', array('onfocus' => "WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',startDate:'%y-%M-%d 23:59:00', onpicking:function (dp) { $('#Goods_end_time').val(dp.cal.getNewDateStr()); dp.hide();}})", "class" => "Wdate")); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model,'status', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'status', array('1' => '显示', '2' => '隐藏' )); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model,'admin_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <span style='width:100px;height:30px;line-height:30px;'>
            <?php if(User::getUserID($model->user_id)){echo User::getUserID($model->user_id);}else{ echo Yii::app()->user->id;} ;?>
            </span>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '修改', array('class' => 'btn btn-primary save')); ?>
    </div>

<?php $this->endWidget(); ?>
<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21150704"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/scripts/goods/add.js?v=wubaiqing1.5.3"></script>
