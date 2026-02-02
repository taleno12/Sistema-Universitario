@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario: {{ $usuario->nombre }}</h1>
@stop

@section('content')
<div class="card card-warning shadow">
    <div class="card-header">
        <h3 class="card-title">Modificar credenciales y perfil</h3>
    </div>
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
            </div>
            <div class="form-group">
                <label>Nueva Contraseña (dejar en blanco para no cambiar)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Foto actual</label><br>
                <img src="{{ asset('storage/'.$usuario->foto) }}" width="80" class="img-circle mb-2">
                <input type="file" name="foto" class="form-control-file">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">Actualizar Datos</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@stop