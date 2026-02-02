@extends('adminlte::page')

@section('title', 'Facultades | KT&U')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-university mr-2 text-indigo"></i>{{ __('Gestión de Facultades') }}
                </h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                {{-- Tarjeta con diseño "Dark Mode" Header --}}
                <div class="card card-outline card-indigo shadow-lg">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title font-weight-bold text-muted">
                                {{ __('Lista de Sedes Académicas') }}
                            </h3>

                            <div class="card-tools d-flex">
                                {{-- Buscador Dinámico --}}
                                <form action="{{ route('facultades.index') }}" method="GET" class="mr-3">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="search" class="form-control rounded-left border-indigo" placeholder="Buscar facultad..." value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-indigo text-white">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            @if(request('search'))
                                                <a href="{{ route('facultades.index') }}" class="btn btn-default border-left-0" title="Limpiar">
                                                    <i class="fas fa-times text-danger"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>

                                {{-- Botones de Acción --}}
                                <a href="{{ route('facultades.create') }}" class="btn btn-indigo btn-sm rounded-pill shadow-sm text-white">
                                    <i class="fa fa-plus-circle"></i> {{ __('Nueva Facultad') }}
                                </a>
                                <a href="{{ route('facultades.pdf') }}" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm ml-2">
                                    <i class="fa fa-file-pdf"></i> {{ __('PDF') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-indigo alert-dismissible fade show m-3 shadow-sm text-white" style="background-color: #6610f2;">
                            <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check-circle"></i> Éxito</h5>
                            {{ $message }}
                        </div>
                    @endif

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-indigo text-white">
                                    <tr>
                                        <th style="width: 80px">ID</th>
                                        <th>Nombre de la Facultad</th>
                                        <th>Descripción Breve</th>
                                        <th class="text-center" style="width: 250px">Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($facultades as $facultade)
                                        <tr>
                                            <td class="align-middle">
                                                <span class="text-muted font-weight-bold">#{{ $facultade->id }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-indigo-light rounded-circle mr-3 text-center" style="width: 35px; height: 35px; line-height: 35px;">
                                                        <i class="fas fa-landmark text-indigo"></i>
                                                    </div>
                                                    <span class="text-bold text-dark">{{ $facultade->nombre }}</span>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-muted">{{ Str::limit($facultade->descripcion, 60) }}</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group">
                                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('facultades.show', $facultade->id) }}" title="Detalles">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-outline-indigo" href="{{ route('facultades.edit', $facultade->id) }}" title="Editar">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('facultades.destroy', $facultade->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-dark" onclick="return confirm('¿Confirmar eliminación?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-search fa-3x mb-3"></i>
                                                    <p>No se encontraron facultades en la base de datos.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center">
                        <small class="text-muted">Mostrando registros de facultades activas.</small>
                        <div>
                            {!! $facultades->withQueryString()->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    /* Variables de color Indigo */
    .text-indigo { color: #6610f2 !important; }
    .bg-indigo { background-color: #6610f2 !important; }
    .bg-indigo-light { background-color: #f3ebff !important; }
    .border-indigo { border-color: #6610f2 !important; }
    .btn-indigo { background-color: #6610f2; border-color: #6610f2; color: white; }
    .btn-indigo:hover { background-color: #520dc2; color: white; }
    .btn-outline-indigo { color: #6610f2; border-color: #6610f2; }
    .btn-outline-indigo:hover { background-color: #6610f2; color: white; }
    .card-indigo.card-outline { border-top: 3px solid #6610f2; }

    /* Estética de tabla */
    .table thead th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
    }
    .table tbody tr { transition: all 0.2s; }
    .table tbody tr:hover { background-color: #fbf9ff; }
</style>
@stop