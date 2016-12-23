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

//$app->get('/', function () use ($app) {
//    return $app->version();
//});

$app->get('/', function () {
	return view('login');
});

$app->post('auth/login', 'AuthController@postLogin');

$app->group(['prefix' => 'v1','namespace' => 'App\Http\Controllers', 'middleware' => 'jwt.auth'], function ($api) {
	$api->get('product', 'ProductController@index');
	$api->get('product/{id}', 'ProductController@show');
	$api->post('product', 'ProductController@store');
	$api->put('product/{id}', 'ProductController@update');
	$api->delete('product/{id}', 'ProductController@destroy');
});

