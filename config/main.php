<?php

return [
    'app_name' => 'Test framework',
    'components' => [
        'router' => [
            'factory' => \Core\Components\Router\RouterFactory::class,
            /*'factory' => \App\Components\Router\RouterFactory::class,
            'able_path' => ['Auth'  => ['login', 'logout', 'registration'],
                'News'  => ['show', 'create', 'edit'],
                'Order' => ['create', 'update'],
                'homeController' => ['index']
            ]*/
        ],
        'cache' => [
            'factory' => \Core\Components\Cache\CacheFactory::class,
            'filename' => 'data/cache/cache.json'
        ],
        'test' => [
            'factory' => \Core\Components\Test\TestFactory::class,
        ]
    ]
];