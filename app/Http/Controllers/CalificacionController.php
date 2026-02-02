<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Calificacion;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::with(['estudiante', 'asignatura', 'carrera', 'calificacion'])
            ->latest()
            ->get();
            
        return view('calificaciones.index', compact('matriculas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricula_id' => 'required|exists:matriculas,id',
            'nota_final' => 'nullable|numeric|min:0|max:100',
        ]);

        Calificacion::updateOrCreate(
            ['matricula_id' => $request->matricula_id],
            [
                'nota_final' => $request->nota_final ?? 0,
                'estado' => ($request->nota_final >= 60) ? 'Aprobado' : 'Reprobado'
            ]
        );

        return redirect()->back()->with('success', 'Calificación procesada.');
    }

    public function show(string $id)
    {
        $matricula = Matricula::with(['estudiante', 'asignatura', 'calificacion'])->findOrFail($id);
        return view('calificaciones.show', compact('matricula'));
    }

    public function destroy(string $id)
    {
        // ✅ CORREGIDO: Usamos el nombre del Modelo correctamente
        $calificacion = Calificacion::findOrFail($id);
        $calificacion->delete();
        
        return back()->with('success', 'Nota eliminada.');
    }
}