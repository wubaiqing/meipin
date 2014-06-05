<div class="box">
    <h3 class="box-header">友情链接管理</h3>
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
                'header' => '网站名称',
                'type' => 'raw',
                'id' => 'image_url',
                'name' => 'image_url',
            ),
            'image_url' => array(
                'header' => '网址',
                'type' => 'raw',
                'id' => 'url',
                'name' => 'url',
                'value' => 'CHtml::link($data->url, $data->url, array("target" => "_blank"))'
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{update} {delete}',
                'header' => '操作',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'imageUrl' => false
                    ),
                    'delete' => array(
                        'label' => '删除',
                        'imageUrl' => false,
                        'click' => '',
                    )
                )
            ),
        ),
    ));
    ?>
</div>
