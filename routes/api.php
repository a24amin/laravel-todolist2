<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController; // Importante: carpeta Api
use App\Http\Controllers\Api\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Esto crea automáticamente todas las rutas con el prefijo /api
Route::apiResource('categories', CategoryController::class);
Route::get('categories/{category}/tasks', [CategoryController::class, 'tasks']);
Route::apiResource('tasks', TaskController::class);