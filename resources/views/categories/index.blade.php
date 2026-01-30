<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ToDo App</title>
    <style>
        /* Estilos básicos para que no se vea roto, pero sí simple */
        body { font-family: sans-serif; padding: 20px; }
        .mensaje { color: green; font-weight: bold; padding: 10px; border: 1px solid green; margin-bottom: 10px; }
        .caja-categoria { border: 1px solid #000; padding: 10px; margin-bottom: 20px; background: #f9f9f9; }
        .tarea { border-bottom: 1px solid #ccc; padding: 5px 0; display: flex; justify-content: space-between; }
        button { cursor: pointer; }
    </style>
</head>
<body>
    <h1>Gestor de Tareas</h1>

    @if (session('success'))
        <div class="mensaje">{{ session('success') }}</div>
    @endif

    <div style="margin-bottom: 20px;">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <label>Nueva Categoría:</label>
            <input type="text" name="name" required placeholder="Nombre categoría...">
            <button type="submit">Agregar</button>
        </form>
    </div>

    <hr>

    @foreach ($categories as $category)
        <div class="caja-categoria">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; color: #333;">{{ $category->name }}</h2>
                
                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Seguro? Se borrarán las tareas dentro.');">
                    @csrf @method('DELETE')
                    <button style="color: red;">Eliminar Categoría</button>
                </form>
            </div>

            <ul>
                @foreach ($category->tasks as $task)
                    <li class="tarea">
                        <span>{{ $task->title }}</span>
                        <div>
                            <a href="{{ route('tasks.edit', $task) }}">[Editar]</a>
                            
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit">X</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div style="margin-top: 10px;">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="text" name="title" required placeholder="Nueva tarea aqui...">
                    <button type="submit">+</button>
                </form>
            </div>
        </div>
    @endforeach
</body>
</html>