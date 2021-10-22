<?php
/**
 * @version 1.0
 */


namespace Core;


use Core\Interfaces\ContainerInterface;
use Core\Interfaces\RouterInterface;
use Core\Interfaces\RunnableInterface;


/**
 * Класс приложения, запускаемого с публичной директории
 *
 * В index.php нужно создать экземпляр...
 * После вызвать то-се...
 *
 * @author Yurii Orlyk <aigletter@gmail.com>
 */
class Application implements RunnableInterface, ContainerInterface
{
    /**
     * Массив компонентов
     * @var array
     */
    protected $components = [];

    /**
     * @var array
     */
    protected $config;

    /**
     * @var Application
     */
    protected static $instance;

    /**
     * Метод синглтона, возвращает экземпляр класса
     * @param array $config
     * @return Application
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Application constructor.
     * @param array $config
     */
    protected function __construct()
    {
        //$this->config = $config;
    }

    /**
     * @todo Доделать проверку класса и отрефакторить
     */
    public function configure(array $config = [])
    {
        $this->config = $config;
        foreach ($this->config['components'] as $name => $item) {
            $factoryClass = $item['factory'];
            /** @var FactoryAbstract $factory */
            $factory = new $factoryClass($item);
            $instance = $factory->createComponent();
            //$this->conmponents[$name] = $instance;
            $this->set($name, $instance);
        }
    }

    /**
     * Запускает роутинг и вызывает метод контроллера
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $router = $this->getRouter();
        $action = $router->route();
        //$action();
        $this->callAction($action);
    }

    /**
     * @param callable $action
     * @return mixed
     * @throws \ReflectionException
     */
    protected function callAction(callable $action)
    {
        if ($action instanceof \Closure) {
            $reflectionMethod = new \ReflectionFunction($action);
        } else {
            $reflectionMethod = new \ReflectionMethod($action[0], $action[1]);
        }

        $parameters = [];
        foreach ($reflectionMethod->getParameters() as $parameter) {
            $name = $parameter->getName();
            if (isset($_GET[$name])) {
                $parameters[$name] = $_GET[$name];
            }
        }

        if ($action instanceof \Closure) {
            return $reflectionMethod->invokeArgs($parameters);
        } else {
            return $reflectionMethod->invokeArgs($action[0], $parameters);
        }
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function get($name)
    {
        if (isset($this->components[$name])) {
            return $this->components[$name];
        }

        throw new \Exception('Can not get service with name' . $name);
    }

    /**
     * @param $name
     * @param $service
     */
    public function set($name, $service)
    {
        $this->components[$name] = $service;
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name): bool
    {
        return isset($this->components[$name]);
    }

    /**
     * @return RouterInterface
     * @throws \Exception
     * @deprecated
     */
    public function getRouter()
    {
        return $this->get('router');
    }
}