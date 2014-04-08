<?php
return array(
    'name' => '美品网',
    'basePath' => realpath(__DIR__ . '/../'),
    'preload'=>array('log'),
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
    )
);
