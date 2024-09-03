@extends('layouts.app')

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
                            @can('crear-seer')
                                <a class="btn btn-warning" href="{{ route('seer.create') }}"> Nuevo</a>
                            @endcan
                            
                            @can('supervisar-seer')
                                Auxiliares de esa zona
                                Conciliadores de esa zona
                                Notificadores de esa zona
                                fecha
                                <a class="btn btn-warning" href="{{ route('seer.create') }}"> Buscar</a>
                            @endcan

                            @can('ver-seer')
                                <div class="table-responsive">
                                    <table class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Solicitudes</th>
                                            <th style="color: #fff;">Ratificaciones</th>
                                            <th style="color: #fff;">Fecha</th>
                                        </thead>
                                        <tbody>
                                            @foreach($estadisticas as $estadistica)
                                                <tr>
                                                    <td style="display: none;">{{$estadistica->id}}</td>
                                                    <td>{{$estadistica->solicitudes}}</td>
                                                    <td>{{$estadistica->ratificaciones}}</td>
                                                    <td>
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
                                {!! $estadisticas->links() !!}
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

