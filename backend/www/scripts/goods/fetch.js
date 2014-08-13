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
        uploadImage : function () {
            $('.upload-placeholder').fileupload({
                url: 'index.php?r=site/upload',
                dataType: 'json',
                done: function (e, data) {
                    if (data.result.success) {
                        $($(this).parent().prev().children(0)).attr('src', data.result.path).show();
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
        modify : function () {
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


        modifychange : function () 
        {
          $('.changePrice').click(function () {
           $.get('index.php?r=goods/changePrice', {id : $(this).attr('data-id')}, function (json) {
                 location.reload();
               });
          });
        },

        /**
         * input回车事件
         */
        inputEnter : function (input, event) {
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
        uploadImageInputEnter : function (input, event) {
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
        goodsPush : function () {
            // 商品推送点击事件
            $('.push').click(function () {
                var input = $(this);

                $('#loadingInfo').html(null);
                var goodsId = $(this).attr('data-goods_id');
                var listOrder = $(this).parent().prev().text();
                var image = $($(this).parent().prev().prev().children().get(0)).children().attr('src');
                var price = $(this).parent().prev().prev().prev().text();
                var url = $(this).parent().prev().prev().prev().prev().text();
                var oldUrl = $(this).parent().prev().prev().prev().prev().attr('data-oldurl');
                var isSkip = (url == oldUrl) ? 0 : 1;
                var catId = $($(this).parent().prev().prev().prev().prev().prev().children().get(0)).val();
                var title = $(this).parent().prev().prev().prev().prev().prev().prev().text().replace('查看', '');
                var origin_price = $(this).attr('data-origin_price');
                $('#loadingInfo').html('正在处理数据.....');

                if (image == 'null') {
                    $('#loadingInfo').html('请上传图片!');
                    return false;
                }


                $.post('index.php?r=fetch/update', {
                    url : url,
                    cat_id : catId,
                    goodsId : goodsId,
                    title : title,
                    price : price,
                    origin_price : origin_price,
                    picture : image,
                    list_order : listOrder,
                    is_skip : isSkip,
                    dataType : 'json'
                }, function (data) {
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
        getZhe800Link : function () {
            $('#getLink').click(function () {
                var catId = $('#cate_id').val();
                window.location.href= 'index.php?r=fetch/admin&cat_id=' + catId;
            });
        },

        /**
         * 搜索
         */
        search: function () {
            $('#search').click(function () {
                var taobaoId = $('#taobaoId').val();
                var title = $('#title').val();
                window.location.href= 'index.php?r=fetch/admin&taobaoId=' + taobaoId + '&title=' + title;
            });
        }
    }
})();

