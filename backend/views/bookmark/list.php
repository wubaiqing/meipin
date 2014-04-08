<div class="box">
    <h3 class="box-header">收藏夹</h3>
    <form class="form-search" method="get">
        <div>
            <label>网站名称：</label>
            <input name="Bookmark[name]" id="name" type="text" value="">
            <label>URL：</label>
            <input name="Bookmark[url]" id="url" type="text" value="">
            <input class="btn" type="button" id="addBookmark" value="添加">
            <input class="btn btn-danger" type="button" id="deleteBookmark" value="删除">
        </div>
    </form>
    <div>
        <table class="table table-bordered">
            <thead>
                <th colspan="4" >收藏夹</th>
            </thead>
            <tbody>
                <td>
                    <?php foreach( $model as $key => $val) : ?>
                    <span><a target="_blank" href="<?php echo $val->url;?>"><?php echo $val->name;?></a></span>
                    <?php endforeach; ?>
                </td>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $('#addBookmark').click(function () {
            var name = $('#name').val();
            var url = $('#url').val();
            $.getJSON('index.php?r=bookmark/addBookmark', {name : name, url : url}, function (data) {
                if (data.code == 2) {
                    alert(data.errorLog);
                } else {
                    location.reload();
                }
            });
        });
        $('#deleteBookmark').click(function () {
            var name = $('#name').val();
            var url = $('#url').val();
            $.getJSON('index.php?r=bookmark/deleteBookmark', {name : name, url : url}, function (data) {
                if (data.code == 2) {
                    alert(data.errorLog);
                } elseif (data.code == 1) {
                    location.reload();
                }
            });
        });
    </script>
    <style type="text/css">
        td span{
            margin-right:10px;
            margin-bottom: 5px;
        }
    </style>
