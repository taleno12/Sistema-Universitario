@extends('adminlte::page')

@section('title', 'Editar Estudiante | KT&U')

@section('content_header')
    <div class="container-fluid">
        <h1><i class="fas fa-user-edit mr-2 text-info"></i>Editar Estudiante</h1>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-outline card-info shadow-lg border-0">
                <div class="card-header bg-white">
                    <h3 class="card-title font-weight-bold">Formulario de Actualización</h3>
                </div>

                {{-- ✅ IMPORTANTE: Se agregó enctype="multipart/form-data" --}}
                <form action="{{ route('estudiantes.update', $estudiante->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            {{-- Sección de Fotografía Actual --}}
                            <div class="col-md-12 text-center mb-4">
                                <label class="d-block text-muted">Fotografía del Estudiante</label>
                                <div class="mb-3">
                                    @if($estudiante->foto)
                                        <img src="{{ asset('storage/' . $estudiante->foto) }}" 
                                             class="img-circle elevation-2 shadow" 
                                             style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #17a2b8;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($estudiante->nombre) }}&background=17a2b8&color=fff&size=120" 
                                             class="img-circle elevation-2 shadow">
                                    @endif
                                </div>
                                <div class="custom-file w-75">
                                    <input type="file" name="foto" class="custom-file-input" id="inputFoto" accept="image/*">
                                    <label class="custom-file-label text-left" for="inputFoto">¿Deseas cambiar la foto?</label>
                                </div>
                                <small class="form-text text-muted mt-2">Formatos permitidos: JPG, PNG. Máx: 2MB.</small>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nombre Completo</label>
                                    <input type="text" name="nombre" value="{{ $estudiante->nombre }}" class="form-control rounded-pill" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Correo Electrónico</label>
                                    <input type="email" name="correo" value="{{ $estudiante->correo }}" class="form-control rounded-pill" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" value="{{ $estudiante->fecha_nacimiento }}" class="form-control rounded-pill" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Facultad</label>
                                    <select name="facultad_id" class="form-control rounded-pill" required>
                                        @foreach($facultades as $facultad)
                                            <option value="{{ $facultad->id }}" {{ $estudiante->facultad_id == $facultad->id ? 'selected' : '' }}>
                                                {{ $facultad->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('estudiantes.index') }}" class="btn btn-link text-muted mr-3">Cancelar</a>
                        <button type="submit" class="btn btn-info px-5 rounded-pill shadow-sm">
                            <i class="fas fa-sync-alt mr-1"></i> Actualizar Estudiante
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Script para mostrar el nombre del archivo seleccionado en el label
    $(document).ready(function () {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endsection