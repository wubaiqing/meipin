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
            'connectionString' => 'mysql:host=115.29.102.213;dbname=meipin',
            'username' => 'deployment',
            'password' => 'SXij0GdRmXumqmlr',
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
                //短信配置
                'sms' => [
                    //短信发送接口地址
                    'sendUrl' => "http://dx.ipyy.net/sms.aspx",
                    //短信账户账号
                    'account' => 'xd000029',
                    //短信账户密码
                    'password' => 'soho2309',
                    //单用户单日最大发送量
                    'sms_day_max' => 5,
                ],
    ],

];
