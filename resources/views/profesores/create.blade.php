@extends('adminlte::page')

@section('title', 'Nuevo Profesor | KT&U')

@section('content_header')
    <h1 class="text-indigo font-weight-bold"><i class="fas fa-user-tie mr-2"></i>Registrar Docente</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-11">
        <form action="{{ route('profesores.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card card-outline card-indigo shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center border-right">
                            <label class="d-block">Fotografía del Docente</label>
                            <div id="preview-container" class="mb-3">
                                <img id="foto-preview" src="{{ asset('img/user-default.png') }}" 
                                     class="img-fluid rounded shadow-sm border" 
                                     style="width: 180px; height: 180px; object-fit: cover;">
                            </div>
                            <div class="custom-file">
                                <input type="file" name="foto" id="foto-input" class="custom-file-input" accept="image/*">
                                <label class="custom-file-label" for="foto-input">Elegir...</label>
                            </div>
                            <small class="text-muted">Formatos: JPG, PNG, WEBP (Máx. 2MB)</small>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>DNI / Cédula</label>
                                    <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Nombres</label>
                                    <input type="text" name="nombres" class="form-control" value="{{ old('nombres') }}" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Email Institucional</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Especialidad</label>
                                    <input type="text" name="especialidad" class="form-control" placeholder="Ej: Ingeniería de Software" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Grado Académico</label>
                                    <select name="grado_academico" class="form-control">
                                        <option value="Licenciado">Licenciado / Ing.</option>
                                        <option value="Magíster">Magíster</option>
                                        <option value="Doctor">Doctor</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Teléfono</label>
                                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white text-right">
                    <a href="{{ route('profesores.index') }}" class="btn btn-secondary rounded-pill px-4">Cancelar</a>
                    <button type="submit" class="btn btn-indigo rounded-pill px-4">
                        <i class="fas fa-save mr-1"></i> Guardar Docente
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
    // Script para previsualizar la foto en tiempo real
    document.getElementById('foto-input').onchange = function (evt) {
        const [file] = this.files;
        if (file) {
            document.getElementById('foto-preview').src = URL.createObjectURL(file);
            // Mostrar nombre del archivo en el label de Bootstrap
            let fileName = this.value.split('\\').pop();
            this.nextElementSibling.classList.add("selected");
            this.nextElementSibling.innerHTML = fileName;
        }
    }
</script>
@stop

@section('css')
<style>
    .btn-indigo { background-color: #6610f2; color: white; }
    .btn-indigo:hover { background-color: #520dc2; color: white; }
    .text-indigo { color: #6610f2; }
    .card-indigo.card-outline { border-top: 3px solid #6610f2; }
</style>
@stop