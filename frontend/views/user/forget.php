<div class="mains" style="clear:both">
    <div class="white_top">
        <div class="white_top_left"></div>
        <div class="white_top_middle"></div>
        <div class="white_top_right"></div>
    </div>
    <div class="white_bg wrap user_login">
        <div class="wrap_left w_reg zc_x" style="border:none ;border-right: 0px solid #DDDDDD;float: left;overflow: hidden;padding-left: 40px;width: 640px;height:auto">
            <h1>请输入注册时邮箱,找回密码</h1>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id' => 'forget-form',
                'enableClientValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit'=>true,
                )
            )); ?>
            <div>
            </div>
 <?php echo $form->errorSummary($model, '');?>
            <div class="fill">
                <ul>
                    <li>
                        <div class="input_left">
                            <label for="email">邮箱：</label>
                            <?php echo $form->textField($model, 'email', array('class'=>'input_off', 'onblur' => 'this.className="input_off";', 'onfocus' => 'this.className="input_on";this.onmouseout=""')); ?>
                        </div>
                    </li>
					   <li>
                        <div class="ipt_check">
                            <label for="captcha">验证码：</label>
                            <?php echo $form->textField($model, 'verifyCode', array('class'=>'check input_text bg text code ', 'onblur' => 'this.className="input_off_c";this.onmouseout=function () {this.className="input_out_c"};', 'onfocus' => 'this.className="input_on_c";this.onmouseout=""', 'maxlength' => 4)); ?>
                            <?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer', 'onclick' => 'captch(this)', 'style' => 'display:inline'))); ?>
                        </div>
                    </li>
                    <li class="ipt_smt">
                        <input type="submit" name="submits" class="smt" id="submits" value="发送到邮箱" tabindex="5">
                        <input type="hidden" name="action" id="reg" value="reg"></li>
				   <li>
				</ul>
            </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="wrap_right">
           
        </div>
    </div>

    <div class="white_bottom">
        <div class="white_bottom_left"></div>
        <div class="white_bottom_middle"></div>
        <div class="white_bottom_right"></div>
    </div>
</div>
