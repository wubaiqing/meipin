<div class="box">
    <h3 class="box-header"><?php echo $titleLabel;?></h3>

    <?php $this->renderPartial('_search', ['shaiModel' => $shaiModel]); ?>

    <?php
    $this->widget('ListView', array(
        'id' => 'exchange-grid',
        'dataProvider' => $shaiModel->search(),
        'pager'=>array('class'=>'CLinkPager'),
        'template'=>'{sorter}{items}{pager}',
        'itemsTagName'=>'table',
        'ajaxUpdate'=>false,
        'itemsCssClass'=>'table table-striped table-bordered',
        'emptyText'=>'对不起，没有任何搜索结果。',
        'viewData'=>[],
        'itemtops'=>'<th width=3%>ID</th><th width=3%>商品id</th><th width=1%>图片</th><th width=16%>评价时间</th><th width=13%>操作</th>',
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
     function goods_delete(obj)
    {
        if (confirm("确定要删除该商品？")) {
            var url = $(obj).attr("url");
            $.post(url,[],function (d) {
                window.location.href=location.href;
            },'json');
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
        var id = $(this).attr("oid");
        var input = this;
        if (id > 0) {
            $.get('index.php?r=brand/modifyOrder', {order : val, id : id}, function (data) {
               $(input).parent().html(val).attr('class', 'settingOrder');
            });
        }
    });

    //设置是否显示
    $('.status').click(function () {
        $.get('index.php?r=brand/changeFirst', {id : $(this).attr('status-id')}, function (json) {
            location.reload();
        });
    });
});
</script>
