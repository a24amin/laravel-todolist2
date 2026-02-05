<?php

namespace App\Http\Controllers\Api; // <--- Fíjate que ahora dice "Api"

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string'
        ]);
        $category = Category::create($validated);
        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        // Validación: No borrar si tiene tareas
        if ($category->tasks()->exists()) {
            return response()->json(['error' => 'No se puede eliminar: tiene tareas.'], 422);
        }
        $category->delete();
        return response()->json(null, 204);
    }

    // Método extra para obtener las tareas de una categoría concreta
    public function tasks(Category $category)
    {
        return TaskResource::collection($category->tasks);
    }
}