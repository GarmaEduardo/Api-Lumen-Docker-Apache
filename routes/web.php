<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->group(['middleware' => 'auth'], function() use ($router){
    $router->get('pasteles', ['as' => 'pasteles', 'uses' => 'PastelController@index']);
    $router->post('pasteles', ['as' => 'pasteles', 'uses' => 'PastelController@store']);
    $router->delete('pasteles/{id}', ['as' => 'pasteles/{id}', 'uses' => 'PastelController@delete']);
    $router->put('pasteles/{id}', ['as' => 'pasteles/{id}', 'uses' => 'PastelController@update']);
    $router->get('search', ['as' => 'search', 'uses' => 'PastelController@search']);
    $router->put('count/{id}', ['as' => 'count', 'uses' => 'PastelController@modifyQuantity']);
});


$router->post('users', ['as' => 'users', 'uses' => 'UserController@store']);
$router->post('login', ['as' => 'login', 'uses' => 'UserController@login']);
