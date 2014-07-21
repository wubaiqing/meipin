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
            <label class="line-note">添加后前台将显示该用户名称</label>
        </div>
    </div>
    <div class="form-actions">
        <?php
        echo CHtml::submitButton('新增注水', array('class' => 'btn btn-primary save'));
        ?>
    </div>
    <h5>参与用户列表</h5>
    <div class="control-group" style="border-top: 1px solid #ccc;padding-top: 10px;">
        <div class="controls">
            <em>注：只用管理员注水用户才能删除</em>
            <?php
            $this->widget('ListView', array(
                'id' => 'exchange-grid',
                'dataProvider' => $water->searchLottery(),
                'pager' => array('class' => 'CLinkPager'),
                'template' => '{sorter}{items}{pager}',
                'itemsTagName' => 'table',
                'ajaxUpdate' => false,
                'itemsCssClass' => 'table table-striped table-bordered',
                'emptyText' => '对不起，没有任何搜索结果。',
                'viewData' => [],
                'itemtops' => '<th >用戶名</th><th >参与时间</th><th >中奖状态</th><th>类型</th><th >操作</th>',
                'itemView' => '_water',
                'pager' => array(
                    'class' => 'CLinkPager',
                    'cssFile' => '',
                    'header' => '',
                    'lastPageLabel' => '尾页',
                    'firstPageLabel' => '首页',
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                ),
            ));
            ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>

    <script type="text/javascript">
        function water_delete(obj)
        {
            if (confirm("确定要如此做？")) {
                var url = $(obj).attr("url");
                $.get(url, {}, function (d) {
                    if (d.status == true) {
//                        $(obj).parents("tr").remove();
                        location.href = location.href;
                    }
                }, 'json');
            }
        }
    </script>
</div>
