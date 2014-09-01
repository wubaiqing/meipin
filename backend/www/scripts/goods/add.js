
$('#getTaobaoData').click(function() {
	var taobaoId = $.trim($('#Goods_tb_id').val());
	var nickName = '';


	$('.text-error').html(null);
	$.get('index.php?r=goods/checkTbId', {tbId : taobaoId}, function (data) {
		if (data == 1) {
			$('.text-error').html('淘宝ID已存在');
		}
	});

	$.getJSON('index.php?r=goods/getgoods', {taobaoId:taobaoId}, function (json) {
		$('#Goods_url').val(json.item_url);
		//$('#Goods_picture').val(json.pic_url);
		$('#Goods_origin_price').val(json.price);
		$('#Goods_url').val(json.item_url);
		$('#Goods_title').val(json.title);
	})

});

$('#Goods_picture').hover(function(){
	var src = $(this).val();
	if (src != '') {
		$('#picture-preview').position($(this).position());
		$('#picture-preview').attr('src', src).removeClass('hide');
	}
}, function(){
	$('#picture-preview').addClass('hide');
});

$('.upload-placeholder').fileupload({
	url: 'index.php?r=site/upload',
	dataType: 'json',
	done: function(e, data) {
		if(data.result.success) {
			$('#Goods_picture').val(data.result.path);
		} else {
			alert(data.result.message);
		}
	}
});


$('#getYQF').click(function () {
	var url = $('#Goods_url').val();
	$.getJSON('index.php?r=goods/getYiqifa', {url:url}, function (data) {
		if (data.response) {
			var goods = data.response.pdt_o_url;
			$('#Goods_url').val(goods.pdt_o_url);
		} else {
			alert('商品获取失败');
			return false;
		}
	});
});

$('.save').click(function () {
	$('form').submit();
	$(this).attr('disabled', 'disabled');
});

//onchange
function zhe800(obj)
{
  zhe = obj.value;
  if(zhe ==3)
  {
  	$("#Goods_end_time").val("2024-10-10 00:00:00");
  }else
  {
  	$("#Goods_end_time").val("");
  }
}