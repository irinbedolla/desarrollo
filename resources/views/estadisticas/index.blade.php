@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">SEER</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-seer')
                                <a class="btn btn-warning" href="{{ route('seer.create') }}"> Nuevo</a>
                            @endcan
                            
                            @if($userRole[0] == "Delegado")
                                {!! Form::open(array('route'=>'seer.store', 'method'=>'POST')) !!}
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Fecha Inicial</label>
                                            <input type="date" class="form-control" name="fecha_inicial">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Fecha Final</label>
                                            <input type="date" class="form-control" name="fecha_final">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Sede *puedes seleccionar mas de uno.</label>
                                            <select multiple class="form-control" name="sedes[]" style="height: 120%">
                                                <option value="">Seleccione</option>
                                                @foreach($estadisticas as $aKey => $aSport)
                                                    <option value="{{$aKey}}">{{$aSport}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Conciliador *puedes seleccionar mas de uno.</label>
                                            <select multiple class="form-control" name="conciliadores[]" style="height: 120%">
                                                <option value="">Seleccione</option>
                                                @foreach($usuariosconciliador as $user)
                                                    <option value="{{$user['id']}}">{{$user['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label multiple for="name">Auxiliares</label>
                                            <select multiple class="form-control" name="auxiliares[]" style="height: 120%">
                                                <option value="">Seleccione</option>
                                                @foreach($usuariosauxiliares as $user)
                                                    <option value="{{$user['id']}}">{{$user['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label multiple for="name">Notificadores</label>
                                            <select multiple class="form-control" name="notificadores[]" style="height: 120%">
                                                <option value="">Seleccione</option>
                                                @foreach($usuariosnotificadores as $user)
                                                    <option value="{{$user['id']}}">{{$user['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </div>
                                {!! Form::close() !!}
                            @endif

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

