@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('content_header')
    <h1>Registrar Nuevo Usuario</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos del Usuario</h3>
            </div>
            
            <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ej: Juan Pérez" required>
                        @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required>
                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rol">Rol de Usuario</label>
                                <select name="rol" class="form-control">
                                    <option value="admin">Administrador</option>
                                    <option value="docente">Docente</option>
                                    <option value="editor">Editor / Bedel</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto de Perfil</label>
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto" accept="image/*">
                            <label class="custom-file-label" for="foto">Elegir imagen...</label>
                        </div>
                        <small class="text-muted">Formato sugerido: JPG o PNG (Max 2MB)</small>
                    </div>

                    <div class="text-center mt-3">
                        <img id="preview" src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" style="width: 120px; height: 120px; object-fit: cover; display: none;">
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    // Lógica para mostrar la imagen seleccionada antes de subirla
    document.getElementById('foto').onchange = function (evt) {
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'inline-block';
            // Actualizar nombre del archivo en el label
            const fileName = this.files[0].name;
            this.nextElementSibling.innerText = fileName;
        }
    }
</script>
@stop