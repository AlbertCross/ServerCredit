<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


//listado de rutas para consumir los endpoints para la aplicacion movil
//obtener la lista de los prospectos registrados
Route::get('getListado', [App\Http\Controllers\ProspectosController::class, 'getListado'])->name('getListado');
//ruta para autorizar el prospecto
Route::post('prospectoAutorizado', [App\Http\Controllers\ProspectosController::class, 'putUpdate'])->name('prospectoAutorizado');
//ruta para rechazar el prospecto
Route::post('prospectoRechazado', [App\Http\Controllers\ProspectosController::class, 'postObservacionRechazar'])->name('prospectoRechazado');
