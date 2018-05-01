<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function () {
    return View::make('home');
});

Route::get('/convocatoria', function () {
    return View::make('convocatoria');
});

Route::get('/registro', function () {
    return View::make('registro');
});

Route::post('/registro', 'ProyectoController@registrarProyecto');

Route::get('/tables', function () {
    return View::make('table');
});

Route::get('/blank', function () {
    return View::make('blank');
});

Route::get('/login', 'AdminController@showLoginForm');

Route::post('/login', 'AdminController@login');

Route::get('/logout', 'AdminController@logout');