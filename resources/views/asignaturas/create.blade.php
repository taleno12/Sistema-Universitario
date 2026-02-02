@extends('adminlte::page')

@section('title', 'Nueva Asignatura | KT&U')

@section('content_header')
    <h1 class="text-indigo"><b>Registrar Nueva Asignatura</b></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-indigo shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro Académico</h3>
                </div>

                <form action="{{ route('asignaturas.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Asignatura</label>
                            <input type="text" name="nombre" 
                                   class="form-control border-indigo @error('nombre') is-invalid @enderror" 
                                   id="nombre" placeholder="Ej: Cálculo Integral" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="creditos">Créditos</label>
                                    <input type="number" name="creditos" 
                                           class="form-control border-indigo @error('creditos') is-invalid @enderror" 
                                           id="creditos" min="1" max="10" value="{{ old('creditos', 3) }}" required>
                                    @error('creditos')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="carrera_id">Carrera Profesional</label>
                                    <select name="carrera_id" id="carrera_id" class="form-control border-indigo @error('carrera_id') is-invalid @enderror" required>
                                        <option value="">-- Seleccione una Carrera --</option>
                                        @foreach($carreras as $carrera)
                                            <option value="{{ $carrera->id }}" {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>
                                                {{ $carrera->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('carrera_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-indigo px-4">
                            <i class="fas fa-save mr-1"></i> Guardar Asignatura
                        </button>
                        <a href="{{ route('asignaturas.index') }}" class="btn btn-outline-secondary px-4">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .text-indigo { color: #6610f2 !important; }
    .btn-indigo { background-color: #6610f2; color: white; }
    .btn-indigo:hover { background-color: #520dc2; color: white; }
    .card-indigo.card-outline { border-top: 3px solid #6610f2; }
    .border-indigo { border-color: #6610f2 !important; }
</style>
@stop