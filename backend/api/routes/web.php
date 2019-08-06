<?php

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('documents',  ['uses' => 'DocumentController@showAllDocuments']);

    $router->get('documents/{id}/', ['uses' => 'DocumentController@showOneDocument']);

    $router->post('documents', ['uses' => 'DocumentController@create']);

    $router->put('documents/{id}', ['uses' => 'DocumentController@update']);

    $router->delete('documents/{id}', ['uses' => 'DocumentController@delete']);

});
