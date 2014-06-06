<div class="box">
    <h3 class="box-header">商品管理</h3>

    <?php $this->renderPartial('_search', ['exchangeModel' => $exchangeModel]); ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'exchange-grid',
        'dataProvider' => $exchangeModel->search(),
        'enableSorting' => false,
        'itemsCssClass' => 'table table-striped table-bordered',
        'pagerCssClass' => 'pagination pagination-small',
        'template' => '{items}{pager}',
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
        'columns' => [
            'id',
            'goods_type' => [
                'name' => 'goods_type',
                'value' => 'Exchange::$goodsType[$data->goods_type]',
                'htmlOptions' => array('width' => '60'),
            ],
            'name' => array(
                'type' => 'raw',
                'name' => 'name',
                'value' => '"<a href=\"$data->taobaoke_url\"  target=\"_blank\">".$data->name."</a>"',
            ),
            'goodscolor' => [
                'name' => 'goodscolor',
                'htmlOptions' => [
                    'width' => '200'
                ]
            ],
            'price',
            'num',
            'delenum' => [
                'name' => 'delenum',
                'value' => '($data->num - $data->sale_num)',
            ],
            'integral',
            'start_time' => [
                'name' => 'start_time',
                'id' => 'start_time',
                'value' => 'date("Y-m-d", $data->start_time)',
                'htmlOptions' => ['width' => '80'],
            ],
            'end_time' => [
                'name' => 'end_time',
                'id' => 'end_time',
                'value' => 'date("Y-m-d", $data->end_time)',
                'htmlOptions' => ['width' => '80']
            ],
            [
                'class' => 'CButtonColumn',
                'template' => '{update} {delete}',
                'header' => '操作',
                'buttons' => [
                    'update' => [
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("exchange/update", array("id" => $data->id))',
                        'imageUrl' => false
                    ],
                    'delete' => [
                        'label' => '删除',
                        'imageUrl' => false,
                    ],
                ]
            ],
        ],
    ));
    ?>
</div>
