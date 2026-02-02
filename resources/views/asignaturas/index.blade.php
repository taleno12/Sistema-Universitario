@extends('adminlte::page')

@section('title', 'Área de Asignaturas | KT&U')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-indigo font-weight-bold">
                    <i class="fas fa-layer-group mr-2"></i>Área de Asignaturas
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Asignaturas</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    {{-- Tarjeta de Estadísticas Rápidas --}}
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-indigo shadow-sm" style="border-radius: 12px;">
                <div class="inner">
                    <h3>{{ $asignaturas->total() }}</h3>
                    <p>Total Asignaturas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-indigo shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header bg-white py-3" style="border-radius: 15px 15px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title text-muted font-weight-bold">
                    <i class="fas fa-list-ul mr-2 text-indigo"></i>Gestión de Créditos y Materias
                </h3>
                <div class="card-tools">
                    {{-- Botón PDF Agregado --}}
                    <a href="{{ route('asignaturas.pdf') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm mr-2">
                        <i class="fas fa-file-pdf mr-1"></i> Exportar Plan
                    </a>
                    <a href="{{ route('asignaturas.create') }}" class="btn btn-indigo btn-sm rounded-pill px-3 shadow-sm">
                        <i class="fas fa-plus-circle mr-1"></i> Nueva Asignatura
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            {{-- Formulario de Búsqueda --}}
            <form action="{{ route('asignaturas.index') }}" method="GET" class="mb-4">
                <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-0 text-indigo pl-4">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" name="search" value="{{ $search }}" 
                           placeholder="Buscar por asignatura o por carrera..." 
                           class="form-control border-0 shadow-none px-2">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-indigo px-4 font-weight-bold">
                            Filtrar
                        </button>
                        @if($search)
                            <a href="{{ route('asignaturas.index') }}" class="btn btn-white text-danger border-0 pr-4 d-flex align-items-center" title="Limpiar búsqueda">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show rounded-lg">
                    <i class="icon fas fa-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="close text-white" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show rounded-lg">
                    <i class="icon fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
                    <button type="button" class="close text-white" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle border-light">
                    <thead class="bg-light text-indigo uppercase small font-weight-bold">
                        <tr>
                            <th class="border-0" style="width: 35%;">Asignatura</th>
                            <th class="border-0 text-center" style="width: 15%;">Créditos</th>
                            <th class="border-0" style="width: 35%;">Carrera Profesional</th>
                            <th class="border-0 text-center" style="width: 15%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asignaturas as $asignatura)
                            <tr class="transition-row">
                                <td class="align-middle border-light">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-indigo-light rounded p-2 mr-3 text-indigo">
                                            <i class="fas fa-bookmark fa-lg"></i>
                                        </div>
                                        <div>
                                            <span class="d-block font-weight-bold text-dark mb-0">{{ $asignatura->nombre }}</span>
                                            <small class="text-muted font-weight-bold text-uppercase">CÓDIGO: {{ $asignatura->codigo ?? 'ASG-'.$asignatura->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center border-light">
                                    <span class="badge badge-indigo-soft px-3 py-2 rounded-pill font-weight-bold">
                                        <i class="fas fa-star mr-1 text-warning"></i> {{ $asignatura->creditos }}
                                    </span>
                                </td>
                                <td class="align-middle border-light">
                                    <span class="badge badge-light border p-2 shadow-none rounded-pill px-3 font-weight-normal text-muted">
                                        <i class="fas fa-graduation-cap mr-1 text-indigo"></i>
                                        {{ $asignatura->carrera->nombre ?? 'Sin Carrera Asignada' }}
                                    </span>
                                </td>
                                <td class="text-center align-middle border-light">
                                    <div class="btn-group">
                                        <a href="{{ route('asignaturas.edit', $asignatura->id) }}" 
                                           class="btn btn-sm text-warning mx-1" 
                                           title="Editar">
                                            <i class="fas fa-pen-nib"></i>
                                        </a>
                                        
                                        <form action="{{ route('asignaturas.destroy', $asignatura->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm text-danger mx-1" 
                                                    title="Eliminar" 
                                                    onclick="return confirm('¿Confirmas que deseas eliminar esta asignatura?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                                    <p class="text-muted font-italic">No encontramos asignaturas registradas para tu búsqueda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-0 py-3" style="border-radius: 0 0 15px 15px;">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-muted small mb-0">Mostrando {{ $asignaturas->count() }} de {{ $asignaturas->total() }} registros</p>
                <div class="pagination-indigo">
                    {{ $asignaturas->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    :root { --main-indigo: #6610f2; }
    .text-indigo { color: var(--main-indigo) !important; }
    .bg-indigo { background-color: var(--main-indigo) !important; color: white; }
    .btn-indigo { background-color: var(--main-indigo); color: white; border: none; }
    .btn-indigo:hover { background-color: #520dc2; color: white; transform: translateY(-1px); }
    .card-indigo.card-outline { border-top: 4px solid var(--main-indigo); }
    .badge-indigo-soft { background-color: rgba(102, 16, 242, 0.08); color: var(--main-indigo); border: 1px solid rgba(102, 16, 242, 0.1); }
    .bg-indigo-light { background-color: rgba(102, 16, 242, 0.05); }
    .transition-row:hover { background-color: #fcfaff !important; transition: 0.3s; }
    .pagination-indigo .page-item.active .page-link { background-color: var(--main-indigo); border-color: var(--main-indigo); }
    .pagination-indigo .page-link { color: var(--main-indigo); }
</style>
@stop