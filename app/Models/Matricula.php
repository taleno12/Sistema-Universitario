<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $fillable = [
        'estudiante_id', 
        'asignatura_id', 
        'carrera_id', 
        'periodo', 
        'fecha_matricula', 
        'estado'
    ];

    /**
     * ✅ RELACIÓN QUE FALTABA:
     * Conecta con el sistema de notas para que el CalificacionController funcione.
     */
    public function calificacion()
    {
        return $this->hasOne(Calificacion::class, 'matricula_id');
    }

    // Relaciones para mostrar nombres en la tabla
    public function estudiante() { return $this->belongsTo(Estudiante::class); }
    public function asignatura() { return $this->belongsTo(Asignatura::class); }
    public function carrera()    { return $this->belongsTo(Carrera::class); }
}