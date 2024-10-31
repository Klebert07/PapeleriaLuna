<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\VentaController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\InventarioController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\ClienteController;

// Rutas públicas
Route::post('login', [LoginController::class, 'store']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Ruta de logout
    Route::post('logout', [LoginController::class, 'logout']);

    // Recursos de API
    Route::apiResource('productos', ProductoController::class);
    Route::apiResource('inventario', InventarioController::class);
    Route::apiResource('ventas', VentaController::class);
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('empleados', EmpleadoController::class); // Cambiado a plural para consistencia
    
    // Ruta opcional para obtener usuario actual
   /* Route::get('/user', function (Request $request) {
        return $request->user();
    });*/
});