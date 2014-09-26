<div class="box">
    <h3 class="box-header">操作日志</h3>

    <?php $this->renderPartial('_searchlog', ['model' => $model]); ?>

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
            'user_id',
            'operation',
            'created_at'=>array(
                'name'=>'created_at',
                'type'=>'datetime'
                ),

        ),
    ));
    ?>
</div>
