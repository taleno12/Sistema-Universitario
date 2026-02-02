@extends('adminlte::page')

@section('title', 'Detalles de Facultad')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-eye mr-2 text-info"></i>{{ __('Expediente de Facultad') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('facultades.index') }}">Facultades</a></li>
                    <li class="breadcrumb-item active">Detalles</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7"> {{-- Centrado y con ancho elegante --}}
                <div class="card card-outline card-info shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-university mr-1"></i> {{ __('Información Institucional') }}
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-tool" href="{{ route('facultades.index') }}">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-0"> {{-- p-0 para que la lista toque los bordes --}}
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th style="width: 30%"><i class="fas fa-id-badge mr-2 text-muted"></i>Nombre:</th>
                                    <td class="text-uppercase font-weight-bold text-primary">
                                        {{ $facultade->nombre }}
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-align-left mr-2 text-muted"></i>Descripción:</th>
                                    <td class="text-muted">
                                        {{ $facultade->descripcion ?? 'Sin descripción disponible' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-calendar-alt mr-2 text-muted"></i>Fecha de Registro:</th>
                                    <td>{{ $facultade->created_at->format('d/m/Y h:i A') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('facultades.index') }}" class="btn btn-info px-4 shadow-sm">
                            <i class="fas fa-arrow-left mr-1"></i> {{ __('Regresar al Listado') }}
                        </a>
                        <a href="{{ route('facultades.edit', $facultade->id) }}" class="btn btn-warning px-4 shadow-sm">
                            <i class="fas fa-edit mr-1"></i> {{ __('Editar Datos') }}
                        </a>
                    </div>
                </div>

                {{-- Pie de página informativo --}}
                <div class="text-center mt-3">
                    <p class="text-muted small">ID Único de Facultad: <strong>#FAC-00{{ $facultade->id }}</strong></p>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <style>
        .table th { background-color: #f8f9fa; }
        .card-title { font-size: 1.15rem; }
    </style>
@stop