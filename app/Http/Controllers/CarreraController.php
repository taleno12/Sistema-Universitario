<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;
use App\Models\Facultade;
use Barryvdh\DomPDF\Facade\Pdf; // Importación para el PDF

class CarreraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Cargamos la relación 'facultade' para evitar el problema N+1 y optimizar
        $carreras = Carrera::with('facultade')
            ->when($search, function ($query, $search) {
                return $query->where('nombre', 'like', "%{$search}%")
                             ->orWhereHas('facultade', function($q) use ($search) {
                                 $q->where('nombre', 'like', "%{$search}%");
                             });
            })
            ->latest()
            ->paginate(10);

        return view('carreras.index', compact('carreras', 'search'));
    }

    public function create()
    {
        $facultades = Facultade::orderBy('nombre')->get();
        return view('carreras.create', compact('facultades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:carreras,nombre|max:255',
            'facultade_id' => 'required|exists:facultades,id'
        ]);

        try {
            Carrera::create($request->all());
            return redirect()->route('carreras.index')->with('success', 'Carrera registrada exitosamente en el sistema.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al guardar la carrera.');
        }
    }

    public function edit($id)
    {
        $carrera = Carrera::findOrFail($id);
        $facultades = Facultade::orderBy('nombre')->get();
        return view('carreras.edit', compact('carrera', 'facultades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:carreras,nombre,'.$id,
            'facultade_id' => 'required|exists:facultades,id'
        ]);

        $carrera = Carrera::findOrFail($id);
        $carrera->update($request->all());

        return redirect()->route('carreras.index')->with('success', 'Información de la carrera actualizada.');
    }

    public function destroy($id)
    {
        try {
            $carrera = Carrera::findOrFail($id);
            $carrera->delete();
            return redirect()->route('carreras.index')->with('success', 'Carrera eliminada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se puede eliminar: existen registros vinculados a esta carrera.');
        }
    }

    /**
     * Exportar listado de carreras a PDF
     */
    public function exportPdf()
    {
        $carreras = Carrera::with('facultade')->get();
        $pdf = Pdf::loadView('carreras.pdf', compact('carreras'));
        
        return $pdf->download('Listado_Carreras_KTU.pdf');
    }
}