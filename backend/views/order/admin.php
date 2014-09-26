<div class="box">
    <h3 class="box-header"><?php echo $titleLabel;?></h3>

    <?php $this->renderPartial('_search', ['orderModel' => $orderModel]); ?>

    <?php
    $this->widget('ListView', array(
        'id' => 'exchange-grid',
        'dataProvider' => $orderModel->search(),
        'pager'=>array('class'=>'CLinkPager'),
        'template'=>'{sorter}{items}{pager}',
        'itemsTagName'=>'table',
        'ajaxUpdate'=>false,
        'itemsCssClass'=>'table table-striped table-bordered',
        'emptyText'=>'对不起，没有任何搜索结果。',
        'viewData'=>[],
        'itemtops'=>'<th width=7%>ID</th><th width=8%>支付状态</th><th width=18%>支付时间</th><th width=7%>购买数量</th><th width=13%>支付总额</th><th width=13%>积分消耗</th><th width=7%>用户id</th><th width=7%>商品id</th>',
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

$(document).ready(function () {


    //修改支付状态
    $('.pay_status').click(function () {
        //var order_id = $(this).attr('paystatus-id');
        if (confirm("确定已过期的订单改为已付款？")) {
            $.get('index.php?r=order/changePaystatus', {order_id : $(this).attr('paystatus-id')}, function (aa) {
                alert(aa);
                location.reload();
            });
       }
    });
});
</script>
