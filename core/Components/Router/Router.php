<?php


namespace Core\Components\Router;


use App\Controllers\HomeController;
use Core\Interfaces\RouterInterface;

class Router implements RouterInterface
{
    public function route(): callable
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $parts = explode('/', $path);

        if (!empty($parts[1])) {
            $controllerName = 'App\\Controllers\\' . ucfirst($parts[1]);
        } else {
            $controllerName = 'App\\Controllers\\HomeController';
        }

        $methodName = $parts[2] ?? 'index';

        if (!class_exists($controllerName)) {
            throw new \Exception('Not found');
        }

        $controller = new $controllerName();

        return [
            $controller,
            $methodName
        ];
    }
}