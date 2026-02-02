<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage; // Importante para la foto

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto', // ✅ Agregado: Permitir guardar la ruta de la foto
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
    |--------------------------------------------------------------------------
    | Integración con AdminLTE (Solución Premium)
    |--------------------------------------------------------------------------
    */

    /**
     * Retorna la URL de la imagen de perfil real del usuario.
     */
    public function adminlte_image()
    {
        // Si el usuario tiene una foto subida, la mostramos. 
        // Si no, mostramos una imagen por defecto local.
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }

        return asset('img/default-user.png'); 
    }

    /**
     * Retorna una descripción corta debajo del nombre del usuario.
     */
    public function adminlte_desc()
    {
        return 'Administrador del Sistema KT&U';
    }

    /**
     * Retorna la URL de la página de perfil.
     */
    public function adminlte_profile_url()
    {
        return route('profile'); // Usamos el nombre de la ruta de Breeze/AdminLTE
    }
}