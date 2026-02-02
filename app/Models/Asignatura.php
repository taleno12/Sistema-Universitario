<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'creditos', 'carrera_id'];

    // Relación con Carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    // Relación con Matrículas
    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}