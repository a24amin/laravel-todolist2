<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id']; // Permite guardar datos

    public function category() {
        return $this->belongsTo(Category::class); // Una tarea pertenece a una categoría
    }
}
