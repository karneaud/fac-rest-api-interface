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
    return sprintf("%s v%d Module:FAC", env('APP_NAME'), env('APP_VERSION') );
});
// register api routes
$router->group(['prefix' => 'api', 'middleware' => ['auth:key', 'verify:key', 'api-version:1' ]], function($router) {
	require __DIR__.'/../Routes/api.v1.php';
});