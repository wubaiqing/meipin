<?php

return [

    'name' => '美品网',

    'aliases' => [
        'common' => __DIR__ . '/../../common',
        'vendor' => __DIR__ . '/../../common/vendors',
        'console' => __DIR__ . '/../../console',
        'backend' => __DIR__ . '/../../backend',
        'frontend' => __DIR__ . '/../../frontend',
    ],

    'import' => [
        'common.helpers.*',
        'common.components.*',
        'common.extensions.*',
        'application.models.*',
        'application.helpers.*',
        'application.components.*',
        'application.controllers.*',
    ],

    'preload' => ['log'],

    'components' => [
        // 禁止调用内置的jquery文件
		'clientScript' => [
			'packages' => [
			],
		],

        'db' => [
            'connectionString' => 'mysql:host=localhost;dbname=meipin',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'emulatePrepare' => true,
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ],

        'user' => [
            'class' => 'WebUser',
            'allowAutoLogin' => true,
        ],

        'format' => [
            'timeFormat' => 'H:i:s',
            'dateFormat' => 'Y-m-d',
            'datetimeFormat' => 'Y-m-d H:i:s',
        ],

		'cache'=>[
            'class'=>'CFileCache',
        ],
    ],

    'params' => [
		'staticDomain' => 'http://static.meipin.com/',
    ],

];
