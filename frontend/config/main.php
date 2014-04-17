<?php

return array(
    'basePath' => realpath(__DIR__ . '/../'),
    'behaviors' => array(),
    'controllerMap' => array(),
    'modules' => array(),
	'name' => '美品网_折800网、九块邮、会员购等9.9包邮精选',
    'components' => array(
    ),
    'params' => array(
		'staticDomain' => 'http://static.meipin.com/',
        'pagination' => array(
            'pageVar' => 'page',
            'pageSize' => 120,
        ),
    ),
);
