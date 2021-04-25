<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Mostramos información del proyecto
Route::get('/about', function () {
    return view('about')->with([
        'titulo_pagina' => 'Acerca de...'
        ]);;
});


// Rutas para los elementos Administración
Route::prefix('administracion')->group(function () {
    Route::redirect('/', '/administracion', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', 'App\Http\Controllers\AdministracionController@index')->name('administracion.index');

    // Crear un elemento
    Route::post('/', 'App\Http\Controllers\AdministracionController@store')->name('administracion.store');

    // Mostrar un elemento
    Route::get('/{administracion}', 'App\Http\Controllers\AdministracionController@show')->name('administracion.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{administracion}', 'App\Http\Controllers\AdministracionController@edit')->name('administracion.edit');

    // Guardar un elemento editado
    Route::post('/edit/{administracion}', 'App\Http\Controllers\AdministracionController@update')->name('administracion.update');

    // Borrar un elemento
    Route::delete('/delete/{administracion}', 'App\Http\Controllers\AdministracionController@destroy')->name('administracion.delete');
});
