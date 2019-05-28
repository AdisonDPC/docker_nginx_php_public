<?php

return [
    'config' => [
        'displayErrorDetails' => true,
        'view' => [
            'path' => __DIR__ . '/../src/views',
            'twig' => [ 'cache' => false ]
        ],
        // 'db' => [
        //     'driver' => 'mysql',
        //     'host' => '192.168.1.122:3344',
        //     'database' => 'db_test',
        //     'username' => 'testuser',
        //     'password' => 'testuser@docker',
        //     'charset'   => 'utf8',
        //     'collation' => 'utf8_spanish2_ci',
        //     'prefix'    => ''
        // ]
        'db' => [
            'driver' => 'json',
            'path' => __DIR__ . '/../databases'
        ]
    ]
];
