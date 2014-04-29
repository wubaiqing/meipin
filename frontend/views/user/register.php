<div class="mains" style="clear:both">
    <div class="white_top">
        <div class="white_top_left"></div>
        <div class="white_top_middle"></div>
        <div class="white_top_right"></div>
    </div>
    <div class="white_bg wrap user_login">
        <div class="wrap_left w_reg zc_x" style="border:none ;border-right: 1px solid #DDDDDD;float: left;overflow: hidden;padding-left: 40px;width: 640px;height:auto">
            <h1>新用户注册</h1>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit'=>true,
                )
            )); ?>
            <div>
                <?php echo $form->errorSummary($model, '');?>
            </div>

            <div class="fill">
                <ul>
                    <li>
                        <div class="input_left">
                            <label for="username">用户名：</label>
                            <?php echo $form->textField($model, 'username', array('class'=>'input_off', 'onblur' => 'this.className="input_off";', 'onfocus' => 'this.className="input_on";this.onmouseout=""')); ?>
                        </div>
                    </li>
                    <li>
                        <div class="input_left">
                            <label for="password">密码：</label>
                            <?php echo $form->passwordField($model, 'password', array('class'=>'input_off', 'onblur' => 'this.className="input_off";', 'onfocus' => 'this.className="input_on";this.onmouseout=""')); ?>
                        </div>
                    </li>
                    <li>
                        <div class="input_left">
                            <label for="repassword">确认密码：</label>
                            <?php echo $form->passwordField($model, 'confirmPassword', array('class'=>'input_off', 'onblur' => 'this.className="input_off";', 'onfocus' => 'this.className="input_on";this.onmouseout=""')); ?>
                        </div>
                    </li>
                    <li>
                        <div class="ipt_check">
                            <label for="captcha">验证码：</label>
                            <?php echo $form->textField($model, 'verifyCode', array('class'=>'check input_text bg text code ', 'onblur' => 'this.className="input_off_c";this.onmouseout=function () {this.className="input_out_c"};', 'onfocus' => 'this.className="input_on_c";this.onmouseout=""', 'maxlength' => 4)); ?>
                            <?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer', 'onclick' => 'captch(this)'))); ?>
                        </div>
                    </li>
                    <li class="ipt_smt">
                        <input type="submit" name="submits" class="smt" id="submits" value="立即注册" tabindex="5">
                        <input type="hidden" name="action" id="reg" value="reg"></li>
                </ul>
            </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="wrap_right">
            <p>
                已经有帐号？请直接登录</p>
            <p>
                <a href="<?php echo $this->createUrl('user/login');?>">登录</a>
            </p>
        </div>
    </div>

    <div class="white_bottom">
        <div class="white_bottom_left"></div>
        <div class="white_bottom_middle"></div>
        <div class="white_bottom_right"></div>
    </div>
</div>
