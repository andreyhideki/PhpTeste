<?php
session_start();
require '../vendor/autoload.php';
require '../routes.php';

$router->run( $router->routes );