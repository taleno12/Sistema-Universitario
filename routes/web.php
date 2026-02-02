<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacultadeController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\ProfesorController; 
use App\Http\Controllers\CalificacionController; 
use App\Http\Controllers\HorarioController; 
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\UsuarioController; // ✅ Importado correctamente
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Middleware auth y verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // ✅ Dashboards Principales
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    /*
    |----------------------------------------------------------------------
    | GESTIÓN DE SEGURIDAD Y USUARIOS (KT&U Academy)
    |----------------------------------------------------------------------
    */
    // Rutas específicas para el área de seguridad del usuario logueado
    Route::get('/admin/seguridad', [UsuarioController::class, 'seguridad'])->name('usuarios.seguridad');
    Route::put('/admin/seguridad/update', [UsuarioController::class, 'updateSeguridad'])->name('usuarios.seguridad.update');

    // CRUD completo de Usuarios (Index, Create, Store, Edit, Update, Destroy)
    Route::resource('usuarios', UsuarioController::class);

    /*
    |----------------------------------------------------------------------
    | GESTIÓN DE PERFIL (AdminLTE + Foto)
    |----------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/foto', [ProfileController::class, 'updateFoto'])->name('profile.update.foto');

    /*
    |----------------------------------------------------------------------
    | REPORTES PDF Y KARDEX
    |----------------------------------------------------------------------
    */
    // PDF Generales
    Route::get('estudiantes/pdf', [EstudianteController::class, 'exportPdf'])->name('estudiantes.pdf');
    Route::get('facultades/pdf', [FacultadeController::class, 'exportPdf'])->name('facultades.pdf');
    Route::get('asignaturas/pdf', [AsignaturaController::class, 'exportPdf'])->name('asignaturas.pdf'); 
    Route::get('carreras/pdf', [CarreraController::class, 'exportPdf'])->name('carreras.pdf'); 
    Route::get('profesores/pdf', [ProfesorController::class, 'generarPdf'])->name('profesores.pdf');
    
    // Horarios Especiales
    Route::get('horarios/esquema', [HorarioController::class, 'esquemaSemanal'])->name('horarios.esquema');
    Route::get('horarios/pdf', [HorarioController::class, 'descargarPdf'])->name('horarios.pdf');

    // ✅ KARDEX ACADÉMICO
    Route::get('reportes/kardex', [EstudianteController::class, 'kardexIndex'])->name('reportes.kardex');
    Route::get('reportes/kardex/{id}', [EstudianteController::class, 'generarKardex'])->name('reportes.kardex.pdf');

    // Matrículas y Comprobantes
    Route::get('matriculas/reporte-general', [MatriculaController::class, 'reporteGeneral'])->name('matriculas.reporte_general');
    Route::get('matriculas/{id}/pdf', [MatriculaController::class, 'generarPdf'])->name('matriculas.pdf_individual');

    /*
    |----------------------------------------------------------------------
    | CRUDs DEL SISTEMA (Resources)
    |----------------------------------------------------------------------
    */
    Route::resource('facultades', FacultadeController::class);
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('carreras', CarreraController::class);
    Route::resource('asignaturas', AsignaturaController::class);
    Route::resource('matriculas', MatriculaController::class);
    Route::resource('profesores', ProfesorController::class);
    Route::resource('calificaciones', CalificacionController::class);
    Route::resource('horarios', HorarioController::class);

});

require __DIR__.'/auth.php';