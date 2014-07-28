<?php

return [
    'basePath' => realpath(__DIR__ . '/../'),
        'timeZone' => 'Asia/Shanghai',
        'behaviors' => [],
        'controllerMap' => [],
        'modules' => [],
        'name' => '美品网-美品网独家优惠,折800、九块邮精选美品会',
        'import' => [
            'application.services.*',
        ],
        'preload' => array('log'),
//        'modules'=>array(
//            'gii'=>array(
//                'class'=>'system.gii.GiiModule',
//                'password'=>'meipin'
//            ),
//        ),
        'components' => [
            'urlManager' => [
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => [
                    'index.html' => 'site/index',
                    'raffle' => 'site/raffle',
                    'out/<id:.+?>.html' => 'site/out',
                    'buy/<id:.+?>.html' => 'site/buy',
                    'site/search' => 'site/search',
                    'brand/<cat:.+?>' => 'brand/index',
                    'exchange/detail_<id:.+?>.html' => 'exchange/exchangeIndex',
                    'exchange/raffle_<id:.+?>.html' => 'exchange/raffle',
                    'exchange/<action:\w+>' => 'exchange/<action>',
                    'exchange/index' => 'exchange/index',
                    'user/login' => 'user/login',
                    'feedback' => 'site/feedback',
                    'tomorrow'  => 'site/tomorrow/cat/1002',
                    '6c5d7ae90439a3538eb535c0757a3816.txt'=>'site/linshi'
                ],
            ],
            'user' => [
                'loginUrl' => ['user/login']
            ],
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    // 日志
                    array(
                        'class' => 'application.components.logging.DateFileLogRoute',
                        'levels' => 'info,error',
                        'categories' => 'application.pay',
                        'logFilename' => 'hessian',
                        'logFilepath' => 'hessian',
                    ),
                    // 错误日志
                    array(
                        'class' => 'application.components.logging.DateFileLogRoute',
                        'levels' => 'warning,info, error'
                    ),
                ),
            ),
            
        ],
        'params' => [
            'title' => '美品网-美品网独家优惠,折800、九块邮精选美品会',
            'keyword' => '美品网,美品,折800,九块邮,独家折扣,9.9包邮,秒杀',
            'desc' => '美品网，一家专门做打折特惠的网站，花最少的钱，买走最好的东西，每日更多众多商品0元换购，美品汇集地。',
            'pagination' => [
                'pageVar' => 'page',
                'pageSize' => 120,
                'exchangePageSize' => 60,//积分兑换首页，每页显示数量
                'goodsdetail'=>12,       
            ],
            'payTimeout' => 3600, //支付超时
            //前台配置标识
            'platform' => 'frontend',
            'linkCacheTime' => 86400,
            //系統全局配置
            'config' => array(
                //是否采用DEBUG模式
                'enableDebug' => false,
                //是否使用系统缓存
                'enableCache' => true,
            ),
            //每日签到积分增加
            'dayRegistionNum' => [
                0 => 0,
                1 => 1,
                2 => 2,
                3 => 3
            ],
            'scorePageSize' => 5,
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
        ],
    ];
