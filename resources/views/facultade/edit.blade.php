@extends('adminlte::page')

@section('title', 'Editar Facultad')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-edit mr-2 text-warning"></i>{{ __('Editar Facultad') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('facultades.index') }}">Facultades</a></li>
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
                {{-- Alerta de errores de validación --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="icon fas fa-ban mr-2"></i><strong>¡Atención!</strong> Por favor revisa los campos del formulario.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-outline card-warning shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-university mr-1"></i> {{ __('Modificar Información Institucional') }}
                        </h3>
                    </div>

                    <div class="card-body bg-white">
                        <p class="text-muted small">Estás editando la facultad: <span class="badge badge-warning text-uppercase">{{ $facultade->nombre }}</span></p>
                        <hr>

                        <form method="POST" action="{{ route('facultades.update', $facultade->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    @include('facultade.form')
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('facultades.index') }}" class="btn btn-default px-4 shadow-sm">
                                    <i class="fas fa-times-circle mr-1"></i> {{ __('Cancelar Cambios') }}
                                </a>
                                
                                <button type="submit" class="btn btn-warning px-5 shadow-sm font-weight-bold">
                                    <i class="fas fa-sync-alt mr-1"></i> {{ __('Guardar Actualización') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-3 text-muted">
                    <small>Última actualización: {{ $facultade->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <style>
        .card-warning.card-outline { border-top: 3px solid #ffc107; }
        label { font-weight: 600 !important; color: #495057; }
    </style>
@stop