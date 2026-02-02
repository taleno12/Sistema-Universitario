@extends('adminlte::page')

@section('title', 'Dashboard | KT&U')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center px-3 py-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-1">
                    <li class="breadcrumb-item"><a href="#" class="text-indigo text-xs uppercase font-weight-bold">Administración</a></li>
                    <li class="breadcrumb-item active text-xs uppercase font-weight-bold" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <h1 class="text-dark font-weight-black" style="letter-spacing: -1.5px; font-size: 2.25rem;">
                {{ __('Sistema KT&U') }}
            </h1>
        </div>
        <div class="text-right d-none d-sm-block">
            <div class="p-2 px-3 bg-white shadow-sm rounded-pill border">
                <i class="far fa-clock text-indigo mr-2"></i>
                <span class="text-muted font-weight-bold" id="current-time">{{ date('d M, Y') }}</span>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    {{-- Estadísticas Principales --}}
    <div class="row">
        {{-- Card Estudiantes --}}
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-soft border-0 bg-white overflow-hidden card-hover">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted text-xs font-weight-black mb-1" style="letter-spacing: 1px;">Estudiantes</p>
                            <h2 class="font-weight-black text-dark mb-0">{{ number_format($cant_estudiantes) }}</h2>
                        </div>
                        <div class="icon-shape bg-indigo-light text-indigo rounded-lg">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm">
                        <a href="{{ route('estudiantes.index') }}" class="text-indigo font-weight-bold">
                            Gestionar registros <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Carreras --}}
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-soft border-0 bg-white overflow-hidden card-hover">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted text-xs font-weight-black mb-1" style="letter-spacing: 1px;">Oferta Académica</p>
                            <h2 class="font-weight-black text-dark mb-0">{{ $cant_carreras }}</h2>
                        </div>
                        <div class="icon-shape bg-purple-light text-purple rounded-lg">
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm">
                        <a href="{{ route('carreras.index') }}" class="text-purple font-weight-bold">
                            Ver programas <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Facultades --}}
        <div class="col-lg-4 col-md-12">
            <div class="card shadow-soft border-0 bg-dark-elegant overflow-hidden card-hover">
                <div class="card-body p-4 text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-uppercase text-white-50 text-xs font-weight-black mb-1" style="letter-spacing: 1px;">Facultades</p>
                            <h2 class="font-weight-black mb-0 text-white">{{ $cant_facultades }}</h2>
                        </div>
                        <div class="icon-shape bg-white-10 rounded-lg">
                            <i class="fas fa-university fa-2x text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm text-white-50">
                        <a href="{{ route('facultades.index') }}" class="text-white font-weight-bold">
                            Estructura Org. <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Banner de Bienvenida y Acciones Rápidas --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-soft" style="border-radius: 24px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <h2 class="font-weight-black text-dark mb-3">Hola, {{ Auth::user()->name }} 👋</h2>
                            <p class="text-muted text-lg leading-relaxed">Bienvenido al centro de mando de <strong>KT&U</strong>. Hemos optimizado la carga de datos para que gestiones a tus <span class="badge badge-indigo">Docentes</span> y alumnos con mayor rapidez.</p>
                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <a href="{{ route('estudiantes.create') }}" class="btn btn-indigo shadow-sm px-4 py-2 rounded-pill font-weight-bold mr-2">
                                    <i class="fas fa-plus-circle mr-2"></i>Nuevo Ingreso
                                </a>
                                <a href="{{ route('profesores.index') }}" class="btn btn-outline-dark px-4 py-2 rounded-pill font-weight-bold">
                                    <i class="fas fa-chalkboard-teacher mr-2"></i>Plantilla Docente
                                </a>
                            </div>
                        </div>
                        <div class="col-md-5 d-none d-md-block text-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/6213/6213816.png" style="width: 200px; opacity: 0.9;" alt="Illustration">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;600;900&display=swap');

    body {
        font-family: 'Figtree', sans-serif;
        background-color: #f4f7f6 !important;
    }

    .font-weight-black { font-weight: 900 !important; }
    .text-xs { font-size: 0.7rem !important; }
    .text-lg { font-size: 1.1rem !important; }
    
    /* Colores Personalizados */
    :root {
        --indigo-primary: #6366f1;
        --indigo-dark: #4338ca;
        --purple-primary: #a855f7;
    }

    .text-indigo { color: var(--indigo-primary) !important; }
    .bg-indigo-light { background-color: rgba(99, 102, 241, 0.1) !important; }
    .bg-purple-light { background-color: rgba(168, 85, 247, 0.1) !important; }
    .bg-white-10 { background-color: rgba(255, 255, 255, 0.1) !important; }
    
    .btn-indigo { 
        background-color: var(--indigo-primary); 
        color: white; 
        border: none;
        transition: all 0.3s;
    }
    .btn-indigo:hover { 
        background-color: var(--indigo-dark); 
        color: white; 
        transform: translateY(-2px);
    }

    /* Cards Estilo Moderno */
    .shadow-soft {
        box-shadow: 0 10px 30px rgba(0,0,0,0.04) !important;
    }

    .card-hover {
        border-radius: 20px !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card-hover:hover {
        transform: translateY(-7px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
    }

    .icon-shape {
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-dark-elegant {
        background: #0f172a !important; /* Slate 900 */
    }

    /* Ajustes AdminLTE */
    .content-wrapper { background-color: #f8fafc !important; }
    .breadcrumb-item + .breadcrumb-item::before { content: "→"; font-size: 10px; color: #cbd5e1; }
</style>
@stop