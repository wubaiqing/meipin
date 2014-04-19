<div class="page_div clear page_bottom wp">
    <div class="list_page">
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

        <span class="current">1</span><span class=""><a href="/index2.html">2</a></span><span class=""><a href="/index3.html">3</a></span><span class=""><a href="/index4.html">4</a></span><span class=""><a href="/index5.html">5</a></span><span class=""><a href="/index6.html">6</a></span><span class=""><a href="/index7.html">7</a></span><span class="next"><a href="/index2.html" style="width: 100px;" rel="next">下一页</a></span>
    </div>
</div>
