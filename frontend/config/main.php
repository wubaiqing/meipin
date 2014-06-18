<?php

return [
    'basePath' => realpath(__DIR__ . '/../'),
        'timeZone' => 'Asia/Shanghai',
        'behaviors' => [],
        'controllerMap' => [],
        'modules' => [],
        'name' => '美品网-美品网独家优惠,折800、九块邮精选美品会',
        'import' => [
            'application.services.*',
        ],
        'components' => [
            'urlManager' => [
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => [
                    'index.html' => 'site/index',
                    'out/<id:.+?>.html' => 'site/out',
                    'site/search' => 'site/search',
                    'exchange/detail_<id:.+?>.html' => 'exchange/exchangeIndex',
                    'exchange/<action:\w+>' => 'exchange/<action>',
                    'exchange/index' => 'exchange/index',
                    'user/login' => 'user/login',
                    'feedback' => 'site/feedback',
                    'tomorrow'  => 'site/tomorrow/cat/1002'
                ],
            ],
            'user' => [
                'loginUrl' => ['user/login']
            ]
        ],
        'params' => [
            'title' => '美品网-美品网独家优惠,折800、九块邮精选美品会',
            'keyword' => '美品网,美品,折800,九块邮,独家折扣,9.9包邮,秒杀',
            'desc' => '美品网，一家专门做打折特惠的网站，花最少的钱，买走最好的东西，每日更多众多商品0元换购，美品汇集地。',
            'pagination' => [
                'pageVar' => 'page',
                'pageSize' => 120,
                'exchangePageSize' => 20,//积分兑换首页，每页显示数量
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
