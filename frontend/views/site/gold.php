<?php $this->renderPartial('afp'); ?>
<div id="wrapper">
	<?php $this->renderPartial('head'); ?>
	<style type="text/css">
		#gold{background:white;height:420px;clear:both;margin:15px auto;min-width:980px;position:relative;width:980px;z-index:1;padding-top:15px;}p{font-size:14px;}.s-inpt{width:300px;width:300px\9;overflow:hidden;font:17px arial;padding:0px 0 0 1px;padding:0px 0 0 4px\9;height:29px;height:27px\9;_margin-right:0;vertical-align:top;outline:0;float:left;}#gold lable{width:140px; text-align:right;height:32px;line-height:32px;font-size:18px;float:left;}.prompt{width:540px; text-align:center;} #state{width:540px;margin:0 auto;margin-bottom:15px;}.alipayBlock{width:540px;margin:0 auto;clear:both;}#alipaySubmit{width:70px; background-color:#333;height:29px;display:block;color:white;float:right; margin-right:244px;}#state{clear:both;}#state a{text-decoration:underline;}.clear{clear:both;}font{text-align:center; font-size:14px; height:40px; line-height:40px; }.row{clear:both; height:40px;}.red{color:red; font-weight:bold;}.pd{padding-left:140px; font-size:14px;}
	</style>
	<div id="gold">
		<div id="state">
			<p>领取说明：</p>
			<p><span class="red">1、必须加客服QQ号800065355为好友，QQ号码需3个月亮以上，小号勿扰。</span></p>
			<p>2、本次活动每个支付宝账号可以领取一次，一个QQ号码只能对应一个支付宝。</p>
			<p>3、提交支付宝后第2天我们将30个集分宝转到您的支付宝账号中，次日访问</p>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="https://jf.alipay.com/prod/pintegral.htm">https://jf.alipay.com/prod/pintegral.htm</a>&nbsp;&nbsp;查看是否收到。</p>
			<p>4、恶意领取者将不予发放。</p>
			<p>5、用QQ小号申请的一律不予发放。</p>
			<p>&nbsp;</p>
			<p>即将推出签到送集分宝，请亲们多多关注，先收藏我们的网址：<a class="header-module-favorite" href="javascript:;" onclick="goods.utils.addFavorite('http://www.51cuxiao.com','收藏我要促销，随时发现精彩分享');">加入收藏</a></p>
			<p>牢记领取集分宝的网址 <a href="http://www.51cuxiao.com/">http://www.51cuxiao.com/</a></p>
		</div>

		<div class="alipayBlock">
			<form action="<?php echo $this->createUrl('site/getgold');?>" method="post">
				<div class="row">
					<lable>支付宝账号：</lable>
					<input type="text" class="s-inpt" name="alipayId" value="<?php echo $alipayId;?>"/>
					<div class="clear"></div>
				</div>
				<div class="row">
					<lable>QQ号：</lable>
					<input type="text" class="s-inpt" name="qq" value="<?php echo $alipayId;?>"/>
					<div class="clear"></div>
				</div>
				<div class="row pd">
					<input type="checkbox" id="affirm" value="确认已经添加客服QQ号800065355为好友"/>
					<label for="affirm">确认已经添加客服QQ号800065355为好友</label>
				</div>
				<div class="row">
					<input type="button" name="" value="提交" id="alipaySubmit"/>
				</div>
			</form>
			<div class="clear"></div>
			<div class="prompt">
				<font color="green" id="success"></font>
				<font color="red" id="error"></font>
			</div>
		</div>
	</div>
	<script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzgwMDA2NTM1NV8xMDIxMDJfODAwMDY1MzU1Xw"></script>
	<div id="footer">
		<?php $this->renderPartial('footer'); ?>
		<?php $this->renderPartial('fix'); ?>
	</div>
	<script type="text/javascript">
		$('input[name="alipayId"]').focus();
		$('input[type="button"]').click(function (){

			if ($('#affirm').is(":checked") == false) {
				$('#error').show().html('请勾选确认已经添加客服QQ号800065355为好友');
				return false;
			}

			var id = $('input[name="alipayId"]').val();
			var qq = $('input[name="qq"]').val();

			$.getJSON('postdata.html', {alipayId : id, qq : qq}, function (json) {
				if (json.status == 1) {
					$('#error').hide();
					$('#success').show().html(json.data);
				} else {
					$('#success').hide();
					$('#error').show().html(json.data);
				}
			});

		});
	</script>
</div>
