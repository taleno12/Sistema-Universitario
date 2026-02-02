@extends('adminlte::page')

@section('title', 'Registrar Estudiante')

@section('content')
<div class="container-fluid pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Tarjeta Estilo KT&U --}}
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-dark">
                        <i class="fas fa-user-plus mr-2 text-primary"></i> Registrar Nuevo Estudiante
                    </h3>
                </div>

                {{-- ✅ IMPORTANTE: Se agregó enctype para permitir la subida de fotos --}}
                <form action="{{ route('estudiantes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            {{-- Sección de Foto --}}
                            <div class="col-md-12 mb-4 text-center">
                                <label class="d-block text-muted">Foto de Perfil</label>
                                <div class="custom-file w-75">
                                    <input type="file" name="foto" class="custom-file-input" id="inputFoto" accept="image/*">
                                    <label class="custom-file-label text-left" for="inputFoto">Elegir imagen...</label>
                                </div>
                                <small class="form-text text-muted">Formatos: JPG, PNG. Máximo 2MB.</small>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nombre Completo</label>
                                    <input type="text" name="nombre" class="form-control rounded-pill" placeholder="Ej. Juan Pérez" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Correo Electrónico</label>
                                    <input type="email" name="correo" class="form-control rounded-pill" placeholder="juan@ejemplo.com" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" class="form-control rounded-pill" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Facultad</label>
                                    <select name="facultad_id" class="form-control rounded-pill" required>
                                        <option value="" disabled selected>Seleccione una facultad</option>
                                        @foreach($facultades as $facultad)
                                            <option value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light d-flex justify-content-end py-3">
                        <a href="{{ route('estudiantes.index') }}" class="btn btn-link text-muted mr-3">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-5 rounded-pill shadow">
                            <i class="fas fa-save mr-1"></i> Guardar Estudiante
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
    // Script para que el nombre del archivo se vea en el input al seleccionarlo
    $(document).ready(function () {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endsection