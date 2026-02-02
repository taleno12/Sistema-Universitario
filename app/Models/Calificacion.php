<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificacions';

    protected $fillable = [
        'matricula_id',
        'nota_parcial',
        'nota_final',
        'estado'
    ];

    /**
     * Una calificación pertenece a una matrícula.
     */
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }

    /**
     * Atributo dinámico para obtener la nota definitiva.
     * Útil para el PDF del Kardex.
     */
    public function getNotaDefinitivaAttribute()
    {
        // Sumamos parcial y final (ajusta la lógica si usas promedios)
        return $this->nota_parcial + $this->nota_final;
    }
}