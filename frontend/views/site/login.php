<div class="topnav">
	<div class="wp">
		<ul class="logininfo r" id="sign">
			<li>
                您好，欢迎来到美品网！请
			<a href="javascript:commonopen();" target="_self">[登录]</a>或<a href="/user/register.html">[免费注册]</a>
			<div id="showjs">
				<div class="neir">
					<h3><a href="javascript:;" onclick="TINY.box.hide();" target="_self"></a>用户登录</h3>
					<!--form method="post" action="/user/login.html" onsubmit="javascript:return F_dlogin_form();"-->
					<form method="post" action="/user/login.html">
						<p>
							<em>用户名：</em><input type="text" class="text" name="username" id="J_username">
						</p>
						<p>
							<em>密   码：</em><input type="password" class="text" name="password" id="J_password">
						</p>
						<p id="pvaliCode">
							<em>验证码：</em><input type="text" class="text code" name="captcha" id="J_captcha"><img src="" id="valiCode" style="cursor:pointer;" border="0">
						</p>
						<p>
							<em>&nbsp;</em><input type="submit" value="登 录" class="submit"><label for="cookietime"><input type="checkbox" name="remember" value="ok" checked="checked" id="J_remember">记住我</label>
						</p>
					</form>
					<div class="reg">
                            没有账号？
						<a href="/user/register.html">成为会员</a><br>
						<a href="/forget/index.html" target="_blank">找回密码</a>
						<a href="/oauth/taobao.html" class="tao_login">淘宝登录</a>
						<a href="/oauth/qq.html" class="Q_login">QQ登录</a>
						<a href="/oauth/sina.html" class="sina_login">新浪微博登录</a>
					</div>
				</div>
			</div>
			</li>
			<li class="qd">
			<a href="javascript:commonopen();" target="_self"><span>签到</span></a>
			</li>
		</ul>
		<ul>
			<li class="a"><a href="javascript:void(0)" onclick="javascript:addToFavorite();">收藏金折</a></li>
		</ul>
	</div>
</div>
