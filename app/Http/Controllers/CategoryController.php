<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Muestra la lista de categorías y sus tareas
    public function index()
    {
        $categories = Category::with('tasks')->get();
        return view('categories.index', compact('categories'));
    }

    // Guarda una nueva categoría
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create($request->all());
        return redirect()->route('home');
    }

    // Elimina una categoría
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('home');
    }
}