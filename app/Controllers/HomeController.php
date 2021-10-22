<?php


namespace App\Controllers;


use Core\Application;

class HomeController
{
    protected $cache;

    public function __construct()
    {
        $this->cache = Application::getInstance()->get('cache');
        $this->cache->set('string', 'Home controller index method');
    }

    public function index()
    {
        echo $this->cache->get('string');

        echo Application::getInstance()->get('test')->run();
    }
}