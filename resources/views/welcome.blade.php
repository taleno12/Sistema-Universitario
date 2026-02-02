<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KT&U | Sistema de Gestión Universitaria</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,900&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        
        <style>
            body { font-family: 'Figtree', sans-serif; }
            
            .glass-nav {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }

            .dark .glass-nav {
                background: rgba(10, 10, 15, 0.8);
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .hero-gradient {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 100%;
                height: 600px;
                background: radial-gradient(circle at 50% 0%, rgba(147, 51, 234, 0.08) 0%, transparent 70%);
                z-index: -1;
            }

            .card-premium {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                border: 1px solid rgba(0, 0, 0, 0.03);
            }

            .card-premium:hover {
                transform: translateY(-5px);
                border-color: rgba(147, 51, 234, 0.3);
            }
        </style>
    </head>
    <body class="antialiased bg-[#fafafa] dark:bg-[#050507] text-gray-900 dark:text-gray-100">
        
        <div class="hero-gradient"></div>

        <nav class="fixed w-full z-50 top-0 glass-nav">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-4">
                        <div class="bg-purple-600 p-2 rounded-xl shadow-lg shadow-purple-500/30">
                            <span class="text-xl font-black text-white tracking-tighter">KT</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold tracking-tight leading-none">KT&U</span>
                            <span class="text-[10px] font-bold text-purple-600 uppercase tracking-[0.2em]">Management</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}" class="text-sm font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">Panel de Control</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="bg-red-500/10 text-red-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-500 hover:text-white transition-all">
                                        Salir
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 dark:text-gray-400 hover:text-purple-600 transition">Entrar</a>
                                <a href="{{ route('register') }}" class="bg-gray-900 dark:bg-white dark:text-black text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-xl active:scale-95 transition-all">
                                    Empezar ahora
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main class="relative pt-32 pb-20 px-6">
            <div class="max-w-6xl mx-auto">
                
                <header class="max-w-3xl mb-16">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-50 dark:bg-purple-900/30 border border-purple-100 dark:border-purple-800/50 mb-6">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-500"></span>
                        </span>
                        <span class="text-[11px] font-black text-purple-700 dark:text-purple-300 uppercase tracking-widest">Soporte Académico v1.2</span>
                    </div>
                    
                    <h1 class="text-6xl md:text-7xl font-bold mb-8 tracking-tight leading-[1.1]">
                        Eleva el estándar de tu <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-500">gestión.</span>
                    </h1>
                    <p class="text-xl text-gray-500 dark:text-gray-400 leading-relaxed">
                        Sistema centralizado para la administración de <span class="text-gray-900 dark:text-gray-200 font-medium">expedientes docentes</span> y control de matrículas, diseñado para instituciones de alto rendimiento.
                    </p>
                </header>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <a href="{{ route('profesores.index') }}" class="card-premium group relative overflow-hidden p-8 rounded-[2rem] bg-white dark:bg-[#0f0f13] shadow-sm">
                        <div class="relative z-10">
                            <div class="w-14 h-14 mb-6 flex items-center justify-center rounded-2xl bg-purple-600 text-white shadow-lg shadow-purple-500/40">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Cuerpo Docente</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">Gestión de expedientes con soporte fotográfico y carga académica detallada.</p>
                            <span class="text-xs font-bold text-purple-600 flex items-center gap-2">
                                CONFIGURAR <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </a>

                    <a href="#" class="card-premium group relative overflow-hidden p-8 rounded-[2rem] bg-white dark:bg-[#0f0f13] shadow-sm">
                        <div class="relative z-10">
                            <div class="w-14 h-14 mb-6 flex items-center justify-center rounded-2xl bg-blue-500 text-white shadow-lg shadow-blue-500/40">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Estudiantes</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">Módulo de seguimiento académico y control de historial de calificaciones.</p>
                            <span class="text-xs font-bold text-blue-500 flex items-center gap-2">
                                EXPLORAR <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </a>

                    <a href="{{ route('profesores.pdf') }}" target="_blank" class="card-premium group relative overflow-hidden p-8 rounded-[2rem] bg-white dark:bg-[#0f0f13] shadow-sm">
                        <div class="relative z-10">
                            <div class="w-14 h-14 mb-6 flex items-center justify-center rounded-2xl bg-gray-900 dark:bg-white text-white dark:text-black shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Reportería</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">Generación de documentos PDF automáticos y analíticas de gestión.</p>
                            <span class="text-xs font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                DESCARGAR <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </a>

                </div>

                <footer class="mt-32 pt-12 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex items-center gap-6">
                        <p class="text-sm font-medium text-gray-400">&copy; {{ date('Y') }} KT&U International.</p>
                        <div class="h-4 w-[1px] bg-gray-300 dark:bg-gray-700"></div>
                        <p class="text-sm font-medium text-gray-400">Masaya, Nicaragua</p>
                    </div>
                    <div class="flex gap-10">
                        <a href="#" class="text-xs font-bold uppercase tracking-widest hover:text-purple-600 transition">Ayuda</a>
                        <a href="#" class="text-xs font-bold uppercase tracking-widest hover:text-purple-600 transition">API</a>
                        <a href="#" class="text-xs font-bold uppercase tracking-widest hover:text-purple-600 transition">Seguridad</a>
                    </div>
                </footer>

            </div>
        </main>

    </body>
</html>