<tr>
    <td class="center"><?php echo $data->id ?></td>
    <td><?php echo $data->name ?></td>
    <td><?php echo Exchange::$goodsType[$data->goods_type] ?></td>
    <td><?php echo $data->goodscolor ?></td>
    <td><?php echo date("Y-m-d H:i", $data->start_time) ?></td>
    <td><?php echo date("Y-m-d H:i", $data->end_time) ?></td>
    <td><?php echo $data->user_count ?></td>
    <td class="button-column">
        <?php
        echo CHtml::link('修改', Yii::app()->createUrl("exchange/update", ["id" => $data->id]), ['class' => 'update']) . "&nbsp;";
        echo CHtml::link('删除', 'javascript:void(0);', ['class' => 'delete','onclick'=>'goods_delete(this);','url'=>Yii::app()->createUrl("exchange/delete", ["id" => $data->id])]) . "&nbsp;";
        if ($data->goods_type == 1) {
            echo CHtml::link('注水', Yii::app()->createUrl("exchange/water", ["id" => $data->id]), ['class' => 'water']) . "&nbsp;";
        }
        ?>
    </td>
</tr>