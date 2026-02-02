<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 
use Illuminate\Support\Facades\Storage;

class ProfesorController extends Controller
{
    /**
     * Muestra el listado con buscador y paginación.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $profesores = Profesor::where('nombres', 'like', "%$search%")
            ->orWhere('apellidos', 'like', "%$search%")
            ->orWhere('dni', 'like', "%$search%")
            ->paginate(10);

        return view('profesores.index', compact('profesores', 'search'));
    }

    /**
     * Muestra el formulario de registro.
     */
    public function create()
    {
        return view('profesores.create');
    }

    /**
     * Guarda un nuevo profesor y su fotografía.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:profesors,dni|max:20',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:profesors,email',
            'especialidad' => 'required',
            'grado_academico' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        // Generación de código automático (Ej: PRF-0001)
        $ultimoId = Profesor::max('id') ?? 0;
        $data['codigo'] = 'PRF-' . str_pad($ultimoId + 1, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nombreFoto = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profesores', $nombreFoto, 'public');
            $data['foto'] = $path;
        }

        Profesor::create($data);

        return redirect()->route('profesores.index')
            ->with('success', 'Docente registrado correctamente en KT&U.');
    }

    /**
     * ✅ AGREGADO: Muestra el perfil detallado del profesor.
     * Esto soluciona el error BadMethodCallException.
     */
    public function show($id)
    {
        $profesor = Profesor::findOrFail($id);
        return view('profesores.show', compact('profesor'));
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit($id)
    {
        $profesor = Profesor::findOrFail($id);
        return view('profesores.edit', compact('profesor'));
    }

    /**
     * Actualiza los datos y gestiona el reemplazo de la foto del docente.
     */
    public function update(Request $request, $id)
    {
        $profesor = Profesor::findOrFail($id);

        $request->validate([
            'dni' => 'required|max:20|unique:profesors,dni,' . $id,
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:profesors,email,' . $id,
            'especialidad' => 'required',
            'grado_academico' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Borrar foto anterior si existe en el disco
            if ($profesor->foto) {
                Storage::disk('public')->delete($profesor->foto);
            }

            $file = $request->file('foto');
            $nombreFoto = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profesores', $nombreFoto, 'public');
            $data['foto'] = $path;
        }

        $profesor->update($data);

        return redirect()->route('profesores.index')
            ->with('success', 'Datos del docente actualizados correctamente.');
    }

    /**
     * Elimina al docente y su archivo de imagen física.
     */
    public function destroy($id)
    {
        $profesor = Profesor::findOrFail($id);

        if ($profesor->foto) {
            Storage::disk('public')->delete($profesor->foto);
        }

        $profesor->delete();

        return redirect()->route('profesores.index')
            ->with('success', 'Docente y fotografía eliminados correctamente.');
    }

    /**
     * Generar reporte en PDF.
     */
    public function generarPdf()
    {
        $profesores = Profesor::all();
        $fecha = date('d/m/Y H:i A');

        $pdf = Pdf::loadView('profesores.pdf', compact('profesores', 'fecha'))
                  ->setPaper('a4', 'landscape');
                  
        return $pdf->stream('Reporte_Profesores_KTU.pdf');
    }
}