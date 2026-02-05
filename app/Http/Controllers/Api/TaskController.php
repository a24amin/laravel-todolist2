<?php

namespace App\Http\Controllers\Api; // <--- Importante: namespace Api

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();
        // Permite filtrar por categoría: /api/tasks?category_id=1
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        return TaskResource::collection($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string'
        ]);
        $task = Task::create($validated);
        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'description' => 'nullable|string',
            'is_done' => 'boolean'
        ]);
        $task->update($validated);
        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}