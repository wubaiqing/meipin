<tr>
    <td class="center"><?php echo $data->id ?></td>
    <?php 
      if($data->goods_type==1)
      {
        $url = "http://www.meipin.com/exchange/raffle_".Des::encrypt($data->id).".html";
    }else
    {
        $url = "http://www.meipin.com/exchange/detail_".Des::encrypt($data->id).".html";
    }
       
     ?>
    <td><a href='<?php echo $url;?>' target='_blank'><?php echo $data->name ?></a></td>
    <td><?php echo $data->goodscolor2 ?></td>
    <td><?php echo date("Y-m-d H:i", $data->start_time) ?></td>
    <td><?php echo date("Y-m-d H:i", $data->end_time) ?></td>
    <td><?php echo $data->user_count ?></td>
    <td><?php echo CHtml::link(Exchange::$is_firstLabels[$data->is_first], "javascript:void(0);", array("first-id" => $data->id, "class" => "is_first")) ?></td>
    <td><?php echo CHtml::link($data->list_order, "javascript:void(0);", array("order-id" => $data->id, "class" => "settingOrder")); ?></td>

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