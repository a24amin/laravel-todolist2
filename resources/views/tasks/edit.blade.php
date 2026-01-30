<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    
    <h2>Editar Tarea</h2>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf 
        @method('PUT')

        <p>
            <label>Título de la tarea:</label><br>
            <input type="text" name="title" value="{{ $task->title }}" required style="width: 300px;">
        </p>

        <p>
            <label>Categoría:</label><br>
            <select name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Guardar Cambios</button>
        <a href="{{ route('home') }}">Cancelar</a>
    </form>

</body>
</html>