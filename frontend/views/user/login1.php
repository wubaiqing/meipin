<div id="content" class="wp">
    <div class="user_login">
        <div class="pic_l l">
            <img src="/static/images/user_login.jpg">
        </div>
        <div class="zc_x fr" id="logincontent">
            <h3></h3>
            <?php
            $form = $this->beginWidget('CActiveForm', [
                'id' => 'login-form',
                'enableClientValidation' => false,
                'clientOptions' => [
                    'validateOnSubmit' => true,
                ]
            ]);
            ?>
            <?php echo $form->errorSummary($model,'','',$htmlOptions=array ('style'=>'color:red;text-align:center;font-size:14px;')); ?>
            <p>
                <em>用户名：</em>
                <?php echo $form->textField($model, 'username', array('class' => 'input_off', 'onblur' => 'this.className="input_off";', 'onfocus' => 'this.className="input_on";this.onmouseout=""')); ?>
            <p>
                <em>密   码：</em>
                <?php echo $form->passwordField($model, 'password', array('class' => 'input_off', 'onblur' => 'this.className="input_off";', 'onfocus' => 'this.className="input_on";this.onmouseout=""')); ?>
            <p id="pvaliCode">
                <em>验证码：</em>
                <?php echo $form->textField($model, 'verifyCode', array('class' => 'check input_text bg text code ', 'onblur' => 'this.className="input_off_c";this.onmouseout=function () {this.className="input_out_c"};', 'onfocus' => 'this.className="input_on_c";this.onmouseout=""', 'maxlength' => 4)); ?>
                <?php $this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer'))); ?>
            </p>
            <p>
                <em>&nbsp;</em>
                <input type="submit" value="登 录" class="submit">
            </p>
            <p class="reg">
                还没有美品网账号？
                <a href="<?php echo $this->createUrl('user/register'); ?>" class="zhuce">立即注册&gt;&gt;</a>
            </p>
            <?php $this->endWidget(); ?>
        </div>
        <span class="clr"></span>
    </div>
</div>
