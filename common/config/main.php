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
            'connectionString' => 'mysql:host=114.215.202.199;dbname=meipin',
            'username' => 'root',
            'password' => '123456',
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
        'cache' => [
            'class' => 'CFileCache',
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
        //兑换记录列表大小
        'exchangeLogPageSize' => 20,
        //分页最大缓存页面数
        'pageCahceMaxCount' => 5,
        //物流系统
        'logisticsSystem' =>[
            1 => 'EMS',
            2 => '申通',
            3 => '圆通',
            4 => '韵达',
            5 => '中通',
            6 => '顺丰',
            7 => '天天',
            8 => '汇通',
        ]
    ],
];
