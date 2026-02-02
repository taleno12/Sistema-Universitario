<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf; // ✅ Importante para el PDF

class AsignaturaController extends Controller
{
    /**
     * Lista las asignaturas con búsqueda por nombre de asignatura O carrera.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $asignaturas = Asignatura::with('carrera')
            ->when($search, function ($query, $search) {
                return $query->where('nombre', 'like', "%{$search}%")
                    ->orWhereHas('carrera', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    });
            })
            ->latest() // ✅ Ordenar por las más recientes
            ->paginate(10);

        return view('asignaturas.index', compact('asignaturas', 'search'));
    }

    /**
     * Exportar Plan de Estudios a PDF
     */
    public function exportPdf()
    {
        // Cargamos relaciones para evitar errores en la vista PDF
        $asignaturas = Asignatura::with('carrera')->orderBy('carrera_id')->get();
        
        $pdf = Pdf::loadView('asignaturas.pdf', compact('asignaturas'));
        
        // Opcional: Configurar tamaño de papel
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Plan_Estudios_KTU_' . now()->format('d-m-Y') . '.pdf');
    }

    public function create()
    {
        $carreras = Carrera::orderBy('nombre')->get();
        return view('asignaturas.create', compact('carreras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:255',
            'creditos'   => 'required|integer|min:1|max:10',
            'carrera_id' => 'required|exists:carreras,id',
        ]);

        try {
            Asignatura::create($request->all());
            return redirect()->route('asignaturas.index')
                ->with('success', 'Asignatura creada correctamente.');
        } catch (\Exception $e) {
            Log::error("Error al crear asignatura: " . $e->getMessage());
            return back()->withInput()->with('error', 'Error al guardar la asignatura.');
        }
    }

    public function edit($id)
    {
        $asignatura = Asignatura::findOrFail($id);
        $carreras = Carrera::orderBy('nombre')->get();
        return view('asignaturas.edit', compact('asignatura', 'carreras'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'     => 'required|string|max:255',
            'creditos'   => 'required|integer|min:1|max:10',
            'carrera_id' => 'required|exists:carreras,id',
        ]);

        try {
            $asignatura = Asignatura::findOrFail($id);
            $asignatura->update($request->all());

            return redirect()->route('asignaturas.index')
                ->with('success', 'Asignatura actualizada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo actualizar la asignatura.');
        }
    }

    public function destroy($id)
    {
        $asignatura = Asignatura::findOrFail($id);
        
        // Verificación de integridad: Evita borrar materias con alumnos
        if ($asignatura->matriculas()->count() > 0) {
            return redirect()->route('asignaturas.index')
                ->with('error', 'Acción denegada: La asignatura tiene registros de matrícula vinculados.');
        }

        $asignatura->delete();
        return redirect()->route('asignaturas.index')
            ->with('success', 'Asignatura eliminada del plan de estudios.');
    }
}