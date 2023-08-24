<?php

use App\Http\Controllers\ApiPedidoController;
use App\Http\Controllers\InsumoApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Insumos
Route::apiResource('insumos', InsumoApiController::class);
Route::apiResource('pedidos', ApiPedidoController::class);
