@extends('adminlte::page')

@section('title', 'Expediente Académico | KT&U')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-indigo font-weight-bold">
                <i class="fas fa-file-signature mr-2 text-indigo-light"></i>Expediente de Calificaciones
            </h1>
            <p class="text-muted m-0">Reporte detallado por asignatura</p>
        </div>
        <a href="{{ route('calificaciones.index') }}" class="btn btn-outline-indigo px-4 shadow-sm" style="border-radius: 12px; font-weight: 600;">
            <i class="fas fa-chevron-left mr-2"></i>Volver al Registro
        </a>
    </div>
@stop

@section('content')
<div class="row">
    {{-- Tarjeta de Información del Estudiante --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-lg text-center" style="border-radius: 20px; overflow: hidden;">
            <div class="bg-indigo py-5"></div>
            <div class="card-body pt-0">
                <div style="margin-top: -50px;">
                    @if($matricula->estudiante->foto)
                        <img src="{{ asset('storage/' . $matricula->estudiante->foto) }}" 
                             class="rounded-circle shadow border border-white" 
                             style="width: 120px; height: 120px; object-fit: cover; border-width: 5px !important;">
                    @else
                        <div class="bg-white rounded-circle shadow d-flex align-items-center justify-content-center mx-auto border border-indigo" 
                             style="width: 120px; height: 120px; font-size: 50px; font-weight: 800; color: #4f46e5; border-width: 5px !important;">
                            {{ strtoupper(substr($matricula->estudiante->nombre, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h4 class="font-weight-bold mt-3 mb-1 text-dark">{{ $matricula->estudiante->nombre }} {{ $matricula->estudiante->apellido }}</h4>
                <p class="text-muted small mb-3">ID: #{{ str_pad($matricula->estudiante->id, 5, '0', STR_PAD_LEFT) }}</p>
                
                <div class="d-flex justify-content-around bg-light p-3" style="border-radius: 15px;">
                    <div>
                        <small class="text-muted d-block">Estado</small>
                        <span class="badge badge-pill {{ ($matricula->calificacion->nota_final ?? 0) >= 60 ? 'badge-success' : 'badge-danger' }}">
                            {{ ($matricula->calificacion->nota_final ?? 0) >= 60 ? 'ACTIVO' : 'ALERTA' }}
                        </span>
                    </div>
                    <div style="border-left: 1px solid #ddd; padding-left: 15px;">
                        <small class="text-muted d-block">Promedio</small>
                        <span class="font-weight-bold text-indigo h5">{{ $matricula->calificacion->nota_final ?? '0.00' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detalle de la Asignatura --}}
    <div class="col-md-8">
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-4 px-4">
                <h4 class="font-weight-bold text-dark m-0"><i class="fas fa-book-reader mr-2 text-indigo"></i>Detalle de Carga Académica</h4>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr class="text-muted small text-uppercase" style="letter-spacing: 1px; border-bottom: 2px solid #f4f6f9;">
                                <th>Asignatura / Carrera</th>
                                <th class="text-center">Nota</th>
                                <th class="text-center">Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #f4f6f9;">
                                <td class="py-4">
                                    <span class="d-block font-weight-bold h5 text-dark mb-0">{{ $matricula->asignatura->nombre }}</span>
                                    <small class="text-muted">{{ $matricula->carrera->nombre ?? 'Tronco Común' }}</small>
                                </td>
                                <td class="py-4 text-center">
                                    <div class="h4 font-weight-bold mb-0 text-indigo">{{ $matricula->calificacion->nota_final ?? '0' }}</div>
                                    <small class="text-muted">Puntos</small>
                                </td>
                                <td class="py-4 text-center align-middle">
                                    @php $nota = $matricula->calificacion->nota_final ?? 0; @endphp
                                    <div class="p-2 {{ $nota >= 60 ? 'bg-success-soft text-success' : 'bg-danger-soft text-danger' }}" style="border-radius: 10px; font-weight: 700;">
                                        {{ $nota >= 60 ? 'APROBADO' : 'REPROBADO' }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 p-4 bg-indigo-soft" style="border-radius: 15px; border-left: 5px solid #4f46e5;">
                    <h6 class="font-weight-bold text-indigo"><i class="fas fa-info-circle mr-2"></i>Observaciones del Sistema</h6>
                    <p class="text-muted small mb-0">
                        @if($nota >= 60)
                            El estudiante ha cumplido satisfactoriamente con los objetivos de la asignatura. Se recomienda proceder con la certificación del periodo.
                        @else
                            El puntaje obtenido es inferior al mínimo requerido (60 pts). El estudiante deberá realizar un examen de recuperación o recursar la asignatura.
                        @endif
                    </p>
                </div>
            </div>
            <div class="card-footer bg-white border-0 text-right pb-4 px-4">
                <button onclick="window.print();" class="btn btn-dark shadow-sm px-4" style="border-radius: 10px;">
                    <i class="fas fa-print mr-2"></i>Imprimir Boleta
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .text-indigo { color: #4f46e5 !important; }
    .text-indigo-light { color: #818cf8 !important; }
    .bg-indigo { background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); }
    .bg-indigo-soft { background-color: #f5f7ff; }
    .bg-success-soft { background-color: #ecfdf5; }
    .bg-danger-soft { background-color: #fef2f2; }
    .btn-outline-indigo { color: #4f46e5; border-color: #4f46e5; }
    .btn-outline-indigo:hover { background-color: #4f46e5; color: white; }
    
    @media print {
        .btn, .main-footer, .nav-item { display: none !important; }
        .content-wrapper { background: white !important; margin: 0 !important; padding: 0 !important; }
        .card { shadow: none !important; border: 1px solid #ddd !important; }
    }
</style>
@stop