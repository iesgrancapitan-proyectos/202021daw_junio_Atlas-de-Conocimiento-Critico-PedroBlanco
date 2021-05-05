<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministracionController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Mostramos información del proyecto
Route::get('/about', function () {
    return view('about')->with([
        'titulo_pagina' => 'Acerca de...'
        ]);
});


// Rutas para los elementos Administración
Route::prefix('administracion')->group(function () {
    Route::redirect('/', '/administracion', 301);

    // Dashboard de prueba - interno para Administración
    Route::get('/dashboard', function () {
        return view('administracion.dashboard');
    })
                    ->middleware(['auth'])
                    ->name('dashboard');

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', [AdministracionController::class, 'index'])
                    ->name('administracion.index');

    // Crear un elemento
    Route::post('/', [AdministracionController::class, 'store'])
                    ->middleware('auth')
                    ->name('administracion.store');

    // Mostrar un elemento
    Route::get('/{administracion}', [AdministracionController::class, 'show'])
                    ->name('administracion.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{administracion}', [AdministracionController::class, 'edit'])
                    ->middleware('auth')
                    ->name('administracion.edit');

    // Guardar un elemento editado
    Route::post('/edit/{administracion}', [AdministracionController::class, 'update'])
                    ->middleware('auth')
                    ->name('administracion.update');

    // Borrar un elemento
    Route::delete('/delete/{administracion}', [AdministracionController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('administracion.delete');
});

// Rutas para los elementos Ámbito
Route::prefix('ambito')->group(function () {
    Route::redirect('/', '/ambito', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', 'App\Http\Controllers\AmbitoController@index')
                    ->middleware('guest')
                    ->name('ambito.index');

    // Crear un elemento
    Route::post('/', 'App\Http\Controllers\AmbitoController@store')
                    ->middleware('auth')
                    ->name('ambito.store');

    // Mostrar un elemento
    Route::get('/{ambito}', 'App\Http\Controllers\AmbitoController@show')
                    ->middleware('guest')
                    ->name('ambito.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{ambito}', 'App\Http\Controllers\AmbitoController@edit')
                    ->middleware('auth')
                    ->name('ambito.edit');

    // Guardar un elemento editado
    Route::post('/edit/{ambito}', 'App\Http\Controllers\AmbitoController@update')
                    ->middleware('auth')
                    ->name('ambito.update');

    // Borrar un elemento
    Route::delete('/delete/{ambito}', 'App\Http\Controllers\AmbitoController@destroy')
                    ->middleware('auth')
                    ->name('ambito.delete');
});

// Rutas para los elementos Estado
Route::prefix('estado')->group(function () {
    Route::redirect('/', '/estado', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', 'App\Http\Controllers\EstadoController@index')
                    ->middleware('guest')
                    ->name('estado.index');

    // Crear un elemento
    Route::post('/', 'App\Http\Controllers\EstadoController@store')
                    ->middleware('auth')
                    ->name('estado.store');

    // Mostrar un elemento
    Route::get('/{estado}', 'App\Http\Controllers\EstadoController@show')
                    ->middleware('guest')
                    ->name('estado.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{estado}', 'App\Http\Controllers\EstadoController@edit')
                    ->middleware('auth')
                    ->name('estado.edit');

    // Guardar un elemento editado
    Route::post('/edit/{estado}', 'App\Http\Controllers\EstadoController@update')
                    ->middleware('auth')
                    ->name('estado.update');

    // Borrar un elemento
    Route::delete('/delete/{estado}', 'App\Http\Controllers\EstadoController@destroy')
                    ->middleware('auth')
                    ->name('estado.delete');
});

// Rutas para los elementos Autor
Route::prefix('autor')->group(function () {
    Route::redirect('/', '/autor', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', 'App\Http\Controllers\AutorController@index')
                    ->middleware('guest')
                    ->name('autor.index');

    // Crear un elemento
    Route::post('/', 'App\Http\Controllers\AutorController@store')
                    ->middleware('auth')
                    ->name('autor.store');

    // Mostrar un elemento
    Route::get('/{autor}', 'App\Http\Controllers\AutorController@show')
                    ->middleware('guest')
                    ->name('autor.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{autor}', 'App\Http\Controllers\AutorController@edit')
                    ->middleware('auth')
                    ->name('autor.edit');

    // Guardar un elemento editado
    Route::post('/edit/{autor}', 'App\Http\Controllers\AutorController@update')
                    ->middleware('auth')
                    ->name('autor.update');

    // Borrar un elemento
    Route::delete('/delete/{autor}', 'App\Http\Controllers\AutorController@destroy')
                    ->middleware('auth')
                    ->name('autor.delete');
});

require __DIR__.'/auth.php';
