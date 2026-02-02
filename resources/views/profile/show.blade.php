@extends('adminlte::page')

@section('title', 'Mi Perfil')

@section('content_header')
    <h1 class="text-indigo"><i class="fas fa-user-circle mr-2"></i>Configuración de Mi Perfil</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        {{-- Tarjeta de Identidad del Usuario --}}
        <div class="card card-indigo card-outline shadow">
            <div class="card-body box-profile">
                <div class="text-center">
                    {{-- Usamos la lógica de fotos que ya definimos --}}
                    @if(Auth::user()->foto)
                        <img class="profile-user-img img-fluid img-circle border-indigo shadow-sm"
                             src="{{ asset('storage/' . Auth::user()->foto) }}"
                             alt="Foto de perfil" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img class="profile-user-img img-fluid img-circle border-secondary"
                             src="{{ asset('img/default-user.png') }}"
                             alt="Usuario por defecto">
                    @endif
                </div>

                <h3 class="profile-username text-center font-weight-bold">{{ Auth::user()->name }}</h3>
                <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Rol en KT&U</b> <a class="float-right badge badge-indigo">Administrador</a>
                    </li>
                    <li class="list-group-item">
                        <b>Miembro desde</b> <a class="float-right">{{ Auth::user()->created_at->format('M. Y') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        {{-- Formulario de actualización --}}
        <div class="card shadow">
            <div class="card-header p-2 bg-white">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active bg-indigo" href="#settings" data-toggle="tab">Ajustes de Cuenta</a></li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('user-profile-information.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nombre Completo</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Cambiar Foto</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" name="foto" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Elegir nueva imagen...</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9 text-right">
                            <button type="submit" class="btn btn-indigo shadow">Actualizar mi información</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .card-indigo.card-outline { border-top: 3px solid #6610f2; }
    .text-indigo { color: #6610f2 !important; }
    .bg-indigo { background-color: #6610f2 !important; color: white !important; }
    .badge-indigo { background-color: #6610f2; color: white; }
    .border-indigo { border-color: #6610f2 !important; }
</style>
@stop