@extends('adminlte::page')

@section('title', 'Editar Docente')

@section('content_header')
    <h1 class="text-indigo font-weight-bold"><i class="fas fa-user-edit mr-2"></i>Editar Datos del Docente</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-outline card-indigo shadow-lg">
            <form action="{{ route('profesores.update', $profesor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Crucial para que el controlador sepa que es una actualización --}}

                <div class="card-body">
                    <div class="row">
                        {{-- Sección de la Foto Actual --}}
                        <div class="col-md-4 text-center border-right">
                            <label class="d-block text-indigo">Fotografía Actual</label>
                            @if($profesor->foto)
                                <img src="{{ asset('storage/' . $profesor->foto) }}" 
                                     class="img-thumbnail shadow-sm mb-3" 
                                     style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                            @else
                                <img src="{{ asset('img/default-user.png') }}" 
                                     class="img-thumbnail mb-3" 
                                     style="width: 200px; height: 200px; opacity: 0.6;">
                            @endif
                            
                            <div class="form-group mt-2">
                                <label for="foto" class="text-muted">Cambiar Fotografía (Opcional)</label>
                                <div class="custom-file text-left">
                                    <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" accept="image/*">
                                    <label class="custom-file-label" for="foto">Elegir archivo...</label>
                                    @error('foto') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <small class="text-muted">Formatos: JPG, PNG, WEBP. Máx: 2MB</small>
                            </div>
                        </div>

                        {{-- Datos Personales --}}
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres', $profesor->nombres) }}" required>
                                    @error('nombres') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos', $profesor->apellidos) }}" required>
                                    @error('apellidos') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="dni">DNI / Cédula</label>
                                    <input type="text" name="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni', $profesor->dni) }}" required>
                                    @error('dni') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $profesor->email) }}" required>
                                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="especialidad">Especialidad</label>
                                    <input type="text" name="especialidad" class="form-control @error('especialidad') is-invalid @enderror" value="{{ old('especialidad', $profesor->especialidad) }}" required>
                                    @error('especialidad') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="grado_academico">Grado Académico</label>
                                    <select name="grado_academico" class="form-control shadow-sm">
                                        <option value="Licenciado" {{ $profesor->grado_academico == 'Licenciado' ? 'selected' : '' }}>Licenciado/a</option>
                                        <option value="Maestría" {{ $profesor->grado_academico == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                        <option value="Doctorado" {{ $profesor->grado_academico == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                        <option value="Ingeniero" {{ $profesor->grado_academico == 'Ingeniero' ? 'selected' : '' }}>Ingeniero/a</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between bg-white">
                    <a href="{{ route('profesores.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-times mr-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-indigo px-5 shadow">
                        <i class="fas fa-sync-alt mr-1"></i> Actualizar Docente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    // Script para que el nombre del archivo aparezca en el input custom de Bootstrap
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@stop

@section('css')
<style>
    .card-indigo.card-outline { border-top: 3px solid #6610f2; }
    .btn-indigo { background-color: #6610f2; color: white; }
    .btn-indigo:hover { background-color: #520dc2; color: white; }
    .text-indigo { color: #6610f2; }
</style>
@stop