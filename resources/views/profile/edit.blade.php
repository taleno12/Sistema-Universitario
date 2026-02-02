@extends('adminlte::page')

@section('title', 'Mi Perfil | KT&U')

@section('content_header')
    <h1 class="text-indigo font-weight-bold">
        <i class="fas fa-user-circle mr-2"></i>Identidad Institucional
    </h1>
@stop

@section('content')
<div class="container-fluid pb-5">
    <div class="row">
        {{-- LADO IZQUIERDO: Tarjeta de Identidad --}}
        <div class="col-md-4">
            <div class="card card-indigo card-outline shadow-lg">
                <div class="card-body box-profile">
                    <div class="text-center position-relative mb-3">
                        @if(Auth::user()->foto)
                            <img class="profile-user-img img-fluid img-circle border-indigo shadow-lg"
                                 src="{{ asset('storage/' . Auth::user()->foto) }}"
                                 alt="Foto de perfil"
                                 style="width: 160px; height: 160px; object-fit: cover; border-width: 4px !important;">
                        @else
                            <div class="mx-auto d-flex align-items-center justify-content-center bg-light img-circle shadow-sm" 
                                 style="width: 160px; height: 160px; border: 3px dashed #6610f2">
                                <i class="fas fa-user text-indigo fa-4x"></i>
                            </div>
                        @endif
                    </div>

                    <h3 class="profile-username text-center text-indigo font-weight-bold mb-0">{{ Auth::user()->nombre }}</h3>
                    <p class="text-muted text-center mb-3">{{ Auth::user()->email }}</p>

                    <form action="{{ route('profile.update.foto') }}" method="POST" enctype="multipart/form-data" class="text-center">
                        @csrf
                        @method('PATCH')
                        <label class="btn btn-outline-indigo btn-sm shadow-sm">
                            <i class="fas fa-camera mr-1"></i> Actualizar Avatar
                            <input type="file" name="foto" onchange="form.submit()" style="display: none;">
                        </label>
                    </form>

                    <hr class="my-4">

                    <div class="bg-indigo p-3 rounded shadow-sm text-white text-center">
                        <small class="text-uppercase d-block mb-1" style="letter-spacing: 1px;">Rango de Acceso</small>
                        <span class="badge badge-light px-3 text-indigo py-2 w-100">
                             <i class="fas fa-user-shield mr-1"></i> {{ strtoupper(Auth::user()->rol ?? 'Administrador') }}
                        </span>
                        <div class="mt-3 small">
                            <i class="fas fa-clock mr-1"></i> Miembro desde: {{ Auth::user()->created_at->format('M, Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- LADO DERECHO: Información Personal --}}
        <div class="col-md-8">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h3 class="card-title text-indigo font-weight-bold">
                        <i class="fas fa-id-card mr-2"></i> Datos de Contacto
                    </h3>
                </div>
                <div class="card-body bg-light-gray pt-0">
                    <div class="p-4 bg-white rounded shadow-sm border">
                        <p class="text-muted mb-4 small">Actualiza tu nombre de pila y dirección de correo electrónico institucional.</p>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Tip informativo en lugar del formulario de password --}}
            <div class="alert alert-info border-0 shadow-sm">
                <h5><i class="icon fas fa-shield-alt"></i> ¿Buscas cambiar tu contraseña?</h5>
                Para gestionar tus credenciales de acceso, dirígete a la sección de <strong>Mi Seguridad</strong> en el menú lateral.
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    :root { --indigo-kt: #6610f2; }
    .text-indigo { color: var(--indigo-kt) !important; }
    .btn-outline-indigo { color: var(--indigo-kt); border-color: var(--indigo-kt); border-radius: 8px; transition: 0.3s; }
    .btn-outline-indigo:hover { background-color: var(--indigo-kt); color: white; transform: scale(1.05); }
    .card-indigo.card-outline { border-top: 4px solid var(--indigo-kt); }
    .border-indigo { border-color: var(--indigo-kt) !important; }
    .bg-light-gray { background-color: #f4f6f9; }
    
    /* Estilos para inputs de Breeze/Laravel */
    input[type="text"], input[type="email"] {
        border-radius: 8px !important;
        border: 1px solid #dee2e6 !important;
        padding: 12px 15px !important;
        transition: 0.3s;
    }
    input:focus {
        border-color: var(--indigo-kt) !important;
        box-shadow: 0 0 0 0.2rem rgba(102, 16, 242, .15) !important;
    }
    
    button[type="submit"] {
        background-color: var(--indigo-kt) !important;
        border-radius: 8px !important;
        padding: 10px 30px !important;
        font-weight: bold;
        box-shadow: 0 4px 6px rgba(102, 16, 242, 0.2);
    }
</style>
@stop