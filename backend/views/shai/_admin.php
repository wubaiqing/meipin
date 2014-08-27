<tr>
    <td class="center"><?php echo $data->id ?></td>
    <td><?php echo $data->goods_id ?></td>
    <td><?php echo $data->ptime; ?></td>


    <td class="button-column">
        <?php
        echo CHtml::link('修改', Yii::app()->createUrl("shai/update", ["id" => $data->id]), ['class' => 'update']) . "&nbsp;";
        echo CHtml::link('删除', 'javascript:void(0);', ['class' => 'delete','onclick'=>'goods_delete(this);','url'=>Yii::app()->createUrl("shai/delete", ["id" => $data->id])]) . "&nbsp;";
        ?>
    </td>
</tr>
