<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Asignatura;
use App\Models\Profesor; 
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HorarioController extends Controller
{
    /**
     * Listado lineal de horarios (Tabla estándar).
     */
    public function index()
    {
        // Cargamos las relaciones para mostrar nombres y fotos de los docentes
        $horarios = Horario::with(['asignatura', 'profesor'])->get();
        return view('horarios.index', compact('horarios'));
    }

    /**
     * Vista de Horario Semanal en formato de Cuadrícula (Calendario).
     */
    public function esquemaSemanal()
    {
        $horarios = Horario::with(['asignatura', 'profesor'])->get();
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        
        $horas = [
            '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', 
            '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00'
        ];

        return view('horarios.esquema', compact('horarios', 'dias', 'horas'));
    }

    /**
     * Generar y descargar el Horario en formato PDF.
     */
    public function descargarPdf()
    {
        $horarios = Horario::with(['asignatura', 'profesor'])->get();
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        $horas = [
            '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', 
            '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00'
        ];

        $pdf = Pdf::loadView('horarios.pdf', compact('horarios', 'dias', 'horas'))
                  ->setPaper('letter', 'landscape');

        return $pdf->stream('Horario_Semanal_KTU.pdf');
    }

    /**
     * Formulario de creación.
     * Corregido: Eliminado el orderBy('nombre') que causaba el crash.
     */
    public function create()
    {
        // Usamos all() para evitar errores si las columnas de nombre varían
        $asignaturas = Asignatura::all();
        $profesores = Profesor::all(); 
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        
        return view('horarios.create', compact('asignaturas', 'profesores', 'dias'));
    }

    /**
     * Guardar el horario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asignatura_id' => 'required|exists:asignaturas,id',
            'profesor_id'   => 'required|exists:profesors,id',
            'dia'           => 'required',
            'hora_inicio'   => 'required',
            'hora_fin'      => 'required',
        ]);

        try {
            Horario::create($request->all());

            return redirect()->route('horarios.index')
                ->with('success', 'Horario asignado correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar registro de horario.
     */
    public function destroy($id)
    {
        try {
            Horario::findOrFail($id)->delete();
            return back()->with('success', 'Horario eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo eliminar el registro.');
        }
    }
}