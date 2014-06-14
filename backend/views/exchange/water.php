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
            <?php
            echo $form->textField($exchangeLog, 'username', ['maxlength' => 50]);
            echo $form->hiddenField($exchangeLog, 'goods_id', ['value' => $exchangeModel->id]);
            ?>
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
                        <td>操作</td>
                    </tr>
                </thead>
                <?php
                foreach ($waterList as $water):
                    ?>
                    <tr>
                        <td><?php echo $water->username; ?></td>
                        <td><?php echo date("Y-m-d H:i:s", $water->created_at); ?></td>
                        <td>
                            <?php
                            echo CHtml::link("删除", 'javascript:', ['url' => Yii::app()->createUrl("exchange/waterDelete", ['id' => $water->id]), 'onclick' => 'water_delete(this)']);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php $this->endWidget(); ?>

    <script type="text/javascript">
        function water_delete(obj) {
            if (confirm("确定要删除该记录？")) {
                var url = $(obj).attr("url");
                $.get(url, {}, function(d) {
                    if (d.status == true) {
                        $(obj).parents("tr").remove();
                    }
                }, 'json');
            }
        }
    </script>
</div>
