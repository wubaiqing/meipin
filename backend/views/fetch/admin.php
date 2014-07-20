<!--
	淘宝U站抓取商品管理页

	1. 根据当前选择的分类管理淘宝U站数据
	2. 编辑可回车保存
	3. 编辑可离开鼠标后保存

	创建日期：2014-7-19
	@author wubaiqing <wubaiqing@vip.qq.com>
-->
<table class="table table-striped table-bordered">
	<div class="box">
		<h3 class="box-header">抓取管理</h3>
		<?php
		echo CHtml::dropDownList('cate_id', $catId, [
			'0' => '未分类',
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
			<td width="50">分类</td>
			<td width="">URL</td>
			<td>现价</td>
			<td width="120">图片</td>
			<td width="50">排序</td>
			<td width="60">操作</td>
		</tr>

		<?php
		foreach ($model as $key => $val) {
			?>

			<tr>
				<td><span class="modify"><?php echo $val->title;?></span> <a href="<?php echo $val->url;?>" target="_blank">查看</a></td>
				<td>
					<?php
					echo CHtml::dropDownList('cate_id', $val->cat_id, [
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
					], ['empty' => '请选择']);
					?>
				</td>
				<td><span class="modify"><?php echo $val->url?></span></td>
				<td><span class="modify"><?php echo $val->price;?></span></td>
				<td>
					<a href="<?php echo $val->picture;?>" target="_blank"><img src="<?php echo $val->picture;?>" style="display: none;" width="120" height="120"/></a>
                <span class="btn fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>上传</span>
                    <input class="upload-placeholder" type="file" name="file" />
                </span>
					</span>
				</td>
				<td><span class="modify">0</span></td>
				<td>
					<a href="javascript:void(0);" class="push" data-cat="<?php echo $val->cat_id;?>" data-origin_price="<?php echo $val->origin_price;?>" data-goods_id="<?php echo $val->id;?>" data-tb_id="<?php echo $val->tb_id;?>" data-url="<?php echo $val->url;?>">保存</a>
				</td>
			</tr>

		<?php } ?>
	</div>
</table>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/css/jquery.fileupload-ui.css" media="all" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/jQuery-File-Upload/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/goods/fetch.js?v=1.0"></script>
<script type="text/javascript">
	fetch.event.modify();
	fetch.event.goodsPush();
	fetch.event.uploadImage();
	fetch.event.getZhe800Link();
</script>
