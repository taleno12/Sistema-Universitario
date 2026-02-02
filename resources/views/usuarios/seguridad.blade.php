@extends('adminlte::page')

@section('title', 'Seguridad de la Cuenta')

@section('content_header')
    <h1><i class="fas fa-shield-alt mr-2 text-primary"></i>Configuración de Seguridad</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary shadow">
            <div class="card-header">
                <h3 class="card-title">Cambiar Contraseña</h3>
            </div>
            
            <form action="{{ route('usuarios.seguridad.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="password_actual">Contraseña Actual</label>
                        <input type="password" name="password_actual" class="form-control @error('password_actual') is-invalid @enderror" placeholder="Introduce tu clave actual" required>
                        @error('password_actual')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="password">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres" required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repite la nueva clave" required>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Actualizar Seguridad
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-info card-outline shadow">
            <div class="card-header">
                <h3 class="card-title">Información de Inicio de Sesión</h3>
            </div>
            <div class="card-body box-profile">
                <div class="text-center">
                    @if(auth()->user()->foto)
                        <img class="profile-user-img img-fluid img-circle shadow"
                             src="{{ asset('storage/' . auth()->user()->foto) }}"
                             alt="User profile picture" style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                             alt="User profile picture">
                    @endif
                </div>

                <h3 class="profile-username text-center mt-3">{{ auth()->user()->nombre }}</h3>
                <p class="text-muted text-center">{{ strtoupper(auth()->user()->rol) }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Correo Electrónico</b> <a class="float-right">{{ auth()->user()->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Estado</b> <a class="float-right badge badge-success">Activo</a>
                    </li>
                    <li class="list-group-item">
                        <b>Miembro desde</b> <a class="float-right">{{ auth()->user()->created_at->format('d/M/Y') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop