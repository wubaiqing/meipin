<div class="mains" style="clear:both">
    <div class="white_top">
        <div class="white_top_left"></div>
        <div class="white_top_middle"></div>
        <div class="white_top_right"></div>
    </div>
    <div class="white_bg wrap user_login">
        <div class="wrap_left w_reg zc_x" style="border:none ;border-right: 1px solid #DDDDDD;float: left;overflow: hidden;padding-left: 40px;width: 640px;height:auto">
            <h1>修改密码</h1>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit'=>true,
                )
            )); ?>
            <div>
            </div>
            <div class="fill">
                <ul>
                    <li>
                        <div class="input_left">
                            <label for="username">用户名：</label>
                              <h1><?php echo $username;?></h1>
                        </div>
                    </li>
                    <li>
                        <div class="input_left">
                            <label for="password">新密码：</label>
                             <?php echo $form->passwordField($model, 'password', array('class' => 'text','id' => 'password1')); ?>
                        </div>
                    </li>
                    <li>
                        <div class="input_left">
                            <label for="repassword">确认密码：</label>
                             <?php echo $form->passwordField($model, 'confirmPassword', array('class' => 'text','id'=>'confirmPassword1')); ?>
                        </div>
                    </li>
                    <li class="ipt_smt">
                        <input type="submit" name="submits" class="smt" id="submits" value="提交"  onclick='check()'tabindex="5">
                        <input type="hidden" name="action" id="reg" value="reg"></li>
                </ul>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>

    <div class="white_bottom">
        <div class="white_bottom_left"></div>
        <div class="white_bottom_middle"></div>
        <div class="white_bottom_right"></div>
    </div>
</div>
<script>
function check (){
	var password=$("#password1") .val();
	var confirmPassword=$("#confirmPassword1") .val();
	if ((password !='') && (confirmPassword != '')) {
		if ( password != confirmPassword){
		alert ('两次输入的密码不一样！');
		 return false;
		} else {
		return true;
		}
	}else {
		alert('新密码与确认密码不能为空');
		return false;
	}
}
</script>

