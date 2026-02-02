<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">Gestión Académica</li>

    <li class="nav-item">
        <a href="{{ route('facultades.index') }}" class="nav-link {{ request()->routeIs('facultades.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-university"></i>
            <p>Facultades</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('estudiantes.index') }}" class="nav-link {{ request()->routeIs('estudiantes.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>Estudiantes</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('carreras.index') }}" class="nav-link {{ request()->routeIs('carreras.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>Carreras</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('asignaturas.index') }}" class="nav-link {{ request()->routeIs('asignaturas.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book"></i>
            <p>Asignaturas</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('matriculas.index') }}" class="nav-link {{ request()->routeIs('matriculas.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-signature"></i>
            <p>Matrículas</p>
        </a>
    </li>
</ul>
