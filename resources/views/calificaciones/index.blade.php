@extends('adminlte::page')

@section('title', 'Registro de Notas | KT&U')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="text-indigo font-weight-bold" style="letter-spacing: -1px;">
                <i class="fas fa-check-double mr-2 text-indigo-light"></i>Gestión Académica
            </h1>
            <p class="text-muted m-0">Registro y actualización de calificaciones en tiempo real</p>
        </div>
        <div class="text-right">
            <span class="badge badge-indigo-soft px-3 py-2" style="border-radius: 10px;">
                <i class="fas fa-calendar-day mr-1"></i> Periodo Actual: 2026-I
            </span>
        </div>
    </div>
@stop

@section('content')
<div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white border-0 py-4 px-4">
        <h4 class="m-0 font-weight-bold text-dark">
            <span class="text-indigo">|</span> Listado de Estudiantes Matriculados
        </h4>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">
                    <tr>
                        <th class="px-4 py-3 border-0">Estudiante</th>
                        <th class="py-3 border-0">Asignatura</th>
                        <th class="py-3 border-0 text-center" style="width: 150px;">Nota Final</th>
                        <th class="py-3 border-0 text-center">Estado Académico</th>
                        <th class="px-4 py-3 border-0 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matriculas as $m)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm-circle mr-3 bg-indigo-soft text-indigo font-weight-bold shadow-sm">
                                    @if($m->estudiante->foto)
                                        <img src="{{ asset('storage/' . $m->estudiante->foto) }}" 
                                             alt="Avatar" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        {{ strtoupper(substr($m->estudiante->nombre, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <span class="d-block font-weight-bold text-dark">{{ $m->estudiante->nombre }} {{ $m->estudiante->apellido }}</span>
                                    <small class="text-muted">ID: #{{ str_pad($m->estudiante->id, 4, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="font-weight-600 text-indigo">{{ $m->asignatura->nombre }}</span>
                                <small class="text-muted font-italic">{{ $m->carrera->nombre ?? 'General' }}</small>
                            </div>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('calificaciones.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="matricula_id" value="{{ $m->id }}">
                                <div class="input-group input-group-sm mx-auto shadow-xs" style="width: 90px;">
                                    <input type="number" 
                                           name="nota_final" 
                                           value="{{ $m->calificacion->nota_final ?? 0 }}" 
                                           class="form-control text-center font-weight-bold border-indigo-light"
                                           onchange="this.form.submit()"
                                           min="0" max="100"
                                           style="border-radius: 10px; height: 35px;">
                                </div>
                            </form>
                        </td>
                        <td class="text-center">
                            @php 
                                $nota = $m->calificacion->nota_final ?? 0;
                                $statusClass = ($nota >= 60) ? 'badge-success-soft text-success' : ($nota > 0 ? 'badge-danger-soft text-danger' : 'badge-light text-muted');
                                $statusIcon = ($nota >= 60) ? 'fa-check-circle' : ($nota > 0 ? 'fa-times-circle' : 'fa-clock');
                            @endphp
                            <span class="badge badge-pill px-3 py-2 {{ $statusClass }}" style="font-size: 0.8rem; border-radius: 12px;">
                                <i class="fas {{ $statusIcon }} mr-1"></i>
                                {{ $nota >= 60 ? 'Aprobado' : ($nota > 0 ? 'Reprobado' : 'Sin Nota') }}
                            </span>
                        </td>
                        <td class="px-4 text-right">
                            <div class="btn-group shadow-xs" style="border-radius: 10px; overflow: hidden;">
                                <a href="{{ route('calificaciones.show', $m->id) }}" class="btn btn-sm btn-white text-indigo border-right" title="Ver Historial">
                                    <i class="fas fa-chart-line"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-white text-danger" title="Borrar Registro" onclick="confirmDelete('{{ $m->id }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Sin datos" style="width: 80px; opacity: 0.5;">
                            <p class="text-muted mt-3">No hay estudiantes registrados en este periodo.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Colores KT&U */
    .text-indigo { color: #4f46e5 !important; }
    .text-indigo-light { color: #818cf8 !important; }
    .bg-indigo-soft { background-color: #eef2ff; }
    .badge-indigo-soft { background-color: #eef2ff; color: #4338ca; border: 1px solid #c7d2fe; }
    .border-indigo-light { border-color: #c7d2fe !important; }

    /* Estados Suaves */
    .badge-success-soft { background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
    .badge-danger-soft { background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    /* Estética de Elementos */
    .avatar-sm-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
    .font-weight-600 { font-weight: 600; }
    .shadow-xs { box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    
    .table thead th { border-top: none !important; }
    .table tbody tr:hover { background-color: #f9faff; transition: all 0.2s; }
    
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; margin: 0; 
    }
</style>
@stop