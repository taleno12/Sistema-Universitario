<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    // Forzamos el nombre de la tabla que ya migramos con éxito
    protected $table = 'horarios';

    protected $fillable = [
        'asignatura_id',
        'profesor_id',
        'dia',
        'hora_inicio',
        'hora_fin',
        'aula',
        'estado'
    ];

    /**
     * Relación con Asignatura
     */
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    /**
     * Relación con Profesor (Donde guardamos la foto)
     */
    public function profesor()
    {
        // Usamos 'profesor_id' porque así quedó en la migración final
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }
}