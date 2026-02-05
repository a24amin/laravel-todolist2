<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Campos que permitimos rellenar
    protected $fillable = ['title', 'description', 'is_done', 'category_id'];

    // Relación: Una tarea pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}