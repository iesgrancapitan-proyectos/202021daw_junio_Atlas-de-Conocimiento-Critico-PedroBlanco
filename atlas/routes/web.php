<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\AmbitoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\MapaController;

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
    Route::get('/', [AmbitoController::class, 'index'])
                    ->name('ambito.index');

    // Crear un elemento
    Route::post('/', [AmbitoController::class, 'store'])
                    ->middleware('auth')
                    ->name('ambito.store');

    // Mostrar un elemento
    Route::get('/{ambito}', [AmbitoController::class, 'show'])
                    ->name('ambito.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{ambito}', [AmbitoController::class, 'edit'])
                    ->middleware('auth')
                    ->name('ambito.edit');

    // Guardar un elemento editado
    Route::post('/edit/{ambito}', [AmbitoController::class, 'update'])
                    ->middleware('auth')
                    ->name('ambito.update');

    // Borrar un elemento
    Route::delete('/delete/{ambito}', [AmbitoController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('ambito.delete');
});

// Rutas para los elementos Estado
Route::prefix('estado')->group(function () {
    Route::redirect('/', '/estado', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', [EstadoController::class, 'index'])
                    ->name('estado.index');

    // Crear un elemento
    Route::post('/', [EstadoController::class, 'store'])
                    ->middleware('auth')
                    ->name('estado.store');

    // Mostrar un elemento
    Route::get('/{estado}', [EstadoController::class, 'show'])
                    ->name('estado.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{estado}', [EstadoController::class, 'edit'])
                    ->middleware('auth')
                    ->name('estado.edit');

    // Guardar un elemento editado
    Route::post('/edit/{estado}', [EstadoController::class, 'update'])
                    ->middleware('auth')
                    ->name('estado.update');

    // Borrar un elemento
    Route::delete('/delete/{estado}', [EstadoController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('estado.delete');
});

// Rutas para los elementos Geo
Route::prefix('geo')->group(function () {
    Route::redirect('/', '/geo', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', [GeoController::class, 'index'])
                    ->name('geo.index');

    // Crear un elemento
    Route::post('/', [GeoController::class, 'store'])
                    ->middleware('auth')
                    ->name('geo.store');

    // Mostrar un elemento
    Route::get('/{geo}', [GeoController::class, 'show'])
                    ->name('geo.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{geo}', [GeoController::class, 'edit'])
                    ->middleware('auth')
                    ->name('geo.edit');

    // Guardar un elemento editado
    Route::post('/edit/{geo}', [GeoController::class, 'update'])
                    ->middleware('auth')
                    ->name('geo.update');

    // Borrar un elemento
    Route::delete('/delete/{geo}', [GeoController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('geo.delete');
});

// Rutas para los elementos Autor
Route::prefix('autor')->group(function () {
    Route::redirect('/', '/autor', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', [AutorController::class, 'index'])
                    ->name('autor.index');

    // Crear un elemento
    Route::post('/', [AutorController::class, 'store'])
                    ->middleware('auth')
                    ->name('autor.store');

    // Mostrar un elemento
    Route::get('/{autor}', [AutorController::class, 'show'])
                    ->name('autor.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{autor}', [AutorController::class, 'edit'])
                    ->middleware('auth')
                    ->name('autor.edit');

    // Guardar un elemento editado
    Route::post('/edit/{autor}', [AutorController::class, 'update'])
                    ->middleware('auth')
                    ->name('autor.update');

    // Borrar un elemento
    Route::delete('/delete/{autor}', [AutorController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('autor.delete');
});

// Rutas para los elementos Mapa
Route::prefix('mapa')->group(function () {
    Route::redirect('/', '/mapa', 301);

    // Mostrar formulario para crear elemento
    // Mostrar a continuación los elementos ya creados
    Route::get('/', [MapaController::class, 'index'])
                    ->name('mapa.index');

    // Crear un elemento
    Route::post('/', [MapaController::class, 'store'])
                    ->middleware('auth')
                    ->name('mapa.store');

    // Mostrar un elemento
    Route::get('/{mapa}', [MapaController::class, 'show'])
                    ->name('mapa.show');

    // Mostrar el formulario de edición de un elemento
    Route::get('/edit/{mapa}', [MapaController::class, 'edit'])
                    ->middleware('auth')
                    ->name('mapa.edit');

    // Guardar un elemento editado
    Route::post('/edit/{mapa}', [MapaController::class, 'update'])
                    ->middleware('auth')
                    ->name('mapa.update');

    // Borrar un elemento
    Route::delete('/delete/{mapa}', [MapaController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('mapa.delete');
});

require __DIR__.'/auth.php';
