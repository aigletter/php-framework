<?php

//ini_set('display_errors', '1');

use Core\Application;

include '../vendor/autoload.php';

$config = include '../config/main.php';
//$app = new Application($config);
$app = Application::getInstance($config);

$app->run();