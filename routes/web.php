<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

// Al entrar a la web, nos manda a la lista de categorías
Route::get('/', [CategoryController::class, 'index'])->name('home');

// Rutas para crear y borrar categorías y tareas
Route::resource('categories', CategoryController::class);
Route::resource('tasks', TaskController::class);