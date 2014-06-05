
<script type="text/javascript">

</script>
<div class="box">
    <h3 class="box-header">商品管理</h3>

    <?php $this->renderPartial('_search', array('model' => $model)); ?>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'goods-grid',
        'dataProvider'=>$model->search(),
        'enableSorting' => false,
        'itemsCssClass' => 'table table-striped table-bordered',
        'pagerCssClass' =>'pagination pagination-small',
        'template'=>'{items}{pager}',
        'cssFile' => false,
        'filter' => $model,
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
            'title' => array(
                'type' => 'raw',
                'id' => 'title',
                'name' => 'title',
                'value' => 'Goods::getUpdateLinkTitle($data->url, $data->title, $data->created_at, $data->updated_at, $data->goods_type)',
            ),
            'price',
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
            array(
                'type' => 'raw',
                'name' => 'status',
                'value' => 'CHtml::link(Goods::$statusLabels[$data->status], "javascript:void(0);", array("data-id" => $data->id, "class" => "changeStatus"))',
            ),
			array(
                'type' => 'raw',
                'name' => '卖光设置',
                'value' => 'CHtml::link(Goods::$statussellLabels[$data->sell_status], "javascript:void(0);", array("data-id" => $data->id, "class" => "statussell"))',
            ),
            'list_order' => array(
                'id' => 'list_order',
                'name' => 'list_order',
                'htmlOptions' => array(
                    'class' => 'settingOrder'
                )
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{update}',
                'header' => '操作',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("goods/update", array("id" => $data->id, "goodsType" => $data->goods_type))',
                        'imageUrl' => false
                    )
                )
            ),
        ),
    ));
    ?>
</div>

<script type="text/javascript">

$(document).ready(function () {
    $(document).on('click', '.settingOrder', function () {

        if ($(this).attr('class') != 'settingOrder') {
            return false;
        }
        var val = $(this).html();
        $(this).html('<input type="text" class="orderInput span1" value="'+val+'" /> ');
        $('.orderInput').select();
        $(this).removeClass('settingOrder');
    });

    $(document).on('blur', '.orderInput', function () {
        var val = $(this).val();
        var id = $.trim($(this).parent().prev().prev().prev().prev().prev().html());
        var input = this;
        if (id > 0) {
            $.get('index.php?r=goods/modifyOrder', {order : val, id : id}, function (data) {
                $(input).parent().html(val).attr('class', 'settingOrder');
            });
        }
    });

    $('.changeStatus').click(function () {
        $.get('index.php?r=goods/changeStatus', {id : $(this).attr('data-id')}, function (json) {
            location.reload();
        });
    }); 
	//设置商品是否销售完
	$('.statussell').click(function () {
        $.get('index.php?r=goods/ChangesellStatus', {id : $(this).attr('data-id')}, function (json) {
            location.reload();
        });
    });

});

</script>
