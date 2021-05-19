<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\WireAdministracion;
use App\Http\Livewire\WireAmbito;
use App\Http\Livewire\WireEstado;
use App\Http\Livewire\WireAutor;
use App\Http\Livewire\WireGeo;
use App\Http\Livewire\WireMapa;

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

Route::get('administracion', WireAdministracion::class);

Route::get('ambito', WireAmbito::class);

Route::get('estado', WireEstado::class);

Route::get('autor', WireAutor::class);

Route::get('geo', WireGeo::class);

Route::get('mapa', WireMapa::class);
