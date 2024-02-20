<?php

use App\Router;

require '../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$router = new Router();
$router->route($uri);