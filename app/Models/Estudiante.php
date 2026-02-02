<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'correo', 
        'fecha_nacimiento', 
        'facultad_id', 
        'foto' 
    ];

    public function facultad()
    {
        return $this->belongsTo(Facultade::class, 'facultad_id');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'estudiante_id');
    }

    /**
     * ✅ RELACIÓN CORREGIDA:
     * Usamos hasManyThrough porque la calificación NO conoce al estudiante,
     * pero la Matrícula conoce a ambos.
     */
    public function calificaciones()
    {
        return $this->hasManyThrough(
            Calificacion::class,
            Matricula::class,
            'estudiante_id', // Llave foránea en tabla matriculas
            'matricula_id',  // Llave foránea en tabla calificacions
            'id',            // Llave local en tabla estudiantes
            'id'             // Llave local en tabla matriculas
        );
    }

    /**
     * Atributo para el promedio usando las notas de la tabla correcta.
     * He ajustado el campo a 'nota_final' que es el que tienes en tu DB.
     */
    public function getPromedioAttribute()
    {
        return $this->calificaciones()->avg('nota_final') ?: 0;
    }
}