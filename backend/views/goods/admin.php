
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
                'value' => 'Goods::getUpdateLinkTitle($data->url, $data->title, $data->created_at, $data->updated_at, $data->goods_type,$data->picture);',
                'htmlOptions' => array('height' => '80','width'=>350),
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
                'name' => 'change_price',
                'value' => 'CHtml::link(Goods::$change_price[$data->change_price], "javascript:void(0);", array("data-id" => $data->id, "class" => "changePrice"))',
            ),
            array(
                'type' => 'raw',
                'name' => '卖光设置',
                'value' => 'CHtml::link(Goods::$statussellLabels[$data->sell_status], "javascript:void(0);", array("data-id" => $data->id, "class" => "statussell"))',
            ),
            'list_order' => array(
                'type' => 'raw',
                'name' => 'list_order',
                'value' => 'CHtml::link($data->list_order, "javascript:void(0);", array("order-id" => $data->id, "class" => "settingOrder"))',
            ),
            'updated_at' => array(
                'name' => 'updated_at',
                'id' => 'updated_at',
                'value' => 'date("Y-m-d H:i:s", $data->updated_at)',
                'htmlOptions' => array('width' => '141')
            ),
            'user_id'=>array(
                 'name'=>'user_id',
                 'id' => 'user_id',
                 'value' => 'User::getUserID($data->user_id)',
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
            array(
                    'selectableRows' => 2,
                    'footer' => '<button type="button" class="GetCheckbox" style="width:33px">批量</button>',
                    'class' => 'CCheckBoxColumn',
                    'headerHtmlOptions' => array('width'=>'33px'),
                    'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
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
            $.get('index.php?r=goods/modifyOrder', {order : val, id : id}, function (data) {
                //alert(data)
               $(input).parent().html(val).attr('class', 'settingOrder');
            });
        }
    });

    $('.changeStatus').click(function () {
        $.get('index.php?r=goods/changeStatus', {id : $(this).attr('data-id')}, function (json) {
            location.reload();
        });
    });

    //修改拍下减价
    $('.changePrice').click(function () {
        $.get('index.php?r=goods/changePrice', {id : $(this).attr('data-id')}, function (json) {
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

/*Array
(
    [selectdel] => Array
        (
            [0] => 13187
            [1] => 13178
            [2] => 10439
        )

)*/

   $('.GetCheckbox').click(function () 
   {
        if (confirm("确定要将排序值修改为0")) 
        {
            var data=new Array();
            $("input:checkbox[name='selectdel[]']").each(function (){
                if(this.checked==true){
                    data.push($(this).val());
                }
            });
           if(data.length > 0)
           {
                    $.post('index.php?r=goods/Allupdate',{'selectdel[]':data}, function (data) {
                            //alert(data)
                            var ret = $.parseJSON(data);
                            if (ret != null && ret.success != null && ret.success) {
                                   location.reload();
                            }
                    });
            }else{
                    alert("请选择要修改的排序值！");
            }
    }
})

</script>
