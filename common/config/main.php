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
            'password' => '0Dz9Bnlmpvs!',
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
            2 => '申通速递',
            3 => '圆通速递',
            4 => '韵达快递',
            5 => '中通快递',
            6 => '顺丰速递',
            7 => '天天快递',
            8 => '百世汇通',
            9 => '邮政包裹',
            10 => '宅急送',
        ],
        //支付宝账号信息配置
        'alipay' =>[
            //收款账号
            'email' => 'meipin2309@163.com',
            //支付宝ID
            'id' => '2088411283973406',
            //支付宝验证码
            'key' => '76suwy363u03pkgzbq1qq2b22z6ddnbb',
        ],
        //支付超时
        'payTimeout' =>3600,
    ],
];
