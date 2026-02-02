<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KT&U') }} | Gestión Universitaria</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        
        /* SIDEBAR: Estilo Moderno (Cápsulas) */
        .main-sidebar { background-color: #1e293b !important; } 
        .brand-link { border-bottom: 1px solid #334155 !important; }
        
        .nav-header { 
            color: #94a3b8 !important; 
            font-weight: 800 !important; 
            font-size: 0.65rem !important; 
            text-transform: uppercase; 
            letter-spacing: 1.2px;
            padding: 1.5rem 1rem 0.5rem 1.5rem !important;
        }

        .nav-sidebar .nav-item .nav-link {
            border-radius: 10px !important;
            margin: 3px 12px !important; /* Efecto flotante */
            color: #cbd5e1 !important;
            transition: all 0.3s ease;
        }

        .nav-sidebar .nav-item .nav-link.active {
            background-color: #6610f2 !important; /* Indigo */
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(102, 16, 242, 0.35) !important;
        }

        .nav-sidebar .nav-item .nav-link:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #ffffff !important;
        }

        /* HEADER DE PÁGINA: Fondo blanco y sombra sutil */
        .content-header-custom {
            background-color: #ffffff;
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 1.5rem;
        }

        .text-indigo { color: #6610f2 !important; }
        .main-footer { font-size: 0.85rem; }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-muted"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6610f2&color=fff" class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline font-weight-bold text-dark">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded-lg border-0 shadow">
                    <span class="dropdown-item dropdown-header font-weight-bold">Opciones de Usuario</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="fas fa-user-circle mr-2 text-indigo"></i> Mi Perfil</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ url('/home') }}" class="brand-link py-3 text-center">
            <span class="brand-text font-weight-bold" style="letter-spacing: 1px;">KT&U ACADEMY</span>
        </a>

        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    
                    <li class="nav-header">ÁREA GENERAL</li>
                    <li class="nav-item">
                        <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>Dashboard Principal</p>
                        </a>
                    </li>

                    <li class="nav-header">GESTIÓN ACADÉMICA</li>
                    <li class="nav-item">
                        <a href="{{ route('facultades.index') }}" class="nav-link {{ request()->routeIs('facultades.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-university"></i>
                            <p>Facultades</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('carreras.index') }}" class="nav-link {{ request()->routeIs('carreras.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Carreras Profesionales</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('estudiantes.index') }}" class="nav-link {{ request()->routeIs('estudiantes.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>Estudiantes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('asignaturas.index') }}" class="nav-link {{ request()->routeIs('asignaturas.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Asignaturas</p>
                        </a>
                    </li>

                    <li class="nav-header">CONTROL ESCOLAR</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Matrículas</p>
                        </a>
                    </li>

                    <li class="nav-header">CONFIGURACIÓN</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Mi Perfil</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        {{-- Encabezado de Página Dinámico --}}
        <div class="content-header-custom shadow-sm">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.5rem;">
                            @yield('page_title', 'Tablero de Control')
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right d-none d-sm-block">
                        <small class="text-muted"><i class="far fa-calendar-alt"></i> {{ date('d M, Y') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer text-center bg-white">
        <strong>&copy; {{ date('Y') }} {{ config('app.name') }}.</strong> Todos los derechos reservados.
    </footer>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>