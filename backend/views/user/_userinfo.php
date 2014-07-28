<tr>
    <td class="center"><?php echo $data->created_at; ?></td>
    <td class="center"><?php echo $data->id; ?></td>
    <?php 
     $score =Users::model()->getscore($data->created_at);?>
    <td><?php echo $score['zjscore'];?></td>
    <td><?php echo $score['xhscore'];?></td>
</tr>
