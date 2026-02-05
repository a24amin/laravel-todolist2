<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Campos que permitimos rellenar
    protected $fillable = ['name', 'color'];

    // Relación: Una categoría tiene muchas tareas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}