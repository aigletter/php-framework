<?php

return [
    'app_name' => 'Test framework',
    'components' => [
        \Core\Interfaces\RouterInterface::class => [
            'factory' => \Core\Components\Router\RouterFactory::class,
            /*'factory' => \App\Components\Router\RouterFactory::class,
            'able_path' => ['Auth'  => ['login', 'logout', 'registration'],
                'News'  => ['show', 'create', 'edit'],
                'Order' => ['create', 'update'],
                'homeController' => ['index']
            ]*/
        ],
        \Psr\SimpleCache\CacheInterface::class => [
            'factory' => \Core\Components\Cache\CacheFactory::class,
            'filename' => 'data/cache/cache.json'
        ],
        \Core\Components\Test\Test::class => [
            'factory' => \Core\Components\Test\TestFactory::class,
        ]
    ]
];