@extends('adminlte::page')

@section('title', 'Gestión de Horarios')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-indigo font-weight-bold">
            <i class="fas fa-calendar-alt mr-2"></i>Gestión de Horarios
        </h1>
        <div>
            <a href="{{ route('horarios.esquema') }}" class="btn btn-outline-indigo shadow-sm mr-2">
                <i class="fas fa-th mr-1"></i> Ver Esquema Visual
            </a>
            <a href="{{ route('horarios.pdf') }}" class="btn btn-danger shadow-sm mr-2">
                <i class="fas fa-file-pdf mr-1"></i> Exportar PDF
            </a>
            <a href="{{ route('horarios.create') }}" class="btn btn-indigo shadow-sm">
                <i class="fas fa-plus-circle mr-1"></i> Nuevo Horario
            </a>
        </div>
    </div>
@stop

@section('content')
<div class="card card-outline card-indigo shadow-lg">
    <div class="card-header bg-white">
        <h3 class="card-title font-weight-bold text-muted">
            <i class="fas fa-list mr-1"></i> Listado de Sesiones Académicas
        </h3>
    </div>
    <div class="card-body">
        <table id="horariosTable" class="table table-hover table-borderless">
            <thead class="thead-light">
                <tr>
                    <th class="text-indigo">Día</th>
                    <th class="text-indigo">Intervalo de Hora</th>
                    <th class="text-indigo">Asignatura</th>
                    <th class="text-indigo">Docente</th>
                    <th class="text-indigo">Aula / Ubicación</th>
                    <th class="text-center text-indigo">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($horarios as $h)
                <tr class="align-middle">
                    <td>
                        <span class="badge badge-indigo p-2 shadow-sm w-100">
                            {{ strtoupper($h->dia) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex flex-column">
                            <span class="text-dark font-weight-bold">
                                <i class="far fa-clock text-indigo mr-1"></i> 
                                {{ \Carbon\Carbon::parse($h->hora_inicio)->format('g:i A') }}
                            </span>
                            <small class="text-muted">Fin: {{ \Carbon\Carbon::parse($h->hora_fin)->format('g:i A') }}</small>
                        </div>
                    </td>
                    <td class="font-weight-bold text-dark">{{ $h->asignatura->nombre }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-40 mr-3">
                                @if($h->profesor->foto)
                                    <img src="{{ asset('storage/' . $h->profesor->foto) }}" 
                                         class="rounded-circle shadow-sm border border-indigo" 
                                         width="40" height="40" style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/default-user.png') }}" 
                                         class="rounded-circle shadow-sm border" 
                                         width="40" height="40" style="object-fit: cover;">
                                @endif
                            </div>
                            <div class="d-flex flex-column">
                                <span class="font-weight-bold text-dark">{{ $h->profesor->nombres }} {{ $h->profesor->apellidos }}</span>
                                <small class="text-muted">{{ $h->profesor->especialidad }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-muted">
                            <i class="fas fa-map-marker-alt mr-1 text-danger"></i> 
                            {{ $h->aula ?? 'No asignada' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group shadow-sm">
                            <form action="{{ route('horarios.destroy', $h->id) }}" method="POST" class="d-inline delete-form">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar Registro">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
<style>
    /* Colores Premium */
    .text-indigo { color: #6610f2 !important; }
    .btn-indigo { background-color: #6610f2; color: white; border: none; }
    .btn-indigo:hover { background-color: #520dc2; color: white; }
    .btn-outline-indigo { border-color: #6610f2; color: #6610f2; }
    .btn-outline-indigo:hover { background-color: #6610f2; color: white; }
    .card-indigo.card-outline { border-top: 3px solid #6610f2; }
    .badge-indigo { background-color: #efebff; color: #6610f2; border: 1px solid #d1c4e9; }
    
    /* Estilo de la Tabla */
    .table thead th { border: none; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; }
    .table tbody tr { transition: all 0.3s ease; border-bottom: 1px solid #f4f4f4; }
    .table tbody tr:hover { background-color: #f8f9ff !important; transform: scale(1.002); }
    .align-middle td { vertical-align: middle !important; }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#horariosTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            }
        });

        $('.delete-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "El horario será eliminado permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6610f2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    });
</script>
@stop