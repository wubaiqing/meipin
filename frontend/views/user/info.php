<div class="box admin hei">
    <h3>
        <span>用户信息</span>
    </h3>
    <span class="t_l"></span>
    <span class="t_r"></span>
    <div class="info">
        <h6>
            <?php echo $this->renderPartial('info_nav', ['current' => 'info']);?>
        </h6>
        <table cellspacing="1" cellpadding="0" border="0" bgcolor="#DFE2E7" class="table_user">
            <tbody>
                <tr align="center">
                    <td bgcolor="#F9FAFC" align="right" width="90">
                        用户名：
                    </td>
                    <td height="32" align="left">
                        <?php echo $model->username;?>
                    </td>
                </tr>
                <tr align="center">
                    <td bgcolor="#F9FAFC" align="right">
                        电子邮箱：
                    </td>
                    <td height="32" align="left">
                      <?php echo $model->is_valid?$model->email:"<a onclick='bd()' id='bde'>您还没有绑定邮箱,点击开始绑定</a>"; ?>
                      <form style="display:none" id='bdemail' action='<?php echo Yii::app()->createUrl("user/aemail") ?>' method='post'>
                         <input type='text' name='email' class="input_off" />
                         <input type='submit' value='确定'>
                      </form>

                    </td>
                </tr>
            </tbody>
        </table>
        <p class="b_tit"></p>
    </div>
</div>
<script type="text/javascript">
    function bd()
    {
        $("#bde").hide();
        $("#bdemail").show();
    }

</script>
