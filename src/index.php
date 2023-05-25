<?php
session_start();
require '../vendor/autoload.php';
//require __DIR__ . '../vendor/autoload.php';

require 'routes.php';

$router->run( $router->routes );

header("Content-Type: application/json");
