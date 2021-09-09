<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', function () {
    return view('dashboard.dashboard');
});

//ruta a la vista de registro
Route::resource('registro', 'App\Http\Controllers\ProspectosController');
//ruta para registrar al prospecto
Route::post('clientProspecto','App\Http\Controllers\ProspectosController@store')->name('clientProspecto');
//ruta a la vista de listado de prospectos
Route::get('listado', [App\Http\Controllers\ProspectosController::class, 'listado'])->name('listado');
//ruta a la vista de visualizar la informacion del prospecto seleccionado
Route::get('verProspecto/{id}', [App\Http\Controllers\ProspectosController::class, 'show'])->name('verProspecto');
//ruta a autorizar prospecto regresandolo al listado
Route::post('autorizarProspecto','App\Http\Controllers\ProspectosController@update')->name('autorizarProspecto');
//ruta a rechazar prospecto regresandolo al listado
Route::post('observacionRechazar','App\Http\Controllers\ProspectosController@observacionRechazar')->name('observacionRechazar');
