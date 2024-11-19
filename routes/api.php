<?php
namespace App\Http\Controllers;

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


//Route::get('/municipio/{id}', [HomeController::class, 'obtenerMunicipio']);

Route::get('/munSolicitante/{id}', [SeerController::class, 'obtenerMunicipio']);
Route::get('/munCitado/{id}', [SeerController::class, 'obtenerMunicipio']);

//Route::get('/local/{id}/niveles', [DistritoLocalController::class, 'obtenerLocal']);
//Route::get('/seccion/{id}/niveles', [SeccionController::class, 'obtenerSeccion']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
