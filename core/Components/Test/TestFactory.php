<?php


namespace Core\Components\Test;


use Core\FactoryAbstract;

class TestFactory extends FactoryAbstract
{
    protected function createConcrete()
    {
        return new Test();
    }
}