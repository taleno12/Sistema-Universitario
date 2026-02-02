<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::dropIfExists('horarios');

        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('asignatura_id');
            $table->unsignedBigInteger('profesor_id');
            
            $table->string('dia'); 
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('aula')->nullable();
            $table->string('estado')->default('activo');
            $table->timestamps();

            // Referencia exacta a la tabla creada en tu log: 'profesors'
            $table->foreign('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade');
            $table->foreign('profesor_id')->references('id')->on('profesors')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('horarios');
    }
};