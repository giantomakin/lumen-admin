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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'api/admin'], function () use ($app) {
    $app->post('login', ['uses' => 'App\Http\Controllers\User@authenticate']);
});

$app->group(['prefix' => 'api/user'], function () use ($app) {
    $app->post('create', ['uses' => 'App\Http\Controllers\User@create']);
    $app->get('find/{id}', ['uses' => 'App\Http\Controllers\User@find']);
    $app->get('all', ['uses' => 'App\Http\Controllers\User@all']);
    $app->post('delete/{id}', ['uses' => 'App\Http\Controllers\User@delete']);
});


