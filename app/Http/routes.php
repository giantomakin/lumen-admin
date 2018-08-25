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

//user
$app->group(['prefix' => 'api/user','middleware' => 'auth'], function () use ($app) {
    $app->post('create', ['uses' => 'App\Http\Controllers\User@create']);
    $app->post('delete/{id}', ['uses' => 'App\Http\Controllers\User@delete']);
    $app->get('find/{id}', ['uses' => 'App\Http\Controllers\User@find']);
    $app->get('all', ['uses' => 'App\Http\Controllers\User@all']);
    $app->get('check-auth', ['uses' => 'App\Http\Controllers\User@checkAuthUser']);
});
//job
$app->group(['prefix' => 'api/job','middleware' => 'auth'], function () use ($app) {
    $app->post('create', ['uses' => 'App\Http\Controllers\Job@create']);
    $app->post('delete/{id}', ['uses' => 'App\Http\Controllers\Job@delete']);
    $app->get('find/{id}', ['uses' => 'App\Http\Controllers\Job@find']);
    $app->get('all', ['uses' => 'App\Http\Controllers\Job@all']);
});
//contact
$app->group(['prefix' => 'api/contact','middleware' => 'auth'], function () use ($app) {
    $app->post('create', ['uses' => 'App\Http\Controllers\Contact@create']);
    $app->post('delete/{id}', ['uses' => 'App\Http\Controllers\Contact@delete']);
    $app->get('find/{id}', ['uses' => 'App\Http\Controllers\Contact@find']);
    $app->get('all', ['uses' => 'App\Http\Controllers\Contact@all']);
});
//post
$app->group(['prefix' => 'api/post','middleware' => 'auth'], function () use ($app) {
    $app->post('create', ['uses' => 'App\Http\Controllers\Post@create']);
    $app->post('delete/{id}', ['uses' => 'App\Http\Controllers\Post@delete']);
    $app->get('find/{id}', ['uses' => 'App\Http\Controllers\Post@find']);
    $app->get('all', ['uses' => 'App\Http\Controllers\Post@all']);
});



