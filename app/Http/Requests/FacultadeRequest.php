<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacultadeRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta petición.
     */
    public function authorize(): bool
    {
        // Permite que cualquier usuario autenticado pueda usar este request
        return true; 
    }

    /**
     * Reglas de validación que aplican a la petición.
     */
    public function rules(): array
    {
        // Obtenemos el modelo Facultade desde la ruta (si existe)
        $facultade = $this->route('facultade');
        $facultadeId = $facultade ? $facultade->id : null;

        return [
            // Campo nombre:
            // - Obligatorio
            // - Texto
            // - Máximo 100 caracteres
            // - Único en la tabla facultades, ignorando el registro actual si estamos editando
            'nombre' => 'required|string|max:100|unique:facultades,nombre,' . $facultadeId,

            // Campo descripción:
            // - Obligatorio
            // - Texto
            'descripcion' => 'required|string',
        ];
    }
}
