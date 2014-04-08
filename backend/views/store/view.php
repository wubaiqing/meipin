<?php
/* @var $this GoodsController */
/* @var $model Goods */

$this->breadcrumbs=array(
    'Goods'=>array('index'),
    $model->title,
);

$this->menu=array(
    array('label'=>'List Goods', 'url'=>array('index')),
    array('label'=>'Create Goods', 'url'=>array('create')),
    array('label'=>'Update Goods', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete Goods', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage Goods', 'url'=>array('admin')),
);
?>

<h1>View Goods #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'tb_id',
        'cat_id',
        'title',
        'url',
        'origin_price',
        'price',
        'discount_price',
        'picture',
        'shop_name',
        'status',
        'collection_time',
        'update_time',
    ),
));
