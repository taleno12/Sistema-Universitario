@extends('adminlte::page')

@section('title', 'Gestión de Usuarios')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-users-cog mr-2"></i>Gestión de Usuarios</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-user-plus mr-1"></i> Nuevo Usuario
                </a>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="card card-outline card-primary shadow-lg">
    <div class="card-body">
        <table id="usuariosTable" class="table table-hover table-valign-middle">
            <thead class="bg-light">
                <tr>
                    <th width="60px">Perfil</th>
                    <th>Nombre y Apellido</th>
                    <th>Identificación Digital (Email)</th>
                    <th width="100px">Rol</th>
                    <th width="150px" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $user)
                <tr>
                    <td>
                        <div class="image">
                            @if($user->foto)
                                <img src="{{ asset('storage/' . $user->foto) }}" 
                                     class="img-circle elevation-2" 
                                     style="width: 45px; height: 45px; object-fit: cover;"
                                     alt="User Image">
                            @else
                                <img src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" 
                                     class="img-circle elevation-2" 
                                     style="width: 45px;"
                                     alt="Default Image">
                            @endif
                        </div>
                    </td>
                    <td class="font-weight-bold">{{ $user->nombre }}</td>
                    <td><span class="text-muted"><i class="fas fa-envelope mr-1"></i>{{ $user->email }}</span></td>
                    <td>
                        @if($user->rol == 'admin')
                            <span class="badge badge-danger px-3">Administrador</span>
                        @elseif($user->rol == 'docente')
                            <span class="badge badge-info px-3">Docente</span>
                        @else
                            <span class="badge badge-secondary px-3">{{ ucfirst($user->rol) }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-sm btn-default shadow-sm" title="Editar">
                                <i class="fas fa-edit text-warning"></i>
                            </a>
                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-default shadow-sm" title="Eliminar">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
    <style>
        /* Ajustes para que los botones de la tabla se vean juntos */
        .form-eliminar { display: inline; }
        .table td { vertical-align: middle !important; }
        .badge { font-size: 0.85rem; }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            // Inicialización de DataTables para búsqueda profesional
            $('#usuariosTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                "responsive": true,
                "autoWidth": false,
            });

            // Alerta de confirmación de eliminación profesional
            $('.form-eliminar').submit(function(e){
                e.preventDefault();
                Swal.fire({
                  title: '¿Estás seguro?',
                  text: "Esta acción no se puede revertir.",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Sí, eliminar',
                  cancelButtonText: 'Cancelar'
                }).then((result) => {
                  if (result.isConfirmed) {
                    this.submit();
                  }
                })
            });
        });
    </script>
@stop