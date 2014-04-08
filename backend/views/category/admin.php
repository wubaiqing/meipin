<div class="box">
    <h3 class="box-header">分类管理</h3>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'category-grid',
        'dataProvider' => $model->search(),
        'enableSorting' => false,
        'itemsCssClass' => 'table-striped table table-bordered',
        'pagerCssClass' =>'pagination pagination-small',
        'template'=>'{items}{pager}',
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
            'name',
            array(
                'name' => 'parent_id',
                'value' => '$data->parent ? $data->parent->name : "无";',
            ),
            array(
                'name' => 'created_at',
                'type' => 'datetime',
            ),
            array(
                'name' => 'updated_at',
                'type' => 'datetime',
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{update} {delete}',
                'header' => '操作',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("category/update", array("id" => $data->id))',
                        'imageUrl' => false
                    ),
                    'delete' => array(
                        'label' => '删除',
                        'url' => 'Yii::app()->createUrl("category/delete", array("id" => $data->id))',
                        'imageUrl' => false
                    )
                )
            ),
        ),
    ));
    ?>
</div>
