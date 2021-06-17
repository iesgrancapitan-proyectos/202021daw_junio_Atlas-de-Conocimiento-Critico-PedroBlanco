<?php

use App\Http\Livewire\Users;
// use App\Http\Livewire\Search;
use App\Http\Livewire\WireGeo;
use App\Http\Livewire\WireMapa;
use App\Http\Livewire\WireAutor;
use App\Http\Livewire\WireAmbito;
use App\Http\Livewire\WireEstado;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\WireAdministracion;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('administracion', WireAdministracion::class)->name('administracion');

Route::get('ambito', WireAmbito::class)->name('ambito');

Route::get('estado', WireEstado::class)->name('estado');

Route::get('autor', WireAutor::class)->name('autor');

Route::get('geo', WireGeo::class)->name('geo');

Route::get('mapa', WireMapa::class)->name('mapa');

// Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
//     return view('livewire.users');
// })->name('livewire.users');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:super', 'prefix' => 'users', 'as' => 'users.'], function () {
        Route::resource('users', Users::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'users', 'as' => 'users.'], function () {
        Route::resource('users', Users::class);
    });
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/users', Users::class)
    ->name('livewire.users');

// Route::get('search', Search::class)->name('search');
