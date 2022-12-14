<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActividadesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** Inicio de sesión */
Route::post('/login', [LoginController::class, 'login']);

/** Registro de usuario */
Route::post('/registro', [LoginController::class, 'registro']);

/** Listar actividades */
Route::get('/getActividades/{idUser}', [ActividadesController::class, 'getActividades']);

/** Registrar una actividad con las respectivos tiempos asignados */
Route::post('/agregarActividad/{idUser}', [ActividadesController::class, 'agregarActividad']);