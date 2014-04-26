<?php

return array(

    'name' => '美品网',

    'aliases' => array(
        'common' => __DIR__ . '/../../common',
        'vendor' => __DIR__ . '/../../common/vendors',
        'console' => __DIR__ . '/../../console',
        'backend' => __DIR__ . '/../../backend',
        'frontend' => __DIR__ . '/../../frontend',
    ),

    'import' => array(
        'common.helpers.*',
        'common.components.*',
        'common.extensions.*',
        'application.models.*',
        'application.helpers.*',
        'application.components.*',
        'application.controllers.*',
    ),

    'preload' => array('log'),

    'components' => array(
        // 禁止调用内置的jquery文件
		'clientScript' => array(
			'packages' => array(
			),
		),

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=meipin',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'emulatePrepare' => true,
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),

        'user' => array(
            'class' => 'WebUser',
            'allowAutoLogin' => true,
        ),

        'format' => array(
            'timeFormat' => 'H:i:s',
            'dateFormat' => 'Y-m-d',
            'datetimeFormat' => 'Y-m-d H:i:s',
        ),

		'cache'=>array(
            'class'=>'CFileCache',
        ),

        
    ),

    'params' => array(
		'staticDomain' => 'http://static.meipin.com/',
    ),
);
