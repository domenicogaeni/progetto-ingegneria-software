<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('register', UserController::class . '@register');
    $router->post('login', UserController::class . '@login');
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => 'book'], function () use ($router) {
        $router->post('', BookController::class . '@new');
        $router->delete('{id}', BookController::class . '@delete');
    });

    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('logout', UserController::class . '@logout');
        $router->get('me', UserController::class . '@me');
    });
});
