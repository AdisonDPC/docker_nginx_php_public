<?php

return [
    'config' => [
        'displayErrorDetails' => true,
        'view' => [
            'path' => __DIR__ . '/../src/views',
            'twig' => [ 'cache' => false ]
        ],
        'db' => [
            'driver' => 'mysql',
            'host' => 'DB_MARIA_DB_LOCAL',
            'database' => 'DB_SLIM_TEST_V1',
            'username' => 'adpcuser',
            'password' => '_bQWl3839',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ]
    ]
];
