<div class="box">
    <h3 class="box-header">商品管理</h3>
    
    <?php $this->renderPartial('_search', array('exchangeModel' => $exchangeModel)); ?>
    
    <span><?php echo CHtml::link('添加积分活动',$this->createUrl('exchange/add'),  array('class'=>'btn-primary btn'));?></span>
    <?php // $this->renderPartial('_search', array('model' => $model)); ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'exchange-grid',
        'dataProvider'=>$exchangeModel->search(),
        'enableSorting' => false,
        'itemsCssClass' => 'table table-striped table-bordered',
        'pagerCssClass' =>'pagination pagination-small',
        'template'=>'{items}{pager}',
        'cssFile' => false,
        'filter' => $exchangeModel,
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
            'name',
            'price',
            'num',
            'integral',
            'start_time' => array(
                'name' => 'start_time',
                'id' => 'start_time',
                'value' => 'date("Y-m-d", $data->start_time)',
                'htmlOptions' => array('width' => '80'),
            ),
            'end_time' => array(
                'name' => 'end_time',
                'id' => 'end_time',
                'value' => 'date("Y-m-d", $data->end_time)',
                'htmlOptions' => array('width' => '80')
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{update}',
                'header' => '操作',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("exchange/update", array("id" => $data->id))',
                        'imageUrl' => false
                    )
                )
            ),
        ),
    ));
    ?>
</div>