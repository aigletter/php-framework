<?php


namespace App\Components\Router;


use Core\FactoryAbstract;

class RouterFactory extends FactoryAbstract
{
    protected function createConcrete()
    {
        return new Router($this->config);
    }
}