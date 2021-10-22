<?php


namespace Core;


use Core\Interfaces\ContainerInterface;
use Core\Interfaces\RunnableInterface;

class Application implements RunnableInterface, ContainerInterface
{
    protected $components = [];

    protected $config;

    protected static $instance;

    public static function getInstance($config = [])
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    protected function __construct($config)
    {
        $this->config = $config;
    }

    protected function bootstrap()
    {
        foreach ($this->config['components'] as $name => $item) {
            $factoryClass = $item['factory'];
            /** @var FactoryAbstract $factory */
            $factory = new $factoryClass();
            $instance = $factory->createComponent();
            //$this->conmponents[$name] = $instance;
            $this->set($name, $instance);
        }
    }

    public function run()
    {
        $this->bootstrap();

        $router = $this->get('router');
        $action = $router->route();
        //$action();
        $this->callAction($action);
    }

    protected function callAction(callable $action)
    {
        $reflectionMethod = new \ReflectionMethod($action[0], $action[1]);
        $parameters = [];
        foreach ($reflectionMethod->getParameters() as $parameter) {
            $name = $parameter->getName();
            if (isset($_GET[$name])) {
                $parameters[$name] = $_GET[$name];
            }
        }
        return $reflectionMethod->invokeArgs($action[0], $parameters);
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function get($name)
    {
        if (isset($this->components[$name])) {
            return $this->components[$name];
        }

        throw new \Exception('Can not get service with name' . $name);
    }

    public function set($name, $service)
    {
        $this->components[$name] = $service;
    }

    public function has($name): bool
    {
        return isset($this->components[$name]);
    }
}