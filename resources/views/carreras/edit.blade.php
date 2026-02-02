@extends('adminlte::page')

@section('title', 'Editar Carrera')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-graduation-cap mr-2 text-warning"></i>{{ __('Editar Carrera Profesional') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('carreras.index') }}">Carreras</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                {{-- Alertas de Validación --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> ¡Error!</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card card-outline card-warning shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-edit mr-1"></i> {{ __('Actualizar Plan de Estudios') }}
                        </h3>
                    </div>

                    <form action="{{ route('carreras.update', $carrera->id) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')

                        <div class="card-body bg-white">
                            <div class="row">
                                {{-- Campo Nombre --}}
                                <div class="col-md-12 form-group">
                                    <label for="nombre"><i class="fas fa-book mr-1"></i> Nombre de la Carrera</label>
                                    <input type="text" name="nombre" value="{{ old('nombre', $carrera->nombre) }}" 
                                           class="form-control @error('nombre') is-invalid @enderror" 
                                           placeholder="Ej: Ingeniería en Sistemas" required>
                                    @error('nombre')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Selector de Facultad --}}
                                <div class="col-md-12 form-group">
                                    <label for="facultad_id"><i class="fas fa-university mr-1"></i> Facultad Perteneciente</label>
                                    <select name="facultad_id" class="form-control select2 @error('facultad_id') is-invalid @enderror" style="width: 100%;" required>
                                        <option value="" disabled>Seleccione una facultad...</option>
                                        @foreach($facultades as $facultad)
                                            <option value="{{ $facultad->id }}" {{ $carrera->facultad_id == $facultad->id ? 'selected' : '' }}>
                                                {{ $facultad->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('facultad_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white d-flex justify-content-between">
                            <a href="{{ route('carreras.index') }}" class="btn btn-default px-4">
                                <i class="fas fa-arrow-left mr-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning px-5 font-weight-bold shadow-sm">
                                <i class="fas fa-sync-alt mr-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>

                <div class="text-center mt-3 text-muted">
                    <small>ID Interno de Carrera: <strong>#CR-{{ str_pad($carrera->id, 4, '0', STR_PAD_LEFT) }}</strong></small>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <style>
        .card-warning.card-outline { border-top: 3px solid #ffc107; }
        label { font-weight: 600 !important; color: #333; }
        .form-control:focus { border-color: #ffc107; box-shadow: none; }
    </style>
@stop