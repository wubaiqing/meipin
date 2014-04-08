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
);
