<?php

return array(
    'basePath' => realpath(__DIR__ . '/../'),
    'commandMap' => array(
        'server' => array(
            'class' => 'Likai\YiiWebserver\ServerCommand',
        ),
        'migrate' => array(
            'class' => 'system.cli.commands.MigrateCommand',
            'migrationPath' => 'application.migrations',
            'migrationTable' => 'migration',
        ),
    ),
    'components' => [
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
    ]
);
