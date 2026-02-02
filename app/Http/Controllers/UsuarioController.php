<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Lista todos los usuarios con buscador profesional.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $usuarios = Usuario::when($search, function($query) use ($search) {
                $query->where('nombre', 'like', "%$search%");
            })
            ->paginate(10);

        return view('usuarios.index', compact('usuarios', 'search'));
    }

    /**
     * Formulario para crear nuevos usuarios.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Guarda el usuario y procesa la foto de perfil.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('usuarios', 'public');
        }

        Usuario::create($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Muestra el formulario de edición por ID.
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Actualiza datos y gestiona el reemplazo de la foto antigua.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'password' => 'nullable|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['password']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($usuario->foto) { 
                Storage::disk('public')->delete($usuario->foto); 
            }
            $data['foto'] = $request->file('foto')->store('usuarios', 'public');
        }

        $usuario->update($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina al usuario y limpia el almacenamiento de su foto.
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        if ($usuario->foto) { 
            Storage::disk('public')->delete($usuario->foto); 
        }
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }

    /* |--------------------------------------------------------------------------
    | ÁREA DE SEGURIDAD (Gestión de Credenciales)
    |--------------------------------------------------------------------------
    */

    /**
     * Muestra la vista de configuración de seguridad.
     */
    public function seguridad()
    {
        $usuario = Auth::user(); 
        return view('usuarios.seguridad', compact('usuario'));
    }

    /**
     * Procesa el cambio de contraseña.
     */
    public function updateSeguridad(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'password_actual' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ], [
            'password_actual.current_password' => 'La contraseña actual no es correcta.',
            'password.confirmed' => 'La confirmación de la nueva contraseña no coincide.'
        ]);

        // Usamos forceFill y save para evitar errores de "método no definido"
        $user->forceFill([
            'password' => Hash::make($request->password)
        ])->save();

        return back()->with('success', '¡Excelente! Tu contraseña ha sido actualizada.');
    }
}