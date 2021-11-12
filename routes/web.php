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

$router->get('login','LoginController@index');
$router->post('login','LoginController@auth');
$router->get('logout','LoginController@logout');
$router->get('register','LoginController@register');
$router->post('save','LoginController@savereg');
$router->get('dashboard','DashboardController@index');

$router->group(['prefix'=>'ip'],function() use ($router) {
    $router->get('/index','IpController@index');
    $router->get('/add','IpController@add');
    $router->get('/edit/{id}','IpController@edit');
    $router->post('/create','IpController@create');
    $router->post('/update','IpController@update');
});