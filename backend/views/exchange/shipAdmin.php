<div class="box">
    <h3 class="box-header">积分商品兑换管理</h3>

    <?php $this->renderPartial('_shipSearch', ['model' => $model]); ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'exchange-grid',
        'dataProvider' => $model->search(),
        'enableSorting' => false,
        'itemsCssClass' => 'table table-striped table-bordered',
        'pagerCssClass' => 'pagination pagination-small',
        'template' => '{items}{pager}',
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
            'goods_id' => array(
                'type' => 'raw',
                'header' => '商品名称',
                'value' => '"<a href=\"\"  target=\"_blank\">". !is_null($data->exchange)?$data->exchange->name:"1" ."</a>"',
            ),
            'gdscolor',
            'user_id' => [
                'type' => 'raw',
                'header' => '兑换用户',
                'value' => '"<a href=\"\"  target=\"_blank\">".!empty($data->users)?$data->users->username:""."</a>"',
                'htmlOptions' => array('width' => '150')
            ],
            'created_at' => array(
                'name' => 'created_at',
                'id' => 'created_at',
                'value' => 'date("Y-m-d H:i:s", $data->created_at)',
                'htmlOptions' => array('width' => '180')
            ),
            'status' => [
                'type' => 'raw',
                'name' => '状态',
                'value' => '"<a url=\"".Yii::app()->createUrl(\'exchange/ajaxShipUpdate\',[\'id\'=>$data->id])."\" '
                . ' class=\"exchange_list_status\" status=\'".$data->status."\''
                . ' href=\"javascript:void(0);\">".ExchangeLog::getStatus($data->status)."</a>"',
                'htmlOptions' => array('width' => '80')
            ],
            array(
                'class' => 'CButtonColumn',
                'template' => '{update}',
                'header' => '操作',
                'htmlOptions' => array('width' => '100'),
                'buttons' => array(
                    'update' => array(
                        'label' => '编辑',
                        'url' => 'Yii::app()->createUrl("exchange/shipView", array("id" => $data->id))',
                        'imageUrl' => false
                    ),
                )
            ),
        ),
    ));

    ?>
</div>
