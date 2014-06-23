<tr>
    <td><?php echo $data->username; ?></td>
    <td><?php echo date("Y-m-d H:i:s", $data->created_at); ?></td>
    <td><?php echo ($data->winner == 1 ? "中奖" : "未中奖"); ?></td>
    <td><?php echo ($data->user_add == 1 ? "后台注水" : "用户参与"); ?></td>
    <td>
        <?php
        if ($data->user_add == 1) {
            echo CHtml::link("删除", 'javascript:', ['url' => Yii::app()->createUrl("exchange/waterUpdate", ['id' => $data->id,'type'=>'delete']), 'onclick' => 'water_delete(this)'])."&nbsp;";
        }
        if ($data->winner == 1) {
            echo CHtml::link("取消中奖", 'javascript:', ['url' => Yii::app()->createUrl("exchange/waterUpdate", ['id' => $data->id,'type'=>'winner','status'=>0]), 'onclick' => 'water_delete(this)'])."&nbsp;";
        }
        if ($data->winner == 0) {
            echo CHtml::link("设为中奖", 'javascript:', ['url' => Yii::app()->createUrl("exchange/waterUpdate", ['id' => $data->id,'type'=>'winner','status'=>1]), 'onclick' => 'water_delete(this)'])."&nbsp;";
        }
        ?>
    </td>
</tr>
