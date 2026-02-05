<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título
            $table->text('description')->nullable(); // Descripción opcional
            $table->boolean('is_done')->default(false); // Estado (hecho o no)
            
            // Relación: Una tarea pertenece a una categoría
            // Si borras la categoría, se borran sus tareas (cascade)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};