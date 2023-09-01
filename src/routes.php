<?php

use src\core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');
$router->get('/ping', 'HomeController@ping');

$router->get('/get', 'HomeController@get');
$router->get('/getall', 'HomeController@getall');

//Pokemon
$router->get('/pokemon/', 'PokeController@index');
$router->get('/pokemon/get', 'PokeController@get');
$router->get('/pokemon/getall', 'PokeController@getall');
$router->post('/pokemon/insert', 'PokeController@insert');
$router->put('/pokemon/update', 'PokeController@update');
$router->delete('/pokemon/delete', 'PokeController@delete');