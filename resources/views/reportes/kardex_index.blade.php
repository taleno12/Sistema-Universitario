@extends('adminlte::page')

@section('title', 'Kardex Académico | KT&U')

@section('content_header')
    <h1 class="text-indigo font-weight-bold">
        <i class="fas fa-file-invoice mr-2"></i>Expediente Académico
    </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-indigo card-outline shadow-lg">
        <div class="card-header">
            <h3 class="card-title">Seleccione un estudiante para generar su historial</h3>
            <div class="card-tools">
                <form action="{{ route('reportes.kardex') }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Buscar estudiante..." value="{{ $search }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-indigo">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="bg-light">
                    <tr>
                        <th class="text-indigo">Foto</th>
                        <th class="text-indigo">Nombre Completo</th>
                        <th class="text-indigo">Facultad</th>
                        <th class="text-indigo">Correo</th>
                        <th class="text-center text-indigo">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estudiantes as $estudiante)
                        <tr>
                            <td class="align-middle">
                                @if($estudiante->foto)
                                    <img src="{{ asset('storage/' . $estudiante->foto) }}" class="img-circle shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/default-user.png') }}" class="img-circle shadow-sm" style="width: 40px;">
                                @endif
                            </td>
                            <td class="align-middle font-weight-bold">{{ $estudiante->nombre }}</td>
                            <td class="align-middle"><span class="badge badge-info">{{ $estudiante->facultad->nombre ?? 'N/A' }}</span></td>
                            <td class="align-middle text-muted">{{ $estudiante->correo }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('reportes.kardex.pdf', $estudiante->id) }}" 
                                   target="_blank" 
                                   class="btn btn-outline-indigo btn-sm shadow-sm px-3">
                                    <i class="fas fa-file-pdf mr-1"></i> Generar Expediente Académico
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No se encontraron estudiantes para generar el reporte.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white">
            <div class="float-right">
                {{ $estudiantes->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .text-indigo { color: #6610f2 !important; }
    .btn-indigo { background-color: #6610f2 !important; color: white !important; }
    .btn-indigo:hover { background-color: #520dc2 !important; }
    .card-indigo.card-outline { border-top: 3px solid #6610f2; }
    .btn-outline-indigo { color: #6610f2; border-color: #6610f2; }
    .btn-outline-indigo:hover { background-color: #6610f2; color: white; }
    .page-item.active .page-link { background-color: #6610f2 !important; border-color: #6610f2 !important; }
</style>
@stop