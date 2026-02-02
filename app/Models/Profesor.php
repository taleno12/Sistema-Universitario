<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesors';
    protected $guarded = []; // Esto es clave para que deje guardar todo lo que enviamos en $data
}