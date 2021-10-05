<?php


namespace Core\Interfaces;


interface RouterInterface
{
    public function route(): callable;
}