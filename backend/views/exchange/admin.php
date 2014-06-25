<div class="box">
    <h3 class="box-header">商品管理</h3>

    <?php $this->renderPartial('_search', ['exchangeModel' => $exchangeModel]); ?>

    <?php
    $this->widget('ListView', array(
        'id' => 'exchange-grid',
        'dataProvider' => $exchangeModel->search(),
        'pager'=>array('class'=>'CLinkPager'),
        'template'=>'{sorter}{items}{pager}',
        'itemsTagName'=>'table',
        'ajaxUpdate'=>false,
        'itemsCssClass'=>'table table-striped table-bordered',
        'emptyText'=>'对不起，没有任何搜索结果。',
        'viewData'=>[],
        'itemtops'=>'<th width=7%>ID</th><th width=8%>商品名称</th><th width=11%>商品类型</th><th width=18%>颜色</th><th width=13%>上线时间</th><th width=13%>下线时间</th><th width=7%>参与人数</th><th width=7%>首页</th><th width=7%>排序</th><th width=11%>操作</th>',
//        'enableSorting' => false,
//        'itemsCssClass' => 'table table-striped table-bordered',
//        'pagerCssClass' => 'pagination pagination-small',
//        'template' => '{items}{pager}',
//        'cssFile' => false,
//        'filter' => $exchangeModel,
//        'filterPosition' => false,
        'itemView'=>'_admin',
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
<style type="text/css">
    .orderInput{width:19px;}
</style>
<script type="text/javascript">
    function goods_delete(obj){
        if(confirm("确定要删除该商品？")){
            window.location.href=$(obj).attr("url");
        }
    }

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
