
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
                'id' => 'name',
                'name' => 'name',
                'value' => '"<a href=\"index.php?r=store/update&id=" . $data->id. "\"/>$data->name</a>" '
            ),
            'cat_id' => array(
                'type' => 'raw',
                'id' => 'cat_id',
                'name' => 'cat_id',
                'value' => '$data->cat->name'
            ),
            'spread' => array(
                'type' => 'raw',
                'id' => 'spread',
                'name' => 'spread',
            ),
            'logo' => array(
                'type' => 'raw',
                'id' => 'logo',
                'name' => 'logo',
                'value' => '"<img src=\"" . $data->logo . "\"/>" '
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{update}',
                'header' => '操作',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("store/update", array("id" => $data->id))',
                        'imageUrl' => false
                    )
                )
            ),
        )
    ));
    ?>
</div>
