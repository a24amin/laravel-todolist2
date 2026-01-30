<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category; // <--- Importante
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Guardar tarea
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required'
        ]);
        
        Task::create($request->all());
        return redirect()->back()->with('success', 'Tasca creada correctament!');
    }

    // Borrar tarea
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Tasca eliminada!');
    }

    // MOSTRAR FORMULARIO DE EDICIÓN (NUEVO)
    public function edit(Task $task)
    {
        $categories = Category::all(); // Necesitamos las categorías para el desplegable
        return view('tasks.edit', compact('task', 'categories'));
    }

    // ACTUALIZAR EN BASE DE DATOS (NUEVO)
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required'
        ]);

        $task->update($request->all());
        return redirect()->route('home')->with('success', 'Tasca actualitzada!');
    }
}