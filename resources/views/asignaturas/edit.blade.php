@extends('adminlte::page')

@section('title', 'Editar Asignatura | KT&U')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-indigo font-weight-bold">
                    <i class="fas fa-edit mr-2"></i>Editar Asignatura
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('asignaturas.index') }}">Malla Curricular</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Tarjeta Principal --}}
            <div class="card card-outline card-indigo shadow-lg border-0">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title text-muted">
                        <i class="fas fa-info-circle mr-2"></i>Actualizar información de <b>{{ $asignatura->nombre }}</b>
                    </h3>
                </div>

                <form action="{{ route('asignaturas.update', $asignatura->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="fas fa-exclamation-triangle mr-2"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group mb-4">
                            <label class="text-indigo font-weight-bold">Nombre de la Asignatura</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0 text-indigo">
                                        <i class="fas fa-book"></i>
                                    </span>
                                </div>
                                <input type="text" name="nombre" 
                                       value="{{ old('nombre', $asignatura->nombre) }}" 
                                       class="form-control border-left-0 shadow-none @error('nombre') is-invalid @enderror" 
                                       placeholder="Ej: Cálculo Avanzado" required>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Campo Créditos (Añadido para consistencia con tu controlador) --}}
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="text-indigo font-weight-bold">Créditos Académicos</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0 text-indigo">
                                                <i class="fas fa-star"></i>
                                            </span>
                                        </div>
                                        <input type="number" name="creditos" 
                                               value="{{ old('creditos', $asignatura->creditos) }}" 
                                               class="form-control border-left-0 shadow-none" 
                                               min="1" max="10" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="text-indigo font-weight-bold">Carrera Profesional</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0 text-indigo">
                                                <i class="fas fa-graduation-cap"></i>
                                            </span>
                                        </div>
                                        <select name="carrera_id" class="form-control border-left-0 shadow-none @error('carrera_id') is-invalid @enderror" required>
                                            @foreach($carreras as $carrera)
                                                <option value="{{ $carrera->id }}" 
                                                    {{ (old('carrera_id', $asignatura->carrera_id) == $carrera->id) ? 'selected' : '' }}>
                                                    {{ $carrera->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light d-flex justify-content-between py-3">
                        <a href="{{ route('asignaturas.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-indigo rounded-pill px-5 shadow-sm">
                            <i class="fas fa-sync-alt mr-1"></i> Actualizar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .text-indigo { color: #6610f2 !important; }
    .btn-indigo { background-color: #6610f2; color: white; transition: 0.3s; }
    .btn-indigo:hover { background-color: #520dc2; color: white; transform: translateY(-1px); }
    .card-indigo.card-outline { border-top: 4px solid #6610f2; }
    .form-control:focus { border-color: #6610f2; }
    .input-group-text { border-color: #ced4da; }
</style>
@stop