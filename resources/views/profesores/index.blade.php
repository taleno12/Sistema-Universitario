@extends('adminlte::page')

@section('title', 'Cuerpo Docente | KT&U')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-indigo font-weight-bold">
            <i class="fas fa-chalkboard-teacher mr-2"></i>Gestión de Docentes
        </h1>
        <div>
            <a href="{{ route('profesores.pdf') }}" target="_blank" class="btn btn-danger shadow-sm rounded-pill px-4 mr-2">
                <i class="fas fa-file-pdf mr-1"></i> Exportar PDF
            </a>
            <a href="{{ route('profesores.create') }}" class="btn btn-indigo shadow-sm rounded-pill px-4">
                <i class="fas fa-plus-circle mr-1"></i> Nuevo Profesor
            </a>
        </div>
    </div>
@stop

@section('content')
<div class="card card-outline card-indigo shadow-lg">
    <div class="card-body">
        <table id="tabla-profesores" class="table table-hover table-striped">
            <thead class="bg-indigo text-white">
                <tr>
                    <th>CÓDIGO</th>
                    <th>DOCENTE</th>
                    <th>ESPECIALIDAD</th>
                    <th>GRADO</th>
                    <th>ESTADO</th>
                    <th class="text-center">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profesores as $profe)
                <tr>
                    <td class="font-weight-bold align-middle">{{ $profe->codigo }}</td>
                    <td class="align-middle">
                        <div class="d-flex align-items-center">
                            {{-- Lógica de Foto del Docente --}}
                            @if($profe->foto)
                                <img src="{{ asset('storage/' . $profe->foto) }}" 
                                     class="rounded-circle mr-2 shadow-sm border" 
                                     width="45" height="45" style="object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($profe->nombres . ' ' . $profe->apellidos) }}&background=6610f2&color=fff" 
                                     class="rounded-circle mr-2 shadow-sm" 
                                     width="45">
                            @endif
                            
                            <div>
                                <span class="d-block font-weight-bold">{{ $profe->nombres }} {{ $profe->apellidos }}</span>
                                <small class="text-muted"><i class="fas fa-envelope fa-xs"></i> {{ $profe->email }}</small>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle">{{ $profe->especialidad }}</td>
                    <td class="align-middle">
                        <span class="badge badge-info shadow-sm">{{ $profe->grado_academico }}</span>
                    </td>
                    <td class="align-middle">
                        @if($profe->estado == 'Activo')
                            <span class="badge badge-success px-3 shadow-sm">Activo</span>
                        @else
                            <span class="badge badge-danger px-3 shadow-sm">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-center align-middle">
                        <div class="btn-group">
                            <a href="{{ route('profesores.show', $profe->id) }}" class="btn btn-sm btn-outline-primary shadow-sm" title="Ver Perfil">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('profesores.edit', $profe->id) }}" class="btn btn-sm btn-outline-warning shadow-sm mx-1" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            {{-- Botón de Eliminar con Formulario --}}
                            <form action="{{ route('profesores.destroy', $profe->id) }}" method="POST" class="form-eliminar d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm" title="Eliminar Docente">
                                    <i class="fas fa-trash"></i>
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
    .btn-indigo { background-color: #6610f2; color: white; }
    .btn-indigo:hover { background-color: #520dc2; color: white; }
    .text-indigo { color: #6610f2; }
    .bg-indigo { background-color: #6610f2 !important; }
    .table thead th { border: none; vertical-align: middle; }
    .shadow-sm { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Inicializar DataTable
        $('#tabla-profesores').DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [[0, "desc"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
        });

        // Confirmación de Eliminación con SweetAlert2
        $('.form-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción eliminará permanentemente al docente y su fotografía!",
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

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Operación Exitosa!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#6610f2',
    });
</script>
@endif
@stop