<?php


namespace Core;


abstract class FactoryAbstract
{
    protected $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function createComponent()
    {
        return $this->createConcrete();
    }

    abstract protected function createConcrete();
}