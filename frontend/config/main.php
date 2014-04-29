<?php
return [
    'basePath' => realpath(__DIR__ . '/../'),
    'behaviors' => [],
    'controllerMap' => [],
    'modules' => [],
    'name' => '美品网_折800网、九块邮、会员购等9.9包邮精选',
    'components' => [
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => [
                'index.html' => 'site/index',
                'out/<id:.+?>.html' => 'site/out',
                'site/search' => 'site/search',
            ],
        ],
    ],
    'params' => [
        'pagination' => [
            'pageVar' => 'page',
            'pageSize' => 120,
        ],
	'linkCacheTime' => 86400
    ],
];
