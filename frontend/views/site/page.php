<?php
$this->widget(
    'CLinkPager',
    array(
        'pages' => $pager,
        'header' => false,
        'cssFile' => '',
        'maxButtonCount' => '7',
        'hiddenPageCssClass' => '',
        'selectedPageCssClass' => 'select',
        'lastPageLabel' => '尾页',
        'firstPageLabel' => '首页',
        'nextPageLabel' => '下一页',
        'prevPageLabel' => '上一页',
        'htmlOptions' => array(
            'class' => 'goods-page',
        )
    )
);
?>

