<?php
if (isset($pager) && !empty($pager)) {
    $this->widget(
        'CLinkPager',
        [
            'pages' => $pager,
            'header' => false,
            'cssFile' => '',
            'maxButtonCount' => '5',
            'hiddenPageCssClass' => '',
            'selectedPageCssClass' => 'select',
            'lastPageLabel' => '尾页',
            'firstPageLabel' => '首页',
            'nextPageLabel' => '下一页',
            'prevPageLabel' => '上一页',
            'htmlOptions' => [
                'class' => 'goods-page',
            ]
        ]
    );
}
