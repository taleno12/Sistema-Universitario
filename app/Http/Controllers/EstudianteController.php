<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Facultade;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    /**
     * Muestra el listado con buscador y paginación.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $estudiantes = Estudiante::with('facultad')
            ->where('nombre', 'like', "%$search%")
            ->paginate(10);

        return view('estudiantes.index', compact('estudiantes', 'search'));
    }

    /**
     * Muestra el formulario de registro.
     */
    public function create()
    {
        $facultades = Facultade::all();
        return view('estudiantes.create', compact('facultades'));
    }

    /**
     * Guarda un nuevo estudiante y su fotografía.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:estudiantes,correo',
            'fecha_nacimiento' => 'required|date',
            'facultad_id' => 'required|exists:facultades,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nombreFoto = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('estudiantes', $nombreFoto, 'public');
            $data['foto'] = $path;
        }

        Estudiante::create($data);

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante registrado correctamente.');
    }

    /**
     * Muestra los detalles de un estudiante.
     */
    public function show($id)
    {
        $estudiante = Estudiante::with('facultad')->findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $facultades = Facultade::all();
        return view('estudiantes.edit', compact('estudiante', 'facultades'));
    }

    /**
     * Actualiza los datos y gestiona el reemplazo de la foto.
     */
    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:estudiantes,correo,' . $id,
            'fecha_nacimiento' => 'required|date',
            'facultad_id' => 'required|exists:facultades,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($estudiante->foto) {
                Storage::disk('public')->delete($estudiante->foto);
            }

            $file = $request->file('foto');
            $nombreFoto = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('estudiantes', $nombreFoto, 'public');
            $data['foto'] = $path;
        }

        $estudiante->update($data);

        return redirect()->route('estudiantes.index')
            ->with('success', 'Datos del estudiante actualizados correctamente.');
    }

    /**
     * Elimina al estudiante y su archivo de imagen.
     */
    public function destroy($id)
    {
        $estudiante = Estudiante::findOrFail($id);

        if ($estudiante->foto) {
            Storage::disk('public')->delete($estudiante->foto);
        }

        $estudiante->delete();

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante y fotografía eliminados.');
    }

    /**
     * Genera el reporte PDF de la lista general.
     */
    public function exportPdf()
    {
        $estudiantes = Estudiante::with('facultad')->get();
        $pdf = Pdf::loadView('estudiantes.pdf', compact('estudiantes'));
        return $pdf->download('reporte-estudiantes.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | MÉTODOS PARA KARDEX ACADÉMICO
    |--------------------------------------------------------------------------
    */

    /**
     * Muestra la lista de estudiantes para seleccionar el Kardex.
     */
    public function kardexIndex(Request $request)
    {
        $search = $request->input('search');
        $estudiantes = Estudiante::with('facultad')
            ->when($search, function($query) use ($search) {
                $query->where('nombre', 'like', "%$search%");
            })
            ->paginate(10);

        return view('reportes.kardex_index', compact('estudiantes', 'search'));
    }

    /**
     * Genera el Kardex (Historial de Notas) en PDF.
     */
    public function generarKardex($id)
    {
        // ✅ CORRECCIÓN DE RELACIONES:
        // Como 'calificaciones' no tiene 'asignatura', cargamos a través de 'matricula'.
        $estudiante = Estudiante::with([
            'facultad', 
            'matriculas.asignatura', 
            'calificaciones.matricula.asignatura' 
        ])->findOrFail($id);

        $pdf = Pdf::loadView('reportes.kardex_pdf', compact('estudiante'));
        
        return $pdf->stream('Kardex_' . $estudiante->nombre . '.pdf');
    }
}