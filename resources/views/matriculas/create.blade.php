@extends('adminlte::page')

@section('title', 'Nueva Matrícula | KT&U')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-indigo font-weight-bold" style="letter-spacing: -0.5px;">
            <i class="fas fa-plus-circle mr-2"></i>Nueva Matrícula
        </h1>
        <a href="{{ route('matriculas.index') }}" class="btn btn-outline-indigo btn-sm rounded-pill px-3">
            <i class="fas fa-arrow-left mr-1"></i> Volver al listado
        </a>
    </div>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9 col-lg-7">
        <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            {{-- Encabezado estilizado --}}
            <div class="card-header bg-indigo py-4 text-center">
                <h3 class="card-title w-100 font-weight-bold text-white m-0">
                    <i class="fas fa-file-signature mr-2"></i> Formulario de Inscripción Académica
                </h3>
                <p class="text-white-50 small m-0 mt-1">Complete todos los campos para registrar al estudiante</p>
            </div>

            <form action="{{ route('matriculas.store') }}" method="POST">
                @csrf
                <div class="card-body p-5">
                    
                    {{-- Sección: Datos del Estudiante --}}
                    <div class="form-group mb-4">
                        <label class="text-indigo font-weight-bold ml-1">
                            <i class="fas fa-user-graduate mr-1"></i> Estudiante a Matricular
                        </label>
                        <div class="input-group input-group-lg shadow-xs">
                            <select name="estudiante_id" class="form-control border-indigo-light custom-select" style="border-radius: 12px;" required>
                                <option value="" disabled selected>Busque y seleccione un estudiante...</option>
                                @foreach($estudiantes as $e)
                                    <option value="{{ $e->id }}">{{ $e->nombre }} {{ $e->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="my-4 border-light">

                    {{-- Sección: Configuración Académica --}}
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="text-indigo font-weight-bold ml-1">
                                <i class="fas fa-university mr-1"></i> Carrera Profesional
                            </label>
                            <select name="carrera_id" id="carrera_id" class="form-control border-indigo-light custom-select shadow-xs" style="border-radius: 12px;" required>
                                <option value="" disabled selected>Seleccione carrera...</option>
                                @foreach($carreras as $c)
                                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="text-indigo font-weight-bold ml-1">
                                <i class="fas fa-calendar-check mr-1"></i> Periodo Lectivo
                            </label>
                            <select name="periodo" class="form-control border-indigo-light custom-select shadow-xs" style="border-radius: 12px;" required>
                                <option value="2026-I">Ciclo 2026 - I</option>
                                <option value="2026-II">Ciclo 2026 - II</option>
                            </select>
                        </div>
                    </div>

                    {{-- Sección: Asignatura (Filtro Dinámico) --}}
                    <div class="form-group mb-4">
                        <label class="text-indigo font-weight-bold ml-1">
                            <i class="fas fa-book-open mr-1"></i> Asignatura Correspondiente
                        </label>
                        <select name="asignatura_id" id="asignatura_id" class="form-control border-indigo-light custom-select shadow-xs" style="border-radius: 12px;" required>
                            <option value="" disabled selected>Primero seleccione una carrera...</option>
                            @foreach($asignaturas as $a)
                                <option value="{{ $a->id }}" data-carrera="{{ $a->carrera_id }}" style="display: none;">
                                    {{ $a->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted ml-1" id="msg-filtro">
                            * Solo se mostrarán las materias de la carrera elegida.
                        </small>
                    </div>

                </div>

                {{-- Botones de Acción --}}
                <div class="card-footer bg-light p-4 text-center">
                    <button type="submit" class="btn btn-indigo btn-lg rounded-pill px-5 shadow-sm btn-hover-scale">
                        <i class="fas fa-save mr-2"></i> Registrar Matrícula
                    </button>
                    <div class="mt-3">
                        <a href="{{ route('matriculas.index') }}" class="text-muted small text-decoration-none">
                             <i class="fas fa-times"></i> Cancelar y volver
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Variables de estilo KT&U */
    .text-indigo { color: #4f46e5 !important; }
    .bg-indigo { background-color: #4f46e5 !important; }
    .border-indigo-light { border-color: #c7d2fe; }
    
    .btn-indigo { 
        background-color: #4f46e5; 
        color: white; 
        border: none; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    }
    
    .btn-indigo:hover { 
        background-color: #4338ca; 
        color: white; 
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4); 
    }

    .btn-hover-scale:active {
        transform: scale(0.95);
    }

    .btn-outline-indigo { 
        color: #4f46e5; 
        border-color: #4f46e5; 
        transition: all 0.3s;
    }
    
    .btn-outline-indigo:hover { 
        background-color: #4f46e5; 
        color: white; 
    }

    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

    .custom-select {
        height: calc(3rem + 2px); /* Un poco más alto para verse premium */
        padding: 0.75rem 1.25rem;
    }

    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.1);
    }

    /* Animación de entrada de la card */
    .card {
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    // Filtro dinámico profesional
    document.getElementById('carrera_id').addEventListener('change', function() {
        let carreraId = this.value;
        let selectAsignatura = document.getElementById('asignatura_id');
        let options = selectAsignatura.querySelectorAll('option');
        let msgFiltro = document.getElementById('msg-filtro');

        // Resetear select y mostrar mensaje de ayuda
        selectAsignatura.value = "";
        msgFiltro.innerHTML = '<i class="fas fa-check-circle text-success"></i> Materias filtradas con éxito.';

        options.forEach(opt => {
            if (opt.value === "") {
                opt.textContent = "Seleccione una asignatura...";
                opt.style.display = 'block';
            } else {
                opt.style.display = (opt.getAttribute('data-carrera') == carreraId) ? 'block' : 'none';
            }
        });
    });
</script>
@stop