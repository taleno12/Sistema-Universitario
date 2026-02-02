<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profesors', function (Blueprint $table) {
            $table->id();
            
            // Datos de Identificación y Acceso
            $table->string('codigo')->unique(); // Ej: PRF-0001
            $table->string('dni', 20)->unique();
            
            // Información Personal
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('foto')->nullable(); // Campo para la ruta de la imagen
            
            // Contacto
            $table->string('email')->unique();
            $table->string('telefono', 20)->nullable();
            
            // Perfil Académico y Estado
            $table->string('especialidad');
            $table->enum('grado_academico', ['Licenciado', 'Magíster', 'Doctor'])->default('Licenciado');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            
            // Auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesors');
    }
};