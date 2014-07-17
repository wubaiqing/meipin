<?php
return array(
    'name' => '美品网',
    'basePath' => realpath(__DIR__ . '/../'),
    'timeZone' => 'Asia/Shanghai',
    'preload'=>array('log'),
    'language'=>'zh_cn',
//    'modules'=>array(
//        'gii'=>array(
//            'class'=>'system.gii.GiiModule',
//            'password'=>'111111'
//        ),
//    ),
    'components'=>array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
            ),
        ),
    ),
    'params' => array(
        'pagination' => array(
            'pageVar' => 'page',
            'pageSize' => 10,
        ),
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
    )
);
