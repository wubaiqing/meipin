<tr>
    <td class="center"><?php echo $data->id ?></td>
    <td><a href='<?php echo 1;?>' target='_blank'><?php echo $data->title ?></a></td>
    <td><?php echo $data->describe; ?></td>
    <td><?php echo date("Y-m-d H:i", $data->start_time) ?></td>
    <td><?php echo date("Y-m-d H:i", $data->end_time) ?></td>
    <td><a href="<?php echo $data->brand_url; ?>" target="_blank">链接</a></td>

    <td><?php echo CHtml::link(Brand::$is_first[$data->status], "javascript:void(0);", array("status-id" => $data->id, "class" => "status")) ?></td>

    <td><?php echo CHtml::link($data->order, "javascript:void(0);", array("order-id" => $data->id, "class" => "settingOrder")); ?></td>

    <td class="button-column">
        <?php
        echo CHtml::link('修改', Yii::app()->createUrl("brand/update", ["id" => $data->id]), ['class' => 'update']) . "&nbsp;";
        echo CHtml::link('删除', 'javascript:void(0);', ['class' => 'delete','onclick'=>'goods_delete(this);','url'=>Yii::app()->createUrl("brand/delete", ["id" => $data->id])]) . "&nbsp;";
        ?>
    </td>
</tr>
