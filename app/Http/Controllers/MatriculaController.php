<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Estudiante;
use App\Models\Asignatura;
use App\Models\Carrera;
use Illuminate\Http\Request;
// Importamos la fachada de PDF para la generación de reportes
use Barryvdh\DomPDF\Facade\Pdf;

class MatriculaController extends Controller
{
    /**
     * Listado principal con buscador y paginación optimizada.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Cargamos relaciones para evitar el problema N+1 y mejorar el rendimiento
        $matriculas = Matricula::with(['estudiante', 'asignatura', 'carrera'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('estudiante', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                      ->orWhere('apellido', 'like', "%{$search}%");
                })->orWhereHas('asignatura', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                })->orWhereHas('carrera', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('matriculas.index', compact('matriculas', 'search'));
    }

    /**
     * Formulario de creación de matrícula.
     */
    public function create()
    {
        $estudiantes = Estudiante::orderBy('nombre')->get();
        $asignaturas = Asignatura::orderBy('nombre')->get();
        $carreras = Carrera::orderBy('nombre')->get();
        
        return view('matriculas.create', compact('estudiantes', 'asignaturas', 'carreras'));
    }

    /**
     * Guardar nueva matrícula con validación estricta.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'carrera_id'    => 'required|exists:carreras,id',
            'periodo'       => 'required|string|max:50',
        ]);

        try {
            Matricula::create([
                'estudiante_id'   => $request->estudiante_id,
                'asignatura_id'   => $request->asignatura_id,
                'carrera_id'      => $request->carrera_id,
                'periodo'         => $request->periodo,
                'fecha_matricula' => now(),
                'estado'          => 'activo',
            ]);
            
            return redirect()->route('matriculas.index')
                ->with('success', '¡Estudiante matriculado con éxito en KT&U!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al procesar la matrícula: ' . $e->getMessage());
        }
    }

    /**
     * Ver detalles detallados de una matrícula.
     */
    public function show($id)
    {
        $matricula = Matricula::with(['estudiante', 'asignatura', 'carrera'])->findOrFail($id);
        return view('matriculas.show', compact('matricula'));
    }

    /**
     * Formulario de edición.
     */
    public function edit($id)
    {
        $matricula = Matricula::findOrFail($id);
        $estudiantes = Estudiante::orderBy('nombre')->get();
        $asignaturas = Asignatura::orderBy('nombre')->get();
        $carreras = Carrera::orderBy('nombre')->get();
        
        return view('matriculas.edit', compact('matricula', 'estudiantes', 'asignaturas', 'carreras'));
    }

    /**
     * Actualizar registro con protección de datos (Mass Assignment Protection).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'carrera_id'    => 'required|exists:carreras,id',
            'periodo'       => 'required|string|max:50',
        ]);

        try {
            $matricula = Matricula::findOrFail($id);
            // Solo actualizamos los campos permitidos
            $matricula->update($request->only([
                'estudiante_id', 
                'asignatura_id', 
                'carrera_id', 
                'periodo'
            ]));
            
            return redirect()->route('matriculas.index')
                ->with('success', 'La matrícula se ha actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un problema al actualizar: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar registro de matrícula.
     */
    public function destroy($id)
    {
        try {
            Matricula::findOrFail($id)->delete();
            return redirect()->route('matriculas.index')
                ->with('success', 'Matrícula eliminada del sistema.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo eliminar el registro solicitado.');
        }
    }

    /**
     * PDF 1: Exportar COMPROBANTE INDIVIDUAL para el estudiante.
     */
    public function generarPdf($id)
    {
        $matricula = Matricula::with(['estudiante', 'asignatura', 'carrera'])->findOrFail($id);
        
        // Vista específica para un recibo formal
        $pdf = Pdf::loadView('matriculas.pdf_individual', compact('matricula'));
        
        $fileName = 'Comprobante_' . str_replace(' ', '_', $matricula->estudiante->nombre) . '.pdf';
        
        return $pdf->download($fileName);
    }

    /**
     * PDF 2: Exportar REPORTE GENERAL de todas las matrículas (Tabla completa).
     */
    public function reporteGeneral()
    {
        $matriculas = Matricula::with(['estudiante', 'asignatura', 'carrera'])->latest()->get();
        $fecha = now()->format('d/m/Y H:i');
        
        // Vista optimizada para formato horizontal o tabla larga
        $pdf = Pdf::loadView('matriculas.reporte_general', compact('matriculas', 'fecha'))
                  ->setPaper('letter', 'landscape'); // Horizontal para que quepa la tabla
        
        return $pdf->stream('Reporte_General_Matriculas_KTU.pdf');
    }
}