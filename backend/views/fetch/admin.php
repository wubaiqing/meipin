<table class="table table-striped table-bordered">
	<div class="box">
		<h3 class="box-header">抓取管理</h3>
		<?php
			echo CHtml::dropDownList('cate_id', $catId, [
				'1' => '女装',
				'4' => '男装',
				'5' => '居家',
				'6' => '母婴',
				'7' => '鞋包',
				'8' => '配饰',
				'9' => '美食',
				'10' => '数码家电',
				'11' => '化妆品',
				'12' => '文体'
			], [
				'class' => 'span2'
			]);
		?> 

		<?php echo CHtml::link('查看', 'javascript:void(0);', ['id' => 'getLink']); ?>
		<span id="loadingInfo" style="color:green;"></span>
	

		<tr>
			<td width="">标题</td>
			<td>现价</td>
			<td>图片</td>
			<td width="50">排序</td>
			<td width="150">开始时间</td>
			<td width="150">结束时间</td>
			<td width="60">操作</td>
		</tr>

		<?php 
			foreach ($model as $key => $val) { 
		?>

		<tr>
			<td><span class="modify"><?php echo $val->title;?></span> <a href="<?php echo $val->url;?>" target="_blank">查看</a></td>
			<td><span class="modify"><?php echo $val->price;?></span></td>
			<td>
				<a href="<?php echo $val->picture;?>" target="_blank"><img src="<?php echo $val->picture;?>" width="120" height="120"/></a>
                <span class="btn fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>上传</span>
                    <input class="upload-placeholder" type="file" name="file" />
                </span>
            </span>
			</td>
			<td><span class="modify">0</span></td>
			<td><span class="modify"><?php echo date('Y-m-d H:i:s', $val->start_time);?></span></td>
			<td><span class="modify"><?php echo date('Y-m-d H:i:s', $val->end_time);?></span></td>
			<td>
				<a href="javascript:void(0);" class="push" data-cat="<?php echo $val->cat_id;?>" data-origin_price="<?php echo $val->origin_price;?>" data-goods_id="<?php echo $val->id;?>" data-tb_id="<?php echo $val->tb_id;?>" data-url="<?php echo $val->url;?>">保存</a>
			</td>
		</tr>

		<?php } ?>
	</table>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/css/jquery.fileupload-ui.css" media="all" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/js/jquery.fileupload.js"></script>

<script type="text/javascript">
/**
 * 抓取管理界面
 * @author wubaiqing <wubaiqing@vip.qq.com>
 */
var fetch = {};

/**
* 配置文件
*/
fetch.config = {
	modifyFlag : true
};

/**
* 折800处理事件
*/
fetch.event = (function () {
	return {
		/**
		 * Ajax上传图片
		 */
		uploadImage : function ()
		{
			$('.upload-placeholder').fileupload({
				url: 'index.php?r=site/upload',
				dataType: 'json',
				done: function(e, data) {
					if(data.result.success) {
						$($(this).parent().prev().children(0)).attr('src', data.result.path);
						$($(this).parent().prev()).attr('href', data.result.path);
					} else {
						alert(data.result.message);
					}
				}
			});
		},

		/**
		* 点击文字显示表单
		*/
		modify : function ()
		{
			var input = this;
			// 可修改class
			$('span.modify').click( function () {
				var html = $.trim($(this).html());
				if (fetch.config.modifyFlag == true) {
					$(this).html('<input class="span11 custom" onBlur="fetch.event.inputEnter(this,event)" type="text" value="'+html+'"/>');
					fetch.config.modifyFlag = false;
					$('.span11').focus();
				}
			});
		},

		/**
		* input回车事件
		*/
		inputEnter : function (input, event)
		{
			var val = $(input).val();
			if (val == '') {
				val = 0;
			}
			$(input).parent().html($.trim(val));
			fetch.config.modifyFlag = true;
		},

		/**
		* 上传图片输入回城事件
		*/
		uploadImageInputEnter : function (input, event)
		{

			// 回车事件
			var url = $(input).val();
			$(input).prev().children().attr('src', $.trim(url));
			$(input).next().show();
			$(input).remove();
			fetch.config.modifyFlag = true;
		},

		/**
		* 商品推送
		*/
		goodsPush : function ()
		{
			// 商品推送点击事件
			$('.push').click(function () {
				var input = $(this);

				$('#loadingInfo').html(null);
				var goodsId = $(this).attr('data-goods_id');
				var endTime = $(this).parent().prev().text();
				var startTime = $(this).parent().prev().prev().text();
				var listOrder = $(this).parent().prev().prev().prev().text();
				var image = $($(this).parent().prev().prev().prev().prev().children().get(0)).children().attr('src');
				var price = $(this).parent().prev().prev().prev().prev().prev().text();
				var title = $(this).parent().prev().prev().prev().prev().prev().prev().text().replace('查看', '');
				var origin_price = $(this).attr('data-origin_price');
				$('#loadingInfo').html('正在处理数据.....');

				$.post('index.php?r=fetch/update', {
					goodsId : goodsId,
					title : title,
					price : price,
					origin_price : origin_price,
					picture : image,
					list_order : listOrder,
					start_time : startTime,
					end_time : endTime,
					dataType : 'json'
				}, function (data){
					if (data.status != 1) {
						$('#loadingInfo').html(data.code);
					} else {
						$('#loadingInfo').html('保存成功');
						input.parent().parent().remove();
					}
				});
			});
		},


		/**
		 * 抓取链接
		 */
		getZhe800Link : function ()
		{
			$('#getLink').click(function (){
				var catId = $('#cate_id').val();
				window.location.href= 'index.php?r=fetch/admin&cat_id=' + catId;
			});
		}
	}
})();

fetch.event.modify();
fetch.event.goodsPush();
fetch.event.uploadImage();
fetch.event.getZhe800Link();

</script>

