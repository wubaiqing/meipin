<div class="box">
    <h3 class="box-header">用户管理</h3>

    <?php $this->renderPartial('_search', ['model' => $model]); ?>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'exchange-grid',
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
            'username',
            'mobile',
            'score',
            'created_at',
            array(
                'class' => 'CButtonColumn',
                'template' => '{update} {delete}',
                'header' => '操作',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("exchange/update", array("id" => $data->id))',
                        'imageUrl' => false
                    ),
                    'delete'=>array(
                        'label'=>'删除',
                        'imageUrl' => false,
                    ),
                )
            ),
        ),
    ));
    ?>
</div>
