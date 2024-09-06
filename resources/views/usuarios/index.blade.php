@extends('layouts.app')


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>


@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-usuario')
                                <a class="btn btn-warning" href="{{ route('usuarios.create') }}"> Nuevo</a>
                            @endcan

                            @can('ver-usuario')
                                <div class="table-responsive">
                                <table id="dtExample" class="display">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Nombre</th>
                                            <th style="color: #fff;">E-mail</th>
                                            <th style="color: #fff;">Rol</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($usuarios as $usuario)
                                                <tr>
                                                    <td style="display: none;">{{$usuario->id}}</td>
                                                    <td>{{$usuario->name}}</td>
                                                    <td>{{$usuario->email}}</td>
                                                    <td>                                                
                                                        @if(!empty($usuario->getRoleNames()))
                                                            @foreach($usuario->getRoleNames() as $rolName)
                                                            <h5><span class="badge badge-dark">{{$rolName}}</span></h5>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @can('editar-usuario')
                                                            <a class="btn btn-info" href="{{ route('usuarios.edit', $usuario->id)}}">Editar</a>
                                                        @endcan
                                                        <!--Utilizamos las librerías de laravel collective para hacer la 
                                                        eliminación más sencilla con un formulario utilizando el metodo DELETE-->
                                                        @can('borrar-usuario')
                                                            {!! Form::open(['method'=>'DELETE', 'route'=> ['usuarios.destroy', $usuario->id], 'style'=>'display:inline']) !!}
                                                                {!! Form::submit('Borrar', ['class'=> 'btn btn-danger']) !!}
                                                            {!! Form::close() !!}
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan
                            <!-- Centramos la paginación a la derecha-->
                            <div class="pagination justify-content-end">
                                {!! $usuarios->links() !!}
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    $(document).ready( function () {
        $('#dtExample').DataTable();
    } )
</script>