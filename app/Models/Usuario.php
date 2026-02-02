<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'foto'
    ];

    protected $hidden = [
        'password',
    ];

    // Esto asegura que Laravel maneje la seguridad de la contraseña automáticamente
    protected $casts = [
        'password' => 'hashed',
    ];
}