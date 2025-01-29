<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\HistorialMovimientosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('auth/register',[AuthController::class,'create']);
Route::post('auth/login',[AuthController::class,'login']);
Route::post('auth/reset-password',[AuthController::class,'resetPassword']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('auth/logout',[AuthController::class,'logout']);
    Route::put('auth/changePassword',[AuthController::class,'changePassword']);
    Route::resource('/productos',ProductoController::class);
    Route::resource('/pedidos',PedidoController::class);
    Route::put('/pedidos/change-status/{id}',[PedidoController::class,'changeStatus']);
    Route::get('/historial',[HistorialMovimientosController::class,'index']);
});



