<div class="box">
    <h3 class="box-header">商品管理</h3>

    <?php $this->renderPartial('_search', ['exchangeModel' => $exchangeModel]); ?>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'exchange-grid',
        'dataProvider'=>$exchangeModel->search(),
        'enableSorting' => false,
        'itemsCssClass' => 'table table-striped table-bordered',
        'pagerCssClass' =>'pagination pagination-small',
        'template'=>'{items}{pager}',
        'cssFile' => false,
        'filter' => $exchangeModel,
        'filterPosition' => false,
        'pager' => array(
            'class' => 'CLinkPager',
            'cssFile' => '',
            'header' => '',
            'lastPageLabel' => '尾页',
            'firstPageLabel' => '首页',
            'nextPageLabel' => '下一页',
            'prevPageLabel' => '上一页',
        ),
        'columns' => array(
            'id',
            'name'=>array(
                'type'=>'raw',
                'name'=>'name',
                'value'=>'"<a href=\"$data->taobaoke_url\"  target=\"_blank\">".$data->name."</a>"',
            ),
            'goodscolor2',
            'price',
            'num',
            'delenum'=>array(
                    'name'=>'delenum',
                    'value'=>'($data->num - $data->sale_num)',
                ),
            'integral',
            'start_time' => array(
                'name' => 'start_time',
                'id' => 'start_time',
                'value' => 'date("Y-m-d", $data->start_time)',
                'htmlOptions' => array('width' => '80'),
            ),
            'end_time' => array(
                'name' => 'end_time',
                'id' => 'end_time',
                'value' => 'date("Y-m-d", $data->end_time)',
                'htmlOptions' => array('width' => '80')
            ),
            'is_first' => array(
                'type' => 'raw',
                'name' => 'is_first',
                'value' => 'CHtml::link(Exchange::$is_firstLabels[$data->is_first], "javascript:void(0);", array("first-id" => $data->id, "class" => "is_first"))',
            ),
            'list_order' => array(
                'type' => 'raw',
                'name' => 'list_order',
                'value' => 'CHtml::link($data->list_order, "javascript:void(0);", array("order-id" => $data->id, "class" => "settingOrder"))', 
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{update} {delete}',
                'header' => '操作',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("exchange/update", array("id" => $data->id))',
                        'imageUrl' => false
                    ),
                    'delete'=>array(
                        'label'=>'删除',
                        'imageUrl' => false,
                    ),
                )
            ),
        ),
    ));
    ?>
</div>
<style type="text/css">
    .orderInput{width:19px;}
</style>
<script type="text/javascript">

$(document).ready(function () {
    $(document).on('click', '.settingOrder', function () {

        if ($(this).attr('class') != 'settingOrder') {
            return false;
        }
        var val = $(this).html();
        var id = $(this).attr('order-id');
        $(this).html('<input type="text" class="orderInput" value="'+val+'" oid="'+id+'"/> ');
        $('.orderInput').select();
        $(this).removeClass('settingOrder');
    });

    $(document).on('blur', '.orderInput', function () {
        var val = $(this).val();
        //var id = $.trim($(this).parent().prev().prev().prev().prev().prev().html());
        var id = $(this).attr("oid");
        var input = this;
        if (id > 0) {
            $.get('index.php?r=exchange/modifyOrder', {order : val, id : id}, function (data) {
               $(input).parent().html(val).attr('class', 'settingOrder');
            });
        }
    });

    //设置是否在首页显示
    $('.is_first').click(function () {
        $.get('index.php?r=exchange/changeFirst', {id : $(this).attr('first-id')}, function (json) {
            location.reload();
        });
    });
});

    </script>