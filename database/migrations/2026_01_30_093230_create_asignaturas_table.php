<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('creditos');
            
            // ✅ Relación con la tabla 'carreras'
            // Asegúrate de que la tabla 'carreras' se cree ANTES que esta
            $table->foreignId('carrera_id')
                  ->constrained('carreras') 
                  ->onDelete('cascade');
                  
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaturas');
    }
};