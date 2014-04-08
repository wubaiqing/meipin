<?php

return array(
    'basePath' => realpath(__DIR__ . '/../'),
    'behaviors' => array(),
    'controllerMap' => array(),
    'modules' => array(),
	'name' => '美品网_折800网、九块邮、会员购等9.9包邮精选',
    'components' => array(
        'urlManager' => array(
            'urlFormat' => 'path',
            'urlSuffix' => '.html',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<action:\w+>/<page:\d+>' => 'site/index/page',
                '<controller:\w+>/<action:\w+>/<tab:\d+>' => 'site/index/tab',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => 'site/go/id/',
            ),
        ),
    ),
    'params' => array(
		'staticDomain' => 'http://static.meipin.com/',
        'pagination' => array(
            'pageVar' => 'page',
            'pageSize' => 120,
        ),
    ),
);
