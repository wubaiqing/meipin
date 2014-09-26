<div class="box">
    <h3 class="box-header"><?php echo $titleLabel;?></h3>

    <?php $this->renderPartial('_shipSearch', ['model' => $model]); ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'exchange-grid',
        'dataProvider' => $model->search($data),
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
            'order_id'=>array(
                'type' => 'raw',
                'header' => '订单编号',
                'name' => 'order_id',
                'value' => '"<a href=\"/index.php?r=order/admin&id=$data->order_id\"  target=\"_blank\">". $data->order_id ."</a>"',
            ),
            'goods_id' => array(
                'type' => 'raw',
                'header' => '商品名称',
                'value' => '"<a href=\"".ExchangeLog::getDetailurl($data->exchange)."\"  target=\"_blank\">". (!is_null($data->exchange)?$data->exchange->name:"1") ."</a>"',
            ),
            'gdscolor' =>[
                'type' => 'raw',
                'header' => '属性',
                'name' => 'gdscolor',
                'htmlOptions' => array('width' => '100')
            ],
            'remark' =>[
                'type' => 'raw',
                'header' => '备注',
                'name' => 'remark',
                'htmlOptions' => array('width' => '100')
            ],

            'user_id' => [
                'type' => 'raw',
                'header' => '用户名',
                'value' => '"<a href=\"\"  target=\"_blank\">".(!empty($data->users)?$data->users->username:"")."</a>"',
                'htmlOptions' => array('width' => '100')
            ],
            'created_at' => array(
                'name' => '参与时间',
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
            'logic' => array(
                'type' => 'raw',
                'name' => '物流信息',
                'id' => 'lotistics',
                'value' => 'ExchangeLog::getLogistics($data)',
                'htmlOptions' => array('width' => '180')
            ),
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
