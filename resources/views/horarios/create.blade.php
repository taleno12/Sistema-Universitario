@extends('adminlte::page')

@section('title', 'Asignar Horario')

@section('content_header')
    <h1 class="text-indigo font-weight-bold"><i class="fas fa-clock mr-2"></i>Asignar Nuevo Horario</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        {{-- Alertas de Error --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-outline card-indigo shadow-lg">
            <div class="card-header">
                <h3 class="card-title text-indigo">Datos de la Sesión Académica</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('horarios.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        {{-- Selección de Asignatura --}}
                        <div class="col-md-6 form-group">
                            <label for="asignatura_id">Asignatura</label>
                            <select name="asignatura_id" id="asignatura_id" class="form-control @error('asignatura_id') is-invalid @enderror" required>
                                <option value="">-- Seleccione Materia --</option>
                                @foreach($asignaturas as $a)
                                    <option value="{{ $a->id }}" {{ old('asignatura_id') == $a->id ? 'selected' : '' }}>
                                        {{ $a->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('asignatura_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        {{-- Selección de Profesor --}}
                        <div class="col-md-6 form-group">
                            <label for="profesor_id">Docente (Profesor)</label>
                            <select name="profesor_id" id="profesor_id" class="form-control @error('profesor_id') is-invalid @enderror" required>
                                <option value="">-- Seleccione Docente --</option>
                                @foreach($profesores as $p)
                                    {{-- Ajustado a 'nombres' y 'apellidos' para evitar el error de columna --}}
                                    <option value="{{ $p->id }}" {{ old('profesor_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->nombres }} {{ $p->apellidos }} {{ $p->foto ? '📷' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('profesor_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Día de la semana --}}
                        <div class="col-md-4 form-group">
                            <label for="dia">Día</label>
                            <select name="dia" class="form-control" required>
                                <option value="">-- Seleccione Día --</option>
                                @foreach($dias as $d)
                                    <option value="{{ $d }}" {{ old('dia') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Horas --}}
                        <div class="col-md-4 form-group">
                            <label for="hora_inicio">Hora Inicio</label>
                            <input type="time" name="hora_inicio" class="form-control @error('hora_inicio') is-invalid @enderror" value="{{ old('hora_inicio') }}" required>
                            @error('hora_inicio') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="hora_fin">Hora Fin</label>
                            <input type="time" name="hora_fin" class="form-control @error('hora_fin') is-invalid @enderror" value="{{ old('hora_fin') }}" required>
                            @error('hora_fin') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="aula">Aula / Salón Virtual</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                            </div>
                            <input type="text" name="aula" class="form-control" value="{{ old('aula') }}" placeholder="Ej: Aula 302, Laboratorio A o Zoom Link">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4 border-top pt-3">
                        <a href="{{ route('horarios.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Volver al listado
                        </a>
                        <button type="submit" class="btn btn-indigo px-5 shadow">
                            <i class="fas fa-save mr-1"></i> Confirmar Horario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .btn-indigo { background-color: #6610f2; color: white; }
        .btn-indigo:hover { background-color: #520dc2; color: white; }
        .card-indigo.card-outline { border-top: 3px solid #6610f2; }
        .text-indigo { color: #6610f2; }
    </style>
@stop