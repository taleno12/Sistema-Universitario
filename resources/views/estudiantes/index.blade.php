@extends('adminlte::page')
@section('title', 'Estudiantes | KT&U')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-user-graduate mr-2 text-primary"></i>{{ __('Gestión de Estudiantes') }}</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-primary shadow-lg">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h3 class="card-title text-bold">{{ __('Lista de Estudiantes Registrados') }}</h3>

                            <div class="card-tools d-flex mt-2 mt-md-0">
                                {{-- Buscador --}}
                                <form action="{{ route('estudiantes.index') }}" method="GET" class="mr-3">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="search" class="form-control rounded-left" placeholder="Buscar estudiante..." value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            @if(request('search'))
                                                <a href="{{ route('estudiantes.index') }}" class="btn btn-danger" title="Limpiar">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>

                                {{-- Botones de Acción --}}
                                <a href="{{ route('estudiantes.create') }}" class="btn btn-success btn-sm rounded-pill mr-2 shadow-sm">
                                    <i class="fa fa-plus-circle mr-1"></i> {{ __('Nuevo') }}
                                </a>
                                <a href="{{ route('estudiantes.pdf') }}" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm">
                                    <i class="fa fa-file-pdf mr-1"></i> {{ __('Exportar PDF') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3 shadow-sm border-0">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <span><i class="icon fas fa-check-circle"></i> {{ $message }}</span>
                        </div>
                    @endif

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center border-0">No</th>
                                        <th class="border-0">Estudiante</th>
                                        <th class="border-0">Correo Electrónico</th>
                                        <th class="border-0">Fecha Nacimiento</th>
                                        <th class="border-0">Facultad</th>
                                        <th class="text-center border-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($estudiantes as $estudiante)
                                        <tr>
                                            <td class="align-middle text-center" style="width: 60px;">
                                                <span class="badge badge-secondary shadow-sm">{{ $loop->iteration }}</span>
                                            </td>
                                            
                                            {{-- Columna de Foto y Nombre --}}
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3">
                                                        @if($estudiante->foto)
                                                            <img src="{{ asset('storage/' . $estudiante->foto) }}" 
                                                                 class="img-circle elevation-2 border border-white" 
                                                                 style="width: 45px; height: 45px; object-fit: cover;" 
                                                                 alt="User Image">
                                                        @else
                                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($estudiante->nombre) }}&background=6610f2&color=fff&bold=true" 
                                                                 class="img-circle elevation-2" 
                                                                 style="width: 45px; height: 45px;" 
                                                                 alt="User Avatar">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="text-bold text-dark mb-0">{{ $estudiante->nombre }}</div>
                                                        <small class="text-muted" style="font-size: 11px;">ID: #{{ str_pad($estudiante->id, 5, '0', STR_PAD_LEFT) }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-muted">{{ $estudiante->correo }}</td>
                                            <td class="align-middle">
                                                <span class="text-indigo"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->format('d M, Y') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge badge-info px-2 py-1 shadow-sm">
                                                    <i class="fas fa-university mr-1"></i> {{ $estudiante->facultad->nombre }}
                                                </span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group shadow-sm">
                                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('estudiantes.show', $estudiante->id) }}" title="Ver Detalle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-outline-info" href="{{ route('estudiantes.edit', $estudiante->id) }}" title="Editar Registro">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar registro?')" title="Eliminar">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3" style="opacity: 0.3;">
                                                <p class="text-muted font-italic">No se encontraron estudiantes para la búsqueda: <strong>"{{ request('search') }}"</strong></p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Mostrando {{ $estudiantes->count() }} de {{ $estudiantes->total() }} registros</small>
                            {!! $estudiantes->withQueryString()->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.8px;
        padding: 15px 10px;
    }
    .table tbody td {
        padding: 12px 10px;
        vertical-align: middle;
    }
    .text-indigo { color: #6610f2; }
    .img-circle {
        transition: transform .2s;
    }
    .img-circle:hover {
        transform: scale(1.1);
    }
    .card-outline.card-primary {
        border-top: 3px solid #6610f2;
    }
    .btn-outline-primary:hover, .btn-primary {
        background-color: #6610f2;
        border-color: #6610f2;
    }
</style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            console.log('Sistema Estudiantil KT&U - Fotos Listas.');
        });
    </script>
@stop