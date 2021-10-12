<?php

return [
    'app_name' => 'Test framework',
    'components' => [
        'router' => [
            'factory' => \Core\Components\Router\RouterFactory::class,
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