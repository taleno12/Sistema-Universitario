@extends('adminlte::page')

@section('title', 'Detalle Estudiante | KT&U')

@section('content_header')
    <h1><i class="fas fa-user-graduate mr-2 text-primary"></i>Perfil del Estudiante</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Columna de la Foto --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline shadow-sm">
                <div class="card-body box-profile">
                    <div class="text-center mb-3">
                        @if($estudiante->foto)
                            {{-- Se busca la foto en el storage público --}}
                            <img class="profile-user-img img-fluid img-circle elevation-2"
                                 src="{{ asset('storage/' . $estudiante->foto) }}"
                                 alt="Foto de {{ $estudiante->nombre }}"
                                 style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #6610f2;">
                        @else
                            {{-- Avatar por defecto si no hay foto --}}
                            <img class="profile-user-img img-fluid img-circle elevation-2"
                                 src="https://ui-avatars.com/api/?name={{ urlencode($estudiante->nombre) }}&background=6610f2&color=fff&size=150"
                                 alt="Avatar predeterminado">
                        @endif
                    </div>

                    <h3 class="profile-username text-center font-weight-bold text-dark">{{ $estudiante->nombre }}</h3>
                    <p class="text-muted text-center">{{ $estudiante->facultad->nombre }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Estado</b> <a class="float-right text-success font-weight-bold">Activo</a>
                        </li>
                        <li class="list-group-item">
                            <b>ID Estudiante</b> <a class="float-right text-secondary">#{{ str_pad($estudiante->id, 5, '0', STR_PAD_LEFT) }}</a>
                        </li>
                    </ul>

                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-primary btn-block rounded-pill">
                        <i class="fas fa-edit mr-1"></i> <b>Editar Perfil</b>
                    </a>
                </div>
            </div>
        </div>

        {{-- Columna de Información --}}
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header p-3 bg-white">
                    <h3 class="card-title text-bold text-primary">
                        <i class="fas fa-id-card mr-2"></i>Información Detallada
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row border-bottom py-3">
                        <div class="col-sm-4 font-weight-bold text-muted">Nombre Completo</div>
                        <div class="col-sm-8 text-dark">{{ $estudiante->nombre }}</div>
                    </div>
                    <div class="row border-bottom py-3">
                        <div class="col-sm-4 font-weight-bold text-muted">Correo Electrónico</div>
                        <div class="col-sm-8 text-dark">{{ $estudiante->correo }}</div>
                    </div>
                    <div class="row border-bottom py-3">
                        <div class="col-sm-4 font-weight-bold text-muted">Fecha de Nacimiento</div>
                        <div class="col-sm-8 text-dark">
                            <span class="badge badge-light p-2 border">
                                <i class="far fa-calendar-alt mr-1"></i> 
                                {{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->format('d \d\e F, Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-sm-4 font-weight-bold text-muted">Facultad</div>
                        <div class="col-sm-8">
                            <span class="badge badge-info px-3 py-2 shadow-sm">
                                <i class="fas fa-university mr-1"></i> {{ $estudiante->facultad->nombre }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('estudiantes.index') }}" class="btn btn-outline-secondary rounded-pill">
                        <i class="fas fa-arrow-left mr-1"></i> Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop