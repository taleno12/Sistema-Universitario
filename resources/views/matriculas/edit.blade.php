@extends('adminlte::page')

@section('title', 'Editar Matrícula | KT&U')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-indigo font-weight-bold" style="letter-spacing: -0.5px;">
            <i class="fas fa-edit mr-2"></i>Editar Matrícula
        </h1>
        <a href="{{ route('matriculas.index') }}" class="btn btn-outline-indigo btn-sm rounded-pill px-3">
            <i class="fas fa-arrow-left mr-1"></i> Volver al listado
        </a>
    </div>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg" style="border-radius: 15px;">
            <div class="card-header bg-indigo py-3" style="border-radius: 15px 15px 0 0;">
                <h3 class="card-title font-weight-bold text-white mb-0">
                    <i class="fas fa-user-edit mr-2"></i> Información del Registro #{{ str_pad($matricula->id, 5, '0', STR_PAD_LEFT) }}
                </h3>
            </div>

            <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body p-4">
                    <div class="row">
                        {{-- Sección Estudiante --}}
                        <div class="col-md-12 mb-4">
                            <label class="text-indigo font-weight-bold"><i class="fas fa-user-graduate mr-1"></i> Estudiante</label>
                            <select name="estudiante_id" class="form-control custom-select border-indigo-light shadow-sm" style="border-radius: 8px;" required>
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}" {{ $matricula->estudiante_id == $estudiante->id ? 'selected' : '' }}>
                                        {{ $estudiante->nombre }} {{ $estudiante->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sección Carrera --}}
                        <div class="col-md-6 mb-4">
                            <label class="text-indigo font-weight-bold"><i class="fas fa-university mr-1"></i> Carrera Profesional</label>
                            <select name="carrera_id" id="carrera_id" class="form-control custom-select border-indigo-light shadow-sm" style="border-radius: 8px;" required>
                                @foreach($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" {{ $matricula->carrera_id == $carrera->id ? 'selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sección Periodo --}}
                        <div class="col-md-6 mb-4">
                            <label class="text-indigo font-weight-bold"><i class="fas fa-calendar-alt mr-1"></i> Periodo Académico</label>
                            <select name="periodo" class="form-control custom-select border-indigo-light shadow-sm" style="border-radius: 8px;" required>
                                <option value="2026-I" {{ $matricula->periodo == '2026-I' ? 'selected' : '' }}>2026-I</option>
                                <option value="2026-II" {{ $matricula->periodo == '2026-II' ? 'selected' : '' }}>2026-II</option>
                            </select>
                        </div>

                        {{-- Sección Asignatura --}}
                        <div class="col-md-6 mb-4">
                            <label class="text-indigo font-weight-bold"><i class="fas fa-book mr-1"></i> Asignatura</label>
                            <select name="asignatura_id" id="asignatura_id" class="form-control custom-select border-indigo-light shadow-sm" style="border-radius: 8px;" required>
                                @foreach($asignaturas as $asignatura)
                                    <option value="{{ $asignatura->id }}" 
                                            data-carrera="{{ $asignatura->carrera_id }}"
                                            {{ $matricula->asignatura_id == $asignatura->id ? 'selected' : '' }}>
                                        {{ $asignatura->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sección Fecha --}}
                        <div class="col-md-6 mb-4">
                            <label class="text-indigo font-weight-bold"><i class="fas fa-clock mr-1"></i> Fecha de Matrícula</label>
                            <input type="date" name="fecha_matricula" value="{{ $matricula->fecha_matricula }}" 
                                   class="form-control border-indigo-light shadow-sm" style="border-radius: 8px;" required>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light p-4 text-right" style="border-radius: 0 0 15px 15px;">
                    <a href="{{ route('matriculas.index') }}" class="btn btn-light px-4 mr-2" style="border-radius: 8px;">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-indigo px-5 shadow-sm" style="border-radius: 8px;">
                        <i class="fas fa-save mr-2"></i> Actualizar Matrícula
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .text-indigo { color: #4f46e5 !important; }
    .bg-indigo { background-color: #4f46e5 !important; }
    .border-indigo-light { border-color: #c7d2fe; }
    .btn-indigo { background-color: #4f46e5; color: white; border: none; transition: all 0.3s; }
    .btn-indigo:hover { background-color: #4338ca; color: white; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
    .btn-outline-indigo { color: #4f46e5; border-color: #4f46e5; }
    .btn-outline-indigo:hover { background-color: #4f46e5; color: white; }
    
    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.1);
    }
</style>

<script>
    // Filtro dinámico de asignaturas por carrera (opcional, mejora la experiencia)
    document.getElementById('carrera_id').addEventListener('change', function() {
        let carreraId = this.value;
        let selectAsignatura = document.getElementById('asignatura_id');
        let options = selectAsignatura.querySelectorAll('option');

        options.forEach(opt => {
            if (opt.getAttribute('data-carrera') == carreraId || opt.value === "") {
                opt.style.display = 'block';
            } else {
                opt.style.display = 'none';
            }
        });
        
        // Si la materia actual no pertenece a la nueva carrera seleccionada, resetear select
        let selectedOption = selectAsignatura.options[selectAsignatura.selectedIndex];
        if (selectedOption.getAttribute('data-carrera') != carreraId) {
            selectAsignatura.value = "";
        }
    });
</script>
@endsection