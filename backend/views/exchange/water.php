<div class="box">
    <h3 class="box-header">商品注水</h3>
    <?php
// 去掉必填项kk
    CHtml::$afterRequiredLabel = '';
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'goods-form',
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
    echo $form->errorSummary($exchangeLog);
    ?>
    <div class="control-group">
        <?php echo $form->labelEx($exchangeModel, 'goods_type', ['class' => 'control-label', 'maxlength' => 50]); ?>
        <div class="controls">
            <?php
            echo $form->dropDownList($exchangeModel, 'goods_type', Exchange::$goodsType, ['disabled' => true]);
            ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($exchangeModel, 'name', ['class' => 'control-label']); ?>
        <div class="controls">
            <?php echo $form->textArea($exchangeModel, 'name', ['maxlength' => 50, 'disabled' => true]); ?>
        </div>
    </div>
    <div class="control-group" style="border-top: 1px solid #ccc;padding-top: 10px;">
        <?php echo $form->labelEx($exchangeLog, 'username', ['class' => 'control-label']); ?>
        <div class="controls">
            <?php echo $form->textField($exchangeLog, 'username', ['maxlength' => 50]); ?>
        </div>
    </div>
    <div class="form-actions">
        <?php
        echo CHtml::submitButton('新增注水', array('class' => 'btn btn-primary save'));
        ?>
    </div>
    <h5>中奖用户列表（注水用户）</h5>
    <div class="control-group" style="border-top: 1px solid #ccc;padding-top: 10px;">
        <div class="controls">
        <table class="table table-striped table-bordered" style="width:300px;">
            <thead>
            <tr>
                <td>用户名</td>
                <td>添加时间</td>
            </tr>
            </thead>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>
            </div>
    </div>
    <?php $this->endWidget(); ?>

    <script>

    </script>
</div>
