@extends('adminlte::page')

@section('title', 'Carreras | KT&U')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-indigo font-weight-bold">
                    <i class="fas fa-university mr-2"></i>Carreras Profesionales
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Carreras</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    {{-- Resumen de Impacto --}}
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm border-0" style="border-radius: 12px;">
                <span class="info-box-icon bg-indigo elevation-1" style="border-radius: 10px;"><i class="fas fa-graduation-cap"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Oferta Académica</span>
                    <span class="info-box-number h5 mb-0">{{ $carreras->total() }} Carreras</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-indigo shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header bg-white py-3" style="border-radius: 15px 15px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title text-muted font-weight-bold">
                    <i class="fas fa-stream mr-2 text-indigo"></i>Gestión de Programas
                </h3>
                <div class="card-tools">
                    {{-- Botón PDF Global añadido --}}
                    <a href="{{ route('carreras.pdf') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm mr-2">
                        <i class="fas fa-file-pdf mr-1"></i> Exportar Listado
                    </a>
                    <a href="{{ route('carreras.create') }}" class="btn btn-indigo btn-sm rounded-pill px-4 shadow-sm">
                        <i class="fas fa-plus-circle mr-1"></i> Nueva Carrera
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            {{-- Buscador Moderno --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="{{ route('carreras.index') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                            <input type="text" name="search" class="form-control border-0 px-4" 
                                   placeholder="Buscar por nombre de carrera o facultad..." 
                                   value="{{ $search }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-white text-indigo border-0">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if($search)
                                    <a href="{{ route('carreras.index') }}" class="btn btn-white text-danger border-0 pr-3">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show rounded-lg">
                    <i class="icon fas fa-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="close text-white" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle border-light">
                    <thead class="bg-light text-indigo uppercase small font-weight-bold">
                        <tr>
                            <th class="border-0 text-center" style="width: 80px">ID</th>
                            <th class="border-0">Nombre de la Carrera</th>
                            <th class="border-0">Facultad Perteneciente</th>
                            <th class="border-0 text-center" style="width: 150px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carreras as $carrera)
                            <tr class="transition-row">
                                <td class="text-center align-middle text-muted font-italic">
                                    #{{ str_pad($carrera->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="align-middle">
                                    <span class="d-block font-weight-bold text-dark">{{ $carrera->nombre }}</span>
                                    <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i>Registro: {{ $carrera->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-indigo-soft px-3 py-2 rounded-pill font-weight-normal">
                                        <i class="fas fa-landmark mr-1"></i>
                                        {{ $carrera->facultade->nombre ?? 'Facultad General' }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('carreras.edit', $carrera->id) }}" 
                                           class="btn btn-sm text-warning mx-1" 
                                           title="Editar">
                                            <i class="fas fa-pen-nib"></i>
                                        </a>
                                        <form action="{{ route('carreras.destroy', $carrera->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger mx-1" 
                                                    title="Eliminar" onclick="return confirm('¿Desea eliminar esta carrera?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                    <p>No se encontraron resultados para tu búsqueda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white py-3" style="border-radius: 0 0 15px 15px;">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted small">Mostrando {{ $carreras->count() }} de {{ $carreras->total() }} registros</span>
                <div class="pagination-indigo">
                    {{ $carreras->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    :root { --indigo-primary: #6610f2; }
    .text-indigo { color: var(--indigo-primary) !important; }
    .bg-indigo { background-color: var(--indigo-primary) !important; color: white; }
    .btn-indigo { background-color: var(--indigo-primary); color: white; border: none; }
    .btn-indigo:hover { background-color: #520dc2; color: white; transform: translateY(-1px); }
    .card-indigo.card-outline { border-top: 4px solid var(--indigo-primary); }
    .badge-indigo-soft { background-color: rgba(102, 16, 242, 0.08); color: var(--indigo-primary); border: 1px solid rgba(102, 16, 242, 0.1); }
    .transition-row { transition: all 0.2s; }
    .transition-row:hover { background-color: #f8f9fa !important; transform: scale(1.002); }
    .btn-white { background: white; }
    
    /* Pagination Styling */
    .pagination-indigo .page-item.active .page-link { background-color: var(--indigo-primary); border-color: var(--indigo-primary); }
    .pagination-indigo .page-link { color: var(--indigo-primary); }
</style>
@stop