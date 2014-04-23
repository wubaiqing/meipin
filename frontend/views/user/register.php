<div class="mains" style="clear:both">
    <div class="white_top">
        <div class="white_top_left"></div>
        <div class="white_top_middle"></div>
        <div class="white_top_right"></div>
    </div>
    <div class="white_bg wrap user_login">
        <div class="wrap_left w_reg zc_x" style="border:none ;border-right: 1px solid #DDDDDD;float: left;overflow: hidden;padding-left: 40px;width: 640px;height:auto">
            <h1>新用户注册</h1>
            <form id="J_register_form" action="/user/register.html" method="post" class="regbox">
                <div class="fill">
                    <ul>

                        <li><div class="input_left">
                                <label for="username">用户名：</label>
                                <input onblur="this.className='input_off';" onfocus="this.className='input_on';this.onmouseout=''" type="text" name="username" class="bg" id="J_username" tabindex="2">
                            </div>
                        </li>
                        <li><div class="input_left">
                                <label for="password">密码：</label>
                                <input onblur="this.className='input_off';" onfocus="this.className='input_on';this.onmouseout=''" type="password" name="password" class="bg" id="J_password" maxlength="36" tabindex="3">
                            </div>
                        </li>
                        <li><div class="input_left">
                                <label for="repassword">确认密码：</label>
                                <input onblur="this.className='input_off';" onfocus="this.className='input_on';this.onmouseout=''" type="password" name="repassword" class="bg" id="J_repassword" maxlength="36" tabindex="4">
                            </div>
                        </li>
                        <li><div class="input_left">
                                <label for="email">电子邮箱：</label>
                                <input onblur="this.className='input_off';" onfocus="this.className='input_on';this.onmouseout=''" type="text" name="email" class="bg" id="J_email" tabindex="5">
                            </div>
                        </li>
                        <li><div class="ipt_check">
                                <label for="captcha">验证码：</label>
                                <input onblur="this.className='input_off_c';this.onmouseout=function(){this.className='input_out_c'};" onfocus="this.className='input_on_c';this.onmouseout=''" type="text" name="captcha" id="J_captcha" maxlength="10" class="check input_text bg text code ">
                                <img src="/captcha/1398264949.html" id="J_captcha_img_reg" class="captcha_img" alt="验证码" onclick="this.src='/captcha/index.html?'+Math.random();" style="cursor:pointer;">
                                <a href="javascript:;" onclick="javascript:document.getElementById('J_captcha_img_reg').src='/captcha/index.html?'+Math.random();">看不清？换张图</a>
                            </div>
                        </li>
                        <li class="ipt_smt">
                            <input type="submit" name="submits" class="smt" id="submits" value="立即注册" tabindex="5">
                            <input type="hidden" name="action" id="reg" value="reg"></li>
                    </ul>
                </div>
            </form>
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
