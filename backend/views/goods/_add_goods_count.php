<div class="box">
    <h3 class="box-header">商品添加数量统计</h3>
<?php

$weeks = array();
foreach ($user as $key => $val) {
    if (!in_array($val['weeks'], $weeks)) {
        $weeks[] = $val['weeks'];
    }
}

$users = array();
foreach ($user as $key => $val) {
    $users[$val['user_id']][$val['weeks']] = intval($val['c']);
}

$dalin = $xiaoyue = $xiaotao = array();
foreach ($weeks as $key => $val) {
    if (!isset($users['2'][$val])) {
        $users['2'][$val] = 0;
    }

    if (!isset($users['3'][$val])) {
        $users['3'][$val] = 0;
    }

    $dalin[] = $users['2'][$val];
    $xiaoyue[] = $users['3'][$val];
    if (isset($users['4']) && isset($users['4'][$val])) {
        $xiaotao[] = $users['4'][$val];
    } else {
        $xiaotao[] = 0;
    }
}

$this->Widget('common.extensions.highcharts.HighchartsWidget', array(
    'options'=>array(
        'title' => array('text' => '30天添加商品数量统计'),
        'xAxis' => array(
            'categories' => $weeks ,
        ),
        'yAxis' => array(
            'title' => array('text' => '30天内添加商品统计')
        ),
        'series' => array(
            array('name' => '小林', 'data' => $dalin),
            array('name' => '小月', 'data' => $xiaoyue),
            array('name' => '小淘', 'data' => $xiaotao)
        )
    )
));
?>
</div>
