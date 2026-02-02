@extends('adminlte::page')

@section('title', 'Matrículas | KT&U')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-indigo font-weight-bold" style="letter-spacing: -0.5px;">
            <i class="fas fa-id-card-alt mr-2"></i>Control de Matrículas
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active text-indigo">Matrículas</li>
            </ol>
        </nav>
    </div>
@stop

@section('content')
{{-- Alertas de Éxito o Error --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 10px;">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title text-dark font-weight-bold">
                <i class="fas fa-users text-indigo mr-2"></i>Listado de Estudiantes Inscritos
            </h3>
            <div class="card-tools d-flex">
                {{-- Botón Reporte General (PDF de toda la lista) --}}
                <a href="{{ route('matriculas.reporte_general') }}" class="btn btn-outline-danger mr-2 shadow-sm" style="border-radius: 8px;">
                    <i class="fas fa-file-pdf mr-1"></i> Reporte General
                </a>
                {{-- Botón Nueva Matrícula --}}
                <a href="{{ route('matriculas.create') }}" class="btn btn-indigo px-4 shadow-sm" style="border-radius: 8px; transition: all 0.3s;">
                    <i class="fas fa-plus-circle mr-2"></i>Nueva Matrícula
                </a>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        {{-- Barra de búsqueda minimalista --}}
        <div class="px-4 py-3 bg-light border-bottom">
            <form action="{{ route('matriculas.index') }}" method="GET">
                <div class="input-group bg-white shadow-xs" style="border-radius: 10px; border: 1px solid #e0e0e0;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-muted">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" name="search" value="{{ $search }}" 
                           class="form-control border-0 bg-transparent py-4" 
                           placeholder="Buscar por alumno, asignatura o carrera...">
                    @if($search)
                        <div class="input-group-append">
                            <a href="{{ route('matriculas.index') }}" class="btn btn-transparent d-flex align-items-center text-muted">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">
                        <th class="px-4 py-3 border-0">Estudiante</th>
                        <th class="py-3 border-0">Asignatura</th>
                        <th class="py-3 border-0">Carrera</th>
                        <th class="py-3 border-0 text-center">Periodo</th>
                        <th class="px-4 py-3 border-0 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matriculas as $matricula)
                    <tr style="transition: background 0.2s;">
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                {{-- Avatar con Foto (Sincronizado con lógica de docentes) --}}
                                <div class="avatar-circle mr-3 bg-indigo-soft text-indigo font-weight-bold shadow-sm overflow-hidden" style="border: 2px solid #fff;">
                                    @if($matricula->estudiante->foto)
                                        <img src="{{ asset('storage/' . $matricula->estudiante->foto) }}" alt="Foto" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        {{ strtoupper(substr($matricula->estudiante->nombre, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <span class="d-block font-weight-bold text-dark">{{ $matricula->estudiante->nombre }} {{ $matricula->estudiante->apellido }}</span>
                                    <small class="text-muted">ID: #{{ str_pad($matricula->id, 5, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="text-dark font-weight-600">{{ $matricula->asignatura->nombre }}</span>
                        </td>
                        <td class="py-3 text-muted">
                            <i class="fas fa-graduation-cap mr-1 small"></i> {{ $matricula->carrera->nombre ?? 'N/A' }}
                        </td>
                        <td class="py-3 text-center">
                            <span class="badge badge-pill badge-indigo-light text-indigo px-3 py-2">
                                {{ $matricula->periodo }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="btn-group">
                                {{-- Comprobante Individual (Ruta corregida según tu web.php) --}}
                                <a href="{{ route('matriculas.pdf_individual', $matricula->id) }}" 
                                   class="btn btn-sm btn-light text-danger shadow-xs border mx-1 action-btn" 
                                   title="Descargar Comprobante PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>

                                {{-- Ver Detalles --}}
                                <a href="{{ route('matriculas.show', $matricula->id) }}" 
                                   class="btn btn-sm btn-light text-indigo shadow-xs border mx-1 action-btn" 
                                   title="Ver Detalles">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Editar --}}
                                <a href="{{ route('matriculas.edit', $matricula->id) }}" 
                                   class="btn btn-sm btn-light text-warning shadow-xs border mx-1 action-btn" 
                                   title="Editar Matrícula">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger shadow-xs border mx-1 action-btn" 
                                            onclick="return confirm('¿Anular esta matrícula?')" 
                                            title="Anular Matrícula">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-50">
                            <h5 class="text-muted">No se encontraron matrículas</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <span class="small text-muted">
                Mostrando <b>{{ $matriculas->firstItem() ?? 0 }}</b> a <b>{{ $matriculas->lastItem() ?? 0 }}</b> de <b>{{ $matriculas->total() }}</b> registros
            </span>
            <div>
                {{ $matriculas->appends(['search' => $search])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<style>
    .bg-indigo-soft { background-color: #e0e7ff; }
    .text-indigo { color: #4f46e5 !important; }
    .btn-indigo { background-color: #4f46e5; color: white; border: none; }
    .btn-indigo:hover { background-color: #4338ca; color: white; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.3); }
    
    .badge-indigo-light { background-color: #eef2ff; color: #4338ca; border: 1px solid #c7d2fe; }
    
    .avatar-circle {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 14px;
        flex-shrink: 0;
    }

    .action-btn { border-radius: 8px !important; transition: all 0.2s; }
    .action-btn:hover { transform: scale(1.1); background: #fff !important; }

    .table td, .table th { vertical-align: middle; }
    .font-weight-600 { font-weight: 600; }
    .shadow-xs { box-shadow: 0 1px 2px rgba(0,0,0,0.05); }

    tbody tr:hover { background-color: #f9fafb !important; }

    .pagination { margin-bottom: 0; }
    .page-item.active .page-link { background-color: #4f46e5; border-color: #4f46e5; }
    .page-link { color: #4f46e5; }
</style>
@stop