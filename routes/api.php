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
Route::get('getListado', [App\Http\Controllers\ApiController::class, 'getListado'])->name('getListado');
//obtener informacion del prospecto registrado
Route::get('getProspecto/{id}', [App\Http\Controllers\ApiController::class, 'getProspecto'])->name('getProspecto');
//ruta para registrar el prospecto
Route::post('registroProspecto', [App\Http\Controllers\ApiController::class, 'registroProspecto'])->name('registroProspecto');
//ruta para guardar las imagenes del prospecto
Route::post('uploadImg/{id}', [App\Http\Controllers\ApiController::class, 'uploadImg'])->name('uploadImg');
//ruta para autorizar el prospecto
Route::post('prospectoAutorizado', [App\Http\Controllers\ApiController::class, 'putUpdate'])->name('prospectoAutorizado');
//ruta para rechazar el prospecto
Route::post('prospectoRechazado', [App\Http\Controllers\ApiController::class, 'postObservacionRechazar'])->name('prospectoRechazado');
