<?php


namespace Core;


use Core\Interfaces\ContainerInterface;

abstract class FactoryAbstract
{
    protected $container;

    protected $config;

    public function __construct(ContainerInterface $container, array $config = [])
    {
        $this->container = $container;
        $this->config = $config;
    }

    public function createComponent()
    {
        return $this->createConcrete();
    }

    abstract protected function createConcrete();
}