<?php
/* @var $this GoodsController */
/* @var $data Goods */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('tb_id')); ?>:</b>
    <?php echo CHtml::encode($data->tb_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('cat_id')); ?>:</b>
    <?php echo CHtml::encode($data->cat_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
    <?php echo CHtml::encode($data->url); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('origin_price')); ?>:</b>
    <?php echo CHtml::encode($data->origin_price); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
    <?php echo CHtml::encode($data->price); ?>
    <br />

    <?php /*
    <b><?php echo CHtml::encode($data->getAttributeLabel('discount_price')); ?>:</b>
    <?php echo CHtml::encode($data->discount_price); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('picture')); ?>:</b>
    <?php echo CHtml::encode($data->picture); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('shop_name')); ?>:</b>
    <?php echo CHtml::encode($data->shop_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->status); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('collection_time')); ?>:</b>
    <?php echo CHtml::encode($data->collection_time); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
    <?php echo CHtml::encode($data->update_time); ?>
    <br />

    */ ?>

</div>
