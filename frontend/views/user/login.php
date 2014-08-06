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
            <style type="text/css">
          
            </style>
            <p>
                <em>用户名：</em>
                <?php if($model->username):?>
                <?php echo $form->textField($model, 'username', array('class' => 'input_off', 'onblur' => "this.className='input_off';",'style'=>'font-size:12px;')); ?>
            <?php else:?>
            <?php echo $form->textField($model, 'username', array('class' => 'input_off', 'onblur' => "this.className='input_off';if(!value){value=defaultValue;}", 'onfocus' => 'this.className="input_on";this.onmouseout=""','value'=>'邮箱/手机号/用户名','onclick'=>"if(value==defaultValue){value='';}",'style'=>'font-size:12px;')); ?>       
            <?php endif;?>
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
				<span><a href="<?php echo $this->createUrl('user/forget'); ?>" class="zhuce">忘记密码!</a></span>
            </p>
            <p class="reg">
                <a href="<?php echo $this->createUrl('user/qlogin'); ?>"><img src="/static/images/qq/Connect_logo_3.png"></a><br>
          <!--       <a href="<?php //echo $this->createUrl('user/tblogin'); ?>"><img src="/static/images/qq/Connect_logo_3.png"></a><br> -->
                还没有美品网账号？
                <a href="<?php echo $this->createUrl('user/register'); ?>" class="zhuce">立即注册&gt;&gt;</a>
            </p>
            <?php $this->endWidget(); ?>
        </div>
        <span class="clr"></span>
    </div>
</div>
        <script type="text/javascript">
/*            var childWindow;
            function toQzoneLogin()
            {
                childWindow = window.open("/user/Qlogin","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
            } 
            
            function closeChildWindow()
            {
                childWindow.close();
            }*/
        </script>
