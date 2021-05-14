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
    return $router->app->version() . ' Module:FAC';
});
// register api routes
$router->group(['prefix' => 'api', 'middleware' => ['auth:api', 'throttle', 'api-version:1' ]], function($router) {
   require __DIR__.'/../Routes/api.v1.php';
});