<div class="box">
    <h3 class="box-header">商品统计</h3>
     <?php $this->renderPartial('_infosearch', ['goodsmodel' => $goodsmodel]); ?>
    <?php
    $this->widget('ListView', array(
        'id' => 'exchange-grid',
        'dataProvider' => $goodsmodel->getgoodsinfo(),
        'pager'=>array('class'=>'CLinkPager'),
        'template'=>'{sorter}{items}{pager}',
        'itemsTagName'=>'table',
        'ajaxUpdate'=>false,
        'itemsCssClass'=>'table table-striped table-bordered',
        'emptyText'=>'对不起，没有任何搜索结果。',
        'viewData'=>[],
        'itemtops'=>'<th width=10%>时间</th><th width=9%>后台用户</th><th width=9%>商品数量</th>',

        'itemView'=>'_goodsinfo',
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
