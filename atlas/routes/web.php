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

// Rutas para los elementos Ámbito
Route::prefix('ambito')->group(function () {
    Route::redirect('/', '/ambito', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', 'App\Http\Controllers\AmbitoController@index')->name('ambito.index');

    // Crear un elemento
    Route::post('/', 'App\Http\Controllers\AmbitoController@store')->name('ambito.store');

    // Mostrar un elemento
    Route::get('/{ambito}', 'App\Http\Controllers\AmbitoController@show')->name('ambito.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{ambito}', 'App\Http\Controllers\AmbitoController@edit')->name('ambito.edit');

    // Guardar un elemento editado
    Route::post('/edit/{ambito}', 'App\Http\Controllers\AmbitoController@update')->name('ambito.update');

    // Borrar un elemento
    Route::delete('/delete/{ambito}', 'App\Http\Controllers\AmbitoController@destroy')->name('ambito.delete');
});

// Rutas para los elementos Estado
Route::prefix('estado')->group(function () {
    Route::redirect('/', '/estado', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', 'App\Http\Controllers\EstadoController@index')->name('estado.index');

    // Crear un elemento
    Route::post('/', 'App\Http\Controllers\EstadoController@store')->name('estado.store');

    // Mostrar un elemento
    Route::get('/{estado}', 'App\Http\Controllers\EstadoController@show')->name('estado.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{estado}', 'App\Http\Controllers\EstadoController@edit')->name('estado.edit');

    // Guardar un elemento editado
    Route::post('/edit/{estado}', 'App\Http\Controllers\EstadoController@update')->name('estado.update');

    // Borrar un elemento
    Route::delete('/delete/{estado}', 'App\Http\Controllers\EstadoController@destroy')->name('estado.delete');
});

// Rutas para los elementos Autor
Route::prefix('autor')->group(function () {
    Route::redirect('/', '/autor', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', 'App\Http\Controllers\AutorController@index')->name('autor.index');

    // Crear un elemento
    Route::post('/', 'App\Http\Controllers\AutorController@store')->name('autor.store');

    // Mostrar un elemento
    Route::get('/{autor}', 'App\Http\Controllers\AutorController@show')->name('autor.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{autor}', 'App\Http\Controllers\AutorController@edit')->name('autor.edit');

    // Guardar un elemento editado
    Route::post('/edit/{autor}', 'App\Http\Controllers\AutorController@update')->name('autor.update');

    // Borrar un elemento
    Route::delete('/delete/{autor}', 'App\Http\Controllers\AutorController@destroy')->name('autor.delete');
});
