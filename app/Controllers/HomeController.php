<?php


namespace App\Controllers;


use Core\Components\Test\Test;
use Core\Interfaces\RouterInterface;
use Psr\SimpleCache\CacheInterface;

class HomeController
{
    /**
     * @var CacheInterface
     *
     * @see CacheInterface::get()
     */
    protected $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
        //$this->cache = Application::getInstance()->get('cache');
        $this->cache->set('string', 'Home controller index method');
    }

    public function index(Test $test, RouterInterface $router)
    {
        echo $this->cache->get('string');
        //echo $this->cache->get(new \stdClass());

        //echo Application::getInstance()->get('test')->run();
    }
}