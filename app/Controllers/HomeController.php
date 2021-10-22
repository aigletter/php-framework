<?php


namespace App\Controllers;


use Core\Application;
use Psr\SimpleCache\CacheInterface;

class HomeController
{
    /**
     * @var CacheInterface
     *
     * @see CacheInterface::get()
     */
    protected $cache;

    public function __construct()
    {
        $this->cache = Application::getInstance()->get('cache');
        $this->cache->set('string', 'Home controller index method');
    }

    public function index()
    {
        echo $this->cache->get('string');
        //echo $this->cache->get(new \stdClass());

        echo Application::getInstance()->get('test')->run();
    }
}