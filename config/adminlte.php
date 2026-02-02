<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    */

    'title' => 'Portal KT&U',
    'title_prefix' => 'KT&U | ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Identidad Visual (Logo Universidad)
    |--------------------------------------------------------------------------
    */

    'logo' => '<b>KT&U</b> Universitario',
    'logo_img' => 'vendor/adminlte/dist/img/logo2.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'KT&U Logo',

    /*
    |--------------------------------------------------------------------------
    | Preloader (Animación de Carga)
    |--------------------------------------------------------------------------
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo2.png',
            'alt' => 'Cargando Sistema KT&U...',
            'effect' => 'animation__shake',
            'width' => 500,
            'height' => 500,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu (Menú de Usuario en Navbar)
    |--------------------------------------------------------------------------
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-indigo',
    'usermenu_image' => true, 
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout y Clases de Estilo "Premium"
    |--------------------------------------------------------------------------
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    'classes_auth_card' => 'card-outline card-indigo',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-indigo',

    'classes_body' => '',
    'classes_brand' => 'bg-white', 
    'classes_brand_text' => 'text-indigo',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    
    'classes_sidebar' => 'sidebar-dark-indigo elevation-4',
    'classes_sidebar_nav' => 'nav-flat nav-child-indent',
    
    'classes_topnav' => 'navbar-white navbar-light border-bottom-0',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Configuración del Menú KT&U (ACTUALIZADO PROFESIONAL)
    |--------------------------------------------------------------------------
    */

    'menu' => [
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'Buscar en el sistema...',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscador rápido',
        ],
        
        ['header' => 'PANEL PRINCIPAL'],
        [
            'text' => 'Area general',
            'url'  => 'home',
            'icon' => 'fas fa-tachometer-alt',
        ],

        ['header' => 'ORGANIZACIÓN'],
        [
            'text' => 'Estructura Institucional',
            'icon' => 'fas fa-university',
            'submenu' => [
                [
                    'text' => 'Facultades',
                    'url'  => 'facultades',
                    'icon' => 'fas fa-landmark',
                ],
                [
                    'text' => 'Carreras Profesionales',
                    'url'  => 'carreras',
                    'icon' => 'fas fa-graduation-cap',
                ],
                [
                    'text' => 'Asignaturas / Materias',
                    'url'  => 'asignaturas',
                    'icon' => 'fas fa-book-open',
                ],
            ],
        ],
        [
            'text' => 'Plantilla Docente',
            'url'  => 'profesores',
            'icon' => 'fas fa-chalkboard-teacher',
            
            'label_color' => 'success',
        ],

        ['header' => 'GESTIÓN DE ESTUDIANTES'],
        [
            'text' => 'Listado de Estudiantes',
            'url'  => 'estudiantes',
            'icon' => 'fas fa-user-graduate',
        ],
        [
            'text' => 'Matrículas y Pagos',
            'url'  => 'matriculas',
            'icon' => 'fas fa-file-signature',
        ],
        [
            'text' => 'Registro de Notas',
            'url'  => 'calificaciones',
            'icon' => 'fas fa-star',
            
            'label_color' => 'warning',
        ],

        ['header' => 'SERVICIOS ACADÉMICOS'],
        [
            'text' => 'Horarios de Clases',
            'url'  => 'horarios',
            'icon' => 'fas fa-calendar-alt',
        ],
        [
            'text' => 'Expediente Académico',
            'url'  => 'reportes/kardex',
            'icon' => 'fas fa-file-invoice',
        ],

        ['header' => 'CONFIGURACIÓN Y SISTEMA'],
        [
            'text' => 'Mi Perfil',
            'url'  => 'profile',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'Gestión de Usuarios',
            'url'  => 'usuarios',
            'icon' => 'fas fa-user-shield',
        ],
       [
            'text' => 'Mi Seguridad',
            'url'  => 'admin/seguridad', // Esta es la URL que pusimos en web.php
            'icon' => 'fas fa-fw fa-lock',
            'label_color' => 'success',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins (Activados para funcionalidad completa)
    |--------------------------------------------------------------------------
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js',
                ],
            ],
        ],
    ],

    'livewire' => false,
];