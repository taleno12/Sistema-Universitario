@extends('adminlte::page')

@section('title', 'Crear Facultad')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-university mr-2 text-success"></i>{{ __('Crear Nueva Facultad') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('facultades.index') }}">Facultades</a></li>
                    <li class="breadcrumb-item active">Nuevo</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8"> {{-- Reducimos el ancho para que no se vea tan estirado --}}

                <div class="card card-outline card-success shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-edit mr-1"></i> {{ __('Formulario de Registro Académico') }}
                        </h3>
                    </div>

                    <div class="card-body bg-white">
                        <p class="text-muted small">Complete todos los campos requeridos para dar de alta una nueva unidad académica.</p>
                        <hr>

                        <form method="POST" action="{{ route('facultades.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            {{-- El formulario base --}}
                            <div class="row">
                                <div class="col-md-12">
                                    @include('facultade.form')
                                </div>
                            </div>

                            <hr>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('facultades.index') }}" class="btn btn-default px-4">
                                    <i class="fas fa-arrow-left mr-1"></i> {{ __('Volver al Listado') }}
                                </a>
                                
                                <button type="submit" class="btn btn-success px-5 shadow-sm">
                                    <i class="fa fa-save mr-1"></i> {{ __('Registrar Facultad') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
                
                {{-- Nota de seguridad opcional --}}
                <div class="text-center mt-3 text-muted">
                    <small><i class="fas fa-info-circle"></i> Los cambios se verán reflejados inmediatamente en el organigrama institucional.</small>
                </div>
                
            </div>
        </div>
    </section>
@stop

@section('css')
    <style>
        .card-title { font-size: 1.1rem; }
        label { font-weight: 600 !important; color: #495057; }
    </style>
@stop