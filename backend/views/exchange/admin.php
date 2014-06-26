<div class="box">
    <h3 class="box-header"><?php echo $titleLabel;?></h3>

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
        'itemtops'=>'<th width=7%>ID</th><th width=8%>商品名称</th><th width=11%>商品类型</th><th width=18%>颜色</th><th width=13%>上线时间</th><th width=13%>下线时间</th><th width=7%>参与人数</th><th width=11%>操作</th>',
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
<script type="text/javascript">
    function goods_delete(obj){
        if(confirm("确定要删除该商品？")){
            window.location.href=$(obj).attr("url");
        }
    }
</script>
