<?php


namespace Core\Components\Cache;


use Core\Application;
use Core\FactoryAbstract;

class CacheFactory extends FactoryAbstract
{
    protected function createConcrete()
    {
        $config = Application::getInstance()->getConfig()['components']['cache'];
        return new Cache($config['filename']);
    }
}