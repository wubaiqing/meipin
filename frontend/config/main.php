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
            'showScriptName' => false,
            'rules' => array(
                'index.html' => 'site/index',
                'out/<id:.+?>.html' => 'site/out',
                'site/search' => 'site/search',
            ),
        ),
    ),
    'params' => array(
        'pagination' => array(
            'pageVar' => 'page',
            'pageSize' => 120,
        ),
    ),
);
