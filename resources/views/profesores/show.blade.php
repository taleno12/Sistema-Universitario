@extends('adminlte::page')

@section('title', 'Perfil del Docente')

@section('content_header')
    <h1 class="text-indigo"><i class="fas fa-user-tie mr-2"></i>Perfil del Docente</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5">
            {{-- Tarjeta de Perfil --}}
            <div class="card card-indigo card-outline shadow-lg">
                <div class="card-body box-profile">
                    <div class="text-center mb-3">
                        @if($profesor->foto)
                            <img class="profile-user-img img-fluid img-circle shadow border-indigo"
                                 src="{{ asset('storage/' . $profesor->foto) }}"
                                 alt="Foto de {{ $profesor->nombres }}"
                                 style="width: 150px; height: 150px; object-fit: cover; border-width: 3px !important;">
                        @else
                            <img class="profile-user-img img-fluid img-circle shadow border-secondary"
                                 src="{{ asset('img/default-user.png') }}"
                                 alt="Sin foto"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </div>

                    <h3 class="profile-username text-center font-weight-bold text-indigo">
                        {{ $profesor->nombres }} {{ $profesor->apellidos }}
                    </h3>

                    <p class="text-muted text-center">
                        <span class="badge badge-indigo px-3 py-2">{{ $profesor->grado_academico }}</span>
                    </p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Código de Empleado</b> <a class="float-right text-dark font-weight-bold">{{ $profesor->codigo }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>DNI / Identificación</b> <a class="float-right text-dark">{{ $profesor->dni }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Especialidad</b> <a class="float-right text-dark">{{ $profesor->especialidad }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Correo Electrónico</b> <a class="float-right text-indigo" href="mailto:{{ $profesor->email }}">{{ $profesor->email }}</a>
                        </li>
                    </ul>

                    <div class="row pt-3">
                        <div class="col-6">
                            <a href="{{ route('profesores.edit', $profesor->id) }}" class="btn btn-primary btn-block shadow-sm">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('profesores.index') }}" class="btn btn-outline-secondary btn-block shadow-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Información Adicional opcional --}}
        <div class="col-md-7">
            <div class="card shadow-lg">
                <div class="card-header bg-indigo">
                    <h3 class="card-title text-white">Resumen de Actividad</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Este docente forma parte de la plantilla activa de <strong>KT&U</strong>. 
                        Asegúrate de que sus datos estén siempre actualizados para la generación de horarios y actas de calificación.
                    </p>
                    <hr>
                    <strong><i class="fas fa-calendar-alt mr-1 text-indigo"></i> Fecha de Registro</strong>
                    <p class="text-muted">{{ $profesor->created_at->format('d \d\e F, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .card-indigo.card-outline { border-top: 3px solid #6610f2; }
    .bg-indigo { background-color: #6610f2 !important; }
    .text-indigo { color: #6610f2 !important; }
    .badge-indigo { background-color: #6610f2; color: white; }
    .border-indigo { border-color: #6610f2 !important; }
</style>
@stop