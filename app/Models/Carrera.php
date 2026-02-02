<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Asignatura;


class Carrera extends Model
{
    use HasFactory;

    // ✅ Ajustado a 'facultade_id' para que coincida con tu migración
    protected $fillable = ['nombre', 'descripcion', 'facultade_id'];

    // ✅ Ajustado a 'Facultade' (con E) para que coincida con tu otro modelo
    public function facultade()
    {
        return $this->belongsTo(Facultade::class, 'facultade_id');
    }

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}