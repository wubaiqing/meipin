<tr>
    <td class="center"><?php echo $data->order_id ?></td>
    <td class="center"><?php //echo Order::$pay_status[$data->pay_status];?>
    <?php echo CHtml::link(Order::$pay_status[$data->pay_status], "javascript:void(0);", array("paystatus-id" => $data->order_id, "class" => "pay_status")) ?>
    </td>
    <td class="left"><?php echo date("Y-m-d H:i", $data->pay_time) ?></td>
    <td class="left"><?php echo $data->buy_count; ?></td>
    <td class="left"><?php echo $data->pay_price; ?></td>
    <td class="left"><?php echo $data->integral; ?></td>
    <td class="left"><?php echo $data->user_id; ?></td>
    <td class="left"><?php echo $data->goods_id; ?></td>
    
</tr>
