<div class="box">
    <h3 class="box-header">用户反馈</h3>

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
            'qq',
            'advise',
            'email',
            array(
                'name'=>'created_at',
                'type'=>'datetime',
              ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{delete}',
                'header' => '操作',
                'buttons' => array(
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
