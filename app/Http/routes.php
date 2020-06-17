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

Route::get('convocatoria_download', function () {
    return response()->download(storage_path('../public/assets/res/convocatoria.pdf'));
});

Route::get('ficha_tecnica_download', function () {
    return response()->download(storage_path('../public/assets/res/ficha_tecnica.pdf'));
});

Route::get('terminos_referencia_download', function () {
    return response()->download(storage_path('../public/assets/res/terminos_referencia.pdf'));
});

Route::get('/registro', function () {
    return View::make('registro');
});

Route::post('/registro', 'ProyectoController@registerProject');

Route::post('/registro_integrante', 'ProyectoController@registerIntegrante');

Route::post('/delete_project', 'ProyectoController@deleteProject');

Route::get('/login', 'AdminController@showLoginForm');

Route::post('/login', 'AdminController@login');

Route::get('/logout', 'AdminController@logout');

Route::get('/proyectos', 'ProyectoController@showProyectosPage');

Route::get('/proyectos/{id}', 'ProyectoController@downloadProjectFiles');

Route::get('/proponentes', 'ProyectoController@getProponentesList');
