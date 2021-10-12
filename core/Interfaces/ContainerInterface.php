<?php


namespace Core\Interfaces;


interface ContainerInterface
{
    public function get($name);

    public function set($name, $service);

    public function has($name): bool;
}