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
| @version 1.0.0
*/

$router->group(['prefix' => 'v1', 'namespace' => 'API\v1' ], function ($router) {
   $router->get('/', function() use ($router) {
   		return $router->app->version() . ' Module:FAC API Route version 1';
   });

   $router->post('/purchase', 'FACController@purchase' );
   $router->post('/authorize', 'FACController@authorizeFAC' );
   $router->post('/refund', 'FACController@refund' );
   $router->post('/capture', 'FACController@capture' );
   $router->post('/tokenize', 'FACController@tokenize' );
});
