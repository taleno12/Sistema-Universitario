<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();
            
            // Llave foránea que conecta con la matrícula
            $table->foreignId('matricula_id')
                  ->constrained('matriculas')
                  ->onDelete('cascade'); 
            
            $table->decimal('nota_parcial', 5, 2)->default(0);
            $table->decimal('nota_final', 5, 2)->default(0);
            $table->string('estado')->default('Pendiente'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};