@extends('adminlte::page')

@section('title', 'Detalle de Matrícula | KT&U')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="text-indigo font-weight-bold" style="letter-spacing: -1px;">
                <i class="fas fa-id-card text-indigo-light mr-2"></i>Expediente de Matrícula
            </h1>
            <p class="text-muted m-0">Gestión de registro académico individual</p>
        </div>
        <a href="{{ route('matriculas.index') }}" class="btn btn-light bg-white shadow-sm border px-4" style="border-radius: 12px; transition: all 0.3s;">
            <i class="fas fa-chevron-left mr-2 text-muted"></i> <span class="font-weight-bold">Volver al Listado</span>
        </a>
    </div>
@stop

@section('content')
<div class="row">
    {{-- Columna Lateral: Perfil --}}
    <div class="col-xl-4 col-lg-5">
        <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-indigo py-4 border-0"></div>
            <div class="card-body pt-0 text-center">
                <div style="margin-top: -50px;">
                    @if($matricula->estudiante->foto)
                        <img src="{{ asset('storage/' . $matricula->estudiante->foto) }}" 
                             alt="Foto Estudiante" 
                             class="rounded-circle shadow-lg border border-white" 
                             style="width: 140px; height: 140px; object-fit: cover; border-width: 5px !important;">
                    @else
                        <div class="bg-white rounded-circle shadow-lg d-flex align-items-center justify-content-center mx-auto border border-indigo" 
                             style="width: 140px; height: 140px; font-size: 55px; font-weight: 800; color: #4f46e5; border-width: 5px !important;">
                            {{ strtoupper(substr($matricula->estudiante->nombre, 0, 1)) }}
                        </div>
                    @endif
                </div>
                
                <div class="mt-3">
                    <h3 class="font-weight-bold text-dark mb-1">{{ $matricula->estudiante->nombre }} {{ $matricula->estudiante->apellido }}</h3>
                    <span class="badge badge-indigo-soft px-3 py-2" style="font-size: 0.9rem; border-radius: 10px;">
                        <i class="fas fa-user-graduate mr-1"></i> Estudiante Activo
                    </span>
                </div>

                <hr class="my-4" style="opacity: 0.1;">

                <div class="text-left px-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-shape bg-indigo-soft text-indigo mr-3">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;">Código ID</small>
                            <span class="font-weight-bold text-dark">#{{ str_pad($matricula->estudiante->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-shape bg-indigo-soft text-indigo mr-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div style="overflow: hidden;">
                            <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;">Correo Electrónico</small>
                            <span class="font-weight-bold text-dark text-truncate d-block">{{ $matricula->estudiante->email ?? 'no-reply@ktu.edu' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Columna Principal: Datos Académicos --}}
    <div class="col-xl-8 col-lg-7">
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-4 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-dark">
                        <span class="text-indigo">|</span> Información del Registro
                    </h4>
                    <span class="badge badge-pill badge-light border px-3 py-2 text-muted">
                        <i class="far fa-calendar-alt mr-1"></i> {{ $matricula->created_at->format('Y') }}
                    </span>
                </div>
            </div>
            
            <div class="card-body px-4">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="p-3 bg-light" style="border-radius: 15px; border-left: 4px solid #4f46e5;">
                            <label class="text-muted small text-uppercase font-weight-black" style="letter-spacing: 1px;">Número de Matrícula</label>
                            <p class="h4 font-weight-bold m-0 text-dark">#{{ str_pad($matricula->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="p-3 bg-light" style="border-radius: 15px; border-left: 4px solid #818cf8;">
                            <label class="text-muted small text-uppercase font-weight-black" style="letter-spacing: 1px;">Periodo Académico</label>
                            <p class="h4 font-weight-bold m-0 text-indigo">{{ $matricula->periodo }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="border rounded p-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, #ffffff 0%, #f9faff 100%); border-radius: 15px !important;">
                            <i class="fas fa-university position-absolute" style="right: -20px; bottom: -20px; font-size: 150px; opacity: 0.03; transform: rotate(-15deg);"></i>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h6 class="text-indigo font-weight-bold text-uppercase small">Carrera Destino</h6>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-graduation-cap text-muted mr-3" style="font-size: 1.5rem;"></i>
                                        <p class="h5 font-weight-bold m-0 text-dark">{{ $matricula->carrera->nombre ?? 'Sin Carrera Asignada' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-indigo font-weight-bold text-uppercase small">Asignatura Inscrita</h6>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book-open text-muted mr-3" style="font-size: 1.5rem;"></i>
                                        <p class="h5 font-weight-bold m-0 text-dark">{{ $matricula->asignatura->nombre }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <p class="text-muted small">
                            <i class="fas fa-clock mr-1"></i> Registrado el: 
                            <span class="font-weight-bold text-dark">{{ $matricula->created_at->translatedFormat('d F Y, h:i A') }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white border-0 py-4 px-4 d-flex justify-content-end gap-2">
                <a href="{{ route('matriculas.pdf_individual', $matricula->id) }}" class="btn btn-danger px-4 shadow-sm py-2 mr-2" style="border-radius: 10px; font-weight: 600;">
                    <i class="fas fa-file-pdf mr-2"></i> PDF Oficial
                </a>
                <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-indigo px-4 shadow-sm py-2" style="border-radius: 10px; font-weight: 600;">
                    <i class="fas fa-edit mr-2"></i> Modificar Datos
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Paleta de Colores KT&U */
    .text-indigo { color: #4f46e5 !important; }
    .text-indigo-light { color: #818cf8 !important; }
    .bg-indigo { background: linear-gradient(90deg, #4f46e5 0%, #6366f1 100%); }
    .bg-indigo-soft { background-color: #eef2ff; }
    .badge-indigo-soft { background-color: #eef2ff; color: #4338ca; border: 1px solid #c7d2fe; }
    .btn-indigo { background-color: #4f46e5; color: white; border: none; }
    .btn-indigo:hover { background-color: #4338ca; color: white; box-shadow: 0 8px 15px rgba(79, 70, 229, 0.2); }

    /* Estilos de Formas */
    .icon-shape {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.1rem;
    }

    .card { transition: transform 0.3s ease; }
    .card:hover { transform: translateY(-5px); }
    
    .font-weight-black { font-weight: 900; }
    
    /* Animación de entrada */
    .row {
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@stop