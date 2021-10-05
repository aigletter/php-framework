<?php


namespace Core;


use App\Controllers\HomeController;
use Core\Interfaces\RouterInterface;
use Core\Interfaces\RunnableInterface;

class Application implements RunnableInterface
{
    protected $router;

    protected $config;

    public function __construct(RouterInterface $router, $config)
    {
        $this->router = $router;
        $this->config = $config;
    }

    /*public function __construct($config = [])
    {
        $this->config = $config;

        if (isset($config['components'])) {
            foreach ($config['components'] as $key => $item) {
                if (isset($item['class']) && class_exists($item['class'])) {
                    $instance = new $item['class']();
                    if (property_exists($this, $key)) {
                        $this->{$key} = $instance;
                    }
                }
            }
        }
    }*/

    public function run()
    {
        $action = $this->router->route();
        $action();
        /*if ($_SERVER['REQUEST_URI'] === '/') {
            $controller = new HomeController();
            $controller->index();
        }*/
    }
}