<?php


namespace Core\Components\Router;


use App\Controllers\HomeController;
use Core\Interfaces\RouterInterface;

class Router implements RouterInterface
{
    public function route(): callable
    {
        // TEMP
        // TODO сделать реализацию
        /*return function () {
            echo 'Router is running';
        };*/

        return [
            new HomeController(),
            'index'
        ];
    }
}