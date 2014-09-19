<tr>
    <td class="center"><?php echo $data->id ?></td>
    <td><?php //echo $data->goods_id;
      $goodsUrl =  Des::encrypt($data->goods_id);?>
      <a href="http://www.meipin.com/out/<?php echo $goodsUrl;?>.html" target="_blank">链接</a></td>
    <td><?php 
    	$img = $data->img;
    	$imgarr = explode(';', $img);
    	//echo $imgarr[0];
    ?>
    <img src="<?php echo $imgarr[0];?>" /></td>
    <td><?php echo $data->ptime; ?></td>


    <td class="button-column">
        <?php
        echo CHtml::link('修改', Yii::app()->createUrl("shai/update", ["id" => $data->id]), ['class' => 'update']) . "&nbsp;";
        echo CHtml::link('删除', 'javascript:void(0);', ['class' => 'delete','onclick'=>'goods_delete(this);','url'=>Yii::app()->createUrl("shai/delete", ["id" => $data->id])]) . "&nbsp;";
        ?>
    </td>
</tr>
