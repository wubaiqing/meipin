<table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user" style="width:100%">
    <tbody>
        <tr align="center">
            <th>用户名</th>
            <th>属性</th>
            <th><?php echo ($goodsType ==0)?"兑换":"抽奖"?>时间</th>
        </tr>
        <?php foreach ($logList['data'] as $log): ?>
            <tr align="center">
                <td><?php echo CommonHelper::filterUsername($log->username); ?></td>
                <td><?php echo $log->gdscolor?$log->gdscolor:'无'; ?></td>
                <td><?php echo date("Y-m-d H:i:s",$log->created_at) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
 <?php $this->renderPartial('//site/page', array('pager' => $logList['pager'])); ?>
