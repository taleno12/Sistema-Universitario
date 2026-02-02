@extends('adminlte::page')

@section('title', 'Crear Carrera | KT&U')

@section('content_header')
    <h1>Registrar Nueva Carrera</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('carreras.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nombre de la Carrera</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Descripción (Opcional)</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Facultad a la que pertenece</label>
                <select name="facultade_id" class="form-control" required>
                    <option value="">-- Seleccione una Facultad --</option>
                    @foreach($facultades as $facultad)
                        <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Carrera</button>
            <a href="{{ route('carreras.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop