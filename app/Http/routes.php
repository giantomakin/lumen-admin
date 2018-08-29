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
//admin
$app->group(['prefix' => 'api/admin'], function () use ($app) {
    $app->post('login', ['uses' => 'App\Http\Controllers\User@authenticate']);
});
//user
$app->group(['prefix' => 'api/user','middleware' => 'auth'], function () use ($app) {
    $app->post('create', ['uses' => 'App\Http\Controllers\User@create']);
    $app->post('delete/{id}', ['uses' => 'App\Http\Controllers\User@delete']);
    $app->put('update/{id}', ['uses' => 'App\Http\Controllers\User@update']);
    $app->get('find/{id}', ['uses' => 'App\Http\Controllers\User@find']);
    $app->get('all', ['uses' => 'App\Http\Controllers\User@all']);
    $app->get('check-auth', ['uses' => 'App\Http\Controllers\User@checkAuthUser']);
});
//pages
$app->group(['prefix' => 'api/page'], function () use ($app) {
  $app->get('{slug}',  ['uses' => 'App\Http\Controllers\Page@staticPage']);
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
//materials
$app->group(['prefix' => 'api/material','middleware' => 'auth'], function () use ($app) {
    $app->post('create', ['uses' => 'App\Http\Controllers\Material@create']);
    $app->post('delete/{id}', ['uses' => 'App\Http\Controllers\Material@delete']);
    $app->get('find/{id}', ['uses' => 'App\Http\Controllers\Material@find']);
    $app->get('all', ['uses' => 'App\Http\Controllers\Material@all']);
});
//materials category
$app->group(['prefix' => 'api/material/category','middleware' => 'auth'], function () use ($app) {
    $app->post('create', ['uses' => 'App\Http\Controllers\MaterialCategory@create']);
    $app->post('delete/{id}', ['uses' => 'App\Http\Controllers\MaterialCategory@delete']);
    $app->get('find/{id}', ['uses' => 'App\Http\Controllers\MaterialCategory@find']);
    $app->get('all', ['uses' => 'App\Http\Controllers\MaterialCategory@all']);
    $app->get('materials/{id}', ['uses' => 'App\Http\Controllers\MaterialCategory@getMaterialsByCategory']);
});
//favorites
$app->group(['prefix' => 'api/favorite'], function () use ($app) {
    $app->post('/add/{type}', ['uses' => 'App\Http\Controllers\Favorite@addFavorite']);
    $app->post('/remove/{type}/{id}', ['uses' => 'App\Http\Controllers\Favorite@removeFavorite']);
    $app->get('/all/{type}', ['uses' => 'App\Http\Controllers\Favorite@getAllFavorites']);
});
//gallery
$app->group(['prefix' => 'api/gallery'], function () use ($app) {
    $app->post('create/{type}', ['uses' => 'App\Http\Controllers\Gallery@create']);
    $app->post('delete/{type}/{id}', ['uses' => 'App\Http\Controllers\Gallery@delete']);
    $app->get('find/{id}', ['uses' => 'App\Http\Controllers\Gallery@find']);
    $app->get('all/{type}', ['uses' => 'App\Http\Controllers\Gallery@all']);
    $app->get('all/{type}/{id}', ['uses' => 'App\Http\Controllers\Gallery@getAlbumsByGallery']);
});
