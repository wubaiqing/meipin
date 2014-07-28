<div class="box">
    <h3 class="box-header">用户统计</h3>
     <?php $this->renderPartial('_infosearch', ['usermodel' => $usermodel]); ?>
    <?php
    $this->widget('ListView', array(
        'id' => 'exchange-grid',
        'dataProvider' => $usermodel->getuserinfo(),
        'pager'=>array('class'=>'CLinkPager'),
        'template'=>'{sorter}{items}{pager}',
        'itemsTagName'=>'table',
        'ajaxUpdate'=>false,
        'itemsCssClass'=>'table table-striped table-bordered',
        'emptyText'=>'对不起，没有任何搜索结果。',
        'viewData'=>[],
        'itemtops'=>'<th width=10%>时间</th><th width=9%>注册用户</th><th width=9%>增加积分</th><th width=9%>消耗积分</th>',

        'itemView'=>'_userinfo',
        'pager' => array(
            'class' => 'CLinkPager',
            'cssFile' => '',
            'header' => '',
            'lastPageLabel' => '尾页',
            'firstPageLabel' => '首页',
            'nextPageLabel' => '下一页',
            'prevPageLabel' => '上一页',
        ),

    ));
    ?>
</div>
