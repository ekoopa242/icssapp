<?php

use App\Http\Livewire\Clientes;
use App\Http\Livewire\Codigoclientes;
use App\Http\Livewire\Empleados;
use App\Http\Livewire\Equipos;
use App\Http\Livewire\Home;
use App\Http\Livewire\Pagos;
use App\Http\Livewire\Plans;
use App\Http\Livewire\Rols;
use App\Http\Livewire\Serviciodatas;
use App\Http\Livewire\Servicios;
use App\Http\Livewire\Test;
use App\Http\Livewire\Usuarios;
use App\Http\Livewire\Velocidads;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['validacion-rol:Administracion']], function () {
        Route::get("/test", Test::class);
        Route::get("/velocidads", Velocidads::class);
        Route::get("/plans", Plans::class);
        Route::get("/serviciodatas", Serviciodatas::class);
        Route::get("/usuarios", Usuarios::class);
        Route::get("/pagos", Pagos::class);

    });

    Route::group(['middleware' => ['validacion-rol:Administracion,Instalacion']], function () {
        Route::get("/servicios", Servicios::class);
        Route::get("/codigoclientes", Codigoclientes::class);
        Route::get("/clientes", Clientes::class);
        Route::get("/equipos", Equipos::class);
    });
});


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
