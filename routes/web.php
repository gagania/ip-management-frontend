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

$router->get('/','LoginController@index');
$router->get('login','LoginController@index');
$router->post('login','LoginController@auth');
$router->get('logout','LoginController@logout');
$router->get('register','LoginController@register');
$router->post('save','LoginController@savereg');
$router->get('dashboard','DashboardController@index');

$router->group(['prefix'=>'ip'],function() use ($router) {
    $router->get('/','IpController@index');
    $router->get('/index','IpController@index');
    $router->get('/add','IpController@add');
    $router->get('/edit/{id}','IpController@edit');
    $router->post('/create','IpController@create');
    $router->post('/update','IpController@update');
});

$router->group(['prefix'=>'audit_trails'],function() use ($router) {
    $router->get('/','AuditTrailsController@index');
    $router->get('/index','AuditTrailsController@index');
    $router->get('/edit/{id}','AuditTrailsController@edit');
});

$router->group(['prefix'=>'access_log'],function() use ($router) {
    $router->get('/','AccessLogController@index');
    $router->get('/index','AccessLogController@index');
    $router->get('/edit/{id}','AccessLogController@edit');
});