<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');
$router->get('/ping', 'HomeController@ping');

$router->get('/get', 'HomeController@get');
$router->get('/getall', 'HomeController@getall');
// $router->put('/update', 'HomeController@update');
// $router->post('/insert', 'HomeController@insert');
// $router->delete('/delete', 'HomeController@delete');