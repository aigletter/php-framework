<?php

//ini_set('display_errors', '1');

use Core\Application;
use Core\Components\Router\Router;

include '../vendor/autoload.php';

$config = include '../config/main.php';
$app = new Application(new Router(), $config);

$app->run();