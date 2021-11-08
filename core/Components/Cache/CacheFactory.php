<?php


namespace Core\Components\Cache;


use Core\Components\Test\Test;
use Core\FactoryAbstract;

class CacheFactory extends FactoryAbstract
{
    protected function createConcrete()
    {
        //$config = Application::getInstance()->getConfig()['components']['cache'];
        $test = $this->container->get(Test::class);
        return new Cache($this->config['filename'], $test);
    }
}