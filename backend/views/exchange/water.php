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
<!--            <table class="table table-striped table-bordered" style="width:400px;">
                <thead>
                    <tr>
                        <td>用户名</td>
                        <td>参与时间</td>
                        <td>是否中奖</td>
                        <td>操作</td>
                    </tr>
                </thead>
            <?php
//                foreach ($waterList as $water):
            ?>
                    <tr>
                        <td><?php // echo $water->username;  ?></td>
                        <td><?php // echo date("Y-m-d H:i:s", $water->created_at);  ?></td>
                        <td><?php // echo ($water->winner == 1?"中奖":"未中奖");  ?></td>
                        <td>
            <?php
//                            echo CHtml::link("删除", 'javascript:', ['url' => Yii::app()->createUrl("exchange/waterDelete", ['id' => $water->id]), 'onclick' => 'water_delete(this)']);
            ?>
                        </td>
                    </tr>
            <?php // endforeach; ?>
            </table>-->
            <?php
            $this->widget('ListView', array(
                'id' => 'exchange-grid',
                'dataProvider' => $water->search(),
                'pager' => array('class' => 'CLinkPager'),
                'template' => '{sorter}{items}{pager}',
                'itemsTagName' => 'table',
                'ajaxUpdate' => false,
                'itemsCssClass' => 'table table-striped table-bordered',
                'emptyText' => '对不起，没有任何搜索结果。',
                'viewData' => [],
                'itemtops' => '<th width=7%>用戶名</th><th width=8%>参与时间</th><th width=11%>中奖状态</th><th width=18%>操作</th>',
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

//    $this->widget('zii.widgets.grid.CGridView', array(
//        'id' => 'exchange-grid',
//        'dataProvider' => $water->search(),
//        'enableSorting' => false,
//        'itemsCssClass' => 'table table-striped table-bordered',
//        'pagerCssClass' => 'pagination pagination-small',
//        'template' => '{items}{pager}',
//        'cssFile' => false,
//        'filter' => $water,
//        'filterPosition' => false,
//        'pager' => array(
//            'class' => 'CLinkPager',
//            'cssFile' => '',
//            'header' => '',
//            'lastPageLabel' => '尾页',
//            'firstPageLabel' => '首页',
//            'nextPageLabel' => '下一页',
//            'prevPageLabel' => '上一页',
//        ),
//        'columns' => array(
//            'goods_id' => array(
//                'type' => 'raw',
//                'header' => '用户名',
//                'value' => '"<a href=\"\"  target=\"_blank\">". $data->username ."</a>"',
//            ),
//            'created_at' => array(
//                'name' => '参与时间',
//                'id' => 'created_at',
//                'value' => 'date("Y-m-d H:i:s", $data->created_at)',
//                'htmlOptions' => array('width' => '180')
//            ),
//            'status' => [
//                'type' => 'raw',
//                'name' => '中奖状态',
//                'value' => '$data->winner == 1?"中奖":"未中奖"',
//                'htmlOptions' => array('width' => '80')
//            ],
//            array(
//                'class' => 'CButtonColumn',
//                'template' => '{update} {delete}',
//                'header' => '操作',
//                'htmlOptions' => array('width' => '100'),
//                'buttons' => array(
//                    'update' => array(
//                        'label' => '设为中奖',
//                        'url' => 'Yii::app()->createUrl("exchange/shipView", ["id" => $data->id])',
//                        'imageUrl' => false,
//                        'visible'=>'$data->user_add==0',
//                    ),
//                    'delete' => array(
//                        'label' => '删除',
//                        'url' => 'Yii::app()->createUrl("exchange/waterDelete", ["id" => $data->id])',
//                        'imageUrl' => false,
//                        'visible'=>'$data->user_add==1',
//                        "htmlOptions"=>['onclick'=>'water_delete(this)']
//                    ),
//                )
//            ),
//        ),
//    ));
            ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>

    <script type="text/javascript">
        function water_delete(obj) {
            if (confirm("确定要删除该记录？")) {
                var url = $(obj).attr("url");
                $.get(url, {}, function(d) {
                    if (d.status == true) {
//                        $(obj).parents("tr").remove();
                        location.href=location.href;
                    }
                }, 'json');
            }
        }
    </script>
</div>
