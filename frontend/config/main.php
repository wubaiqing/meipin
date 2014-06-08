<?php

return [
    'basePath' => realpath(__DIR__ . '/../'),
    'timeZone' => 'Asia/Shanghai',
    'behaviors' => [],
    'controllerMap' => [],
    'modules' => [],
    'name' => '美品网_折800网、九块邮、会员购等9.9包邮精选',
    'import' => [
        'application.services.*',
    ],
    'components' => [
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => [
                'index.html' => 'site/index',
                'raffle' => 'site/raffle',
                'out/<id:.+?>.html' => 'site/out',
                'site/search' => 'site/search',
                'exchange/detail_<id:.+?>.html' => 'exchange/exchangeIndex',
                'exchange/raffle_<id:.+?>.html' => 'exchange/raffle',
                'exchange/<action:\w+>' => 'exchange/<action>',
                'user/login' => 'user/login',
                'feedback' => 'site/feedback',
                'tomorrow' => 'site/tomorrow/cat/1002'
            ],
        ],
        'user' => [
            'loginUrl' => ['user/login']
        ]
    ],
    'params' => [
        'title' => '【美品网】美品网独家优惠,美品网团购,天天特价9.9包邮秒杀在美品网!',
        'keyword' => '美品网,美品,美品网独家优惠,美品网天天特价，美品网9.9包邮,美品网团购,美品网独家秒杀,meipin',
        'desc' => '',
        'pagination' => [
            'pageVar' => 'page',
            'pageSize' => 120,
            'exchangePageSize' => 20, //积分兑换首页，每页显示数量
        ],
        //前台配置标识
        'platform' => 'frontend',
        'linkCacheTime' => 86400,
        //系統全局配置
        'config' => array(
            //是否采用DEBUG模式
            'enableDebug' => false,
            //是否使用系统缓存
            'enableCache' => true,
        ),
        //每日签到积分增加
        'dayRegistionNum' => [
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3
        ],
        'scorePageSize' => 5,
        //兑换记录列表大小
        'exchangeLogPageSize' => 20,
        //分页最大缓存页面数
        'pageCahceMaxCount' => 5,
    ],
];
