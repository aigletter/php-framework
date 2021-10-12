<?php


namespace Core;


abstract class FactoryAbstract
{
    public function createComponent()
    {
        return $this->createConcrete();
    }

    abstract protected function createConcrete();
}