<?php

return [
    'basePath' => realpath(__DIR__ . '/../'),
    'timeZone' => 'Asia/Shanghai',
    'behaviors' => [],
    'controllerMap' => [],
    'modules' => [],
    'name' => '美品网_折800网、九块邮、会员购等9.9包邮精选',
    'import' => array(
		'application.services.*',
	),
    'components' => [
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => [
                'index.html' => 'site/index',
                'out/<id:.+?>.html' => 'site/out',
                'site/search' => 'site/search',
                'score/ec/<id:.+?>.html' => 'score/exchangeIndex',
                'score/ajax/<action:\w+>' => 'score/<action>',
            ],
        ],
    ],
    'params' => [
        'title' => '【美品网】美品网独家优惠,美品网团购,天天特价9.9包邮秒杀在美品网!',
        'keyword' => '美品网,美品,美品网独家优惠,美品网天天特价，美品网9.9包邮,美品网团购,美品网独家秒杀,meipin',
        'desc' => '',
        'pagination' => [
            'pageVar' => 'page',
            'pageSize' => 120,
        ],
        'linkCacheTime' => 86400,
        //系統全局配置 
        'config' => array(
            //是否采用DEBUG模式
            'enableDebug' => false,
            //是否使用系统缓存
            'enableCache' => true,
        ),
    ],
];
